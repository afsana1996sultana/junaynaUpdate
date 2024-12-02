@extends('admin.admin_master')
@section('admin')
<section class="content-main">
    <div class="content-header col-md-8 mx-auto">
        <h2 class="content-title">Social Media Setting</h2>
    </div> 
    <div class="">
    	<form method="post" action="{{ route('setting.facebook_plugin_setting') }}" enctype="multipart/form-data">
	    	@csrf
		    <div class="row">
	            <div class="col-md-8 mx-auto">
					<div class="card">
						<div class="card-header">
							<h3>Facebook Messenger Plugin</h3>
						</div>
				        <div class="card-body">
	                    	<div class="row">
				        		<div class="col-sm-4 mb-3">
		                           	<label for="messenger_page_id" class="col-form-label" style="font-weight: bold;">Facebook Page ID for Messenger</label>
		                           	<input type="hidden" name="types[]" value="messenger_page_id">
		                           	<input class="form-control" type="text" name="messenger_page_id" placeholder="messenger page id" value="{{ get_setting('messenger_page_id')->value ?? '' }}">
		                           	@error('messenger_page_id')
		                               	<p class="text-danger">{{$message}}</p>
		                           	@enderror
		                        </div>

		                        <div class="col-sm-4 mb-3">
		                           	<label for="messenger_version" class="col-form-label" style="font-weight: bold;">Messenger App Version</label>
		                           	<input type="hidden" name="types[]" value="messenger_version">
		                           	<input class="form-control" type="text" name="messenger_version" placeholder="messenger version" value="{{ get_setting('messenger_version')->value ?? '' }}">
		                           	@error('messenger_version')
		                               	<p class="text-danger">{{$message}}</p>
		                           	@enderror
		                        </div>

				        		<div class="col-sm-4 mb-3">
		                           <label for="business_address" class="col-form-label" style="font-weight: bold;">Facebook Messenger Activation</label>
		                           <input type="hidden" name="types[]" value="messenger_status">
                                   <select id="messenger_status" class="form-control" name="messenger_status" >
                                        <option value="1" {{ get_setting('messenger_status')->value == 1 ? ' Selected' : '' }}>Active</option>
                                        <option value="0" {{ get_setting('messenger_status')->value == 0 ? ' Selected' : '' }}>Inactive</option>
                                    </select>
		                            @error('messenger_status')
		                                <p class="text-danger">{{$message}}</p>
		                            @enderror
		                        </div>
				        	</div>
				        	<!-- Row End// -->
				        </div>
				        <!-- card body .// -->
				    </div>
				    <!-- card .// --> 
				</div>
				<!-- col-6 //-->

                <div class="col-md-8 mx-auto">
					<div class="card">
						<div class="card-header">
							<h3>Facebook Pixel Plugin</h3>
						</div>
				        <div class="card-body">
	                    	<div class="row">
				        		<div class="col-sm-4 mb-3">
		                           	<label for="pixel_id" class="col-form-label" style="font-weight: bold;">Facebook Pixel ID</label>
		                           	<input type="hidden" name="types[]" value="pixel_id">
		                           	<input class="form-control" type="text" name="pixel_id" placeholder="facebook pixel id" value="{{ get_setting('pixel_id')->value ?? '' }}">
		                           	@error('pixel_id')
		                               	<p class="text-danger">{{$message}}</p>
		                           	@enderror
		                        </div>

		                        <div class="col-sm-4 mb-3">
		                           	<label for="pixel_version" class="col-form-label" style="font-weight: bold;">Pixel Version</label>
		                           	<input type="hidden" name="types[]" value="pixel_version">
		                           	<input class="form-control" type="text" name="pixel_version" placeholder="pixel version" value="{{ get_setting('pixel_version')->value ?? '' }}">
		                           	@error('pixel_version')
		                               	<p class="text-danger">{{$message}}</p>
		                           	@enderror
		                        </div>

				        		<div class="col-sm-4 mb-3">
		                           <label for="pixel_status" class="col-form-label" style="font-weight: bold;">Facebook Pixel Activation</label>
		                           <input type="hidden" name="types[]" value="pixel_status">
                                   <select id="pixel_status" class="form-control" name="pixel_status">
                                        <option value="1" {{ get_setting('pixel_status')->value == 1 ? 'Selected' : '' }}>Active</option>
                                        <option value="0" {{ get_setting('pixel_status')->value == 0 ? 'Selected' : '' }}>Inactive</option>
                                    </select>
		                            @error('pixel_status')
		                                <p class="text-danger">{{$message}}</p>
		                            @enderror
		                        </div>
				        	</div>
				        	<!-- Row End// -->
				        </div>
				        <!-- card body .// -->
				    </div>
				    <!-- card .// --> 
				</div>
				<!-- col-6 //-->
			</div>
			<div class="row mb-4 justify-content-sm-end">
				<div class="col-lg-3 col-md-4 col-sm-5 col-6">
					<input type="submit" class="btn btn-primary" value="Update">
				</div>
			</div>
		</form>
		<!-- .row // --> 
	</div>
</section>
@endsection