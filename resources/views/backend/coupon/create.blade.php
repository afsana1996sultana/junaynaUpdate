@extends('admin.admin_master')
@section('admin')
<section class="content-main">
    <div class="content-header">
        <h2 class="content-title">Coupon Add</h2>
        <div class="">
            <a href="{{ route('coupons.index') }}" class="btn btn-primary"><i class="material-icons md-plus"></i> Coupon List</a>
        </div>
    </div> 
    <div class="row justify-content-center">
        <div class="row">
            <div class="col-md-8 mx-auto">
				<form method="post" action="{{ route('coupons.store') }}" enctype="multipart/form-data">
					@csrf

					<div class="card">
						<div class="card-header">
							<h3>Coupon</h3>
						</div>
			        	<div class="card-body">
			        		<div class="row">
			                	<div class="col-md-6 mb-4">
			                        <label for="coupon_code" class="col-form-label" style="font-weight: bold;">Coupon Code: *</label>
			                        <input class="form-control" id="coupon_code" type="text" name="coupon_code" placeholder="Write Coupon Code" required="">
			                        @error('coupon_code')
			                            <p class="text-danger">{{$message}}</p>
			                        @enderror
			                    </div>

			                    <div class="col-md-6 mb-4">
		                         	<label for="discount_type" class="col-form-label" style="font-weight: bold;">Discount Type:</label>
					                <div class="custom_select">
	                                    <select class="form-control select-active w-100 form-select select-nice" name="discount_type" id="discount_type">
						                	<option value="1">Fixed Amount</option>
		                            		<option value="0">Percent %</option>
	                                    </select>
	                                </div>
		                        </div>

		                        <div class="col-md-6 mb-4">
		                          	<label for="discount" class="col-form-label" style="font-weight: bold;">Discount Amount/Percent:</label>
		                            <input class="form-control" id="discount" type="number" name="discount" placeholder="Write discount amount/percent" min="0" value="0">
		                        </div>

		                        <div class="col-md-6 mb-4">
		                          	<label for="limit_per_user" class="col-form-label" style="font-weight: bold;">Use Limit Per User: *</label>
		                            <input class="form-control" id="limit_per_user" type="number" name="limit_per_user" placeholder="Write use limit per user" min="0" value="0">
			                        @error('limit_per_user')
		                                <p class="text-danger">{{$message}}</p>
		                            @enderror
		                        </div>

		                        <div class="col-md-6 mb-4">
		                          	<label for="total_use_limit" class="col-form-label" style="font-weight: bold;">Total Use Limit: *</label>
		                            <input class="form-control" id="total_use_limit" type="number" name="total_use_limit" placeholder="Enter total use limit" required min="0">
			                        @error('total_use_limit')
		                                <p class="text-danger">{{$message}}</p>
		                            @enderror
		                        </div>
								
								<div class="col-md-6 mb-4">
		                          	<label for="expire_date" class="col-form-label" style="font-weight: bold;">Expire Date:</label>
		                            <input class="form-control" id="expire_date" type="date" name="expire_date" min="0">
		                        </div>

		                        <div class="col-md-6 mb-4">
		                         	<label for="type" class="col-form-label" style="font-weight: bold;">Coupon For:</label>
					                <div class="custom_select">
	                                    <select class="form-control select-active w-100 form-select select-nice" name="type" id="type">
	                                    	<option value="1">All Customer</option>
	                                    	<option value="0">Specific Customer</option>
	                                    </select>
	                                </div>
		                        </div>

		                        <div class="col-md-6 mb-4">
		                         	<label for="user_id" class="col-form-label" style="font-weight: bold;">Customer: *</label>
					                <div class="custom_select cit-multi-select">
	                                    <select class="form-control select-active w-100 form-select select-nice" name="user_id[]" id="user_id" multiple="multiple" data-placeholder="User id" required>
						                	@foreach($users as $user)
						                		<option value="{{ $user->id }}">{{ $user->name }}</option>
						               		@endforeach
	                                    </select>
	                                </div>
		                        </div>

			        		</div>
			        		<!-- Row //-->

			        		<div class="row">
		                        <div class="col-md-12 mb-4">
		                          	<label for="description" class="col-form-label" style="font-weight: bold;">Description:</label>
		                            <textarea name="description" id="description" rows="2" cols="2" class="form-control" placeholder="Write Description"></textarea> 
		                        </div>
		                        <!-- Description End -->
			        		</div>
			        		<div class="row">
                          		<div class="custom-control custom-switch">
                                    <input type="checkbox" class="form-check-input me-2 cursor" name="status" id="status" checked value="1">
                                    <label class="form-check-label cursor" for="status">Status</label>
                                </div>
	                        </div>
	                        <!-- Row //-->
			        	</div>
			        	<!-- card body .// -->
				    </div>
				    <!-- card .// -->

				    <div class="row mb-4 justify-content-sm-end">
						<div class="col-lg-3 col-md-4 col-sm-5 col-6">
							<input type="submit" class="btn btn-primary" value="Submit">
						</div>
					</div> 
			    </form>  
			</div>
        </div>
        <!-- .row // -->
    </div>
</section>

@endsection