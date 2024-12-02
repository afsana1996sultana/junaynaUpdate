@extends('admin.admin_master')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<section class="content-main">
    <div class="content-header">
        <h2 class="content-title">Payment Methods Configuration</h2>
        
    </div> 
		<div class="row">
			@if ($errors->any())
			    <div class="alert alert-danger">
			        <ul>
			            @foreach ($errors->all() as $error)
			                <li>{{ $error }}</li>
			            @endforeach
			        </ul>
			    </div>
			@endif
		
        	<div class="col-sm-6">
				<div class="card">
					<div class="card-header">
						<h3>bKash</h3>
					</div>
		        	<div class="card-body" style="font-size: 12px;">
		        		<form method="post" action="{{ route('paymentMethod.update') }}" enctype="multipart/form-data">
							@csrf
							<input type="hidden" name="payment_method" value="bkash">
							<div class="form-group row mb-2">
	                            <input type="hidden" name="types[]" value="BKASH_CHECKOUT_APP_KEY">
	                            <div class="col-md-4">
	                                <label class="col-from-label">{{ __('BKASH CHECKOUT APP KEY')}}</label>
	                            </div>
	                            <div class="col-md-8">
	                                <input type="hidden" class="form-control" name="BKASH_CHECKOUT_APP_KEY" value="{{  env('BKASH_CHECKOUT_APP_KEY') }}" placeholder="{{__('BKASH CHECKOUT APP KEY')}}" required>
	                                <input type="text" class="form-control" value="" placeholder="mNvzKKtCLtAAl6bJM92ayUMSDW" required>
	                            </div>
	                        </div>
	                        <div class="form-group row mb-2">
	                            <input type="hidden" name="types[]" value="BKASH_CHECKOUT_APP_SECRET">
	                            <div class="col-md-4">
	                                <label class="col-from-label">{{__('BKASH CHECKOUT APP SECRET')}}</label>
	                            </div>
	                            <div class="col-md-8">
	                                <input type="hidden" class="form-control" name="BKASH_CHECKOUT_APP_SECRET" value="{{  env('BKASH_CHECKOUT_APP_SECRET') }}" placeholder="{{__('BKASH CHECKOUT APP SECRET')}}" required>
	                                <input type="text" class="form-control" value="" placeholder="eIzXKNK6qXbGYXzbS7YFbeVtEa7Pwoqf4iHdhLDiZ14FuK5Gscft" required>
	                            </div>
	                        </div>
	                        <div class="form-group row mb-2">
	                            <input type="hidden" name="types[]" value="BKASH_CHECKOUT_USER_NAME">
	                            <div class="col-md-4">
	                                <label class="col-from-label">{{__('BKASH CHECKOUT USER NAME')}}</label>
	                            </div>
	                            <div class="col-md-8">
	                                <input type="hidden" class="form-control" name="BKASH_CHECKOUT_USER_NAME" value="{{  env('BKASH_CHECKOUT_USER_NAME') }}" placeholder="{{__('BKASH CHECKOUT USER NAME')}}" required>
	                                <input type="text" class="form-control" value="" placeholder="CLASSICISMLRM49310_CHKOUT" required>
	                            </div>
	                        </div>
	                        <div class="form-group row mb-2">
	                            <input type="hidden" name="types[]" value="BKASH_CHECKOUT_PASSWORD">
	                            <div class="col-md-4">
	                                <label class="col-from-label">{{__('BKASH CHECKOUT PASSWORD')}}</label>
	                            </div>
	                            <div class="col-md-8">
	                                <input type="hidden" class="form-control" name="BKASH_CHECKOUT_PASSWORD" value="{{  env('BKASH_CHECKOUT_PASSWORD') }}" placeholder="{{__('BKASH CHECKOUT PASSWORD')}}" required>
	                                <input type="text" class="form-control" value="" placeholder="^D9aeUTC<j." required>
	                            </div>
	                        </div>
	                        <div class="form-group row mb-2">
	                            <div class="col-md-4">
	                                <label class="col-from-label">{{__('Bkash Sandbox Mode')}}</label>
	                            </div>
	                            <div class="col-md-8">
	                                <label class="aiz-switch aiz-switch-success mb-0">
	                                    <input value="1" name="bkash_sandbox" type="checkbox" @if (get_setting('bkash_sandbox') == 1)
	                                        checked
	                                    @endif>
	                                    <span class="slider round"></span>
	                                </label>
	                            </div>
	                        </div>
	                        <div class="form-group mb-0 text-right">
	                            <button type="submit" class="btn btn-sm btn-primary">{{__('Save')}}</button>
	                        </div>
						</form>
		        	</div>
		        	<!-- card body .// -->
			    </div>
			    <!-- card .// -->   
			</div>
			<div class="col-sm-6">
				<div class="card">
					<div class="card-header">
						<h3>Nagad</h3>
					</div>
		        	<div class="card-body" style="font-size: 12px;">
		        		<form method="post" action="{{ route('paymentMethod.update') }}" enctype="multipart/form-data">
							@csrf
							<input type="hidden" name="payment_method" value="nagad">

							<div class="form-group row mb-2">
	                            <input type="hidden" name="types[]" value="NAGAD_MODE">
	                            <div class="col-md-4">
	                                <label class="col-from-label">{{__('NAGAD MODE')}}</label>
	                            </div>
	                            <div class="col-md-8">
	                            <input type="hidden" class="form-control" name="NAGAD_MODE" value="{{  env('NAGAD_MODE') }}" placeholder="{{__('NAGAD MODE')}}" required>
	                            <input type="text" class="form-control" value="" placeholder="NAGAD" required>
	                            </div>
	                        </div>
	                        <div class="form-group row mb-2">
	                            <input type="hidden" name="types[]" value="NAGAD_MERCHANT_ID">
	                            <div class="col-md-4">
	                                <label class="col-from-label">{{__('NAGAD MERCHANT ID')}}</label>
	                            </div>
	                            <div class="col-md-8">
	                                <input type="hidden" class="form-control" name="NAGAD_MERCHANT_ID" value="{{  env('NAGAD_MERCHANT_ID') }}" placeholder="{{__('NAGAD MERCHANT ID')}}" required>
	                                <input type="text" class="form-control" value="" placeholder="687172861417375" required>
	                            </div>
	                        </div>
	                        <div class="form-group row mb-2">
	                            <input type="hidden" name="types[]" value="NAGAD_MERCHANT_NUMBER">
	                            <div class="col-md-4">
	                                <label class="col-from-label">{{__('NAGAD MERCHANT NUMBER')}}</label>
	                            </div>
	                            <div class="col-md-8">
	                                <input type="hidden" class="form-control" name="NAGAD_MERCHANT_NUMBER" value="{{  env('NAGAD_MERCHANT_NUMBER') }}" placeholder="{{__('NAGAD MERCHANT NUMBER')}}" required>
	                                <input type="text" class="form-control" value="" placeholder="01717286141" required>
	                            </div>
	                        </div>
	                        <div class="form-group row mb-2">
	                            <input type="hidden" name="types[]" value="NAGAD_PG_PUBLIC_KEY">
	                            <div class="col-md-4">
	                                <label class="col-from-label">{{__('NAGAD PG PUBLIC KEY')}}</label>
	                            </div>
	                            <div class="col-md-8">
	                                <input type="hidden" class="form-control" name="NAGAD_PG_PUBLIC_KEY" value="{{  env('NAGAD_PG_PUBLIC_KEY') }}" placeholder="{{__('NAGAD PG PUBLIC KEY')}}" required>
	                                <input type="text" class="form-control" value="" placeholder="MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAiCWvxDZZesS1g1lQfilVt8l3X5aMbXg5WOCYdG7q5C+Qevw0upm3tyYiKIwzXbqexnPNTHwRU7Ul7t8jP6nNVS/jLm35WFy6G9qRyXqMc1dHlwjpYwRNovLc12iTn1C5lCqIfiT+B/O/py1eIwNXgqQf39GDMJ3SesonowWioMJNXm3o80wscLMwjeezYGsyHcrnyYI2LnwfIMTSVN4T92Yy77SmE8xPydcdkgUaFxhK16qCGXMV3mF/VFx67LpZm8Sw3v135hxYX8wG1tCBKlL4psJF4+9vSy4W+8R5ieeqhrvRH+2MKLiKbDnewzKonFLbn2aKNrJefXYY7klaawIDAQAB" required>
	                            </div>
	                        </div>
	                        <div class="form-group row mb-2">
	                            <input type="hidden" name="types[]" value="NAGAD_MERCHANT_PRIVATE_KEY">
	                            <div class="col-md-4">
	                                <label class="col-from-label">{{__('NAGAD MERCHANT PRIVATE KEY')}}</label>
	                            </div>
	                            <div class="col-md-8">
	                                <input type="hidden" class="form-control" name="NAGAD_MERCHANT_PRIVATE_KEY" value="{{  env('NAGAD_MERCHANT_PRIVATE_KEY') }}" placeholder="{{__('NAGAD MERCHANT PRIVATE KEY')}}" required>
	                                 <input type="text" class="form-control" value="" placeholder="MIIEvgIBADANBgkqhkiG9w0BAQEFAASCBKgwggSkAgEAAoIBAQC4NvUlZJeCR4pjBhgK6kRAqFITP9KnJDn4Jc+YlmAIbNGmVPSEvFULsz2+vuIXx3lrmXN8WUe+JVEJM0bDQJp7t1wTS1arfuyugV6/6z0Rz+2q9nhL+OKB2V1QWLOe+C/zEuIEYeeoYK7W8W65GJFe1R4hCrz7rIM6BOo51MisK965bwLvGx9RoZ1NxiyjO6YlB323y++UXinfHPBItSN/j1qWoIB1sMcnsWqM61D3omLSZZhzgqRk7+i5zVKpOT08+ceDje0qst8895F/ZKd7cXSK6j5/dofxxIvKMBFA4r1d4ZuKx8ozO+GUyEEDP0AOy4a1eDhntk7Xif6jgTnHAgMBAAECggEBALPLyBc4B/x7EOG3h+3XWsh0wK7TAyppXD8LwIPgeVifxTv//Sw0mRkzV5d9vTSSV7siaao7hZ9b0q0VJALcYitP+olGZhA6cI2d7TmKQu/IruLHbwBPqdwsqDwMZzxIZpxrmLfISw93Vg6qVHRKO1CA18hOL8fAR9BwDaBmQ3puKRe6NNEybqhI30LBsbWb44Ex1TQxvXhNHfjj78J5zXgUSVv5+vFQxab/CFq/xKo0r1h5DXMog6bZp27t3+q4KZgSNwVGcIGpxk8MHNdXjjSD6dD46DQVPY6q5/QloNbaixAjryozAqGp+JbMTACb54mRzVAxQ5YKpDGnw3f4K1kCgYEA77kLkCZQVC3JK+3hFJY1FJtDO2EdxlFnZBrGyBs6SSEtUPquMAek/yWfjzODG51jm+cRyPfV3fznRTOPCQWfG4dHU4hU+9N6smqcCGlyljjhGi+M7e0Q6Ch/kDvqWY83xDYLgloEqCpREB67CMRzr97SgMyWFC0DTPTvj9j4Tj0CgYEAxLkMWsUEYKm1ZL29B7mImmkhpguGACSWyG6voqGHc720PaDpchZLkHVo+6r0hgNCn/s37nmnaKpoqHwZvHzM8C6GH9t8u5EfOb3SFbNn9jJqIXdbX3rk84QwmNVjjtRp0F/kWVaIwPJxS3PpMmHpJpycXWjZ3apdCAoSsKb5DFMCgYEAoumEnDANg0eiYYJF5nG2HQzvAdmcHHyR4Qv5b2BhmfU8EL5rxiRL00HET9NYFFo/qWG9SnBzHWuT2AmT+TOiz1h99py99G3iAoJFC8ptnv2ErQEHq2HijYOIPYMaXkbgRS3dYHbAl3A6qtPXk7u+SxUIxZNDou58Qb5rV7zB8pkCgYBkEiYgvnwdl/b4SjSwi0bcFYLSbqY5yGMTjoq11imLTQM1HnfiW0kRMUi4TRyaV2o665ZmL2hjq9wVaRvGcE3oGCKObh6jY41Y2CDYfSzzZm3qnEbU6TUyUxpNhK9iZtd08nK8p3JlhG7xjQMhaAEsbRp1wfKh+hndDxK23hlulQKBgH5GLqy4jbAtxxeYNiuSEwZA7oW+2o1blGZ2Oh6xNRNaj+pXS9JcYqToz4KxFRiTXOwHk8bO43eexO6u9qGLTpfG0EM2+Y+RdmQYNDl2l0BtrVcR7WjFYl4MdASBecpqgOU94rPT/woDb7TOXV8iuFKAoVL371LZ/qgcm2nNXjul" required>
	                            </div>
	                        </div>
	                        <div class="form-group mb-0 text-right">
	                            <button type="submit" class="btn btn-sm btn-primary">{{__('Save')}}</button>
	                        </div>
						</form>
		        	</div>
		        	<!-- card body .// -->
			    </div>
			    <!-- card .// -->   
			</div>
			<div class="col-sm-6">
				<div class="card">
					<div class="card-header">
						<h3>SSL Commerz</h3>
					</div>
		        	<div class="card-body" style="font-size: 12px;">
		        		<form method="post" action="{{ route('paymentMethod.update') }}" enctype="multipart/form-data">
							@csrf
							<input type="hidden" name="payment_method" value="sslcommerz">

							<div class="form-group row mb-2">
	                            <input type="hidden" name="types[]" value="SSLCZ_STORE_ID">
	                            <div class="col-md-4">
	                                <label class="col-from-label">{{__('Sslcz Store Id')}}</label>
	                            </div>
	                            <div class="col-md-8">
	                                <input type="hidden" class="form-control" name="SSLCZ_STORE_ID" value="{{  env('SSLCZ_STORE_ID') }}" placeholder="{{__('Sslcz Store Id')}}" required>
	                                <input type="text" class="form-control" value="" placeholder="janan639acfef8140d" required>
	                            </div>
	                        </div>
	                        <div class="form-group row mb-2">
	                            <input type="hidden" name="types[]" value="SSLCZ_STORE_PASSWD">
	                            <div class="col-md-4">
	                                <label class="col-from-label">{{__('Sslcz store password')}}</label>
	                            </div>
	                            <div class="col-md-8">
	                                <input type="hidden" class="form-control" name="SSLCZ_STORE_PASSWD" value="{{  env('SSLCZ_STORE_PASSWD') }}" placeholder="{{__('Sslcz store password')}}" required>
	                                <input type="text" class="form-control" value="" placeholder="janan639acfef8140d@ssl" required>
	                            </div>
	                        </div>
	                        <div class="form-group row mb-2">
	                            <div class="col-md-4">
	                                <label class="col-from-label">{{__('Sslcommerz Sandbox Mode')}}</label>
	                            </div>
	                            <div class="col-md-8">
	                                <label class="aiz-switch aiz-switch-success mb-0">
	                                    <input value="1" name="sslcommerz_sandbox" type="checkbox" @if (get_setting('sslcommerz_sandbox') == 1)
	                                        checked
	                                    @endif>
	                                    <span class="slider round"></span>
	                                </label>
	                            </div>
	                        </div>
	                        <div class="form-group mb-0 text-right">
	                            <button type="submit" class="btn btn-sm btn-primary">{{__('Save')}}</button>
	                        </div>
						</form>
		        	</div>
		        	<!-- card body .// -->
			    </div>
			    <!-- card .// -->   
			</div>
			<div class="col-sm-6">
				<div class="card">
					<div class="card-header">
						<h3>Aamarpay</h3>
					</div>
		        	<div class="card-body" style="font-size: 12px;">
		        		<form method="post" action="{{ route('paymentMethod.update') }}" enctype="multipart/form-data">
							@csrf
							<input type="hidden" name="payment_method" value="aamarpay">

							<div class="form-group row mb-2">
	                            <input type="hidden" name="types[]" value="AAMARPAY_STORE_ID">
	                            <div class="col-md-4">
	                                <label class="col-from-label">{{__('Aamarpay Store Id')}}</label>
	                            </div>
	                            <div class="col-md-8">
	                                <input type="text" class="form-control" name="AAMARPAY_STORE_ID" value="{{  env('AAMARPAY_STORE_ID') }}" placeholder="{{__('Aamarpay Store Id')}}" required>
	                            </div>
	                        </div>
	                        <div class="form-group row mb-2">
	                            <input type="hidden" name="types[]" value="AAMARPAY_SIGNATURE_KEY">
	                            <div class="col-md-4">
	                                <label class="col-from-label">{{__('Aamarpay signature key')}}</label>
	                            </div>
	                            <div class="col-md-8">
	                                <input type="text" class="form-control" name="AAMARPAY_SIGNATURE_KEY" value="{{  env('AAMARPAY_SIGNATURE_KEY') }}" placeholder="{{__('Aamarpay signature key')}}" required>
	                            </div>
	                        </div>
	                        <div class="form-group row mb-2">
	                            <div class="col-md-4">
	                                <label class="col-from-label">{{__('Aamarpay Sandbox Mode')}}</label>
	                            </div>
	                            <div class="col-md-8">
	                                <label class="aiz-switch aiz-switch-success mb-0">
	                                    <input value="1" name="aamarpay_sandbox" type="checkbox" @if (get_setting('aamarpay_sandbox') == 1)
	                                        checked
	                                    @endif>
	                                    <span class="slider round"></span>
	                                </label>
	                            </div>
	                        </div>
	                        <div class="form-group mb-0 text-right">
	                            <button type="submit" class="btn btn-sm btn-primary">{{__('Save')}}</button>
	                        </div>
						</form>
		        	</div>
		        	<!-- card body .// -->
			    </div>
			    <!-- card .// -->   
			</div>
		
		<!-- col-6 //-->

		</div>
</section>

@endsection



@push('footer-script')

@endpush