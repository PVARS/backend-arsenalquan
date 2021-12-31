<?php


namespace App\Http\Services\admin;

use App\Exceptions\ApiException;
use App\Http\Repositories\admin\CategoryRepository;
use App\Http\Repositories\admin\NewsRepository;
use App\Http\Services\Service;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;

class NewsService extends Service
{
    /**
     * @var NewsRepository
     */
    protected $repository, $categoryRepo;

    //Error code SQL: Integrity constraint violation
    const UNIQUE_VALUE = 23000;

    /**
     * NewsService constructor.
     */
    public function __construct()
    {
        $this->repository = new NewsRepository();
        $this->categoryRepo = new CategoryRepository();
    }

    /**
     * Get all news
     *
     * @return mixed
     * @throws ApiException
     */
    public function list()
    {
        try {
            $result = $this->repository->list();
        } catch (\Exception $e) {
            throw new ApiException('AQ-0000');
        }

        return $result;
    }

    /**
     * Get all pending news
     *
     * @return mixed
     * @throws ApiException
     */
    public function listNewsPending()
    {
        try {
            $result = $this->repository->listNewsPending();
        } catch (\Exception $e) {
            throw new ApiException('AQ-0000');
        }

        return $result;
    }

    /**
     * Get news by id
     *
     * @param $news
     * @return mixed
     * @throws ApiException
     */
    public function getById($news)
    {
        try {
            $result = $this->repository->getById($news);
        } catch (\Exception $e) {
            throw new ApiException('AQ-0000');
        }

        return $result;
    }

    /**
     * Filter news by category
     *
     * @param $category
     * @return mixed
     * @throws ApiException
     */
    public function getNewsByCategory($category)
    {
        try {
            $result = $this->repository->getNewsByCategory($category);
        } catch (\Exception $e) {
            throw new ApiException('AQ-0000');
        }

        return $result;
    }

    /**
     * List news in recycle bin
     *
     * @return mixed
     * @throws ApiException
     */
    public function recycleBin()
    {
        if (!Gate::allows(self::ACCESS_ADMIN)) throw new ApiException('AQ-0002', 401);

        try {
            $result = $this->repository->recycleBin();
        } catch (\Exception $e) {
            throw new ApiException('AQ-0000');
        }

        return $result;
    }

    /**
     * Create new news
     *
     * @param $request
     * @return mixed
     * @throws ApiException
     */
    public function createNews($request)
    {
        $categoryService = new CategoryService();
        $categoryId = $request['category_id'];

        //Check exist category
        $categoryService->categoryFindOrFail($categoryId);

        //Check status category
        if ($categoryService->categoryById($categoryId)->disabled) {
            throw new ApiException('AQ-0006', 200);
        }

        //Set status approval for category
        $approve = true;
        $approvedBy = auth()->user()->login_id;
        if (auth()->user()->role_id != 1 && auth()->user()->role_id != 2) {
            $approve = false;
            $approvedBy = null;
        }

        $idMax = $this->getIdMax('news');

        $input = [
            'id' => $idMax,
            'category_id' => $categoryId,
            'title' => $request['title'],
            'short_description' => $request['short_description'],
            'thumbnail' => $request['thumbnail'],
            'content' => $request['content'],
            'key_word' => json_encode($request['key_word']),
            'slug' => Str::slug($request['title']),
            'approve' => $approve,
            'approved_by' => $approvedBy,
            'created_at' => Carbon::now(),
            'created_by' => Auth::id()
        ];

        try {
            DB::beginTransaction();
            $this->repository->create($input);
            DB::commit();

            return $this->getById($idMax);
        } catch (\Exception $e) {
            DB::rollBack();
            if ($e->getCode() == self::UNIQUE_VALUE) {
                throw new ApiException('AQ-0007');
            } else {
                throw new ApiException('AQ-0000');
            }
        }
    }

    /**
     * Update news
     *
     * @param $request
     * @param $news
     * @return mixed
     * @throws ApiException
     */
    public function updateNews($request, $news)
    {
        $categoryService = new CategoryService();

        //Check exist category
        $categoryService->categoryFindOrFail($request['category_id']);

        //Check status category
        if ($categoryService->categoryById($request['category_id'])->disabled) {
            throw new ApiException('AQ-0006', 200);
        }

        //Check exist news
        if (!$this->repository->getById($news)) {
            throw new ApiException('AQ-0008', 404);
        }

        $input = [
            'news.category_id' => $request['category_id'],
            'news.title' => $request['title'],
            'news.short_description' => $request['short_description'],
            'news.thumbnail' => $request['thumbnail'],
            'news.content' => $request['content'],
            'news.key_word' => json_encode($request['key_word']),
            'news.slug' => $request['title'],
            'news.updated_at' => Carbon::now(),
            'news.updated_by' => Auth::id()
        ];

        try {
            DB::beginTransaction();
            $this->repository->update($input, $news);
            DB::commit();

            return $this->getById($news);
        } catch (\Exception $e) {
            DB::rollBack();
            if ($e->getCode() == self::UNIQUE_VALUE) {
                throw new ApiException('AQ-0007');
            } else {
                throw new ApiException('AQ-0000');
            }
        }
    }

    /**
     * Approve news
     *
     * @param $news
     * @throws ApiException
     */
    public function approve($news)
    {
        if (!Gate::allows(self::ACCESS_ADMIN)) throw new ApiException('AQ-0002', 401);

        $newsResult = $this->repository->getById($news);
        if (!$newsResult) {
            throw new ApiException('AQ-0008', 404);
        }

        if ($newsResult->approve) {
            throw new ApiException('AQ-0009', 200);
        }

        $input = ['approve' => true, 'approved_by' => auth()->user()->login_id];

        try {
            DB::beginTransaction();
            $this->repository->update($input, $news);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw new ApiException('AQ-0000');
        }
    }

    /**
     * Delete news
     *
     * @param $news
     * @throws ApiException
     */
    public function delete($news)
    {
        if (!Gate::allows(self::ACCESS_ADMIN)) throw new ApiException('AQ-0002', 401);

        $newsResult = $this->repository->getById($news);
        if (!$newsResult) {
            throw new ApiException('AQ-0010', 404);
        }

        $input = [
            'news.approve' => false,
            'news.deleted_at' => Carbon::now()
        ];

        try {
            DB::beginTransaction();
            $this->repository->update($input, $news);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw new ApiException('AQ-0000');
        }
    }

    /**
     * Restore news
     *
     * @param $news
     * @throws ApiException
     */
    public function restore($news)
    {
        if (!Gate::allows(self::ACCESS_ADMIN)) throw new ApiException('AQ-0002', 401);

        $input = ['deleted_at' => null];

        try {
            DB::beginTransaction();
            $this->repository->restore($input, $news);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw new ApiException('AQ-0000');
        }
    }
}
