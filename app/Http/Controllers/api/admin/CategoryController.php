<?php

namespace App\Http\Controllers\api\admin;

use App\Exceptions\ApiException;
use App\Http\Controllers\Controller;
use App\Http\Request\Category\CategoryRequest;
use App\Http\Resources\admin\category\CategoryGetAllCollection;
use App\Http\Resources\admin\category\CategoryGetAllResource;
use App\Http\Resources\admin\category\CategoryRecycleBinCollection;
use App\Http\Services\admin\CategoryService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * @var CategoryService
     */
    protected $service;

    /**
     * CategoryController constructor.
     */
    public function __construct()
    {
        $this->service = new CategoryService();
    }

    /**
     * Get all category
     *
     * @param Request $request
     * @return JsonResponse
     * @throws ApiException
     */
    public function findAll(Request $request): JsonResponse
    {
        $fields = $request->all();

        $result = $this->service->list($fields);

        return $this->success($this->formatJson(CategoryGetAllCollection::class, $result));
    }

    /**
     * List category in recycle bin
     *
     * @return JsonResponse
     * @throws ApiException
     */
    public function recycleBin(): JsonResponse
    {
        $result = $this->service->recycleBin();

        return $this->success($this->formatJson(CategoryRecycleBinCollection::class, $result));
    }

    /**
     * Get category by id
     *
     * @param $category
     * @return JsonResponse
     * @throws ApiException
     */
    public function getById($category): JsonResponse
    {
        $result = $this->service->categoryById($category);

        return $this->success($this->formatJson(CategoryGetAllResource::class, $result));
    }

    /**
     * Create new category
     *
     * @param CategoryRequest $request
     * @return JsonResponse
     * @throws ApiException
     */
    public function store(CategoryRequest $request): JsonResponse
    {
        $this->service->create($request);
        $this->message = 'Thêm thàh công.';

        return $this->success();
    }

    /**
     * Update category by id
     *
     * @param CategoryRequest $request
     * @param $category
     * @return JsonResponse
     * @throws ApiException
     */
    public function update(CategoryRequest $request, $category): JsonResponse
    {
        $this->service->update($request, $category);
        $this->message = 'Cập nhật thành công.';

        return $this->success();
    }

    /**
     * Delete category by id
     *
     * @param $category
     * @return JsonResponse
     * @throws ApiException
     */
    public function destroy($category): JsonResponse
    {
        $this->service->delete($category);
        $this->message = 'Xoá thành công.';

        return $this->success();
    }

    /**
     * Disable category by id
     *
     * @param $category
     * @return JsonResponse
     * @throws ApiException
     */
    public function disable($category): JsonResponse
    {
        $result = $this->service->disable($category);
        $this->message = $result;

        return $this->success();
    }

    /**
     * Restore category in recycle bin
     *
     * @param $category
     * @return JsonResponse
     * @throws ApiException
     */
    public function restore($category): JsonResponse
    {
        $this->service->restore($category);
        $this->message = 'Đã khôi phục danh mục.';

        return $this->success();
    }
}
