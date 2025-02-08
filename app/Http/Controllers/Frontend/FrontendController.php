<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Banner;
use App\Models\Slider;
use App\Models\Product;
use App\Models\Attribute;
use App\Models\MultiImg;
use App\Models\Page;
use App\Models\Blog;
use App\Models\OrderDetail;
use App\Models\Order;
use App\Models\Vendor;
use Auth;
use Illuminate\Support\Facades\Hash;
use Session;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use App\Utility\CategoryUtility;

class FrontendController extends Controller
{
    /*=================== Start Index Methoed ===================*/
    public function index(Request $request)
    {
        $products = Product::where('status',1)->where('is_featured',1)->orderBy('id','DESC')->get();
        // Search Start
        $sort_search =null;
        if ($request->has('search')){
            $sort_search = $request->search;
            $products = $products->where('name_en', 'like', '%'.$sort_search.'%');
            // dd($products);
        }else{
            $products = Product::where('status',1)->where('is_featured',1)->orderBy('id','DESC')->get();
        }
        // Header Category Start
        $categories = Category::orderBy('name_en','DESC')->where('status','=',1)->limit(5)->get();
        // Header Category End
        // Category Featured all
        $featured_category = Category::orderBy('name_en','DESC')->where('is_featured','=',1)->where('status','=',1)->limit(15)->get();
        //Slider
        $sliders = Slider::where('status',1)->orderBy('id','ASC')->limit(10)->get();
        // Product Top Selling
        $product_top_sellings = Product::where('status',1)->orderBy('id','ASC')->limit(2)->get();
        //Product Trending
        $product_trendings = Product::where('status',1)->orderBy('id','ASC')->skip(2)->limit(2)->get();
        //Product Recently Added
        // $product_recently_adds = Product::where('status',1)->latest()->skip(2)->limit(2)->get();
        $product_recently_adds = Product::where('status',1)->latest()->get();

        $product_top_rates = Product::where('status',1)->orderBy('regular_price')->limit(2)->get();
        // Home Banner
        $home_banners = Banner::where('status',1)->where('position',1)->orderBy('id','DESC')->get();
        // Daily Best Sells
        $todays_sale  = OrderDetail::where('created_at', 'like', '%'.date('Y-m-d').'%')->get();
        $todays_sale = $todays_sale->unique('product_id');
        //Home2 featured category
        $home2_featured_categories = Category::where('is_featured','=',1)->where('parent_id', 0)->where('status', 1)->orderBy('id','DESC')->limit(8)->get();

        foreach($home2_featured_categories as $home2_featured_category){
            $fcat_products = null;
            $conditions = array();

            $category_ids = CategoryUtility::children_ids($home2_featured_category->id);
            $category_ids[] = $home2_featured_category->id;

            $fcat_products = Product::where($conditions)->whereIn('category_id', $category_ids)->limit(10)->latest()->get();
            $home2_featured_category->cat_products = $fcat_products;
        }

        //$home2_featured_categories = Category::where('is_featured', 1)->where('status', 1)->limit(8)->latest()->get();
        // Hot deals product
        $hot_deals = Product::where('status',1)->where('is_deals',1)->latest()->get();
        //dd($hot_deals);
        // blog
        $blogs = Blog::where('status',1)->orderBy('id','DESC')->get();

        $home_view = 'frontend.home';

        return view($home_view, compact('categories','sliders','featured_category','products','product_top_sellings','product_trendings','product_recently_adds','product_top_rates','home_banners','sort_search','todays_sale','home2_featured_categories','hot_deals','blogs'));
    } // end method

    /* ========== Start ProductDetails Method ======== */
    public function productDetails($slug){

        $product = Product::where('slug', $slug)->first();
        if($product){
            if($product->id){
                $multiImg = MultiImg::where('product_id',$product->id)->get();
            }

            /* ================= Product Color Eng ================== */
            $color_en = $product->product_color_en;
            $product_color_en = explode(',', $color_en);

            /* ================= Product Size Eng =================== */
            $size_en = $product->product_size_en;
            $product_size_en = explode(',', $size_en);

            /* ================= Realted Product =============== */
            $cat_id = $product->category_id;
            $relatedProduct = Product::where('category_id', $cat_id)->where('id', '!=', $product->id)->where('status', 1)->orderBy('id', 'DESC')->get();

            $categories = Category::orderBy('name_en','ASC')->where('status','=',1)->limit(5)->get();
            $new_products = Product::orderBy('name_en')->where('status','=',1)->limit(3)->latest()->get();

            return view('frontend.product.product_details', compact('product','multiImg','categories','new_products','product_color_en','product_size_en','relatedProduct'));
        }

        return view('frontend.product.productNotFound');
    }

