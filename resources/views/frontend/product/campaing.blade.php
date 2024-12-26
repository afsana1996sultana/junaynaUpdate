@extends('layouts.frontend')
@section('content-frontend')
@include('frontend.common.add_to_cart_modal')
@section('title')
Category Nest Online Shop
@endsection
@push('css')

<style>
.campain__list {
    display: flex;
    flex-wrap: wrap;
    gap: 18px;
}

.single__campaign {
    width: 18%;
}
.campain__list {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
}

/* Normal desktop :1200px. */
@media (min-width: 1200px) and (max-width: 1500px) {}


/* Normal desktop :992px. */
@media (min-width: 992px) and (max-width: 1200px) {
    .single__campaign {
    	width: 22%;
    }
}


/* Tablet desktop :768px. */
@media (min-width: 768px) and (max-width: 991px) {
     .single__campaign {
    	width: 22%;
    }   
}


/* small mobile :320px. */
@media (max-width: 767px) {
   .single__campaign {
	width: 45%;
}
.product-cart-wrap .product-badges-right span {
	padding: 5px 8px;
}
.campain__list {
	margin-top: 50px;
}
}

/* Large Mobile :480px. */
@media only screen and (min-width: 480px) and (max-width: 767px) {

}
</style>

@endpush

<main class="main">
    <div class=" mt-30 mb-50 page-header">
        <div class="container-fluid">
            <div class="archive-header">
                <div class="row align-items-center">
                    <div class="col-xl-3">
                        <h1 class="mb-15">All Campaign</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="container-fluid category-wise-product" style="padding-top:0">
        <div class="row">
            <!-- Campaign Slider Start-->
             <div class="col-xl-9 col-lg-9">
        		@php
                    $campaign = \App\Models\Campaing::where('status', 1)->where('is_featured', 1)->first();
                @endphp
        	
            @if($campaign)
                @php
                    $start_diff=date_diff(date_create($campaign->flash_start), date_create(date('d-m-Y H:i:s')));
                    $end_diff=date_diff(date_create(date('d-m-Y H:i:s')), date_create($campaign->flash_end));
                @endphp
                @if ($start_diff->invert == 0 && $end_diff->invert == 0)
                <section class="common-product section-padding">
                    <div class="container wow animate__animated animate__fadeIn">
                        <div class="section-title">
                            <div class="title">
                                <h3>{{$campaign->name_en }}</h3>
                                <div class="deals-countdown-wrap">
                                    <div class="deals-countdown" data-countdown="{{ date(('Y-m-d H:i:s'), strtotime($campaign->flash_end)) }}"></div>
                                </div>
                            </div>
                        </div>
                        <div class="campain__list">
                                 @foreach($campaign->campaing_products->take(20) as $campaing_product)
                                    @php
                                        $product = \App\Models\Product::find($campaing_product->product_id);
                                    @endphp
                                    @if ($product != null && $product->status != 0)
                                          <div class="product-cart-wrap single__campaign  mb-30 wow animate__animated animate__fadeIn" data-wow-delay=".1s">
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
                                     
                                                 <div class="product-card-bottom d-flex">
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
                                                     @php
                                                        $productsellcount = \App\Models\OrderDetail::where('product_id', $product->id)->sum('qty') ?? 0;
                                                    @endphp
                                                    <span class="price">Sold({{ $productsellcount }})</span>
                                                 </div>
                                             </div>
                                         </div>
                                        
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                </section>
                @endif
        	@endif
        	
        	<!-- Campaign Slider End-->
            <div class="col-xl-3 col-lg-3 sticky-sidebar">
                <!-- Fillter By Price -->
                @include('frontend.common.filterby')
                <!-- SideCategory -->
                @include('frontend.common.sidecategory')
            </div>
             </div>
        </div>
    </div>
</main>
@endsection
@push('footer-script')
<script type="text/javascript">
</script>

<script type="text/javascript">
    function filter() {
        $('#search-form').submit();
    }
</script>
@endpush