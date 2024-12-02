<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use App\Models\User;
use App\Models\AccountHead;
use App\Models\AccountLedger;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Staff;
use Auth;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Session;

class PosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::where('status', 1)->latest()->get();
        $categories = Category::where('status', 1)->latest()->get();
        $brands = Brand::where('status', 1)->latest()->get();
        $staffs = Staff::latest()->get();
        $customers = User::where('role', 3)->where('status', 1)->latest()->get();
        return view('backend.pos.index', compact('products', 'categories', 'brands', 'customers','staffs'));
    }

    public function getProduct($id)
    {
        $product = Product::findOrFail($id);
        return json_encode($product);
    }

    public function filter()
    {
        $products = Product::where('status', 1);
        if(isset($_GET['search_term'])){
            $products = $products->where('name_en', 'like', '%'.$_GET['search_term'].'%');
        }
        if(isset($_GET['category_id'])){
            $products = $products->where('category_id', $_GET['category_id']);
        }
        if(isset($_GET['brand_id'])){
            $products = $products->where('brand_id', $_GET['brand_id']);
        }
        $products = $products->get();
        return json_encode($products);
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
        //dd($request);
        $product_ids = $request->product_id;

        if(!$product_ids || count($product_ids)<=0){
            $notification = array(
                'message' => 'Add at least one product.', 
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }

        //dd($request->customer_id);

        if($request->payment_method == NULL) {
            $request->payment_method = "cash";
        }
        
        if($request->due_amount == 0.00){
            $payment = $request->payment_status = 'paid';
        }else{
            $payment = $request->payment_status = 'unpaid';
        }

       

        $invoice_data = Order::orderBy('id','desc')->first();
        if($invoice_data){
            $lastId = $invoice_data->id;
            // $idd = str_replace("E-", "", $lastId);
            $id = str_pad($lastId + 1, 7, 0, STR_PAD_LEFT);
            $invoice_no = $id;
        }else{
            $invoice_no = "0000001";
        }
        if($request->staff_id){
            $staff = Staff::where('id', $request->staff_id)->first();
            $staff_commission = (($request->grand_total/100) * $staff->user->commission);
        }else{
            $staff_commission = 0;
        }

        $gust_user = User::where('role', 4)->first();
        if($request->customer_id == 0){
            $customer = $gust_user->id;
            $user_name = $gust_user->name;
            $user_email = $gust_user->email;
            $user_phone = $gust_user->phone;
            $user_address = $gust_user->address;
        }else{
            $customer =$request->customer_id;
            $find_user = User::findOrFail($request->customer_id);
            $user_name = $find_user->name;
            $user_email = $find_user->email;
            $user_phone = $find_user->phone;
            $user_address = $find_user->address;
        }

        // dd($customer);
        // dd($staff_commission);
        $order = Order::create([
            'user_id'           => $customer,
            'staff_id'          => $request->staff_id,
            'staff_commission'  => $staff_commission,
            'grand_total'       => $request->grand_total,
            'sub_total'         => $request->subtotal,
            'discount'          => $request->discount,
            'paid_amount'       => $request->paid_amount,
            'due_amount'        => $request->due_amount,
            'payment_method'    => $request->payment_method,
            'payment_status'    => $payment,
            'invoice_no'        => $invoice_no,
            'delivery_status'   => 'pending',
            'name'              => $user_name,
            'phone'             => $user_phone,
            'email'             => $user_email,
            'address'           => $user_address,
            'type'              => 3,
            //'created_by' => Auth::guard('admin')->user()->id,
        ]);
        //dd($order);

        // order details add //
        for($i=0; $i<count($product_ids); $i++) {
            //$product = Product::find($product_ids[$i]);
            OrderDetail::insert([
                'order_id' => $order->id, 
                'product_id' => $product_ids[$i],
                'is_varient' => 0,
                'qty' => $request->qty[$i],
                'price' => $request->price[$i],
                'created_at' => Carbon::now(),
            ]);
        }

        //Ledger Entry

        $ledger_balance = get_account_balance() + $order->grand_total;
        
        $ledger = AccountLedger::create([
            'account_head_id' => 2,
            'particulars' => 'Order ID: '.$order->id,
            'credit' => $order->grand_total,
            'order_id' => $order->id,
            'balance' => $ledger_balance,
            'type' => 2,
        ]);

        $notification = array(
            'message' => 'Your order has been placed successfully.', 
            'alert-type' => 'success'
        );
        return redirect()->route('print.invoice.download', compact('order'))->with($notification);
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
    public function customerInsert(Request $request)
    {
        // if($request->name == Null){
        //     return response()->json(['error'=> 'Customer Field Required']);
        // }

        $this->validate($request,[
            'name'              => 'required',
            'username'          => ['nullable', 'unique:users'],
            'phone'             => ['required','regex:/(\+){0,1}(88){0,1}01(3|4|5|6|7|8|9)(\d){8}/','min:11','max:15', 'unique:users'],
            'email'             => ['nullable', 'string', 'email', 'max:255', 'unique:users'],
            'address'           => 'required',
            'profile_image'     => 'nullable',
        ]);
        
        $customer = new User();
        if($request->hasfile('profile_image')){
            $image = $request->file('profile_image');
            $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(300,300)->save('upload/user/'.$name_gen);
            $save_url = 'upload/user/'.$name_gen; 
        }else{ 
            $save_url = '';
        }
        $customer->profile_image = $save_url;
        
        $customer->name     = $request->name;
        $customer->username = $request->username;
        $customer->phone    = $request->phone;
        $customer->email    = $request->email;
        $customer->address  = $request->address;
        $customer->role     = 3;
        $customer->status   = 1;
        $customer->password = Hash::make("12345678");
        $customer->save();

        $customers = User::where('role', 3)->orderBy('id','desc')->get();

        return response()->json([ 
            'success'=> 'Customer Inserted Successfully',
            'customers' => $customers,
        ]);
    }
}