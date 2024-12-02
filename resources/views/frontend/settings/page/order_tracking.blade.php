@extends('layouts.frontend')
@section('content-frontend')
    <main class="main">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="{{ route('home')}}" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                    <span></span> Page
                    <span></span> Order Tracking
                </div>
            </div>
        </div>
        <div class="container mt-50">
            <div class="row">
                <div class="col-lg-11 mb-40 mx-auto">
                    <div class="card py-4 px-3 shadow-sm">
                        <div class="col-xl-10 col-lg-10 col-md-12 m-auto">
                            <div class="row">
                                <div class="col-lg-6 d-none d-lg-block">
                                    <img class="border-radius-15" src="{{asset('frontend/assets/imgs/page/Order-Tracking.webp')}}" alt="" />
                                </div>
                                <div class="col-lg-6 col-md-8">
                                    <div class="login_wrap widget-taber-content background-white">
                                        <div class="padding_eight_all bg-white">
                                            <div class="heading_s1">
                                                <h1 class="mb-5" style="font-size: 36px !important;">Track Your Order Status</h1>
                                                <p class="mb-30">To track your order Status please enter your Invoice No in the box below and press "Track" button. This was given to you on your receipt and in the confirmation phone you should have received.</p>
                                            </div>
                                            <form method="POST" action="{{ route('order.track') }}" class="row g-3 needs-validation" novalidate>
                                                @csrf
                                                <div class="form-group">
                                                    <label>Order ID <span class="text-danger">*</span></label>
                                                    <input type="text" name="invoice_no" placeholder="Found in your order confirmation email" value="{{ old('invoice_no') }}" required/>
                                                    @error('invoice_no')
                                                        <div class="text-danger" style="font-weight: bold;">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label>Phone <span class="text-danger">*</span></label>
                                                    <input type="number" name="phone" placeholder="Phone you used during checkout" value="{{ old('phone')}}"  required/>
                                                    @error('phone')
                                                        <div class="text-danger" style="font-weight: bold;">{{ $message }}</div>
                                                    @enderror
                                                </div> 
                                                <div class="form-group">
                                                    <button class="submit submit-auto-width" type="submit">Track</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection