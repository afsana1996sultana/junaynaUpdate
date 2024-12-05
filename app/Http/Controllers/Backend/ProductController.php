<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\AccountHead;
use App\Models\AccountLedger;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Vendor;
use App\Models\Supplier;
use App\Models\Product;
use App\Models\MultiImg;
use App\Models\Attribute;
use App\Models\AttributeValue;
use App\Models\ProductStock;
use App\Models\Unit;
use Carbon\Carbon;
use Image;
use Session;
use Illuminate\Support\Str;
use Auth;
use Illuminate\Support\Collection;
use Yajra\DataTables\Facades\DataTables;

class ProductController extends Controller
{
    /*=================== Start ProductView Methoed ===================*/
    public function ProductView(Request $request)
 {

     if (\request()->ajax()) {
         $products = Product::latest()->get();
         return DataTables::of($products)
             ->addIndexColumn()
             ->addColumn('product_image', function ($product) {
                 return '<img src="' . asset($product->product_thumbnail) . '" class="img-sm" alt="Userpic" style="width: 50px; height: 50px;">';
             })
             ->addColumn('name_en', function ($product) {
                 return $product->name_en ?? ' ';
             })
             ->addColumn('category', function ($product) {
                 return $product->category->name_en ?? ' ';
             })
             ->addColumn('regular_price', function ($product) {
                 return $product->regular_price ?? ' ';
             })
             ->addColumn('quantity', function ($product) {
                  if ($product->is_varient){
                      return  'Variant Product';
                  }else{
                   return  $product->stock_qty ?? 'NULL';
                  }
             })
             ->addColumn('discount', function ($product) {
                  if ($product->discount_price >0){
                      if ($product->discount_type == 1){
                       return '<span style="font-size: 12px" class="badge rounded-pill alert-info">৳'. $product->discount_price . '</span>';
                      }elseif($product->discount_type == 2){
                            return   '<span style="font-size: 12px" class="badge rounded-pill alert-success">'. $product->discount_price .'% off</span>';
                      }
                  }else{
                    return '<span style="font-size: 12px" class="badge rounded-pill alert-danger">No Discount</span>';
                  }

             })
             ->addColumn('featured', function ($product) {
                 if ($product->is_featured == 1) {
                     return '<a href="'. route('product.featured', ['id' => $product->id]).'"> <span style="font-size: 12px" class="badge rounded-pill alert-success"">Yes</span> </a>';
                 } else {
                     return '<a href="' . route('product.featured', ['id' => $product->id]) .'"> <span style="font-size: 12px" class="badge rounded-pill alert-danger">No</span> </a>';
                 }
             })

             ->addColumn('name_bn', function ($product) {
                return $product->name_bn ?? ' ';
             })
             ->addColumn('status', function ($product) {
                if ($product->status == 1) {
                    return '<a href="'. route('product.in_active', ['id' => $product->id]).'"> <span style="font-size: 12px" class="badge badge-success">Active</span> </a>';
                } else {
                    return '<a href="' . route('product.active', ['id' => $product->id]) .'"> <span style="font-size: 12px" class="badge badge-danger">Disable</span> </a>';
                }
            })

             ->addColumn('action', function ($product) {
                 return view('backend.product.action_button', compact('product'));
             })
             ->rawColumns(['status','action','name_en','name_bn','product_image','regular_price','category','quantity','discount','featured'])
             ->tojson();
     }
     return view('backend.product.product_view');
}

    // end method

    /*=================== Start ProductAdd Methoed ===================*/
    public function ProductAdd()
    {
        $categories = Category::where('parent_id', 0)->with('childrenCategories')->orderBy('name_en', 'asc')->get();
        $brands = Brand::latest()->get();
        $vendors = Vendor::latest()->get();
        $suppliers = Supplier::latest()->get();
        $units = Unit::latest()->get();
        $attributes = Attribute::latest()->get();
        return view('backend.product.product_add', compact('categories', 'brands', 'vendors', 'suppliers', 'attributes', 'units'));
    } // end method

