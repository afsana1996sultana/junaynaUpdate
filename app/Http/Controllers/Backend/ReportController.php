<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\Vendor;
use Auth;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $sort_by = null;
        $products = Product::orderBy('created_at', 'desc');
        $categories = Category::where('id', $request->category_id)->select('id', 'name_en')->first();
        
        if (Auth::guard('admin')->user()->role == '2') {
            $products = Product::orderBy('created_at', 'desc')->where('vendor_id', Auth::guard('admin')->user()->id);
        
            // Check if category_id is present in the request
            if ($request->has('category_id')) {
                $sort_by = $request->category_id;
                $products->where('category_id', $sort_by);
            }
            $vendor = Vendor::where('user_id', Auth::guard('admin')->user()->id)->first();
        
            if ($vendor) {
                $products->where('vendor_id', $vendor->user_id)->latest();
            }
            //return $products->get();
        } else {
            $products = Product::orderBy('created_at', 'desc');
        
            if ($request->has('category_id')) {
                $sort_by = $request->category_id;
                $products->where('category_id', $sort_by);
            }

            //return $products->get();
        }
        $products = $products->paginate(20);
        return view('backend.reports.index', compact('products', 'categories'));
    }


    public function ProductSellindex(Request $request)
    {
        $products = Product::query()->orderBy('created_at', 'desc');
        // Filter by vendor if the user is a vendor
        if (Auth::guard('admin')->user()->role == '2') {
            $vendorId = Auth::guard('admin')->user()->id;
            $products->where('vendor_id', $vendorId);
        }

        // Filter by category if provided
        if ($request->has('category_id')) {
            $products->where('category_id', $request->category_id);
        }
    
        // Paginate the result
        $products = $products->withCount(['orderDetails as product_sell_count' => function ($query) {
            $query->select(DB::raw("SUM(qty)"));
        }])->paginate(20);
    
        // Fetch the category (if needed)
        $categories = Category::find($request->category_id);
    
        return view('backend.reports.productsellindex', compact('products', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}