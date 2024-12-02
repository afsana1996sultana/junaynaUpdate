@extends('layouts.frontend')
@section('content-frontend')
	<div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="{{ route('home') }}" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                <span>Brands</span>
            </div>
        </div>
    </div>
    <div class="container mb-30 mt-30">
        <div class="row">
            <div class="col-lg-12">
                <div class="shop-product-fillter-header">
                    <div class="row">
                    	@foreach($brands as $brand)
                        <div class="col-md-3">
                            <div class="card">
                            	<div class="category_header">
                                    <a href="{{ route('product.brand', $brand->slug) }}" class="align-items-center d-flex d-inline-block">
                                        <img src="{{ asset($brand->brand_image) }}" class="img-fluid category_image" alt="{{ env('APP_NAME') }}">
                                        <h4 class="category-title">
                                            @if(session()->get('language') == 'bangla')
                                                {{ $brand->name_bn }}
                                            @else
                                                {{ $brand->name_en }}
                                            @endif
                                        </h4>
                                    </a> <hr>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection