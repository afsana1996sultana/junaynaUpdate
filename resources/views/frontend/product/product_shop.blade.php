 @extends('layouts.frontend')
@section('content-frontend')
@include('frontend.common.add_to_cart_modal')
<main class="main product-shop">
	<div class="container-fluid mb-30 mt-60">
	    <div class="row">
	        <div class="col-lg-4-5">
                <form class="" id="search-form" action="" method="GET">
    	            <div class="shop-product-fillter">
    	                <div class="totall-product">
    	                    <p>We found <strong class="text-brand">{{ count($products)}}</strong> items for you!</p>
    	                </div>
    	            </div>
    	            <div class="row product-grid gutters-5">
    	            	@forelse($products as $product)
    	                <div class="col-lg-1-5 col-md-4 col-6 col-sm-6">
    	                     <div class="product-cart-wrap">
                                <div class="product-img-action-wrap">
                                    <div class="product-img product-img-zoom">
                                        <a href="{{ route('product.details',$product->slug) }}">
                                            @if($product->product_thumbnail && $product->product_thumbnail != '' && $product->product_thumbnail != 'Null')
                                                <img class="default-img" src="{{ asset($product->product_thumbnail) }}" alt="" />
                                                <img class="hover-img" src="{{ asset($product->product_thumbnail) }}" alt="" />
                                            @else
                                                <img class="img-lg mb-3" src="{{ asset('upload/no_image.jpg') }}" alt="" />
                                            @endif
                                        </a>
                                    </div>
                                    <div class="product-action-1 d-flex">
                                        <a aria-label="Quick view" id="{{ $product->id }}" onclick="productView(this.id)" class="action-btn" data-bs-toggle="modal" data-bs-target="#quickViewModal"><i class="fi-rs-eye"></i></a>
                                    </div>
                                    
                                    <div class="product-badges product-badges-position product-badges-mrg">
                                        @php
                                            if($product->discount_type == 1){
                                                $price_after_discount = $product->regular_price - $product->discount_price;
                                            }elseif($product->discount_type == 2){
                                                $price_after_discount = $product->regular_price - ($product->regular_price * $product->discount_price / 100);
                                            }
                                        @endphp

                                        @if($product->discount_price > 0)
                                        <div class="product-badges-right product-badges-position-right product-badges-mrg">
                                                @if($product->discount_type == 1)
                                                    <span class="hot">৳{{ $product->discount_price }} off</span>
                                                @elseif($product->discount_type == 2)
                                                    <span class="hot">{{ $product->discount_price }}% off</span>
                                                @endif
                                        </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="product-content-wrap">
                                    <h2>
                                        <a href="{{ route('product.details',$product->slug) }}">
                                            @if(session()->get('language') == 'bangla')
                                                <?php $p_name_bn =  strip_tags(html_entity_decode($product->name_bn))?>
                                                {{ Str::limit($p_name_bn, $limit = 30, $end = '. . .') }}
                                            @else
                                                <?php $p_name_en =  strip_tags(html_entity_decode($product->name_en))?>
                                                {{ Str::limit($p_name_en, $limit = 30, $end = '. . .') }}
                                            @endif
                                        </a>
                                    </h2>
                                    
                                    <div class="product-category">
                                        <a href="{{ route('product.category', $product->category->slug) }}">
                                        	@if(session()->get('language') == 'bangla') 
    			                                {{ $product->category->name_bn }}
    			                            @else 
    			                                {{ $product->category->name_en }} 
    			                            @endif
                                        </a>
                                    </div>
                                    @php
                                        $reviews = \App\Models\Review::where('product_id', $product->id)
                                        ->where('status', 1)
                                        ->get();
                                        $averageRating = $reviews->avg('rating');
                                        $ratingCount = $reviews->count(); // Add this line to get the rating count
                                    @endphp
                
                                    <div class="product__rating">
                                        @if ($reviews->isNotEmpty())
                                            @for ($i = 1; $i <= 5; $i++)
                                                @if ($i <= floor($averageRating))
                                                    <i class="fa fa-star" style="color: #c90312;"></i>
                                                @elseif ($i == ceil($averageRating) && $averageRating - floor($averageRating) >= 0.5)
                                                    {{-- Display a half-star with gradient --}}
                                                    <i class="fa fa-star" style="background: linear-gradient(to right, #c90312 50%, gray 50%); -webkit-background-clip: text; color: transparent;"></i>
                                                @else
                                                    <i class="fa fa-star" style="color: gray;"></i>
                                                @endif
                                            @endfor
                                        @else
                                            @for ($i = 1; $i <= 5; $i++)
                                                <i class="fa fa-star" style="color: gray;"></i>
                                            @endfor
                                        @endif
                                        <span class="rating-count">({{ number_format($averageRating, 1) }})</span>
                                    </div>
                                    <div class="product-card-bottom">
                                        @if ($product->discount_price > 0)
                                            <div class="product-price">
                                                <span class="price"> ৳{{ $price_after_discount }} </span>
                                                <span class="old-price">৳ {{ $product->regular_price }}</span>
                                            </div>
                                        @else
                                            <div class="product-price">
                                                <span class="price"> ৳{{ $product->regular_price }} </span>
                                            </div>
                                        @endif
                                        {{-- <div class="add-cart">
                                            @if($product->is_varient == 1)
                                                <a class="add" id="{{ $product->id }}" onclick="productView(this.id)" data-bs-toggle="modal" data-bs-target="#quickViewModal"><i class="fi-rs-shopping-cart mr-5"></i>Add </a>
                                            @else
                                                <input type="hidden" id="pfrom" value="direct">
                                                <input type="hidden" id="product_product_id" value="{{ $product->id }}"  min="1">
                                                <input type="hidden" id="{{ $product->id }}-product_pname" value="{{ $product->name_en }}">
                                                <a class="add" onclick="addToCartDirect({{ $product->id }})" ><i class="fi-rs-shopping-cart mr-5"></i>Add </a>
                                            @endif
                                        </div> --}}
                                    </div>
                                </div>
                            </div>
    	                </div>
    	                @empty
                            @if(session()->get('language') == 'bangla') 
    	                        <h5 class="text-danger">এখানে কোন পণ্য খুঁজে পাওয়া যায়নি!</h5> 
    	                    @else 
    	                       	<h5 class="text-danger">No products were found here!</h5> 
    	                    @endif
    	                @endforelse
    	                <!--end product card-->
    	            </div>
    	            <!--product grid-->
    	            <div class="pagination-area mt-20 mb-20">
    	                <nav aria-label="Page navigation example">
    	                    <ul class="pagination justify-content-end">
    	                        {{ $products->links() }}
    	                    </ul>
    	                </nav>
    	            </div>
                </form>
                <!--End Deals-->
	        </div>
            <!-- Side Filter Start -->
	        <div class="col-lg-1-5 primary-sidebar sticky-sidebar">
                <form action="{{ URL::current() }}" method="GET" id="search-form">
                    <div class="card">
                        <div class="sidebar-widget price_range range border-0">
                            <h5 class="mb-20">By Price</h5>
                            <div class="price-filter mb-30">
                                <div class="price-filter-inner">
                                    <div id="slider-range" class="mb-20"></div>
                                    <div class="d-flex justify-content-between">
                                        <div class="caption">From: <strong id="slider-range-value1" class="text-brand">@if(isset($_GET['filter_price_start'])) {{ $_GET['filter_price_start'] }} @endif</strong></div>
                                        <div class="caption">To: <strong id="slider-range-value2" class="text-brand"></strong></div>
                                    </div>
                                </div>
                            </div>
                            
                                <input type="hidden" id="filter_price_start" name="filter_price_start" @if(isset($_GET['filter_price_start'])) value="{{ $_GET['filter_price_start'] }}" @else value="1" @endif>
                                <input type="hidden" id="filter_price_end" name="filter_price_end" @if(isset($_GET['filter_price_end'])) value="{{ $_GET['filter_price_end'] }}" @else value="200000" @endif>
                            
                            <h5 class="mb-20">Category</h5>
                            <div class="custome-checkbox">
                                @foreach(get_categories() as $category)
                                    <div class="mb-2">
                                        @php
                                            $checked = [];
                                            if(isset($_GET['filtercategory'])){
                                                $checked = $_GET['filtercategory'];
                                            }
                                        @endphp
                                        <input class="form-check-input" type="checkbox" name="filtercategory[]" id="category_{{$category->id}}" value="{{$category->name_en}}" 
                                            @if(in_array($category->name_en, $checked)) checked @endif
                                        />
                                        <label class="form-check-label" for="category_{{$category->id}}">
                                            <span>
                                                @if(session()->get('language') == 'bangla') 
                                                    {{ $category->name_bn }}
                                                @else 
                                                    {{ $category->name_en }} 
                                                @endif 
                                            </span>
                                        </label>
                                        @php
                                            $conditions = ['status' => 1];
                                            $category_ids = App\Utility\CategoryUtility::children_ids($category->id);
                                            $category_ids[] = $category->id;
                                            $products = App\Models\Product::where($conditions)->whereIn('category_id', $category_ids)->orderBy('id','DESC')->get();
                                        @endphp
                                        <span class="float-end">{{ count($products) }}</span>
                                        <br>
                                    </div>
                                @endforeach
                            </div>
                            <button type="submin" class="btn btn-sm btn-default mt-20 mb-10" onclick="sort_price_filter()" ><i class="fi-rs-filter mr-5"></i> Fillter</button>
                        </div>
                    </div>
                </form>
	        </div>
            <!-- Side Filter End -->
	    </div>
	</div>
