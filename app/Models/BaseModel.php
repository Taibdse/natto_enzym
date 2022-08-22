<?php
/**
 * BaseModel
 *
 * BaseModel for app
 * php version 7.0
 *
 * @category   StatusCommunication
 * @package    App\Models
 * @subpackage BaseModel
 * @author     VinhCV <vinh@nomeo.be>
 * @license    https://www.gnu.org/licenses/gpl-3.0.txt GNU/GPLv3
 * @link       https://status.nomeo.be
 * @since      1.0.0
 */
namespace App\Models;

use App\Helpers\StringHelper;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;
use Carbon\Carbon;
use DB;
use Auth;
use Session;
use Cache;

/**
 * Class BaseModel
 *
 * @category   StatusCommunication
 * @package    App\Models
 * @subpackage BaseModel
 * @author     VinhCV <vinh@nomeo.be>
 * @license    https://www.gnu.org/licenses/gpl-3.0.txt GNU/GPLv3
 * @link       https://status.nomeo.be
 */
class BaseModel extends Model
{
    protected $parentField = false;
    protected $orderField = false;
    protected $slugField = false;
    protected $enableLog = false;

    const TYPE_DELETE = 0;
    const TYPE_CREATE = 1;
    const TYPE_UPDATE = 2;
    /**
     * Boot function
     *
     * @return void
     */
    public static function boot()
    {
        parent::boot();

        static::created(
            function ($data) {
                $user = Auth::user();

                if ($data->enableLog) {
                    self::insertLog($data->getTable(), 'id', '', $data->title, $data->id, self::TYPE_CREATE);
                }

                if (Schema::hasColumn($data->table, 'created_by')) {
                    self::where('id', $data->id)
                        ->update(['created_by' => $user ? $user->id : 0]);
                }

                if ($data->orderField) {
                    if ($data->parentField) {
                        self::where('id', $data->id)
                        ->update(
                            [
                                $data->orderField => self::where(
                                    $data->parentField,
                                    $data->{$data->parentField}
                                )->max($data->orderField) + 1
                            ]
                        );
                    } else {
                        self::where('id', $data->id)
                            ->update(
                                [
                                    $data->orderField => self::max($data->orderField)
                                        + 1
                                ]
                            );
                    }
                }

                self::reOrder($data);
                self::generateSlug($data);
                self::deleteCache($data);
                return true;
            }
        );

        static::deleting(
            function ($data) {
                if ($data->enableLog) {
                    self::insertLog($data->getTable(), 'id', $data->title, '', $data->id, self::TYPE_DELETE);
                }

                self::reOrder($data);
                self::deleteCache($data);
                return true;
            }
        );

        static::updated(
            function ($data) {
                $user = Auth::user();
                if (Schema::hasColumn($data->table, 'updated_by')) {
                    self::where('id', $data->id)
                        ->update(['updated_by' => $user ? $user->id : 0]);
                }

                self::generateSlug($data);
                self::deleteCache($data);

                $dirty = $data->getDirty();
                if ($data->enableLog) {
                    foreach ($dirty as $key => $value) {
                        if($key != 'updated_at') {
                            self::insertLog($data->getTable(), $key , $data->original[$key], $value, $data->id, self::TYPE_UPDATE);
                        }
                    }
                }
                return true;
            }
        );
    }

    public static function deleteCache($data)
    {
        // Delete cache when admin update data
        if (Auth::guard('admin')->check()) {
            Cache::flush();
            @unlink(public_path('index.html'));
        }
    }

    public static function insertLog($table, $field, $before, $after, $item_id, $type)
    {
        $user = Auth::user();
        if (!$user) return;

        DB::table('audits')->insert(
            [
                'created_by' => $user->id,
                'module' => $table,
                'type_changes' => $type == self::TYPE_CREATE ? 'id' : $field,
                'before' =>  $type == self::TYPE_CREATE ? '' : $before,
                'after' => $after,
                'module_item_id' => $item_id,
                'action' => $type,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ]
        );
    }

    public static function generateSlug($data)
    {
        if ($data->slugField) {
            foreach ($data->slugField as $slugField => $valueField){
                self::where('id', $data->id)
                    ->update([
                        $slugField => StringHelper::removeSign($data->{$valueField}, true, 50)
                    ]);
            }
        }
    }

