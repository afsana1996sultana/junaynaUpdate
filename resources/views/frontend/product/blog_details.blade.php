@extends('layouts.frontend')
@section('content-frontend')
    <div class="blog-details mt-5">
        <div class="container" >
            <div class="row" >
                <div class="col-12">
                    <ul class="breadcrumb d-flex dashboard-bg p-20" style="background: #F1FCFC">
                        <li><a href="{{ route('home') }}" rel="nofollow">Home</a></li>
                         <li style="padding:0 5px;"><span></span> Blog Details</li>
                         <li><span></span> {{ $blog->title_en }}</li>
                    </ul>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-xl-3 col-lg-3 col-md-4">
                    <div class="blog-left-side">
                        <h4><i class="fa fa-solid fa-gem"></i> CATEGORIES</h4>
                        <ul>
                            @foreach(get_categories() as $category)
                                <li>
                                    <a href="{{ route('product.category', $category->slug) }}">
                                        @if(session()->get('language') == 'bangla') 
                                            {{ $category->name_bn }}
                                        @else 
                                            {{ $category->name_en }} 
                                        @endif
                                        @php
                                           $products = App\Models\Product::where('category_id',$category->id)->orderBy('id','DESC')->get(); 
                                        @endphp
                                    <span>( {{ count($products) }} )</span>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                
                
                <div class="col-xl-9 col-lg-9 col-md-8">
                    <div class="single-blog">
                        <h6 class="blog-date">
                            <strong>{{ date_format(date_create($blog->created_at), 'd') }}<span>{{ date_format(date_create($blog->created_at), 'M') }}</strong>
                        </h6>
                        <div class="blog-details-img">
                            <img src="{{ asset($blog->blog_img) }}" alt="">
                        </div>
                        <div class="blog-content">
                            <h5>{{ $blog->title_en }}</h5>
                            <ul class="d-flex">
                                <li><i class="fa fa-comments"></i>
                                    0 comments
                                </li>
                                <li>
                                    <i class="fa fa-tags"></i>
                                    <span>{{ $blog->tags }}</span>
                                </li>
                            </ul>

                            <p>{!! $blog->description !!}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- announcement start -->
    <div class="announcement-area">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="section-heading text-center">
                        <h3>RELATED blog</h3>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="announcement-active">
                    @foreach ($relatedBlog as $blog)
                    <div class="single-blog">
                        <a href="{{ route('blog.details', $blog->slug) }}" class="single-announcement">
                            <div class="announcement-image">
                                <img src="{{ asset($blog->blog_img) }}" alt="">
                            </div>
                            <div class="announcement-content">
                                <h6>{{ $blog->title_en }}</h6>
                                <a href="{{ route('blog.details', $blog->slug) }}">Read more <i class="fa fa-right-long"></i></a>
                            </div>
                        </a>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <!-- announcement end -->
@endsection
@push('footer-script')
<!-- Image zoom -->
    <script src="{{asset('frontend/magiczoomplus/magiczoomplus.js')}}"></script>
	<script>
		var mzOptions = {
			zoomWidth: "400px",
			zoomHeight: "400px",
			zoomDistance: 15,
			expandZoomMode: "magnifier",
			expandZoomOn: "always",
			variableZoom: true,
		};
	</script>
@endpush