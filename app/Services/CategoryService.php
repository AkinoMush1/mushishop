<?php

namespace App\Services;

use App\Models\Category;

class CategoryService
{
    // 这是一个递归方法
    // $parentId 参数代表要获取子类目的父类目 ID，null 代表获取所有根类目
    // $allCategories 参数代表数据库中所有的类目，如果是 null 代表需要从数据库中查询
    public function getCategoryTree($parentId = null, $allCategories = null)
    {
        if (is_null($allCategories)) {
            // 从数据库中一次性取出所有类目
            $allCategories = Category::all();
        }

        return $allCategories
            ->where('parent_id', $parentId)
            ->each(function ($category) {
                $data = ['id' => $category->id, 'name' => $category->name];
                if (!$category->is_directory) {
                    return $data;
                }
                $data['children'] = $this->getCategoryTree($category->id, $category->children);

                return $data;
            });
    }
}
