<?php

namespace App\Http\ViewComposers;

use App\Services\CategoryService;
use Illuminate\View\View;

class CategoryTreeComposer
{
    protected $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function compose(View $view)
    {
        // 绑定参数到view实例
        $view->with('categoryTree', $this->categoryService->getCategoryTree());
    }
}