    /* ========== Start BlogDetails Method ======== */
    public function blogDetails($slug){

        // $data['blogData'] = Blog::where('blogs.slug',$request->slug)->first();

        $blog = Blog::where('slug', $slug)->first();
        $relatedBlog = Blog::where('status',1)->latest()->limit(5)->orderBy('id','DESC')->get();
        return view('frontend.product.blog_details', compact('blog','relatedBlog'));
    }

    public function CatWiseProduct(Request $request, $slug)
    {
        $category = Category::where('slug', $slug)->first();
        $sort_by = $request->input('sort_by');
        $brand_id = $request->brand_id;

        $conditions = ['status' => 1];

        if($brand_id != null){
            $conditions = array_merge($conditions, ['brand_id' => $brand_id]);
        }

        // Start building the query with conditions
        $products = Product::where($conditions);

        // Apply category filtering
        $category_ids = CategoryUtility::children_ids($category->id);
        $category_ids[] = $category->id;
        $products = $products->whereIn('category_id', $category_ids);

        // Apply price filtering
        $min_price = $request->get('filter_price_start');
        $max_price = $request->get('filter_price_end');

        if ($min_price != null && $max_price != null) {
            $products = $products->whereBetween('regular_price', [$min_price, $max_price]);
        }

        // Apply sorting
        switch ($sort_by) {
            case 'newest':
                $products = $products->orderBy('created_at', 'desc');
                break;
            case 'oldest':
                $products = $products->orderBy('created_at', 'asc');
                break;
            case 'price-asc':
                $products = $products->orderBy('regular_price', 'asc');
                //dd($products);
                break;
            case 'price-desc':
                $products = $products->orderBy('regular_price', 'desc');
                break;
            default:
                $products = $products->orderBy('id', 'desc');
                break;
        }

        $products = $products->paginate(32)->appends(request()->query());
        //$products = $products->get();
        //dd($products);
        $categories = Category::orderBy('name_en', 'ASC')->where('status', '=', 1)->get();
        $subcategories = Category::orderBy('name_en', 'ASC')->where('status', 1)->where('parent_id', $category->id)->get();
        return view('frontend.product.category_view', compact('products', 'categories', 'category', 'sort_by', 'brand_id', 'subcategories'));
    }


    public function BrandWiseProduct(Request $request, $slug)
    {
        $brands = Brand::where('slug', $slug)->first();
        $conditions = ['status' => 1];
        $products = Product::where($conditions);
        if ($brands) {
            $products = $products->where('brand_id', $brands->id);
        }

        $min_price = $request->get('filter_price_start');
        $max_price = $request->get('filter_price_end');

        if ($min_price != null && $max_price != null) {
            $products = $products->whereBetween('regular_price', [$min_price, $max_price]);
        }

        $products = $products->paginate(32)->appends(request()->query());
        return view('frontend.product.brand_view', compact('products', 'brands'));
    }



    /* ========== Start AllFeaturedProduct Method ======== */
    public function AllFeaturedProduct(Request $request){
        $sort_by = $request->sort_by;
        $brand_id = $request->brand;

        $conditions = ['status' => 1];

        if($brand_id != null){
            $conditions = array_merge($conditions, ['brand_id' => $brand_id]);
        }elseif ($request->brand != null) {
            $brand_id = (Brand::where('slug', $request->brand)->first() != null) ? Brand::where('slug', $request->brand)->first()->id : null;
            $conditions = array_merge($conditions, ['brand_id' => $brand_id]);
        }

        $products_sort_by = Product::where($conditions);

        switch ($sort_by) {
            case 'newest':
                $products_sort_by->orderBy('created_at', 'desc')->paginate(32)->appends(request()->query());
                break;
            case 'oldest':
                $products_sort_by->orderBy('created_at', 'asc')->paginate(32)->appends(request()->query());
                break;
            case 'price-asc':
                $products_sort_by->orderBy('regular_price', 'asc')->paginate(32)->appends(request()->query());
                break;
            case 'price-desc':
                $products_sort_by->orderBy('regular_price', 'desc')->paginate(32)->appends(request()->query());
                break;
            default:
                $products_sort_by->orderBy('id', 'desc')->paginate(32)->appends(request()->query());
                break;
        }
        // Hot deals product
        $products = Product::where('status',1)->where('is_featured',1)->paginate(32)->appends(request()->query());

        // Category Filter Start
        if ($request->get('filtercategory')){

            $checked = $_GET['filtercategory'];
            // filter With name start
            $category_filter = Category::whereIn('name_en', $checked)->get();
            $catId = [];
            foreach($category_filter as $cat_list){
                array_push($catId, $cat_list->id);
            }
            // filter With name end

            $products = Product::whereIn('category_id', $catId)->where('status', 1)->where('is_featured',1)->latest()->paginate(32)->appends(request()->query());
            // dd($products);
        }

    return view('frontend.product.featuredproduct_view',compact('products'));

    } // end method