</main>
@endsection
@push('footer-script')
    <script>
        function updateBrandId(value) {
            document.getElementById('brand_id').value = value;
        }
    
        function updateSortBy(value) {
            document.getElementById('sort_by').value = value;
        }
    
        function filter() {
            document.getElementById('search-form').submit();
        }
    </script>
    
    <script type="text/javascript">
        function sort_price_filter(){
           var start = $('#slider-range-value1').html();
           var end = $('#slider-range-value2').html();
           $('#filter_price_start').val(start);
           $('#filter_price_end').val(end);
           $('#search-form').submit();
        }
    </script>
    
    <script type="text/javascript">
        (function ($) {
            ("use strict");
            // Slider Range JS
            if ($("#slider-range").length) {
                $(".noUi-handle").on("click", function () {
                    $(this).width(50);
                });
                var rangeSlider = document.getElementById("slider-range");
                var moneyFormat = wNumb({
                    decimals: 0,
                });
                var start_price = document.getElementById("filter_price_start").value;
                var end_price = document.getElementById("filter_price_end").value;
                noUiSlider.create(rangeSlider, {
                    start: [start_price, end_price],
                    step: 1,
                    range: {
                        min: [1],
                        max: [5000]
                    },
                    format: moneyFormat,
                    connect: true
                });

                // Set visual min and max values and also update value hidden form inputs
                rangeSlider.noUiSlider.on("update", function (values, handle) {
                    document.getElementById("slider-range-value1").innerHTML = values[0];
                    document.getElementById("slider-range-value2").innerHTML = values[1];
                    document.getElementsByName("min-value").value = moneyFormat.from(values[0]);
                    document.getElementsByName("max-value").value = moneyFormat.from(values[1]);
                });
                
            }
        })(jQuery);
    </script>
@endpush