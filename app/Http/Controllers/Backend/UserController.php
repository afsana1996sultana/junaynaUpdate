<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Session;
use Image;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::guard('admin')->user()->role != '1'){
            abort(404);
        }
        $customers = User::where('role', 3)->latest()->get();
    	return view('backend.customer.index',compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.customer.create');
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
        $this->validate($request,[
            'name'                  => 'required',
            'username'              => 'nullable',
            'email'                 => 'nullable|email|max:191|unique:users',
            'address'               => 'required',
            'phone'                 => ['required','regex:/(\+){0,1}(88){0,1}01(3|4|5|6|7|8|9)(\d){8}/','min:11','max:15','unique:users'],
            'profile_image'         => 'nullable',
            'status'                => 'nullable',
            'division_id'           => 'required',
            'district_id'           => 'required',
            'upazilla_id'           => 'required',
        ]);

        if($request->hasfile('profile_image')){
            $image = $request->file('profile_image');
            $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(160,160)->save('upload/admin_images/'.$name_gen);
            $save_url = 'upload/admin_images/'.$name_gen;
        }else{
            $save_url = '';
        }

        $customer = new User();
        $customer->name = $request->name;
        $customer->username = $request->username;
        $customer->email = $request->email;
        $customer->phone = $request->phone;
        $customer->division_id = $request->division_id;
        $customer->district_id = $request->district_id;
        $customer->upazilla_id = $request->upazilla_id;
        $customer->address = $request->address;
        $customer->password =  Hash::make("12345678");
        $customer->profile_image = $save_url;
        $customer->created_at = Carbon::now();
        $customer->role = 3;
        $customer->status = $request->status;
        $customer->save();
		Session::flash('success','Customer Create Successfully');
		return redirect()->route('customer.index');
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
        $customer = User::findOrFail($id);
    	return view('backend.customer.edit',compact('customer'));
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
        $this->validate($request,[
            'name'                  => 'required',
            'address'               => 'nullable',
            'profile_image'         => 'nullable',
            'status'                => 'nullable',
        ]);
        $customer = User::find($id);
        if($request->hasfile('profile_image')){
            try {
                if(file_exists($customer->profile_image)){
                    unlink($customer->profile_image);
                }
            } catch (Exception $e) {

            }
            $profile_image = $request->profile_image;
            $profile_save = time().$profile_image->getClientOriginalName();
            $profile_image->move('upload/admin_images/',$profile_save);
            $customer->profile_image = 'upload/admin_images/'.$profile_save;
        }else{
            $profile_save = '';
        }

        $customer->name = $request->name;
        $customer->username = $request->username;
        $customer->email = $request->email;
        $customer->phone = $request->phone;
        $customer->division_id = $request->division_id;
        $customer->district_id = $request->district_id;
        $customer->upazilla_id = $request->upazilla_id;
        $customer->address = $request->address;
        $customer->role = 3;
        $customer->status = $request->status;
        $customer->save();
		Session::flash('success','Customer Update Successfully');
		return redirect()->route('customer.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $customer = User::findOrFail($id);
    	try {
            if(file_exists($customer->profile_image)){
                unlink($customer->profile_image);
            }
        } catch (Exception $e) {

        }

    	$customer->delete();

        $notification = array(
            'message' => 'Customer Deleted Successfully.',
            'alert-type' => 'error'
        );
		return redirect()->back()->with($notification);
    }


    public function status($id)
    {
        $customer = User::find($id);
        if($customer->status == 1){
            $customer->status = 0;
        }else{
            $customer->status = 1;
        }
        $customer->save();
        $notification = array(
            'message' => 'Customer Feature Status Changed Successfully.',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
}
