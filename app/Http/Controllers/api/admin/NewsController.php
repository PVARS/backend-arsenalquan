<?php

namespace App\Http\Controllers\api\admin;

use App\Http\Controllers\Controller;
use App\Http\Request\News\NewsRequest;
use App\Models\Category;
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
            $listNews = News::whereNull('deleted_at')
                ->where('approve', '=', true)
                ->orderby('created_at', 'desc')
                ->get();

            return $this->responseData($listNews);
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
            $listNews = News::whereNull('deleted_at')
                ->where('approve', '=', false)
                ->orderBy('created_at', 'asc')
                ->get();

            return $this->responseData($listNews);
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
            return $this->responseData(News::findOrFail($news));
        } catch (ModelNotFoundException $exception){
            return $this->sendMessage('Không tìm thấy', 404);
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
            $listNews = News::join('category', 'news.category_id', '=', 'category.id')
                ->where('news.category_id', $category)
                ->orderBy('news.created_at', 'desc')
                ->get();
            return $this->responseData($listNews);
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
            if (auth()->user()->role_id != 1 || auth()->user()->role_id != 2){
                $approve = false;
            }

            try {
                Category::findOrFail($fields['category_id']);
            } catch (ModelNotFoundException $exception){
                return $this->sendMessage('Không tìm thấy danh mục', 404);
            }

            News::create([
                'category_id' => $fields['category_id'],
                'title' => $fields['title'],
                'short_description' => $fields['short_description'],
                'thumbnail' => $fields['thumbnail'],
                'content' => Auth::id(),
                'key_word' => $fields['key_word'],
                'slug' => $fields['slug'],
                'approve' => $approve,
                'approved_by' => Auth::id(),
                'created_at' => Carbon::now('Asia/Ho_Chi_Minh'),
                'created_by' => Auth::id()
            ]);

            return $this->sendMessage('Tạo thành công');
        } catch (Exception $exception){
            return $this->sendError500($exception->getMessage());
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
            if (auth()->user()->role_id != 1 || auth()->user()->role_id != 2){
                $approve = false;
            }

            try {
                Category::findOrFail($fields['category_id']);
            } catch (ModelNotFoundException $exception){
                return $this->sendMessage('Không tìm thấy danh mục', 404);
            }

            $isUpdate = News::where('id', $news)->update([
                'category_id' => $fields['category_id'],
                'title' => $fields['title'],
                'short_description' => $fields['short_description'],
                'thumbnail' => $fields['thumbnail'],
                'content' => Auth::id(),
                'key_word' => $fields['key_word'],
                'slug' => $fields['slug'],
                'approve' => $approve,
                'approved_by' => Auth::id(),
                'updated_at' => Carbon::now('Asia/Ho_Chi_Minh'),
                'updated_by' => Auth::id()
            ]);
            if (!$isUpdate){
                return $this->sendMessage('Không tìm thấy');
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

            if ($result->update(['approve' => true, 'approved_by' => Auth::id()]))
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
            try {
                $result = News::findOrFail($news);
            } catch (ModelNotFoundException $exception){
                return $this->sendMessage('Không tìm thấy', 404);
            }

            if ($result->deleted_at){
                return $this->sendMessage('Không tìm thấy', 404);
            }

            if ($result->update(['deleted_at' => Carbon::now('Asia/Ho_Chi_Minh')]))
                return $this->sendMessage('Xoá thành công');
        } catch (Exception $exception){
            return $this->sendError500();
        }
    }
}
