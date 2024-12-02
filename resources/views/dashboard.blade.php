@extends('layouts.frontend')
@section('title')
Dashboard Nest Online Shop
@endsection
@section('content-frontend')
<main class="main pages">
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="{{ route('home') }}" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                <span></span> Pages <span></span> My Account
            </div>
        </div>
    </div>
    <div class="page-content pt-150 pb-150">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 m-auto">
                    <div class="row">
                        <div class="col-md-3">
                            <div><p class="fs-4 fw-bolder mb-3 text-brand text-center"><i>Hello {{ Auth::user()->name ?? 'Null' }}</i></p></div>
                            <div class="dashboard-menu">
                                <ul class="nav flex-column" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="dashboard-tab" data-bs-toggle="tab" href="#dashboard" role="tab" aria-controls="dashboard" aria-selected="false"><i class="fi-rs-settings-sliders mr-10"></i>Dashboard</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="orders-tab" data-bs-toggle="tab" href="#orders" role="tab" aria-controls="orders" aria-selected="false"><i class="fi-rs-shopping-bag mr-10"></i>Orders</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="track-orders-tab" data-bs-toggle="tab" href="#track-orders" role="tab" aria-controls="track-orders" aria-selected="false"><i class="fi-rs-shopping-cart-check mr-10"></i>Track Your Order</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="address-tab" data-bs-toggle="tab" href="#address" role="tab" aria-controls="address" aria-selected="true"><i class="fi-rs-marker mr-10"></i>My Address</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="account-detail-tab" data-bs-toggle="tab" href="#account-detail" role="tab" aria-controls="account-detail" aria-selected="true"><i class="fi-rs-user mr-10"></i>Account details</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="user-password-tab" data-bs-toggle="tab" href="#user-password" role="tab" aria-controls="user-password" aria-selected="true"><i class="fi-rs-user mr-10"></i>Password Change</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="mr-10 nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                            <i class="fi-rs-sign-out mr-10"></i>
                                                {{ __('Logout') }}
                                        </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                            @csrf
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-9 dashboard">
                            <div class="tab-content account dashboard-content pl-50">
                                <div class="tab-pane fade active show" id="dashboard" role="tabpanel" aria-labelledby="dashboard-tab">
                                    <div class="row">
                                        <!--<div class="col-lg-4 col-md-4 col-sm-4 col-6 item text-center">-->
                                        <!--    <div class="card">-->
                                        <!--        <p><i class="fas fa-coins"></i></p>-->
                                        <!--        <span class="mb-4">PENDING POINT</span>-->
                                        <!--    </div>-->
                                        <!--</div>-->
                                        <!--<div class="col-lg-4 col-md-4 col-sm-4 col-6 item text-center">-->
                                        <!--    <div class="card">-->
                                        <!--        <p><i class="fas fa-coins"></i></p>-->
                                        <!--        <span>TOTAL POINT</span>-->
                                        <!--        <p>0</p>-->
                                        <!--    </div>-->
                                        <!--</div>-->
                                        <!--<div class="col-lg-4 col-md-4 col-sm-4 col-6 item text-center">-->
                                        <!--    <div class="card">-->
                                        <!--        <p><i class="fas fa-newspaper"></i></p>-->
                                        <!--        <span>TOTAL BLOGS</span>-->
                                        <!--        <p>0</p>-->
                                        <!--    </div>-->
                                        <!--</div>-->

                                        <div class="col-lg-4 col-md-4 col-sm-4 col-6 item text-center">
                                            <div class="card">
                                                <p><i class="fas fa-box"></i></p>
                                                <span>TOTAL ORDER</span>
                                                <p>{{ count($all) }}</p>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-6 item text-center">
                                            <div class="card">
                                                <p><i class="fas fa-balance-scale"></i></p>
                                                <span>PENDING ORDER</span>
                                                <p>{{ count($pending) }}</p>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-6 item text-center">
                                            <div class="card">
                                                <p><i class="fas fa-hourglass-start"></i></p>
                                                <span>PROCESSING ORDER</span>
                                                <p>{{ count($processing) }}</p>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-6 item text-center">
                                            <div class="card">
                                                <p><i class="fas fa-plane"></i></p>
                                                <span>SHIPPING ORDER</span>
                                                <p>{{ count($shipping) }}</p>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-6 item text-center">
                                            <div class="card">
                                                <p><i class="fas fa-thumbs-up"></i></p>
                                                <span>PICKED UP ORDER</span>
                                                <p>{{ count($picked) }}</p>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-6 item text-center">
                                            <div class="card">
                                                <p><i class="fa fa-window-close"></i></p>
                                                <span>CANCELED ORDER</span>
                                                <p>{{ count($cancelled) }}</p>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-6 item text-center">
                                            <div class="card">
                                                <p><i class="fa fa-window-close"></i></p>
                                                <span>COMPLETED ORDER</span>
                                                <p>{{ count($completed) }}</p>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="tab-pane fade" id="orders" role="tabpanel" aria-labelledby="orders-tab">
                                   
                                    <div class="card">
                                        <div class="card-header">
                                            <h3 class="mb-0">Your Orders</h3>
                                        </div>
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th>Sl</th>
                                                            <th>Invoice No</th>
                                                            <th>Date</th>
                                                            <th>Status</th>
                                                            <th>Total</th>
                                                            <th>Actions</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>

                                                        @if($orders->count() > 0)
                                                            @foreach($orders as $key=> $order)
                                                            <tr>
                                                                <td>{{ $key+1 }}</td>
                                                                <td>{{ $order->invoice_no }}</td>
                                                                <td>{{ \Carbon\Carbon::parse($order->date)->isoFormat('MMM Do YYYY')}}</td>
                                                                <td>{{ $order->delivery_status }}</td>
                                                                <td>{{ $order->grand_total }}</td>
                                                                <td><a target="_blank" href="{{ route('order.view',$order->invoice_no) }}" class="btn-small d-block">View</a></td>
                                                            </tr>
                                                            @endforeach
                                                        @else
                                                            <tr>
                                                                <td colspan="3"></td>
                                                                <td>
                                                                    <span class="text-center text-danger">Cart Empty!</span>
                                                                </td>
                                                            </tr>
                                                        @endif
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="track-orders" role="tabpanel" aria-labelledby="track-orders-tab">
                                    <div class="card">
                                        <div class="card-header">
                                            <h3 class="mb-0">Orders tracking</h3>
                                        </div>
                                        <div class="card-body contact-from-area">
                                            <p>To track your order please enter your OrderID in the box below and press "Track" button. This was given to you on your receipt and in the confirmation email you should have received.</p>
                                            <div class="row">
                                                <div class="col-lg-8">
                                                    <form class="contact-form-style mt-30 mb-50" action="{{ route('order.track') }}" method="POST">
                                                        @csrf
                                                        <div class="input-style mb-20">
                                                            <label>Order ID <span class="text-danger">*</span></label>
                                                            <input type="text" name="invoice_no" placeholder="Found in your order confirmation email" value="{{ old('invoice_no') }}" required/>
                                                            @error('invoice_no')
                                                                <div class="text-danger" style="font-weight: bold;">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                
                                                        <div class="input-style mb-20">
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
                                <div class="tab-pane fade" id="address" role="tabpanel" aria-labelledby="address-tab">
                                    <h3 class="mb-0">Billing Address</h3>
                                    <div class="row mt-3">
                                        @php
                                            $id = Auth::user()->id;
                                            $addresses = App\Models\Address::where('user_id', $id)->latest()->get();
                                        @endphp
                                        @foreach($addresses as $key=> $address)
                                        <div class="col-lg-6 mb-3">
                                            <div class="card mb-lg-0 position-relative">
                                                <div class="card-body">
                                                    @if ($address->is_default)
                                                        <p style="position:absolute;bottom: 11px;right: 19px;padding: 2px;background: #fc0000;font-weight: 600;font-size: 14px;color: #fff;border-radius: 20px;">Default</p>
                                                    @endif
                                                    <div class="dropdown" style="float: right; position: absolute;top: 9px;right: 17px;">
                                                        <a href="#" data-bs-toggle="dropdown" class="text-white rounded btn-sm font-sm" style="background-color:#3bb77e"> <i class="material-icons md-more_horiz"></i>:</a>
                                                        <div class="dropdown-menu">
                                                            
                                                            @if(!$address->is_default)
                                                            <a class="dropdown-item" href="{{ route('addresses.set_default', $address->id) }}">Make This Default</a>
                                                            @endif
                                                            <a class="dropdown-item text-danger" href="{{ route('user.addresses.destroy',$address->id) }}" id="delete">Delete</a>
                                                        </div>
                                                    </div>
                                                    <address>
                                                       Address {{ $key+1 }}
                                                    </address>
                                                    <p>
                                                        {{ $address->address }}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach

                                        <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#userAddressEdit">Edit info</a>
                                        <!-- Modal -->
                                        <div class="modal fade" id="userAddressEdit" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                          <div class="modal-dialog">
                                            <div class="modal-content">
                                              <div class="modal-header">
                                                <h5 class="modal-title" id="staticBackdropLabel">Address Edit</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                              </div>
                                                <form method="post" action="#">
                                                    @csrf
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="form-group col-lg-6">
                                                                <label for="division_id" class="fw-bold text-black col-form-label"><span class="text-danger">*</span> Division</label>
                                                                <select class="form-select" aria-label="Default select example"  name="division_id" id="division_id" required>
                                                                    <option selected>Select Division</option>
                                                                        @foreach(get_divisions() as $division)
                                                                            <option value="{{ $division->id }}">{{ ucwords($division->division_name_en) }}</option>
                                                                        @endforeach
                                                                </select>
                                                                @error('division_id')
                                                                    <span>{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                            <div class="form-group col-lg-6">
                                                                <label for="district_id" class="fw-bold text-black col-form-label"><span class="text-danger">*</span> District</label>
                                                                <select class="form-select" aria-label="Default select example"  name="district_id" id="district_id" required>
                                                                    <option selected=""  value="">Select District</option>
                                                                </select>
                                                                @error('district_id')
                                                                    <span>{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                            <div class="form-group col-lg-6">
                                                                <label for="upazilla_id" class="fw-bold text-black col-form-label"><span class="text-danger">*</span> Upazilla</label>
                                                                <select class="form-select" aria-label="Default select example"  name="upazilla_id" id="upazilla_id" required>
                                                                    <option selected=""  value="">Select Upazilla</option>
                                                                </select>
                                                                @error('upazilla_id')
                                                                    <span>{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                            <div class="form-group col-lg-6">
                                                                <label for="address" class="fw-bold text-black col-form-label"><span class="text-danger">*</span>Address:</label>
                                                                <textarea class="form-control" name="address" id="address" required placeholder="Address"></textarea>
                                                                @error('address')
                                                                    <span>{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                            <div class="custom-control custom-switch">
                                                                <input type="checkbox" id="md_checkbox_29" class="form-check-input cursor" name="is_default" checked="" value="1">
                                                                <label for="md_checkbox_29" class="form-check-label cursor" style="  cursor: pointer; font-weight: bold; padding-left: 8px;"> Is Default</label>
                                                            </div>
                                                            <div class="custom-control custom-switch">
                                                                <input type="checkbox" class="form-check-input me-2 cursor" name="status" id="status" checked value="1">
                                                                <label style="cursor: pointer;" class="form-check-label cursor" for="status">Status</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">Submit</button>
                                                    </div>
                                                </form>
                                            </div>
                                          </div>
                                        </div>
                                    </div>

                                    <div class="row mt-3">
                                        <div class="col-lg-6">
                                                <button class="btn btn-small" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Create New Address</button>
                                        </div>
                                        <!-- Modal -->
                                        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                          <div class="modal-dialog">
                                            <div class="modal-content">
                                              <div class="modal-header">
                                                <h5 class="modal-title" id="staticBackdropLabel">Create New Address</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                              </div>
                                                <form method="post" action="{{ route('user.address.store') }}">
                                                    @csrf
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="form-group col-lg-6">
                                                                <label for="division_id" class="fw-bold text-black col-form-label"><span class="text-danger">*</span> Division</label>
                                                                <select class="form-select" aria-label="Default select example"  name="division_id" id="division_id" required>
                                                                    <option selected>Select Division</option>
                                                                        @foreach(get_divisions() as $division)
                                                                            <option value="{{ $division->id}}">{{ ucwords($division->division_name_en) }}</option>
                                                                        @endforeach
                                                                </select>
                                                                @error('division_id')
                                                                    <span>{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                            <div class="form-group col-lg-6">
                                                                <label for="district_id" class="fw-bold text-black col-form-label"><span class="text-danger">*</span> District</label>
                                                                <select class="form-select" aria-label="Default select example"  name="district_id" id="district_id" required>
                                                                    <option selected=""  value="">Select District</option>
                                                                </select>
                                                                @error('district_id')
                                                                    <span>{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                            <div class="form-group col-lg-6">
                                                                <label for="upazilla_id" class="fw-bold text-black col-form-label"><span class="text-danger">*</span> Upazilla</label>
                                                                <select class="form-select" aria-label="Default select example"  name="upazilla_id" id="upazilla_id" required>
                                                                    <option selected=""  value="">Select Upazilla</option>
                                                                </select>
                                                                @error('upazilla_id')
                                                                    <span>{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                            <div class="form-group col-lg-6">
                                                                <label for="address" class="fw-bold text-black col-form-label"><span class="text-danger">*</span>Address:</label>
                                                                <textarea class="form-control" name="address" id="address" required placeholder="Address"></textarea>
                                                                @error('address')
                                                                    <span>{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                            <div class="custom-control custom-switch">
                                                                <input type="checkbox" id="md_checkbox_29" class="form-check-input cursor" name="is_default" value="0">
                                                                <label for="md_checkbox_29" class="form-check-label cursor" style="  cursor: pointer; font-weight: bold; padding-left: 8px;"> Is Default</label>
                                                            </div>
                                                            <div class="custom-control custom-switch">
                                                                <input type="checkbox" class="form-check-input me-2 cursor" name="status" id="status" checked value="1">
                                                                <label style="cursor: pointer;" class="form-check-label cursor" for="status">Status</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">Submit</button>
                                                    </div>
                                                </form>
                                            </div>
                                          </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane fade" id="account-detail" role="tabpanel" aria-labelledby="account-detail-tab">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5>Account Details</h5>
                                        </div>
                                        <div class="card-body">
                                            <p>Already have an account? <a href="{{ route('login') }}">Log in instead!</a></p>
                                            <form method="POST" action="{{ route('user.profile.update') }}" enctype="multipart/form-data" >
                                                @csrf
                                                <div class="row">
                                                    <div class="form-group col-md-6">
                                                        <label>Full Name <span class="required">*</span></label>
                                                        <input required value="{{ Auth::user()->name }}" class="form-control" name="name" type="text" />
                                                    </div>
                                                    {{-- <div class="form-group col-md-6">
                                                        <label>User Name<span class="required">*</span></label>
                                                        <input required value="{{ Auth::user()->username }}" class="form-control" name="username" type="text" />
                                                    </div> --}}
                                                    {{-- <div class="form-group col-md-12">
                                                        <label>Phone <span class="required">*</span></label>
                                                        <input required value="{{ Auth::user()->phone }}" class="form-control" name="phone" type="number" />
                                                    </div> --}}
                                                    <div class="form-group col-md-6">
                                                        <label>Email Address <span class="required">*</span></label>
                                                        <input required value="{{ Auth::user()->email }}" class="form-control" name="email" type="email" />
                                                    </div>

                                                    <div class="my-4">
                                                        <img id="showImage" class="rounded avatar-lg" src="{{ asset(Auth::user()->profile_image ) }}" alt="Card image cap" width="100px" height="80px;">
                                                    </div>
                                                    <div class="mb-4">
                                                        <label for="image" class="col-form-label col-md-2" style="font-weight: bold;">User Photo:</label>
                                                        <input name="profile_image" class="form-control" type="file" id="image">
                                                    </div>

                                                    <div class="col-md-12">
                                                        <button type="submit" class="btn btn-fill-out submit font-weight-bold">Save Change</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane fade" id="user-password" role="tabpanel" aria-labelledby="user-password-tab">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5>Password Change</h5>
                                        </div>
                                        <div class="card-body">
                                            @if(count($errors))
                                                @foreach($errors->all() as $error)
                                                    <p class="alert alert-danger alert-dismissible fade show">{{$error}}</p>
                                                @endforeach
                                            @endif
                                            <form method="POST" action="{{ route('user-passwordupdate') }}" name="enq">
                                                @csrf
                                                <div class="row">
                                                    <div class="form-group col-md-12">
                                                        <label>Current Password <span class="required">*</span></label>
                                                        <input class="form-control" required name="oldpassword" type="password" />

                                                    </div>
                                                    <div class="form-group col-md-12">
                                                        <label>New Password <span class="required">*</span></label>
                                                        <input class="form-control" required name="newpassword" type="password" />
                                                    </div>
                                                    <div class="form-group col-md-12">
                                                        <label>Confirm Password <span class="required">*</span></label>
                                                        <input class="form-control" required name="confirm_password" type="password" />
                                                    </div>
                                                    <div class="col-md-12">
                                                        <button type="submit" class="btn btn-fill-out submit font-weight-bold" name="submit" value="Submit">Save Change</button>
                                                    </div>
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
    </div>
</main>
@endsection

@push('footer-script')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<!--  Division To District Show Ajax -->
<script type="text/javascript">
  $(document).ready(function() {
    $('select[name="division_id"]').on('change', function(){
        var division_id = $(this).val();
        // const divArray = division.split("-");
        // var division_id = divArray[0];
        // $('#division_name').val(divArray[1]);
        if(division_id) {
            $.ajax({
                url: "{{  url('/division-district/ajax') }}/"+division_id,
                type:"GET",
                dataType:"json",
                success:function(data) {
                    $('select[name="district_id"]').html('<option value="" selected="" disabled="">Select District</option>');
                      $.each(data, function(key, value){
                        // console.log(value);
                          $('select[name="district_id"]').append('<option value="'+ value.id +'">' + capitalizeFirstLetter(value.district_name_en) + '</option>');
                    });
                    $('select[name="upazilla_id"]').html('<option value="" selected="" disabled="">Select District</option>');
                },
            });
        } else {
           alert('danger');
        }
    });
    function capitalizeFirstLetter(string) {
      return string.charAt(0).toUpperCase() + string.slice(1);
    }
});
</script>

<!--  District To Upazilla Show Ajax -->
<script type="text/javascript">
  $(document).ready(function() {
    $('select[name="district_id"]').on('change', function(){
        var district_id = $(this).val();
        // const divArray = district.split("-");
        // var division_id = divArray[0];
        // $('#district_name').val(divArray[1]);
        if(district_id) {
            $.ajax({
                url: "{{  url('/district-upazilla/ajax') }}/"+district_id,
                type:"GET",
                dataType:"json",
                success:function(data) {
                   var d =$('select[name="upazilla_id"]').empty();
                      $.each(data, function(key, value){
                          $('select[name="upazilla_id"]').append('<option value="'+ value.id +'">' + value.name_en + '</option>');
                          $('select[name="upazilla_id"]').append('<option  class="d-none" value="'+ value.id +'">' + value.name_en + '</option>');
                      });
                },
            });
        } else {
            alert('danger');
        }
    });
});
</script>

@endpush