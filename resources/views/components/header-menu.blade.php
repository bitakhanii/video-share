<div id="main-category">
    <div class="container-full">
        <div class="row">
            <div class="col-md-12">
                <ul class="main-category-menu">
                    @foreach($categories as $category)
                        <li class="color-{{ ($loop->iteration) /*or ($loop->index+1)*/ }}">
                            <a href="{{ route('categories.videos.index', $category->slug) }}">
                                <i class="{{ $category->icon }}"></i>
                                {{ $category->name }}
                            </a>
                        </li>
                    @endforeach
                    <li class="color-6">
                        <a href="{{ route('products.index') }}">
                            <i class="fa fa-shopping-bag"></i>
                            محصولات
                        </a>
                    </li>
                </ul>
            </div><!-- // col-md-14 -->
        </div><!-- // row -->
    </div><!-- // container-full -->
</div><!-- // main-category -->