     /* ========== Start CatWiseProduct Method ======== */
    public function VendorWiseProduct(Request $request,$slug){

        $vendor = Vendor::where('slug', $slug)->first();
        // dd($category);

        $products = Product::where('status', 1)->where('vendor_id',$vendor->id)->orderBy('id','DESC')->paginate(32)->appends(request()->query());
        // Price Filter
        if ($request->get('filter_price_start')!== Null && $request->get('filter_price_end')!== Null ){
            $filter_price_start = $request->get('filter_price_start');
            $filter_price_end = $request->get('filter_price_end');

            if ($filter_price_start>0 && $filter_price_end>0) {
                $products = Product::where('status','=',1)->where('vendor_id',$vendor->id)->whereBetween('regular_price',[$filter_price_start,$filter_price_end])->paginate(32)->appends(request()->query());
                // dd($products);
            }

        }

        $categories = Category::orderBy('name_en','ASC')->where('status','=',1)->get();
        // dd($products);

        return view('frontend.product.vendor_view',compact('products','categories','vendor'));
    } // end method
    /* ========== End CatWiseProduct Method ======== */

    /* ================= Start ProductViewAjax Method ================= */
    public function ProductViewAjax($id){

        $product = Product::with('category','brand')->findOrFail($id);
        //dd($product);
        $attribute_values = json_decode($product->attribute_values);

        $attributes = new Collection;
        foreach($attribute_values as $key => $attribute_value){
            $attr = Attribute::select('id','name')->where('id',$attribute_value->attribute_id)->first();
            // $attribute->name = $attr->name;
            // $attribute->id = $attr->id;
            $attr->values = $attribute_value->values;
            $attributes->add($attr);
        }


        return response()->json(array(
            'product' => $product,
            'attributes' => $attributes,
        ));
    }
    /* ================= END PRODUCT VIEW WITH MODAL METHOD =================== */


    public function pageAbout($slug){
        $page = Page::where('slug', $slug)->first();
        return view('frontend.settings.page.about',compact('page'));
    }

    public function orderTracking()
    {
        return view('frontend.settings.page.order_tracking');
    }

    public function orderTrack(Request $request)
    {
        $this->validate($request, [
            'invoice_no' => 'required',
        ]);

        $searchQuery = $request->invoice_no;

        $order = Order::where('invoice_no', $searchQuery)
                    ->orWhere('phone', $searchQuery) // Exact phone number match
                    ->orWhere('phone', 'LIKE', "%$searchQuery") // Last 4-digit phone match
                    ->orWhere('name', 'LIKE', "%$searchQuery%") // Partial name match
                    ->first();

        if (!$order) {
            return redirect()->back()->with([
                'message' => 'Order not found. Please check your input.',
                'alert-type' => 'error'
            ]);
        }
        return view('frontend.settings.page.track', compact('order'));
    }


