@extends('layouts.app')
@section('title', '商品列表')

@section('content')
    <div class="row">
        <div class="col-lg-10 offset-lg-1">
            <div class="card">
                <div class="card-body">
                    <!-- 筛选组件开始 -->
                    <form action="{{ route('products.index') }}" class="search-form">
                        <input type="hidden" name="filters">
                        <div class="form-row">
                            <div class="col-md-9">
                                <div class="form-row">
                                    <!-- 面包屑开始 -->
                                    <div class="col-auto category-breadcrumb">
                                        <a class="all-products" href="{{ route('products.index') }}">全部</a> >
                                        @if ($category)
                                            @foreach($category->ancestors as $ancestor)
                                                <span class="category">
                                                    <a href="{{ route('products.index', ['category_id' => $ancestor->id]) }}">{{ $ancestor->name }}</a>
                                                </span>
                                                <span>&gt;</span>
                                            @endforeach
                                            <span class="category">{{ $category->name }}</span><span> ></span>
                                            <input type="hidden" name="category_id" value="{{ $category->id }}">
                                        @endif
                                        @if($propertyFilters)
                                            @foreach($propertyFilters as $name => $value)
                                                <span class="filter">{{ $name }}:
                                                <span class="filter-value">{{ $value }}</span>
                                                    <!-- 调用之后定义的 removeFilterFromQuery -->
                                                <a class="remove-filter"
                                                   href="javascript: removeFilterFromQuery('{{ $name }}')">×</a>
                                            </span>
                                            @endforeach
                                        @endif
                                    </div>
                                    <div class="col-auto"><input type="text" class="form-control form-control-sm"
                                                                 name="search" placeholder="搜索"></div>
                                    <div class="col-auto">
                                        <button class="btn btn-primary btn-sm">搜索</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <select name="order" class="form-control form-control-sm float-right">
                                    <option value="">排序方式</option>
                                    <option value="price_asc">价格从低到高</option>
                                    <option value="price_desc">价格从高到低</option>
                                    <option value="sold_count_desc">销量从高到低</option>
                                    <option value="sold_count_asc">销量从低到高</option>
                                    <option value="rating_desc">评价从高到低</option>
                                    <option value="rating_asc">评价从低到高</option>
                                </select>
                            </div>
                        </div>
                    </form>
                    <!-- 筛选组件结束 -->
                    <!-- 展示子类目开始 -->
                    <div class="filters">
                    @if($category)
                        <!-- 如果当前是通过类目筛选，并且此类目是一个父类目 -->
                            @if ($category->is_directory)
                                <div class="row">
                                    <div class="col-3 filter-key">子类目：</div>
                                    <div class="col-9 filter-values">
                                        <!-- 遍历直接子类目 -->
                                        @foreach($category->children as $child)
                                            <a href="{{ route('products.index', ['category_id' => $child->id]) }}">{{ $child->name }}</a>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        @else
                            <div class="row">
                                <div class="col-3 filter-key">子类目：</div>
                                <div class="col-9 filter-values">
                                    <!-- 遍历直接子类目 -->
                                    @foreach($directories as $directory)
                                        <a href="{{ route('products.index', ['category_id' => $directory->id]) }}">{{ $directory->name }}</a>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        @foreach($properties as $property)
                            <div class="row">
                                <!-- 输出属性名 -->
                                <div class="col-3 filter-key">{{ $property['key'] }}：</div>
                                <div class="col-9 filter-values">
                                    <!-- 遍历属性值列表 -->
                                    @foreach($property['values'] as $value)
                                        <a href="#"
                                           onclick="appendFilterToQuery('{{ $property['key'] }}', '{{ $value }}')">{{ $value }}</a>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <!-- 展示子类目结束 -->
                    <div class="row products-list">
                        @foreach($products as $product)
                            <div class="col-3 product-item">
                                <div class="product-content">
                                    <div class="top">
                                        <div class="img">
                                            <a href="{{ route('products.show', ['product' => $product->id]) }}">
                                                <img src="{{ $product->image_url }}" alt="">
                                            </a>
                                        </div>
                                        <div class="price"><b>￥</b>{{ $product->price }}</div>
                                        <div class="title">{{ $product->title }}</div>
                                    </div>
                                    <div class="bottom">
                                        <div class="sold_count">销量 <span>{{ $product->sold_count }}笔</span></div>
                                        <div class="review_count">评价 <span>{{ $product->review_count }}</span></div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="float-right">{{ $products->appends($filters)->render() }}</div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scriptsAfterJs')
    <script>
        var filters = {!! json_encode($filters) !!};
        $(document).ready(function () {
            $('.search-form input[name=search]').val(filters.search);
            $('.search-form select[name=order]').val(filters.order);

            $('.search-form select[name=order]').on('change', function () {
                var searches = parseSearch();
                // 如果有属性筛选
                if (searches['filters']) {
                    // 将属性筛选值放入隐藏字段中
                    $('.search-form input[name=filters]').val(searches['filters']);
                }
                $('.search-form').submit();

            });
        })

        function appendFilterToQuery(name, value) {
            var searches = parseSearch();

            if (searches['filters']) {
                searches['filters'] += '|' + name + ':' + value;
            } else {
                searches['filters'] = name + ':' + value;
            }

            location.search = buildSearch(searches);
        }

        function parseSearch() {
            var searches = {};
            location.search.substr(1).split('&').forEach(function (str) {
                var result = str.split('=');
                searches[decodeURIComponent(result[0])] = decodeURIComponent(result[1]);
            })

            return searches;
        }


        // 根据 Key-Value 对象构建查询参数
        function buildSearch(searches) {
            var query = '?';
            _.forEach(searches, function (value, key) {
                query += encodeURIComponent(key) + '=' + encodeURIComponent(value) + '&';
            });
            return query.substr(0, query.length - 1);
        }

        function removeFilterFromQuery(name) {
            var searches = parseSearch();

            if (!searches['filters']) {
                return;
            }
            var filters = [];
            searches['filters'].split('|').forEach(function (filter) {
                result = filter.split(':');
                if (result[0] === name) {
                    return;
                }
                filters.push(filter);
            });

            searches['filters'] = filters.join('|');

            location.search = buildSearch(searches);
        }

    </script>
@endsection
