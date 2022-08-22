<?php

namespace App\Http\Controllers\CMS;

use App\Helpers\NotificationHelper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CMS\Comments;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;

use Auth;

class CommentsController extends Controller
{
    public $baseModel;

    public function __construct()
    {
        $this->baseModel = new Comments();
    }

    public function index(Request $request)
    {
        $page = $request->input('page', 1);
        $rating = $request->input('rating', 1);
        $module = $request->input('module', '');
        $moduleItemId = $request->input('module_item_id', '');

        $filter = [
            'parent_id' => '0',
            'module' => $module,
            'module_item_id' => $moduleItemId,
        ];

        $comments = Comments::search($filter)->paginate(10);

        // View more
        if ($page > 1) {
            return $this->ajaxRespond(
                1,
                '',
                view('tpmeta.pages.comments_items', compact('comments', 'module', 'moduleItemId'))->render()
            );
        }

        $statistic = [
            5 => Comments::search($filter + ['rating' => 5])->count(),
            4 => Comments::search($filter + ['rating' => 4])->count(),
            3 => Comments::search($filter + ['rating' => 3])->count(),
            2 => Comments::search($filter + ['rating' => 2])->count(),
            1 => Comments::search($filter + ['rating' => 1])->count(),
        ];

        // Return comments block
        return $this->ajaxRespond(
            1,
            '',
            view('tpmeta.pages.comments', compact('comments', 'rating', 'module', 'moduleItemId', 'statistic'))->render()
        );
    }

    public function store(Request $request)
    {
        $requestData = $request->all();

        $user = Auth::user();

        $bugs = [];

        if ($request->ajax()) {
            $messages = [
                'content.required' => 'Bạn phải nhập nội dung bình luận',
                'mobile.required' => 'Bạn phải nhập Số điện thoại',
                'name.required' => 'Bạn phải nhập Họ tên',
                'rating.required' => 'Bạn vui lòng đánh giá số sao',
            ];

            $rules = [
                'name' => 'required',
                'mobile' => 'required',
                'content' => 'required',
            ];

            if (!$request->parent_id) {
                $rules['rating'] = 'required';
            }

            $validator = Validator::make($requestData, $rules, $messages);
            if ($validator->fails()) {
                $errors = $validator->errors()->messages();
                foreach ($errors as $error) {
                    $bugs[] = $error[0];
                }
            }

            if (count($bugs)) {
                $message = 'Ops<br/>' . join('<br/>', $bugs);
                return $this->ajaxRespond(0, $message);
            }

            $commentData = [
                'name'  => makeSafe($requestData['name']),
                'mobile' => makeSafe($requestData['mobile']),
                'content' => makeSafe($requestData['content']),
                'parent_id' => $requestData['parent_id'],
                'module' => $requestData['module'],
                'module_item_id' => $requestData['module_item_id'],
                'rating' => $requestData['rating'] ?? 1,
                'created_by' => $user->id ?? 0,
                'status' => 1,
            ];

            $comment = $this->baseModel->create($commentData);

            // Calculate total
            $this->baseModel->calculateComments($requestData['module'], $requestData['module_item_id']);
            // Update updated_at for parent
            if ($requestData['parent_id']) {
                $parent = $this->baseModel->find($requestData['parent_id']);
                $parent->updated_at = date('Y-m-d H:i:s');
                $parent->save();
            }

            // Send to telegram
            $message[] = 'Bạn có một bình luận mới:';
            $message[] = '--------------';
            $message[] = 'Họ tên: '. $comment->name;
            $message[] = 'Số điện thoại: '. $comment->mobile;
            $message[] = 'Link sản phẩm: '. url($comment->item->slug . '-sp' . $comment->item->id . '.html');
            $message[] = '--------------';
            $message[] = 'Nội dung:';
            $message[] =  $comment->content;

            NotificationHelper::sendTelegram(join("\n", $message));

            //$module = $requestData['module_item_id'];
            //$comment->html = view('tpnews.blocks.comment_item', compact('comment', 'module'))->render();

            return $this->ajaxRespond(
                1,
                'Cảm ơn bạn đã gửi Bình luận!',
                $comment
            );

        }

    }

    public function like(Request $request)
    {
        $id = $request->input('id', '');
        $sessionCommentLike = Session::get('session_comment_like_' . $id);

        if (! $sessionCommentLike) {
            Session::put('session_comment_like_' . $id, 1);
            $comment = $this->baseModel->find($id);

            if ($comment) {
                $comment->increment('likes');

                return $this->ajaxRespond(
                    1,
                    '',
                    $comment->likes
                );
            }

        }

    }
}
