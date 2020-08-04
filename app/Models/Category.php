<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public $fillable = [
        'name',
        'parent_id',
        'is_directory',
        'level',
        'path',
    ];

    public $casts = [
        'is_directory' => 'boolean'
    ];

    protected static function boot()
    {
        parent::boot();

        Category::creating(function ($category) {
            if (is_null($category->parent_id)) {
                $category->level = '0';
                $category->path = '-';
            } else {
                $category->level = $category->parent->level + 1;
                $category->path = $category->parent->path . $category->level . '-';
            }
        });
    }

    public function parent()
    {
        return $this->belongsTo(Category::class);
    }

    public function children()
    {
        return $this->hasMany(Category::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function getPathIdsAttribute()
    {
        return array_filter(explode('-', trim($this->path, '-')));
    }

    // 定义一个访问器，获取所有祖先类目并按层级排序
    public function getAncestorsAttribute()
    {
        return Category::query()
            ->whereIn('id', $this->getPathIdsAttribute())
            ->orderBy('level')
            ->get();
    }

    // 定义一个访问器，获取以 - 为分隔的所有祖先类目名称以及当前类目的名称
    public function getFullNameAttribute()
    {
        $this->ancestors
            ->pluck('name')
            ->push($this->name)
            ->implode('-');
    }
}