    /**
     * Set order field
     *
     * @param integer $id     Field id value
     * @param string  $action Action name
     *
     * @return void
     */
    public static function setOrder($id, $action = 'up')
    {
        if ($action == 'up') {
            $item = self::findOrFail($id);
            if ($item && $item->{$item->orderField} > 1) {
                $mustChange = DB::table($item->table)
                    ->where($item->orderField, '<', $item->{$item->orderField})
                    ->where($item->primaryKey, '!=', $item->id)
                    ->orderBy($item->orderField, 'DESC');

                if ($item->parentField) {
                    $mustChange = $mustChange->where(
                        $item->parentField,
                        $item->{$item->parentField}
                    );
                }
                $mustChange = $mustChange->first();

                if ($mustChange) {
                    DB::table($item->table)
                        ->where($item->primaryKey, $mustChange->{$item->primaryKey})
                        ->update(
                            [
                            $item->orderField => $item->{$item->orderField}
                            ]
                        );
                }

                $item->{$item->orderField} = $item->{$item->orderField} - 1;
                $item->save();

                self::reOrder($item);
            }
        }

        if ($action == 'down') {
            $item = self::findOrFail($id);
            if ($item) {
                $mustChange = DB::table($item->table)
                    ->where($item->orderField, '>', $item->{$item->orderField})
                    ->where($item->primaryKey, '!=', $item->id)
                    ->orderBy($item->orderField, 'ASC');

                if ($item->parentField) {
                    $mustChange = $mustChange->where(
                        $item->parentField,
                        $item->{$item->parentField}
                    );
                }
                $mustChange = $mustChange->first();

                if ($mustChange) {
                    DB::table($item->table)
                        ->where($item->primaryKey, $mustChange->{$item->primaryKey})
                        ->update(
                            [
                            $item->orderField => $item->{$item->orderField}
                            ]
                        );
                }

                $item->{$item->orderField} = $item->{$item->orderField} + 1;
                $item->save();
            }

            self::reOrder($item);
        }
    }

    /**
     * Re order items
     *
     * @param object $data Object data
     *
     * @return void
     */
    public static function reOrder($data)
    {
        if ($data->orderField) {
            $query = DB::table($data->table)->orderBy($data->orderField, 'ASC');

            if ($data->parentField) {
                $query = $query->where(
                    $data->parentField,
                    $data->{$data->parentField}
                );
            }

            $items = $query->get();
            if ($items) {
                foreach ($items as $k => $item) {
                    DB::table($data->table)
                        ->where($data->primaryKey, $item->{$data->primaryKey})
                        ->update(
                            [
                            $data->orderField => $k + 1
                            ]
                        );
                }
            }
        }
    }

    /**
     * Set field value
     *
     * @param integer $id    Field ID
     * @param string  $field Field name
     * @param string  $value Field value
     *
     * @return void
     */
    public static function setFieldValue($id, $field, $value)
    {
        $item = self::findOrFail($id);
        $item->{$field} = $value;
        $item->save();
    }


    /**
     * Get select box data
     *
     * @param string $titleField   Title field
     * @param string $defaultTitle Default first option title
     *
     * @return array
     */
    public static function getSelectBox(
        $titleField = 'title',
        $defaultTitle = '--Select--'
    ) {
        $items = self::pluck($titleField, 'id')->toArray();
        return $defaultTitle ? [0 => $defaultTitle] + $items : $items;
    }

    /**
     * Get created by user
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function createdByUser()
    {
        return $this->hasOne('App\Models\User', 'id', 'created_by')->withDefault(
            function ($user) {
                $user->name = 'N/A';
                $user->id = 0;
            }
        );
    }

    /**
     * Get updated by user
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function updatedByUser()
    {
        return $this->hasOne('App\Models\User', 'id', 'updated_by')->withDefault(
            function ($user) {
                $user->name = 'N/A';
                $user->id = 0;
            }
        );
    }

    public static function getNavigation($catId) {
        $cat = self::find($catId);

        $category = array();
        if (is_object($cat)) {
            $category[] = $cat;
            if ($cat->parent_id) {
                $category = array_merge($category, self::getNavigation($cat->parent_id));
            }
        }

        return array_reverse($category);
    }

    public static function getChildrenIds($catId)
    {
        $childIds = [$catId];

        $subs = self::where('parent_id', $catId)->get();
        foreach ($subs as $sub) {
            $childIds[] = $sub->id;
            $childIds = array_merge($childIds, self::getChildrenIds($sub->id));
        }

        return $childIds;
    }

    public function incrementSession($columnName = '')
    {
        $sessionViews = Session::get('session_' . $columnName . $this->id, '');
        if (! $sessionViews) {
            Session::put('session_' . $columnName . $this->id, 1);
            $this->increment($columnName);
        }
    }

    public static function getCategoryTree($level=0, $prefix='', $activeOnly=true, $flatTree = true) {
        $query = self::where('parent_id', $level)
            ->orderBy('ordering', 'asc');
        if ($activeOnly) {
            $query->where('status', 4);
        }else{
            $query->where('status', '>=', 1);
        }

        $rows = $query->get();
        $category = array();
        if (count($rows) > 0) {
            foreach ($rows as $row) {
                if ($flatTree) {
                    $row->title = $prefix . $row->title;
                    $category[] = $row;
                    $category = array_merge($category, self::getCategoryTree($row->id, $prefix . '|---', $activeOnly));

                }else{

                    $row->items = self::getCategoryTree($row->id, $prefix . '', $activeOnly, $flatTree);
                    $category[] = $row;
                }
            }
        }

        return $category;
    }

    public function getCategorySelect($level = 0, $prefix = '', $activeOnly = true){
        $selectCat = $this->getCategoryTree($level, $prefix, $activeOnly);
        $parentCat = array();
        foreach ($selectCat as $row){
            $parentCat[$row->id] = $row->title;
        }
        $selectCat = array('0' => '--- Chọn danh mục ---') + $parentCat;

        return $selectCat;
    }
}
