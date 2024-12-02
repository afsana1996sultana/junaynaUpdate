<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Coupon;
use App\Models\User;
use Carbon\Carbon;
use Session;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $coupons = Coupon::latest()->get();
        return view('backend.coupon.index', compact('coupons'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::latest()->get();
        return view('backend.coupon.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'coupon_code' => 'required|max:50',
            'limit_per_user' => 'required',
            'total_use_limit' => 'required',
            'expire_date' => 'nullable',
            'type' => 'required',
            'user_id' => 'required',
            'description' => 'nullable',
        ]);

        $coupon = new Coupon();
        $coupon->coupon_code = $request->coupon_code;
        $coupon->discount_type = $request->discount_type;
        $coupon->discount = $request->discount;
        $coupon->limit_per_user = $request->limit_per_user;
        $coupon->total_use_limit = $request->total_use_limit;
        $coupon->expire_date = $request->expire_date;
        $coupon->type = $request->type;
        $coupon->description = $request->description;
        
        $coupon['user_id'] = implode(',', $request->user_id);


        if($request->status == Null){
            $request->status = 0;
        }
        $coupon->status = $request->status;
        $coupon->created_at = Carbon::now();

        $coupon->save();

        Session::flash('success','Coupon Inserted Successfully');
        return redirect()->route('coupons.index');
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
        $coupon = Coupon::findOrFail($id);
        $users = User::latest()->get();
        return view('backend.coupon.edit',compact('coupon','users'));
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

        $coupon = Coupon::findOrFail($id);

        $this->validate($request,[
            'coupon_code' => 'required|max:50',
            'discount_type' => 'required',
            'discount' => 'required',
            'limit_per_user' => 'required',
            'total_use_limit' => 'required',
            'expire_date' => 'nullable',
            'type' => 'required',
            'user_id' => 'required',
            'description' => 'nullable',
        ]);

        $coupon->coupon_code        = $request->coupon_code;
        $coupon->discount_type      = $request->discount_type;
        $coupon->discount           = $request->discount;
        $coupon->limit_per_user     = $request->limit_per_user;
        $coupon->total_use_limit    = $request->total_use_limit;
        $coupon->expire_date        = $request->expire_date;
        $coupon['user_id']          = implode(',', $request->user_id);
        $coupon->type               = $request->type;
        $coupon->description        = $request->description;

        if($request->status == Null){
            $request->status = 0;
        }
        $coupon->status = $request->status;
        $coupon->updated_at = Carbon::now();

        $coupon->save();

        Session::flash('success','Coupon Updated Successfully');
        return redirect()->route('coupons.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $coupon = Coupon::findOrFail($id);

        $coupon->delete();

        $notification = array(
            'message' => 'Coupon Deleted Successfully.',
            'alert-type' => 'error'
        );
        return redirect()->back()->with($notification);
    }
    /*=================== Start Active/Inactive Methoed ===================*/
    public function active($id){
        $coupon = Coupon::find($id);
        $coupon->status = 1;
        $coupon->save();

        Session::flash('success','Coupon Active Successfully.');
        return redirect()->back();
    }

    public function inactive($id){
        $coupon = Coupon::find($id);
        $coupon->status = 0;
        $coupon->save();

        Session::flash('warning','Coupon Inactive Successfully.');
        return redirect()->back();
    }
}
