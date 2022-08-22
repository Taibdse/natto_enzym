<?php
/**
 * Created by PhpStorm.
 * User: Quyen
 * Date: 11/19/2019
 * Time: 9:07 AM
 */

namespace App\Models\CMS;

use App\Models\BaseModel;
use App\Models\CMS\Tags;

class TagsModules extends BaseModel
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'cms_tags_modules';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'id',
        'module',
        'module_item_id',
        'tag_id',
    ];

    public static function search($filter = [], $orderBy = 'ID', $orderType = 'DESC', $activeOnly = true)
    {
        $query = self::select('*')->orderBy($orderBy, $orderType);

        if (isset($filter['keyword']) && $filter['keyword']) {
            $query->where('title', 'LIKE', "%".$filter['keyword']."%");
        }

        if (isset($filter['featured']) && $filter['featured']) {
            $query->where('featured', $filter['featured']);
        }

        if ($activeOnly) {
            $query->where('status', 4);
        }else{
            $query->where('status', '>=', 1);
        }

        return $query;
    }

    public function tag()
    {
        return $this->hasOne(Tags::class, 'id', 'tag_id');
    }

    public static function createTags($module, $itemId, $data)
    {
        $existIds = [0];
        $tags = $data['tags'] ?? null;

        if ($tags && count($tags)) {
            foreach ($tags as $tagId){
                if (intval($tagId)) {
                    $item = TagsModules::updateOrCreate(
                        [
                            'module' => $module,
                            'module_item_id' => $itemId,
                            'tag_id' => $tagId,
                        ],
                        [
                            'module' => $module,
                            'module_item_id' => $itemId,
                            'tag_id' => $tagId,
                        ]
                    );

                    echo $item->id;
                    $existIds[] = $item->id;
                }
                else {
                    $tag = Tags::create([
                        'title' => $tagId
                    ]);

                    $item = TagsModules::create([
                        'module' => $module,
                        'module_item_id' => $itemId,
                        'tag_id' => $tag->id,
                    ]);

                    $existIds[] = $item->id;
                }
            }
        }

        TagsModules::where(['module' => $module, 'module_item_id' => $itemId])
            ->whereNotIn('id', $existIds)
            ->delete();
    }
}
