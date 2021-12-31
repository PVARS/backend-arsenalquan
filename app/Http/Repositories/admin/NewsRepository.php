<?php


namespace App\Http\Repositories\admin;


use App\Http\Repositories\Repository;
use App\Models\News;

class NewsRepository extends Repository
{
    /**
     * @param $category
     * @return mixed
     */
    public function findFullNewsByCategory($category)
    {
        return News::where('category_id', $category)->get();
    }

    /**
     * @param array $input
     * @return mixed
     */
    public function list(array $input)
    {
        return News::join('category', 'category.id', '=', 'news.category_id')
            ->join('user', 'user.id', '=', 'news.created_by')
            ->whereNull('news.deleted_at')
            ->where('news.approve', '=', true)
            ->whereNull('category.deleted_at')
            ->where(function ($query) use ($input) {
                if ($input['category_id']) {
                    $query->where('news.category_id', $input['category_id']);
                }

                if ($input['title']) {
                    $query->where('news.title', 'like', '%' . $input['title'] . '%');
                }

                if ($input['create_by']) {
                    $query->where('user.full_name', 'like', '%' . $input['create_by'] . '%');
                }

                if ($input['date_from'] && $input['date_to']) {
                    $query->whereBetween('news.created_at', [$input['date_from'] . self::TIME_FROM, $input['date_to'] . self::TIME_TO]);
                } else if ($input['date_from']) {
                    $query->where('news.created_at', '>=', $input['date_from'] . self::TIME_FROM);
                } else if ($input['date_to']) {
                    $query->where('news.created_at', '<=', $input['date_to'] . self::TIME_TO);
                }
            })
            ->orderby('news.created_at', 'desc')
            ->select(
                'news.id',
                'news.title',
                'news.short_description',
                'news.thumbnail',
                'news.content',
                'news.key_word',
                'news.view',
                'news.slug',
                'news.approve',
                'news.approved_by',
                'news.created_at',
                'news.created_by',
                'category.category_name',
                'user.login_id')
            ->get();
    }

    /**
     * @return mixed
     */
    public function listNewsPending()
    {
        return News::join('category', 'category.id', '=', 'news.category_id')
            ->join('user', 'user.id', '=', 'news.created_by')
            ->whereNull('news.deleted_at')
            ->where('news.approve', '=', false)
            ->whereNull('category.deleted_at')
            ->orderBy('news.created_at', 'asc')
            ->select(
                'news.id',
                'news.title',
                'news.short_description',
                'news.thumbnail',
                'news.content',
                'news.key_word',
                'news.view',
                'news.slug',
                'news.approve',
                'news.approved_by',
                'news.created_at',
                'news.created_by',
                'category.category_name',
                'user.login_id')
            ->get();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getById($id)
    {
        return News::join('category', 'category.id', '=', 'news.category_id')
            ->join('user', 'user.id', '=', 'news.created_by')
            ->whereNull('news.deleted_at')
            ->where('news.id', $id)
            ->whereNull('category.deleted_at')
            ->orderBy('news.created_at', 'asc')
            ->select(
                'news.id',
                'news.title',
                'news.short_description',
                'news.thumbnail',
                'news.content',
                'news.key_word',
                'news.view',
                'news.slug',
                'news.approve',
                'news.approved_by',
                'news.created_at',
                'news.created_by',
                'category.category_name',
                'user.login_id')
            ->first();
    }

    /**
     * @param $idCategory
     * @return mixed
     */
    public function getNewsByCategory($idCategory)
    {
        return News::join('category', 'news.category_id', '=', 'category.id')
            ->join('user', 'user.id', '=', 'news.created_by')
            ->whereNull('news.deleted_at')
            ->where('news.category_id', $idCategory)
            ->where('news.approve', '=', true)
            ->whereNull('category.deleted_at')
            ->orderBy('news.created_at', 'desc')
            ->select(
                'news.id',
                'news.title',
                'news.short_description',
                'news.thumbnail',
                'news.content',
                'news.key_word',
                'news.view',
                'news.slug',
                'news.approve',
                'news.approved_by',
                'news.created_at',
                'news.created_by',
                'category.category_name',
                'user.login_id')
            ->get();
    }

    /**
     * @return mixed
     */
    public function recycleBin()
    {
        return News::join('category', 'news.category_id', '=', 'category.id')
            ->join('user', 'user.id', '=', 'news.created_by')
            ->whereNotNull('news.deleted_at')
            ->whereNull('category.deleted_at')
            ->orderby('news.deleted_at', 'asc')
            ->select(
                'news.id',
                'news.title',
                'news.short_description',
                'news.thumbnail',
                'news.content',
                'news.key_word',
                'news.view',
                'news.slug',
                'news.approve',
                'news.approved_by',
                'news.created_at',
                'news.created_by',
                'news.deleted_at',
                'category.category_name',
                'user.login_id')
            ->get();
    }

    /**
     * @param array $input
     */
    public function create(array $input)
    {
        News::create($input);
    }

    /**
     * Update, approve, delete news
     *
     * @param array $input
     * @param $id
     */
    public function update(array $input, $id)
    {
        News::join('category', 'news.category_id', '=', 'category.id')
            ->where('news.id', $id)
            ->whereNull('news.deleted_at')
            ->whereNull('category.deleted_at')
            ->where('category.disabled', false)
            ->update($input);
    }

    /**
     * @param array $input
     * @param $id
     */
    public function restore(array $input, $id)
    {
        News::whereNotNull('deleted_at')
            ->where('id', $id)
            ->update($input);
    }
}
