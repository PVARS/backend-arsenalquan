<?php


namespace App\Http\Services\admin;

use App\Exceptions\ApiException;
use App\Http\Repositories\admin\CategoryRepository;
use App\Http\Repositories\admin\NewsRepository;
use App\Http\Services\Service;
use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;

class CategoryService extends Service
{
    /**
     * @var CategoryRepository
     */
    protected $repository;

    /**
     * CategoryService constructor.
     */
    public function __construct()
    {
        $this->repository = new CategoryRepository();
    }

    /**
     * Get all category
     *
     * @param $request
     * @return mixed
     * @throws ApiException
     */
    public function list($request)
    {
        $input = [
            'category_name' => isset($request['category_name']) ? $request['category_name'] : '',
            'full_name' => isset($request['full_name']) ? $request['full_name'] : '',
            'status' => isset($request['status']) ? $request['status'] : '',
        ];

        try {
            $result = $this->repository->list($input);
        } catch (\Exception $e) {
            throw new ApiException('AQ-0000');
        }

        return $result;
    }

    /**
     * Get category by id
     *
     * @param $category
     * @return mixed
     * @throws ApiException
     */
    public function categoryById($category)
    {
        try {
            $result = $this->repository->getById($category);
        } catch (\Exception $e) {
            throw new ApiException('AQ-0000');
        }

        return $result;
    }

    /**
     * Find or fail category
     *
     * @param $category
     * @return
     * @throws ApiException
     */
    public function categoryFindOrFail($category)
    {
        try {
            return Category::findOrFail($category);
        } catch (ModelNotFoundException $e) {
            throw new ApiException('AQ-0003', 404);
        }
    }

    /**
     * List category in recycle bin
     *
     * @return mixed
     * @throws ApiException
     */
    public function recycleBin()
    {
        try {
            $result = $this->repository->recycleBin();
        } catch (\Exception $e) {
            throw new ApiException('AQ-0000');
        }

        if (Gate::allows('access-admin')) {
            return $result;
        }
        throw new ApiException('AQ-0002', 401);
    }

    /**
     * Create new category
     *
     * @param $request
     * @throws ApiException
     */
    public function create($request)
    {
        if (!Gate::allows(self::ACCESS_ADMIN)) throw new ApiException('AQ-0002', 401);

        $input = [
            'id' => $this->getIdMax('category'),
            'category_name' => $request['category_name'],
            'icon' => $request['icon'],
            'slug' => Str::slug($request['category_name']),
            'created_at' => Carbon::now(),
            'created_by' => Auth::id()
        ];

        try {
            DB::beginTransaction();
            $this->repository->create($input);
            DB::commit();
        } catch (\Exception $e) {
            dd($e->getMessage());
            DB::rollBack();
            throw new ApiException('AQ-0000');
        }
    }

    /**
     * Update category by id
     *
     * @param $request
     * @param $category
     * @throws ApiException
     */
    public function update($request, $category)
    {
        if (!Gate::allows(self::ACCESS_ADMIN)) throw new ApiException('AQ-0002', 401);

        $this->categoryFindOrFail($category);

        $slug = Str::slug($request['category_name']);

        $input = [
            'category_name' => $request['category_name'],
            'icon' => $request['icon'] || null,
            'slug' => $slug,
            'updated_at' => Carbon::now(),
            'updated_by' => Auth::id()
        ];
        try {
            DB::beginTransaction();
            $this->repository->update($input, $category);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw new ApiException('AQ-0000');
        }
    }

    /**
     * Delete category by id
     *
     * @param $category
     * @throws ApiException
     */
    public function delete($category)
    {
        if (!Gate::allows(self::ACCESS_ADMIN)) throw new ApiException('AQ-0002', 401);

        $repositoryNews = new NewsRepository();

        $this->categoryFindOrFail($category);

        try {
            $listNews = $repositoryNews->findFullNewsByCategory($category);
        } catch (\Exception $e) {
            throw new ApiException('AQ-0000');
        }

        if (!$listNews->isEmpty()) {
            throw new ApiException('AQ-0004', 200);
        }

        $input = ['deleted_at' => Carbon::now()];

        try {
            DB::beginTransaction();
            $this->repository->delete($input, $category);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw new ApiException('AQ-0000');
        }
    }

    /**
     * Disable category by id
     *
     * @param $category
     * @return string
     * @throws ApiException
     */
    public function disable($category)
    {
        if (!Gate::allows(self::ACCESS_ADMIN)) throw new ApiException('AQ-0002', 401);

        $result = $this->categoryFindOrFail($category);

        if ($result->deleted_at) {
            throw new ApiException('AQ-0005', 200);
        }

        if ($result->disabled == 0) {
            $status = true;
            $message = 'Đã khoá.';
        } else {
            $status = false;
            $message = 'Mở khoá thành công.';
        }

        $input = ['disabled' => $status];

        try {
            DB::beginTransaction();
            $this->repository->disable($input, $category);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw new ApiException('AQ-0000');
        }

        return $message;
    }

    /**
     * Restore category in recycle bin
     *
     * @param $category
     * @throws ApiException
     */
    public function restore($category)
    {
        if (!Gate::allows(self::ACCESS_ADMIN)) throw new ApiException('AQ-0002', 401);

        $this->categoryFindOrFail($category);

        $input = ['deleted_at' => null];

        try {
            DB::beginTransaction();
            $this->repository->restore($input, $category);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw new ApiException('AQ-0000');
        }
    }
}
