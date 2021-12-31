<?php

namespace App\Http\Controllers\api\admin;

use App\Exceptions\ApiException;
use App\Http\Controllers\Controller;
use App\Http\Request\News\NewsRequest;
use App\Http\Resources\admin\news\NewsGetAllResource;
use App\Http\Resources\admin\news\NewsRecycleBinCollection;
use App\Http\Resources\admin\news\NewsGetAllCollection;
use App\Http\Services\admin\NewsService;
use Illuminate\Http\JsonResponse;

class NewsController extends Controller
{
    protected $service;

    public function __construct()
    {
        $this->service = new NewsService();
    }

    /**
     * Get all news
     *
     * @return JsonResponse
     * @throws ApiException
     */
    public function findAll(): JsonResponse
    {
        $result = $this->service->list();

        return $this->success($this->formatJson(NewsGetAllCollection::class, $result));
    }

    /**
     * Get all pending news
     *
     * @return JsonResponse
     * @throws ApiException
     */
    public function findPendingNews(): JsonResponse
    {
        $result = $this->service->listNewsPending();

        return $this->success($this->formatJson(NewsGetAllCollection::class, $result));
    }

    /**
     * Get news by id
     *
     * @param $news
     * @return JsonResponse
     * @throws ApiException
     */
    public function getById($news): JsonResponse
    {
        $result = $this->service->getById($news);

        return $this->success($this->formatJson(NewsGetAllCollection::class, $result));
    }

    /**
     * Filter news by category
     *
     * @param $category
     * @return JsonResponse
     * @throws ApiException
     */
    public function findNewsByCategory($category): JsonResponse
    {
        $result = $this->service->getNewsByCategory($category);

        return $this->success($this->formatJson(NewsGetAllCollection::class, $result));
    }

    /**
     * List news in recycle bin
     *
     * @return JsonResponse
     * @throws ApiException
     */
    public function recycleBin(): JsonResponse
    {
        $result = $this->service->recycleBin();

        return $this->success($this->formatJson(NewsRecycleBinCollection::class, $result));
    }

    /**
     * Create new post
     *
     * @param NewsRequest $request
     * @return JsonResponse
     * @throws ApiException
     */
    public function store(NewsRequest $request): JsonResponse
    {
        $fields = $request->all();

        $result = $this->service->createNews($fields);
        $this->message = 'Thêm thành công.';

        return $this->success($this->formatJson(NewsGetAllResource::class, $result), 201);
    }

    /**
     * Update news by id
     *
     * @param NewsRequest $request
     * @param $news
     * @return JsonResponse
     * @throws ApiException
     */
    public function update(NewsRequest $request, $news): JsonResponse
    {
        $fields = $request->all();

        $result = $this->service->updateNews($fields, $news);
        $this->message = 'Cập nhật thành công.';

        return $this->success($this->formatJson(NewsGetAllResource::class, $result), 200);
    }

    /**
     * Approve news
     *
     * @param $news
     * @return JsonResponse
     * @throws ApiException
     */
    public function approve($news): JsonResponse
    {
        $this->service->approve($news);
        $this->message = 'Đã duyệt.';

        return $this->success();
    }

    /**
     * Delete news by id
     *
     * @param $news
     * @return JsonResponse
     * @throws ApiException
     */
    public function destroy($news): JsonResponse
    {
        $this->service->delete($news);
        $this->message = 'Đã xoá.';

        return $this->success();
    }

    /**
     * Restore news in recycle bin
     *
     * @param $news
     * @return JsonResponse
     * @throws ApiException
     */
    public function restore($news): JsonResponse
    {
        $this->service->restore($news);
        $this->message = 'Đã khôi phục bài viết.';

        return $this->success();
    }
}