    /* ================= Start Product Search =================== */
    public function ProductSearch(Request $request){

        //$request->validate(["search" => "required"]);
        $sort_by = $request->sort_by;
        $brand_id = $request->brand;

        $conditions = ['status' => 1];

        if($brand_id != null){
            $conditions = array_merge($conditions, ['brand_id' => $brand_id]);
        }elseif ($request->brand != null) {
            $brand_id = (Brand::where('slug', $request->brand)->first() != null) ? Brand::where('slug', $request->brand)->first()->id : null;
            $conditions = array_merge($conditions, ['brand_id' => $brand_id]);
        }

        $products_sort_by = Product::where($conditions);

        switch ($sort_by) {
            case 'newest':
                $products_sort_by->orderBy('created_at', 'desc')->paginate(32)->appends(request()->query());
                break;
            case 'oldest':
                $products_sort_by->orderBy('created_at', 'asc')->paginate(32)->appends(request()->query());
                break;
            case 'price-asc':
                $products_sort_by->orderBy('regular_price', 'asc')->paginate(32)->appends(request()->query());
                break;
            case 'price-desc':
                $products_sort_by->orderBy('regular_price', 'desc')->paginate(32)->appends(request()->query());
                break;
            default:
                $products_sort_by->orderBy('id', 'desc')->paginate(32)->appends(request()->query());
                break;
        }

        $item = $request->search;
        $category_id = $request->searchCategory;
        // echo "$item";

        // Header Category Start //
        $categories = Category::orderBy('name_en','DESC')->where('status', 1)->get();
        if($category_id == 0){
            $products = Product::where('name_en','LIKE',"%$item%")->where('status'
            , 1)->latest()->get();
        }else{
            $products = Product::where('name_en','LIKE',"%$item%")->where('category_id', $category_id)->where('status'
            , 1)->latest()->get();
        }

        $attributes = Attribute::orderBy('name', 'DESC')->where('status', 1)->latest()->get();

        return view('frontend.product.search',compact('products','categories','attributes','sort_by','brand_id'));

    } // end method

    /* ================= End Product Search =================== */

    /* ================= Start Advance Product Search =================== */
    public function advanceProduct(Request $request){

        //  return $request;

        $request->validate(["search" => "required"]);

        $item = $request->search;
        $category_id = $request->category;
        // echo "$item";

        // Header Category Start //
        $categories = Category::orderBy('name_en','DESC')->where('status', 1)->get();

        if($category_id == 0){
            $products = Product::where('name_en','LIKE',"%$item%")->where('status'
            , 1)->latest()->get();
        }else{
            $products = Product::where('name_en','LIKE',"%$item%")->where('category_id', $category_id)->where('status'
            , 1)->latest()->get();
        }

        $attributes = Attribute::orderBy('name', 'DESC')->where('status', 1)->latest()->get();

        return view('frontend.product.advance_search',compact('products','categories','attributes'));

    } // end method

    /* ================= End Advance Product Search =================== */

    /* ================= Start Hot Deals Page Show =================== */
    public function hotDeals(Request $request){

        $sort_by = $request->sort_by;
        $brand_id = $request->brand;

        $conditions = ['status' => 1];

        if($brand_id != null){
            $conditions = array_merge($conditions, ['brand_id' => $brand_id]);
        }elseif ($request->brand != null) {
            $brand_id = (Brand::where('slug', $request->brand)->first() != null) ? Brand::where('slug', $request->brand)->first()->id : null;
            $conditions = array_merge($conditions, ['brand_id' => $brand_id]);
        }

        $products_sort_by = Product::where($conditions);

        switch ($sort_by) {
            case 'newest':
                $products_sort_by->orderBy('created_at', 'desc')->paginate(32)->appends(request()->query());
                break;
            case 'oldest':
                $products_sort_by->orderBy('created_at', 'asc')->paginate(32)->appends(request()->query());
                break;
            case 'price-asc':
                $products_sort_by->orderBy('regular_price', 'asc')->paginate(32)->appends(request()->query());
                break;
            case 'price-desc':
                $products_sort_by->orderBy('regular_price', 'desc')->paginate(32)->appends(request()->query());
                break;
            default:
                $products_sort_by->orderBy('id', 'desc')->paginate(32)->appends(request()->query());
                break;
        }
        // Hot deals product
        $products = Product::where('status',1)->where('is_deals',1)->paginate(32)->appends(request()->query());

        // Category Filter Start
        if ($request->get('filtercategory')){

            $checked = $_GET['filtercategory'];
            // filter With name start
            $category_filter = Category::whereIn('name_en', $checked)->get();
            $catId = [];
            foreach($category_filter as $cat_list){
                array_push($catId, $cat_list->id);
            }
            // filter With name end

            $products = Product::whereIn('category_id', $catId)->where('status', 1)->where('is_deals',1)->latest()->paginate(32)->appends(request()->query());
            // dd($products);
        }
        // Category Filter End

        $attributes = Attribute::orderBy('name', 'DESC')->where('status', 1)->latest()->get();
        // End Shop Product //
        return view('frontend.deals.hot_deals',compact('attributes','products','sort_by','brand_id'));

    } // end method
}
