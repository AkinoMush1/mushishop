<?php

namespace App\Services;

use App\Models\Product;
use App\SearchBuilders\ProductSearchBuilder;

class ProductService
{
    public function getSimilarProductIds(Product $product, $size)
    {
        $builder = (new ProductSearchBuilder())->onSale()->paginate($size, 1);

        foreach ($product->properties as $property) {
            $builder->propertyFilter($property->name, $property->value, 'should');
        }

        $builder->minShouldMatch(ceil(count($product->properties) / 2));

        $params = $builder->getParams();

        $params['body']['query']['bool']['must_not'] = ['term' => ['_id' => $product->id]];

        $result = app('es')->search($params);

        return collect($result['hits']['hits'])->pluck('_id')->all();
    }
}
