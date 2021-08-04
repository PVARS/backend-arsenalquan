<?php

namespace App\Http\Controllers\api\admin;

use App\Http\Controllers\Controller;
use App\Http\Request\News\NewsRequest;
use App\Http\Resources\admin\news\NewsRecycleBinCollection;
use App\Http\Resources\admin\news\NewsGetAllCollection;
use App\Http\Resources\admin\news\NewsRecycleBinResource;
use App\Models\News;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class NewsController extends Controller
{
    /**
     * Get all news
     *
     * @return JsonResponse
     */
    public function findAll(): JsonResponse
    {
        try {
            $result = News::join('category', 'category.id', '=', 'news.category_id')
                ->join('user', 'user.id', '=', 'news.created_by')
                ->whereNull('news.deleted_at')
                ->where('news.approve', '=', true)
                ->where('category.disabled', false)
                ->whereNull('category.deleted_at')
                ->orderby('news.created_at', 'desc')
                ->select('news.*', 'category.category_name', 'user.login_id')
                ->get();

            return $this->responseData($this->formatJson(NewsGetAllCollection::class, $result));
        } catch (Exception $exception){
            return $this->sendError500();
        }
    }

    /**
     * Get all pending news
     *
     * @return JsonResponse
     */
    public function findPendingNews(): JsonResponse
    {
        try {
            $result = News::join('category', 'category.id', '=', 'news.category_id')
                ->join('user', 'user.id', '=', 'news.created_by')
                ->whereNull('news.deleted_at')
                ->where('news.approve', '=', false)
                ->where('category.disabled', false)
                ->whereNull('category.deleted_at')
                ->orderBy('news.created_at', 'asc')
                ->select('news.*', 'category.category_name', 'user.login_id')
                ->get();

            return $this->responseData($this->formatJson(NewsGetAllCollection::class, $result));
        } catch (Exception $exception){
            return $this->sendError500();
        }
    }

    /**
     * Get news by id
     *
     * @param $news
     * @return JsonResponse
     */
    public function getById($news): JsonResponse
    {
        try {
            $result = News::join('category', 'category.id', '=', 'news.category_id')
                ->join('user', 'user.id', '=', 'news.created_by')
                ->whereNull('news.deleted_at')
                ->where('news.id', $news)
                ->where('category.disabled', false)
                ->whereNull('category.deleted_at')
                ->orderBy('news.created_at', 'asc')
                ->select('news.*', 'category.category_name', 'user.login_id')
                ->get();

            return $this->responseData($this->formatJson(NewsGetAllCollection::class, $result));
        } catch (Exception $exception){
            return $this->sendError500();
        }
    }

    /**
     * Filter news by category
     *
     * @param $category
     * @return JsonResponse
     */
    public function findNewsByCategory($category): JsonResponse
    {
        try {
            $result = News::join('category', 'news.category_id', '=', 'category.id')
                ->join('user', 'user.id', '=', 'news.created_by')
                ->whereNull('news.deleted_at')
                ->where('news.category_id', $category)
                ->where('news.approve', '=', true)
                ->where('category.disabled', false)
                ->whereNull('category.deleted_at')
                ->orderBy('news.created_at', 'desc')
                ->select('news.*', 'category.category_name', 'user.login_id')
                ->get();

            return $this->responseData($this->formatJson(NewsGetAllCollection::class, $result));
        } catch (Exception $exception){
            return $this->sendError500();
        }
    }

    /**
     * List news in recycle bin
     *
     * @return JsonResponse
     */
    public function recycleBin(): JsonResponse
    {
        try {
            $result = News::join('category', 'news.category_id', '=', 'category.id')
                ->join('user', 'user.id', '=', 'news.created_by')
                ->whereNotNull('news.deleted_at')
                ->where('category.disabled', false)
                ->whereNull('category.deleted_at')
                ->orderby('news.deleted_at', 'asc')
                ->select('news.*', 'category.category_name', 'user.login_id')
                ->get();

            return $this->responseData($this->formatJson(NewsRecycleBinCollection::class, $result));
        } catch (Exception $exception){
            return $this->sendError500();
        }
    }

    /**
     * Create new post
     *
     * @param NewsRequest $request
     * @return JsonResponse
     */
    public function store(NewsRequest $request): JsonResponse
    {
        try {
            $fields = $request->all();

            $approve = true;
            $approvedBy = auth()->user()->login_id;
            if (auth()->user()->role_id != 1 || auth()->user()->role_id != 2){
                $approve = false;
                $approvedBy = null;
            }

            if ($this->findCategory($fields['category_id']) != true){
                return $this->sendMessage('Không tìm thấy! Danh mục đã bị xoá hoặc đã bị vô hiệu hoá', 404);
            }

            $result = News::create([
                    'category_id' => $fields['category_id'],
                    'title' => $fields['title'],
                    'short_description' => $fields['short_description'],
                    'thumbnail' => $fields['thumbnail'],
                    'content' => Auth::id(),
                    'key_word' => $fields['key_word'],
                    'slug' => $fields['slug'],
                    'approve' => $approve,
                    'approved_by' => $approvedBy,
                    'created_at' => Carbon::now('Asia/Ho_Chi_Minh'),
                    'created_by' => Auth::id()
            ]);

            if (!$result){
                return $this->sendMessage('Thêm thất bại', 400);
            }

            return $this->sendMessage('Tạo thành công', 201);
        } catch (Exception $exception){
            return $this->sendError500();
        }
    }

    /**
     * Update news by id
     *
     * @param NewsRequest $request
     * @param $news
     * @return JsonResponse
     */
    public function update(NewsRequest $request, $news): JsonResponse
    {
        try {
            $fields = $request->all();

            $approve = true;
            $approvedBy = auth()->user()->login_id;
            if (auth()->user()->role_id != 1 || auth()->user()->role_id != 2){
                $approve = false;
                $approvedBy = null;
            }

            if ($this->findCategory($fields['category_id']) != true){
                return $this->sendMessage('Không tìm thấy! Danh mục đã bị xoá hoặc đã bị vô hiệu hoá', 404);
            }

            $result = News::join('category', 'news.category_id', '=', 'category.id')
                ->where('news.id', $news)
                ->whereNull('news.deleted_at')
                ->whereNull('category.deleted_at')
                ->where('category.disabled', false)
                ->update([
                    'news.category_id' => $fields['category_id'],
                    'news.title' => $fields['title'],
                    'news.short_description' => $fields['short_description'],
                    'news.thumbnail' => $fields['thumbnail'],
                    'news.content' => Auth::id(),
                    'news.key_word' => $fields['key_word'],
                    'news.slug' => $fields['slug'],
                    'news.approve' => $approve,
                    'news.approved_by' => $approvedBy,
                    'news.updated_at' => Carbon::now('Asia/Ho_Chi_Minh'),
                    'news.updated_by' => Auth::id()
            ]);

            if (!$result){
                return $this->sendMessage('Không tìm thấy! Bài viết có thể đã bị xoá hoặc danh mục đã bị vô hiệu hoá', 404);
            }
            return $this->sendMessage('Cập nhật thành công');
        } catch (Exception $exception){
            return $this->sendError500();
        }
    }

    /**
     * Approve news
     *
     * @param $news
     * @return JsonResponse
     */
    public function approve($news): JsonResponse
    {
        try {
            try {
                $result = News::findOrFail($news);
            } catch (ModelNotFoundException $exception){
                return $this->sendMessage('Không tìm thấy', 404);
            }

            if ($result->approve == true){
                return $this->sendMessage('Bài viết này đã được phê duyệt', 404);
            }

            if ($result->update(['approve' => true, 'approved_by' => auth()->user()->login_id])) // 0: false; 1: true
                return $this->sendMessage('Đã duyệt');
        } catch (Exception $exception){
            return $this->sendError500();
        }
    }

    /**
     * Delete news by id
     *
     * @param $news
     * @return JsonResponse
     */
    public function destroy($news): JsonResponse
    {
        try {
            $result = News::join('category', 'news.category_id', '=', 'category.id')
                ->whereNull('category.deleted_at')
                ->where('category.disabled', false)
                ->whereNull('news.deleted_at')
                ->where('news.id', $news)
                ->update([
                    'news.approve' => false,
                    'news.deleted_at' => Carbon::now('Asia/Ho_Chi_Minh')
                ]);

            if (!$result){
                return $this->sendMessage('Không tìm thấy! Bài viết có thể đã bị xoá hoặc danh mục đã bị vô hiệu hoá', 404);
            }

            return $this->sendMessage('Xoá thành công');
        } catch (Exception $exception){
            return $this->sendError500();
        }
    }

    /**
     * Restore news in recycle bin
     *
     * @param $news
     * @return JsonResponse
     */
    public function restore($news): JsonResponse
    {
        $result = News::whereNotNull('deleted_at')
            ->where('id', $news)
            ->update(['deleted_at' => null]);

        if (!$result){
            return $this->sendMessage('Không tìm thấy! Bài viết có thể đã được khôi phục', 404);
        }

        return $this->sendMessage('Đã khôi phục bài viết');
    }
}
