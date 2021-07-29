<?php

namespace App\Http\Controllers\api\admin;

use App\Http\Controllers\Controller;
use App\Http\Request\Category\CategoryRequest;
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
            $listRole = Category::all()
                ->whereNull('deleted_at');

            return $this->responseData($listRole);
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
            return $this->responseData(Category::findOrFail($category));
        } catch (ModelNotFoundException $exception){
            return $this->sendMessage('Không tìm thấy', 404);
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

            $isUpdate = Category::where('id', $category)->update([
                'category_name' => $fields['category_name'],
                'icon' => $icon,
                'slug' => $slug,
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
     * Delete category by id
     *
     * @param $category
     * @return JsonResponse
     */
    public function destroy($category): JsonResponse
    {
        try {
            try {
                $result = Category::findOrFail($category);
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
                return $this->sendMessage('Không tìm thấy', 404);
            }

            if ($result->disabled == 0) {
                $status = 1;
                $message = 'Khoá thành công';
            } else {
                $status = 0;
                $message = 'Mở khoá thành công';
            }

            if ($result->update(['disabled' => $status]))
                return $this->sendMessage($message);
        } catch (Exception $exception){
            return $this->sendError500();
        }
    }
}
