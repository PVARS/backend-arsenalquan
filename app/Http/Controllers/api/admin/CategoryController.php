<?php

namespace App\Http\Controllers\api\admin;

use App\Http\Controllers\Controller;
use App\Http\Request\Category\CategoryRequest;
use App\Http\Resources\admin\category\CategoryGetAllCollection;
use App\Http\Resources\admin\category\CategoryRecycleBinCollection;
use App\Models\Category;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\JsonResponse;
use \Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Get all category
     *
     * @return JsonResponse
     */
    public function findAll(): JsonResponse
    {
        try {
            $result = Category::join('user', 'user.id', '=', 'category.created_by')
                ->whereNull('category.deleted_at')
                ->orderby('disabled', 'asc')
                ->orderby('category.created_at', 'desc')
                ->select('category.*', 'user.login_id')
                ->get();

            return $this->responseData($this->formatJson(CategoryGetAllCollection::class, $result));
        } catch (Exception $exception){
            return $this->sendError500();
        }
    }

    /**
     * List category in recycle bin
     *
     * @return JsonResponse
     */
    public function recycleBin(): JsonResponse
    {
        try {
            $result = Category::join('user', 'user.id', '=', 'category.created_by')
                ->whereNotNull('category.deleted_at')
                ->orderby('category.deleted_at', 'desc')
                ->select('category.*', 'user.login_id')
                ->get();

            return $this->responseData($this->formatJson(CategoryRecycleBinCollection::class, $result));
        } catch (Exception $exception){
            return $this->sendError500();
        }
    }

    /**
     * Get category by id
     *
     * @param $category
     * @return JsonResponse
     */
    public function getById($category): JsonResponse
    {
        try {
            $result = Category::join('user', 'user.id', '=', 'category.created_by')
                ->whereNull('category.deleted_at')
                ->where('category.id', $category)
                ->orderby('category.created_at', 'desc')
                ->select('category.*', 'user.login_id')
                ->get();

            return $this->responseData($this->formatJson(CategoryGetAllCollection::class, $result));
        } catch (Exception $exception){
            return $this->sendError500();
        }
    }

    /**
     * Create new category
     *
     * @param CategoryRequest $request
     * @return JsonResponse
     */
    public function store(CategoryRequest $request): JsonResponse
    {
        try {
            $fields = $request->all();
            $slug = Str::slug($fields['category_name']);
            $icon = null;

            if (isset($fields['icon'])){
                $icon = $fields['icon'];
            }

            Category::create([
                'category_name' => $fields['category_name'],
                'icon' => $icon,
                'slug' => $slug,
                'created_at' => Carbon::now('Asia/Ho_Chi_Minh'),
                'created_by' => Auth::id()
            ]);

            return $this->sendMessage('Tạo thành công');
        } catch (Exception $exception){
            return $this->sendError500();
        }
    }

    /**
     * Update category by id
     *
     * @param CategoryRequest $request
     * @param $category
     * @return JsonResponse
     */
    public function update(CategoryRequest $request, $category): JsonResponse
    {
        try {
            $fields = $request->all();
            $slug = Str::slug($fields['category_name']);
            $icon = null;

            if (isset($fields['icon'])){
                $icon = $fields['icon'];
            }

            $result = Category::whereNull('deleted_at')
                ->where('id', $category)
                ->update([
                    'category_name' => $fields['category_name'],
                    'icon' => $icon,
                    'slug' => $slug,
                    'updated_at' => Carbon::now('Asia/Ho_Chi_Minh'),
                    'updated_by' => Auth::id()
            ]);

            if (!$result){
                return $this->sendMessage('Không tìm thấy danh mục');
            }

            return $this->sendMessage('Cập nhật thành công');
        } catch (Exception $exception){
            return $this->sendError500();
        }
    }

    /**
     * Delete category by id
     *
     * @param $category
     * @return JsonResponse
     */
    public function destroy($category): JsonResponse
    {
        try {
            $result = Category::whereNull('deleted_at')
                ->where('id', $category)
                ->update(['deleted_at' => Carbon::now('Asia/Ho_Chi_Minh')]);

            if (!$result){
                return $this->sendMessage('Không tìm thấy danh mục', 404);
            }

            return $this->sendMessage('Xoá thành công');
        } catch (Exception $exception){
            return $this->sendError500();
        }
    }

    /**
     * Disable category by id
     *
     * @param $category
     * @return JsonResponse
     */
    public function disable($category): JsonResponse
    {
        try {
            try {
                $result = Category::findOrFail($category);
            } catch (ModelNotFoundException $exception){
                return $this->sendMessage('Danh mục không tồn tại', 404);
            }

            if ($result->disabled == 0) {
                $status = true;
                $message = 'Đã khoá';
            } else {
                $status = false;
                $message = 'Mở khoá thành công';
            }

            Category::whereNull('deleted_at')
                ->where('id', $category)
                ->update(['disabled' => $status]);

            return $this->sendMessage($message);
        } catch (Exception $exception){
            return $this->sendError500();
        }
    }

    /**
     * Restore category in recycle bin
     *
     * @param $category
     * @return JsonResponse
     */
    public function restore($category): JsonResponse
    {
        try {
            $result = Category::whereNotNull('deleted_at')
                ->where('id', $category)
                ->update(['deleted_at' => null]);

            if (!$result){
                return $this->sendMessage('Không tìm thấy! Danh mục có thể đã được khôi phục', 404);
            }

            return $this->sendMessage('Đã khôi phục danh mục');
        } catch (Exception $exception){
            return $this->sendError500();
        }
    }
}
