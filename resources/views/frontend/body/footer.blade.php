<footer class="main footer-dark">
    <section class="featured section-padding">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-1-5 col-md-4  col-sm-6 col-6 mb-md-4 mb-xl-0">
                    <div class="banner-left-icon wow animate__animated animate__fadeInUp" data-wow-delay="0">
                        <center>
                            <div class="banner-icon">
                                <img src="{{ asset('frontend/assets/imgs/theme/icons/icon-1.svg') }}" alt="" />
                            </div>
                        </center>
                        <div class="banner-text">
                            <h3 class="icon-box-title">Best prices & offers</h3>
                            <p>Orders $50 or more</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-1-5 col-md-4  col-sm-6 col-6">
                    <div class="banner-left-icon wow animate__animated animate__fadeInUp" data-wow-delay=".1s">
                        <center>
                            <div class="banner-icon">
                                <img src="{{ asset('frontend/assets/imgs/theme/icons/icon-2.svg') }}" alt="" />
                            </div>
                        </center>
                        <div class="banner-text">
                            <h3 class="icon-box-title">Free delivery</h3>
                            <p>24/7 amazing services</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-1-5 col-md-4 col-sm-6 col-6">
                    <div class="banner-left-icon wow animate__animated animate__fadeInUp" data-wow-delay=".2s">
                        <center>
                            <div class="banner-icon">
                                <img src="{{ asset('frontend/assets/imgs/theme/icons/icon-3.svg') }}" alt="" />
                            </div>
                        </center>
                        <div class="banner-text">
                            <h3 class="icon-box-title">Great daily deal</h3>
                            <p>When you sign up</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-1-5 col-md-4 col-sm-6 col-6">
                    <div class="banner-left-icon wow animate__animated animate__fadeInUp" data-wow-delay=".3s">
                        <center>
                            <div class="banner-icon">
                                <img src="{{ asset('frontend/assets/imgs/theme/icons/icon-4.svg') }}" alt="" />
                            </div>
                        </center>
                        <div class="banner-text">
                            <h3 class="icon-box-title">Wide assortment</h3>
                            <p>Mega Discounts</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-1-5 col-md-4 col-sm-6 col-6">
                    <div class="banner-left-icon wow animate__animated animate__fadeInUp" data-wow-delay=".4s">
                        <center>
                            <div class="banner-icon">
                                <img src="{{ asset('frontend/assets/imgs/theme/icons/icon-5.svg') }}" alt="" />
                            </div>
                        </center>
                        <div class="banner-text">
                            <h3 class="icon-box-title">Easy returns</h3>
                            <p>Within 30 days</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-1-5 col-md-4 col-sm-6 col-6 d-none">
                    <div class="banner-left-icon wow animate__animated animate__fadeInUp" data-wow-delay=".5s">
                        <center>
                            <div class="banner-icon">
                                <img src="{{ asset('frontend/assets/imgs/theme/icons/icon-6.svg') }}" alt="" />
                            </div>
                        </center>
                        <div class="banner-text">
                            <h3 class="icon-box-title">Safe delivery</h3>
                            <p>Within 30 days</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--subscribe start-->
    <div class="subscribe-area">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 ">
                    <div class="subscribe-contents ">
                        <img src="{{ asset('upload/subscribe.png') }}" alt="">
                        <h5>SIGN UP FOR NEWSLETTER FOR OFFER AND UPDATES</h5>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="subscribe-content">
                        <form action="{{ route('subscribers.store') }}" method="POST"
                            class="d-flex align-items-center">
                            @csrf
                            <input type="email" name="email" placeholder="Your Email Address">
                            <button type="submit">Subscribe</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--subscribe end-->

    <section class="section-padding footer-mid dark-section main-footer-custom">
        <div class="container-fluid pt-15 pb-20">
            <div class="row">
                <div class="col-md-4 col-sm-6 col-12">
                    <div class="footer-link-widget wow animate__animated animate__fadeInUp" data-wow-delay=".1s">
                        <h4 class="widget-title">SEA FOOD Info</h4>
                        <ul class="contact-infor">
                            <li>
                                <img src="{{ asset('frontend/assets/imgs/theme/icons/icon-location.svg') }}"
                                    alt="" /><strong>Address: </strong>
                                <span>{{ get_setting('business_address')->value ?? 'null' }}</span>
                            </li>

                            <li>
                                <img src="{{ asset('frontend/assets/imgs/theme/icons/icon-contact.svg') }}"
                                    alt="" /><strong>Call Us: </strong><a
                                    href="tel:{{ get_setting('phone')->value ?? 'null' }}">{{ get_setting('phone')->value ?? 'null' }}</a>
                            </li>

                            <li>
                                <img src="{{ asset('frontend/assets/imgs/theme/icons/icon-email-2.svg') }}"
                                    alt="" /><strong>Email: </strong><a
                                    href="mailto:{{ get_setting('email')->value ?? 'null' }}">{{ get_setting('email')->value ?? 'null' }}</a>
                            </li>

                            <li>
                                <img src="{{ asset('frontend/assets/imgs/theme/icons/icon-clock.svg') }}"
                                    alt="" /><strong>Hours:</strong><span>
                                    {{ get_setting('business_hours')->value ?? 'null' }}</span>
                            </li>
                        </ul>

                        <div class="mobile-social-icon justify-content-start mt-3">
                            <a target="_blank" href="{{ get_setting('facebook_url')->value ?? 'null' }}"><img
                                    src="{{ asset('frontend/assets/imgs/theme/icons/icon-facebook-white.svg') }}"
                                    alt="" /></a>
                            <a target="_blank" href="{{ get_setting('twitter_url')->value ?? 'null' }}"><img
                                    src="{{ asset('frontend/assets/imgs/theme/icons/icon-twitter-white.svg') }}"
                                    alt="" /></a>
                            <a target="_blank" href="{{ get_setting('instagram_url')->value ?? 'null' }}"><img
                                    src="{{ asset('frontend/assets/imgs/theme/icons/icon-instagram-white.svg') }}"
                                    alt="" /></a>
                            <a target="_blank" href="{{ get_setting('pinterest_url')->value ?? 'null' }}"><img
                                    src="{{ asset('frontend/assets/imgs/theme/icons/icon-pinterest-white.svg') }}"
                                    alt="" /></a>
                            <a target="_blank" href="{{ get_setting('youtube_url')->value ?? 'null' }}"><img
                                    src="{{ asset('frontend/assets/imgs/theme/icons/icon-youtube-white.svg') }}"
                                    alt="" /></a>
                        </div>
                    </div>
                </div>

                <div class="col-md-8 col-sm-6 col-12">
                    <div class="row">
                        <div class="col-sm-6 col-md-3 col-12">
                            <div class="footer-link-widget wow animate__animated animate__fadeInUp"
                                data-wow-delay=".2s">
                                <h4 class="widget-title">Account</h4>
                                <ul class="footer-list mb-sm-5 mb-md-0">
                                    <li><a href="#">My Profile</a></li>
                                    <li><a href="{{ route('cart.show') }}">cart</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-3 col-12">
                            <div class="footer-link-widget wow animate__animated animate__fadeInUp"
                                data-wow-delay=".1s">
                                <h4 class="widget-title">Policy</h4>
                                <ul class="footer-list mb-sm-5 mb-md-0">
                                    @foreach (get_pages_both_footer()->take(3) as $page)
                                        <li>
                                            <a href="{{ route('page.about', $page->slug) }}">
                                                {{ $page->title }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <div class="ms-xl-auto col-md-5 col-12 mr-0">
                            <div class="footer-link-widget wow animate__animated animate__fadeInUp"
                                data-wow-delay=".1s">
                                <h4 class="widget-title">Quick Links</h4>
                                <ul class="footer-list mb-sm-5 mb-md-0">
                                    @foreach (get_pages_both_footer()->skip(3)->take(4) as $page)
                                        <li>
                                            <a href="{{ route('page.about', $page->slug) }}">
                                                {{ $page->title }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="pb-30 wow animate__animated animate__fadeInUp dark-section special__section" data-wow-delay="0">
        <div class="container">
            <div class="row align-items-center copyright__content">
                 <div class="col-12 text-center">
                      <p class="m-0">&copy; {{ get_setting('copy_right')->value ?? 'null' }} All rights reserved </p>
                    <span>
                        Developed by:
                        <a target="_blank" href="https://codehouseit.com/">Codehouse IT</a>
                    </span>
                </div>
            </div>
        </div>
    </div>
</footer>

@php
    $prefix = Request::route()->getPrefix();
    $route = Route::current()->getName();
@endphp
<div class="nest-mobile-bottom-nav d-xl-none mobile_fixed_bottom bg-white shadow-lg border-top rounded-top"
    style="box-shadow: 0px -1px 10px rgb(0 0 0 / 15%)!important; ">
    <div class="row align-items-center gutters-5">
        <div class="col mobile_bottom_nav_col">
            <a href="{{ route('home') }}" class="text-reset d-block text-center pb-2 pt-3">
                <i class="fas fa-home fs-20 opacity-60 opacity-100 {{ $route == 'home' ? 'text-brand' : '' }}"></i>
                <span class="d-block fs-10 fw-600">Home</span>
            </a>
        </div>
        <div class="col mobile_bottom_nav_col">
            <a href="{{ route('product.show') }}" class="text-reset d-block text-center pb-2 pt-3">
                <span class="d-inline-block position-relative px-2">
                    <i
                        class="fa-sharp fa-solid fa-bag-shopping {{ $route == 'product.show' ? 'text-brand' : '' }}"></i>
                </span>
                <span class="d-block fs-10 fw-600">Shop</span>
            </a>
        </div>
        <div class="col-auto">
            <a href="{{ route('cart.show') }}" class="text-reset d-block text-center pb-2 pt-3">
                <span class="mobile-card-nav align-items-center d-flex justify-content-center position-relative"
                    style="margin-top: -33px;box-shadow: 0px -5px 10px rgb(0 0 0 / 15%);border-color: #fff !important;">
                    <i class="fa-solid fa-cart-shopping la-2x text-white"></i>
                </span>
                <span class="d-block mt-1 fs-10 fw-600">
                    Cart
                    (<span class="cart-count cartQty"></span>)
                </span>
            </a>
        </div>
        <div class="col mobile_bottom_nav_col">
            <a href="{{ route('category_list.index') }}" class="text-reset d-block text-center pb-2 pt-3">
                <i
                    class="fas fa-list-ul fs-20 opacity-60 {{ $route == 'category_list.index' ? 'text-brand' : '' }}"></i>
                <span class="d-block fs-10 fw-600">Categories</span>
            </a>
        </div>
        <div class="col mobile_bottom_nav_col">
            @if (Auth()->check())
                <a href="{{ route('dashboard') }}" class="text-reset d-block text-center pb-2 pt-3">
                    <span class="d-block mx-auto">
                        <img src="{{ asset('frontend/assets/imgs/avatar-place.png') }}"
                            class="rounded-circle mobile_bottom_nav_account">
                    </span>
                    <span class="d-block fs-10 fw-600">Account</span>
                </a>
            @else
                <a href="{{ route('login') }}" class="text-reset d-block text-center pb-2 pt-3">
                    <span class="d-block mx-auto">
                        <img src="{{ asset('frontend/assets/imgs/avatar-place.png') }}"
                            class="rounded-circle mobile_bottom_nav_account">
                    </span>
                    <span class="d-block fs-10 fw-600">Account</span>
                </a>
            @endif
        </div>
    </div>
</div>
