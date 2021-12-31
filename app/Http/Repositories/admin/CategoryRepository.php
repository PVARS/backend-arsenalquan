<?php


namespace App\Http\Repositories\admin;


use App\Http\Repositories\Repository;
use App\Models\Category;

class CategoryRepository extends Repository
{
    /**
     * @return mixed
     */
    public function list()
    {
        return Category::join('user', 'user.id', '=', 'category.created_by')
            ->whereNull('category.deleted_at')
            ->orderby('disabled', 'asc')
            ->orderby('category.created_at', 'desc')
            ->select(
                'category.id',
                'category.category_name',
                'category.slug',
                'category.icon',
                'category.disabled',
                'category.created_at',
                'category.created_by',
                'user.login_id')
            ->get();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getById($id)
    {
        return Category::join('user', 'user.id', '=', 'category.created_by')
            ->whereNull('category.deleted_at')
            ->where('category.id', $id)
            ->orderby('category.created_at', 'desc')
            ->select(
                'category.id',
                'category.category_name',
                'category.slug',
                'category.icon',
                'category.disabled',
                'category.created_at',
                'category.created_by',
                'user.login_id')
            ->first();
    }

    /**
     * @return mixed
     */
    public function recycleBin()
    {
        return Category::join('user', 'user.id', '=', 'category.created_by')
            ->whereNotNull('category.deleted_at')
            ->orderby('category.deleted_at', 'desc')
            ->select(
                'category.id',
                'category.category_name',
                'category.slug',
                'category.icon',
                'category.disabled',
                'category.created_at',
                'category.created_by',
                'category.deleted_at',
                'user.login_id'
            )
            ->get();
    }

    /**
     * @param array $input
     */
    public function create(array $input)
    {
        Category::create($input);
    }

    /**
     * @param array $input
     * @param $id
     */
    public function update(array $input, $id)
    {
        Category::whereNull('deleted_at')
            ->where('id', $id)
            ->update($input);
    }

    /**
     * @param array $input
     * @param $id
     */
    public function delete(array $input, $id)
    {
        Category::whereNull('deleted_at')
            ->where('id', $id)
            ->update($input);
    }

    /**
     * @param array $input
     * @param $id
     */
    public function disable(array $input, $id)
    {
        Category::whereNull('deleted_at')
            ->where('id', $id)
            ->update($input);
    }

    /**
     * @param array $input
     * @param $id
     */
    public function restore(array $input, $id)
    {
        Category::whereNotNull('deleted_at')
            ->where('id', $id)
            ->update($input);
    }
}