    /*=================== Start StoreProduct Methoed ===================*/
    public function StoreProduct(Request $request)
    {
        $request->validate([
            'name_en'           => 'required|max:150',
            'purchase_price'    => 'required|numeric',
            'wholesell_price'   => 'nullable|numeric',
            'discount_price'    => 'nullable|numeric',
            'regular_price'     => 'required|numeric',
            'stock_qty'         => 'required|integer',
            'minimum_buy_qty'   => 'required|integer',
            'description_en'    => 'nullable|string',
            'short_description_en'    => 'nullable|string',
            'category_id'       => 'required|integer',
            'unit_weight'       => 'nullable|numeric',
            'unit_id'           => 'nullable|integer',
            'product_thumbnail' => 'nullable|file',
        ]);

        if (!$request->name_bn) {
            $request->name_bn = $request->name_en;
        }

        if (!$request->description_bn) {
            $request->description_bn = $request->description_en;
        }

        if (!$request->short_description_bn) {
            $request->short_description_bn = $request->description_en;
        }

        // $slug = strtolower(str_replace(' ', '-', $request->name_en));
        if ($request->slug != null) {
            $slug = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', $request->slug));
        } else {
            $slug = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', $request->name_en)) . '-' . Str::random(5);
        }

        if ($request->vendor_id == null || $request->vendor_id == "") {
            $request->vendor_id = 0;
        }

        if ($request->supplier_id == null || $request->supplier_id == "") {
            $request->supplier_id = 0;
        }

        if ($request->unit_id == null || $request->unit_id == "") {
            $request->unit_id = 0;
        }

        if ($request->hasfile('product_thumbnail')) {
            $image = $request->file('product_thumbnail');
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(438, 438)->save('upload/products/thumbnails/' . $name_gen);
            $save_url = 'upload/products/thumbnails/' . $name_gen;
        } else {
            $save_url = '';
        }

        $product = Product::create([
            'brand_id'              => $request->brand_id,
            'category_id'           => $request->category_id,
            'vendor_id'             => $request->vendor_id,
            'supplier_id'           => $request->supplier_id,
            'unit_id'               => $request->unit_id,
            'name_en'               => $request->name_en,
            'name_bn'               => $request->name_bn,
            'slug'                  => $slug,
            'unit_weight'           => $request->unit_weight,
            'purchase_price'        => $request->purchase_price,
            'wholesell_price'       => $request->wholesell_price,
            'wholesell_minimum_qty' => $request->wholesell_minimum_qty,
            'regular_price'         => $request->regular_price,
            'discount_price'        => $request->discount_price,
            'discount_type'         => $request->discount_type,
            'product_code'          => rand(10000, 99999),
            'minimum_buy_qty'       => $request->minimum_buy_qty,
            'stock_qty'             => $request->stock_qty,
            'description_en'        => $request->description_en,
            'description_bn'        => $request->description_bn,
            'short_description_en'        => $request->short_description_en,
            'short_description_bn'        => $request->short_description_bn,
            'is_featured'           => $request->is_featured ? 1 : 0,
            'is_deals'              => $request->is_deals ? 1 : 0,
            'is_digital'            => $request->is_digital ? 1 : 0,
            'status'                => $request->status ? 1 : 0,
            'product_thumbnail'     => $save_url,
            'created_by'            => Auth::guard('admin')->user()->id,
        ]);



        // dd($product);

        /* ========= Start Multiple Image Upload ========= */
        $images = $request->file('multi_img');
        if ($images) {
            foreach ($images as $img) {
                $make_name = hexdec(uniqid()) . '.' . $img->getClientOriginalExtension();
                Image::make($img)->resize(917, 1000)->save('upload/products/multi-image/' . $make_name);
                $uploadPath = 'upload/products/multi-image/' . $make_name;

                MultiImg::insert([
                    'product_id' => $product->id,
                    'photo_name' => $uploadPath,
                    'created_at' => Carbon::now(),
                ]);
            }
        }
        /* ========= End Multiple Image Upload ========= */

        /* ========= Product Attributes Start ========= */
        $attribute_values = array();
        if ($request->has('choice_attributes')) {
            foreach ($request->choice_attributes as $key => $attribute) {
                $atr = 'choice_options' . $attribute;
                $item['attribute_id'] = $attribute;
                $data = array();

                foreach ($request[$atr] as $key => $value) {
                    array_push($data, $value);
                }

                $item['values'] = $data;
                array_push($attribute_values, $item);
            }
        }

        if (!empty($request->choice_attributes)) {
            $product->attributes = json_encode($request->choice_attributes);
            $product->is_varient = 1;

            if ($request->has('vnames')) {
                $i = 0;
                foreach ($request->vnames as $key => $name) {
                    $stock = ProductStock::create([
                        'product_id' => $product->id,
                        'varient'    => $name,
                        'sku'        => $request->vskus[$i],
                        'price'      => $request->vprices[$i],
                        'qty'        => $request->vqtys[$i],
                    ]);

                    if ($request->vimages) {
                        $image = $request->vimages[$i];
                        if ($image) {
                            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
                            Image::make($image)->resize(438, 438)->save('upload/products/variations/' . $name_gen);
                            $save_url = 'upload/products/variations/' . $name_gen;
                        } else {
                            $save_url = '';
                        }
                        $stock->image = $save_url;
                    }
                    $stock->save();
                    $i++;
                }
            }
        } else {
            $product->attributes = json_encode(array());
        }

        $attr_values = collect($attribute_values);
        $attr_values_sorted = $attr_values->sortByDesc('attribute_id');

        $sorted_array = array();
        foreach ($attr_values_sorted as $attr) {
            array_push($sorted_array, $attr);
        }

        $product->attribute_values = json_encode($sorted_array, JSON_UNESCAPED_UNICODE);
        /* ========= End Product Attributes ========= */

        /* =========== Start Product Tags =========== */
        $product->tags = implode(',', $request->tags);
        /* =========== End Product Tags =========== */

        $product->save();

        $ledger_balance = get_account_balance() - $product->purchase_price;
        //Ledger Entry
        $ledger = AccountLedger::create([
            'account_head_id' => 1,
            'particulars' => 'Product ID: ' . $product->id,
            'debit' => $product->purchase_price,
            'balance' => $ledger_balance,
            'product_id' => $product->id,
            'type' => 1,
        ]);

        $notification = array(
            'message' => 'Product Inserted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('product.all')->with($notification);
    } // end method

    /*=================== Start EditProduct Methoed ===================*/
    public function EditProduct($id)
    {
        $product = Product::findOrFail($id);
        $multiImgs = MultiImg::where('product_id', $id)->get();

        $categories = Category::latest()->get();
        $brands = Brand::latest()->get();
        $vendors = Vendor::latest()->get();
        $suppliers = Supplier::latest()->get();
        $units = Unit::latest()->get();
        $attributes = Attribute::latest()->get();

        //dd($product->stocks);

        return view('backend.product.product_edit', compact('categories', 'vendors', 'suppliers', 'brands', 'attributes', 'product', 'multiImgs', 'units'));
    } // end method

    /*=================== Start ProductUpdate Methoed ===================*/
    public function ProductUpdate(Request $request, $id)
    {
        $currentPage = $request->get('page', $request->page);
        $product = Product::find($id);

        $this->validate($request, [
            'name_en'           => 'required|max:150',
            'purchase_price'    => 'required|numeric',
            'wholesell_price'   => 'nullable|numeric',
            'discount_price'    => 'nullable|numeric',
            'regular_price'     => 'required|numeric',
            'stock_qty'         => 'required|integer',
            'description_en'    => 'nullable|string',
            'short_description_en'    => 'nullable|string',
            'category_id'       => 'required|integer',
            'brand_id'          => 'nullable|integer',
            'unit_id'           => 'nullable|integer',
            'unit_weight'       => 'nullable|numeric',
        ]);

        if (!$request->name_bn) {
            $request->name_bn = $request->name_en;
        }

        if (!$request->description_bn) {
            $request->description_bn = $request->description_en;
        }

        if (!$request->short_description_bn) {
            $request->short_description_bn = $request->short_description_en;
        }

        if ($request->name_en != $product->name_en) {
            if ($request->slug != null) {
                $slug = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', $request->slug));
            } else {
                $slug = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', $request->name_en)) . '-' . Str::random(5);
            }
        } else {
            $slug = $product->slug;
        }

        if ($request->vendor_id == null || $request->vendor_id == "") {
            $request->vendor_id = 0;
        }

        if ($request->supplier_id == null || $request->supplier_id == "") {
            $request->supplier_id = 0;
        }

        if ($request->unit_id == null || $request->unit_id == "") {
            $request->unit_id = 0;
        }

        if ($request->hasfile('product_thumbnail')) {
            try {
                if (file_exists($product->product_thumbnail)) {
                    unlink($product->product_thumbnail);
                }
            } catch (Exception $e) {
            }
            $image = $request->file('product_thumbnail');
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(438, 438)->save('upload/products/thumbnails/' . $name_gen);
            $save_url = 'upload/products/thumbnails/' . $name_gen;
        } else {
            $save_url = $product->product_thumbnail;
        }

        $product->update([
            'brand_id'              => $request->brand_id,
            'category_id'           => $request->category_id,
            'vendor_id'             => $request->vendor_id,
            'supplier_id'           => $request->supplier_id,
            'unit_id'               => $request->unit_id,
            'name_en'               => $request->name_en,
            'name_bn'               => $request->name_bn,
            'slug'                  => $slug,
            'unit_weight'           => $request->unit_weight,
            'purchase_price'        => $request->purchase_price,
            'wholesell_price'       => $request->wholesell_price,
            'wholesell_minimum_qty' => $request->wholesell_minimum_qty,
            'regular_price'         => $request->regular_price,
            'discount_price'        => $request->discount_price,
            'discount_type'         => $request->discount_type,
            'minimum_buy_qty'       => $request->minimum_buy_qty,
            'stock_qty'             => $request->stock_qty,
            'description_en'        => $request->description_en,
            'description_bn'        => $request->description_bn,
            'short_description_en'        => $request->short_description_en,
            'short_description_bn'        => $request->short_description_bn,
            'is_featured'           => $request->is_featured ? 1 : 0,
            'is_deals'              => $request->is_deals ? 1 : 0,
            'is_digital'            => $request->is_digital ? 1 : 0,
            'status'                => $request->status ? 1 : 0,
            'product_thumbnail'     => $save_url,
            'created_by' => Auth::guard('admin')->user()->id,
        ]);


        /* ========= Product Previous Stock Clear ========= */
        $product_stocks = $product->stocks;
        if (count($product_stocks) > 0) {
            if ($request->is_variation_changed) {
                foreach ($product_stocks as $stock) {
                    // unlink($stock->image);
                    try {
                        if (file_exists($stock->image)) {
                            unlink($stock->image);
                        }
                    } catch (Exception $e) {
                    }
                    $stock->delete();
                }
            } else {
                foreach ($product_stocks as $stock) {
                    try {
                        if (file_exists($stock->image)) {
                            //unlink($stock->image);
                        }
                        $newImage = $request->file($stock->id . "_image");
                        if ($newImage && $newImage->isValid()) {
                            // Generate a new image name and save it
                            $name_gen = hexdec(uniqid()) . '.' . $newImage->getClientOriginalExtension();
                            Image::make($newImage)->resize(438, 438)->save('upload/products/variations/' . $name_gen);
                            $save_url = 'upload/products/variations/' . $name_gen;

                            $stock->update([
                                'image' => $save_url,
                            ]);
                        }
                    } catch (Exception $e) {
                    }

                    $variant = $stock->id . "_variant";
                    $price = $stock->id . "_price";
                    $sku = $stock->id . "_sku";
                    $qty = $stock->id . "_qty";
                    $image = $stock->id . "_image";

                    $stock->update([
                        'sku' => $request->$sku,
                        'price' => $request->$price,
                        'qty' => $request->$qty,
                    ]);
                }
            }
        }

        if ($request->is_variation_changed) {
            /* ========= Product Attributes Start ========= */
            $attribute_values = array();
            if ($request->has('choice_attributes')) {
                foreach ($request->choice_attributes as $key => $attribute) {
                    $atr = 'choice_options' . $attribute;
                    $item['attribute_id'] = $attribute;
                    $data = array();

                    foreach ($request[$atr] as $key => $value) {
                        array_push($data, $value);
                    }

                    $item['values'] = $data;
                    array_push($attribute_values, $item);
                }
            }

            if (!empty($request->choice_attributes)) {
                $product->attributes = json_encode($request->choice_attributes);
                $product->is_varient = 1;

                if ($request->has('vnames')) {
                    $i = 0;
                    foreach ($request->vnames as $key => $name) {
                        $stock = ProductStock::create([
                            'product_id' => $product->id,
                            'varient'    => $name,
                            'sku'        => $request->vskus[$i],
                            'price'      => $request->vprices[$i],
                            'qty'        => $request->vqtys[$i],
                        ]);
                        if ($request->vimages) {
                            $image = $request->vimages[$i];
                            if ($image) {
                                $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
                                Image::make($image)->resize(438, 438)->save('upload/products/variations/' . $name_gen);
                                $save_url = 'upload/products/variations/' . $name_gen;
                            } else {
                                $save_url = '';
                            }
                            $stock->image = $save_url;
                        }
                        $stock->save();
                        $i++;
                    }
                }
            } else {
                $product->attributes = json_encode(array());
                $product->is_varient = 0;
            }

            $attr_values = collect($attribute_values);
            $attr_values_sorted = $attr_values->sortByDesc('attribute_id');

            $sorted_array = array();
            foreach ($attr_values_sorted as $attr) {
                array_push($sorted_array, $attr);
            }

            $product->attribute_values = json_encode($sorted_array, JSON_UNESCAPED_UNICODE);
            /* ========= End Product Attributes ========= */
        }


        /* =========== Start Product Tags =========== */
        $product->tags = implode(',', $request->tags);
        /* =========== End Product Tags =========== */

        /* =========== Multiple Image Update =========== */

        $images = $request->file('multi_img');

        if ($images == Null) {
            $product->multi_imgs->photo_name = $request->multi_img;
            $product->update();
        } else {
            foreach ($images as $img) {
                $make_name = hexdec(uniqid()) . '.' . $img->getClientOriginalExtension();
                Image::make($img)->resize(917, 1000)->save('upload/products/multi-image/' . $make_name);
                $uploadPath = 'upload/products/multi-image/' . $make_name;

                MultiImg::insert([
                    'product_id' => $product->id,
                    'photo_name' => $uploadPath,
                    'created_at' => Carbon::now(),
                ]);
            }
        }

        $product->save();

        Session::flash('success', 'Product Updated Successfully');
        return redirect()->route('product.all', ['page' => $currentPage]);
    } // end method
    /*=================== End ProductUpdate Methoed ===================*/

    /*=================== Start Multi Image Delete =================*/
    public function MultiImageDelete($id)
    {
        $oldimg = MultiImg::findOrFail($id);
        try {
            if (file_exists($oldimg->photo_name)) {
                unlink($oldimg->photo_name);
            }
        } catch (Exception $e) {
        }
        MultiImg::findOrFail($id)->delete();


        return response()->json(['success' => 'Product Deleted Successfully']);
    } // end method
    /*=================== End Multi Image Delete =================*/

    /*=================== Start ProductDelete Method =================*/
    public function ProductDelete($id)
    {

        if (!demo_mode()) {
            $product = Product::findOrFail($id);

            try {
                if (file_exists($product->product_thumbnail)) {
                    unlink($product->product_thumbnail);
                }
            } catch (Exception $e) {
            }

            $product->delete();

            $images = MultiImg::where('product_id', $id)->get();
            foreach ($images as $img) {
                try {
                    if (file_exists($img->photo_name)) {
                        unlink($img->photo_name);
                    }
                } catch (Exception $e) {
                }
                MultiImg::where('product_id', $id)->delete();
            }

            $notification = array(
                'message' => 'Product Deleted Successfully',
                'alert-type' => 'success'
            );
        } else {
            $notification = array(
                'message' => 'Product can not be deleted on demo mode.',
                'alert-type' => 'error'
            );
        }

        return redirect()->back()->with($notification);
    } // end method
    /*=================== End ProductDelete Method =================*/

    /*=================== Start Active/Inactive Methoed ===================*/
    public function active($id)
    {
        $product = Product::find($id);
        $product->status = 1;
        $product->save();

        $notification = array(
            'message' => 'Product Active Successfully.',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    } // end method

    public function inactive($id)
    {
        $product = Product::find($id);
        $product->status = 0;
        $product->save();

        $notification = array(
            'message' => 'Product Inactive Successfully.',
            'alert-type' => 'error'
        );
        return redirect()->back()->with($notification);
    } // end method

    /*=================== Start Featured Methoed ===================*/
    public function featured($id)
    {
        $product = Product::find($id);
        if ($product->is_featured == 1) {
            $product->is_featured = 0;
        } else {
            $product->is_featured = 1;
        }
        $product->save();
        $notification = array(
            'message' => 'Product Feature Status Changed Successfully.',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    } // end method

    /*=================== Start Category With SubCategory  Ajax ===================*/
    public function GetSubProductCategory($category_id)
    {
        $subcat = SubCategory::where('category_id', $category_id)->orderBy('subcategory_name_en', 'ASC')->get();
        return json_encode($subcat);
    } // end method

    /*=================== Start SubCategory With Childe Ajax ===================*/
    public function GetSubSubCategory($subcategory_id)
    {
        $childe = SubSubCategory::where('subcategory_id', $subcategory_id)->orderBy('subsubcategory_name_en', 'ASC')->get();
        return json_encode($childe);
    } // end method

    public function add_more_choice_option(Request $request)
    {
        $attributes = Attribute::whereIn('id', $request->attribute_ids)->get();
        // dd($attributes);
        return view('backend.product.attribute_select_value', compact('attributes'));
    }


    /* ============== Category Store Ajax ============ */
    public function categoryInsert(Request $request)
    {

        if ($request->name_en == Null) {
            return response()->json(['error' => 'Category Field  Required']);
        }

        $category = new Category();

        $category->name_en = $request->name_en;

        /* ======== Category Name English ======= */
        $category->name_en = $request->name_en;
        if ($request->name_bn == '') {
            $category->name_bn = $request->name_en;
        } else {
            $category->name_bn = $request->name_bn;
        }

        /* ======== Category Parent Id  ======= */
        if ($request->parent_id != "0") {
            $category->parent_id = $request->parent_id;

            $parent = Category::find($request->parent_id);

            // dd($parent);
            $category->type = $parent->type + 1;
        }

        /* ======== Category Slug   ======= */
        if ($request->slug != null) {
            $category->slug = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', $request->slug));
        } else {
            $category->slug = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', $request->name_en)) . '-' . Str::random(5);
        }

        if ($request->hasfile('image')) {
            $image = $request->file('image');
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(300, 300)->save('upload/category/' . $name_gen);
            $save_url = 'upload/category/' . $name_gen;
        } else {
            $save_url = '';
        }

        $category->image = $save_url;
        $category->created_by = Auth::guard('admin')->user()->id;
        $category->save();

        $categories = Category::with('childrenCategories')->orderBy('name_en', 'asc')->get();

        return response()->json([
            'success' => 'Category Inserted Successfully',
            'categories' => $categories,
        ]);
    }

    /* ============== Brand Store Ajax ============ */

    /* ============== Brand Store Ajax ============== */
    public function brandInsert(Request $request)
    {

        if ($request->name_en == Null) {
            return response()->json(['error' => 'Brand Field  Required']);
        }

        $brand = new Brand();

        $brand->name_en = $request->name_en;

        /* ======== brand Name English ======= */
        $brand->name_en = $request->name_en;
        if ($request->name_bn == '') {
            $brand->name_bn = $request->name_en;
        } else {
            $brand->name_bn = $request->name_bn;
        }

        /* ======== Category Slug   ======= */
        if ($request->slug != null) {
            $brand->slug = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', $request->slug));
        } else {
            $brand->slug = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', $request->name_en)) . '-' . Str::random(5);
        }



        // dd($request->image);


        if ($request->hasfile('brand_image')) {
            $image = $request->file('brand_image');
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(300, 300)->save('upload/brand/' . $name_gen);
            $save_url = 'upload/brand/' . $name_gen;
        } else {
            $save_url = '';
        }

        $brand->brand_image = $save_url;
        $brand->created_by = Auth::guard('admin')->user()->id;

        $brand->save();
        $brands = Brand::all();

        return response()->json([
            'success' => 'Brand Inserted Successfully',
            'brands' => $brands,
        ]);
    }
}
