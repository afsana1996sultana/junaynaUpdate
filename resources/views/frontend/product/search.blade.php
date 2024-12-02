@extends('layouts.frontend')
@section('content-frontend')
@include('frontend.common.add_to_cart_modal')

<main class="main">
	<div class="container mb-30 mt-60">
	    <div class="row">
	            <div class="row product-grid">
	            	@forelse($products as $product)
	                <div class="col-lg-1-5 col-md-4 col-12 col-sm-6">
                        <div class="product-cart-wrap mb-30 wow animate__animated animate__fadeIn" data-wow-delay=".1s">
                            <div class="product-img-action-wrap">
                                <div class="product-img product-img-zoom">
                                    <a href="{{ route('product.details', $product->slug) }}">
                                        @if ($product->product_thumbnail && $product->product_thumbnail != '' && $product->product_thumbnail != '')
                                            <img class="default-img lazyload img-responsive"
                                                data-original="{{ asset($product->product_thumbnail) }}"
                                                src="{{ asset($product->product_thumbnail) }}" alt="">
                                            <img class="hover-img" src="{{ asset($product->product_thumbnail) }}"
                                                alt="" />
                                        @else
                                            <img class="img-lg mb-3" data-original="{{ asset('upload/no_image.jpg') }}" alt="" />
                                        @endif
                                    </a>
                                </div>
                                <div class="product-action-1 d-flex">
                                    <a aria-label="Quick view" id="{{ $product->id }}" onclick="productView(this.id)" class="action-btn"
                                        data-bs-toggle="modal" data-bs-target="#quickViewModal"><i class="fi-rs-eye"></i></a>
                                </div>
                                <!-- start product discount section -->
                                @php
                                    if ($product->discount_type == 1) {
                                        $price_after_discount = $product->regular_price - $product->discount_price;
                                    } elseif ($product->discount_type == 2) {
                                        $price_after_discount = $product->regular_price - ($product->regular_price * $product->discount_price) / 100;
                                    }
                                @endphp
                   
                                @if ($product->discount_price > 0)
                                    <div class="product-badges-right product-badges-position-right product-badges-mrg">
                                        @if ($product->discount_type == 1)
                                            <span class="hot">৳{{ $product->discount_price }} off</span>
                                        @elseif($product->discount_type == 2)
                                            <span class="hot">{{ $product->discount_price }}% off</span>
                                        @endif
                                    </div>
                                @endif
                            </div>
                            
                            <div class="product-content-wrap">
                                <h2 class="mt-3">
                                    <a href="{{ route('product.details', $product->slug) }}">
                                        @if (session()->get('language') == 'bangla')
                                            <?php $p_name_bn = strip_tags(html_entity_decode($product->name_bn)); ?>
                                            {{ Str::limit($p_name_bn, $limit = 30, $end = '. . .') }}
                                        @else
                                            <?php $p_name_en = strip_tags(html_entity_decode($product->name_en)); ?>
                                            {{ Str::limit($p_name_en, $limit = 30, $end = '. . .') }}
                                        @endif
                                    </a>
                                </h2>
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
                                            <span class="price">৳{{ $price_after_discount }}</span>
                                            <span class="old-price" style="color: #DD1D21;">৳{{ $product->regular_price }}</span>
                                        </div>
                                    @else
                                        <div class="product-price">
                                            <span class="price">৳{{ $product->regular_price }}</span>
                                        </div>
                                    @endif
                                    {{--  <div class="add-cart">
                                        @if ($product->is_varient == 1)
                                            <a class="add" id="{{ $product->id }}" onclick="productView(this.id)"
                                                data-bs-toggle="modal" data-bs-target="#quickViewModal"><i
                                                    class="fi-rs-shopping-cart mr-5"></i>Add </a>
                                        @else
                                            <input type="hidden" id="pfrom" value="direct">
                                            <input type="hidden" id="product_product_id" value="{{ $product->id }}" min="1">
                                            <input type="hidden" id="{{ $product->id }}-product_pname" value="{{ $product->name_en }}">
                                            <a class="add" onclick="addToCartDirect({{ $product->id }})"><i
                                                    class="fi-rs-shopping-cart mr-5"></i>Add </a>
                                        @endif
                                    </div>  --}}
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
                <div class="justify-content-center">
                    
                </div>
	           
	        </div>
            <!-- Side Filter Start -->
	        <div class="col-lg-1-5 primary-sidebar sticky-sidebar">
	        </div>
            <!-- Side Filter End -->
	    </div>
	</div>
</main>
@endsection