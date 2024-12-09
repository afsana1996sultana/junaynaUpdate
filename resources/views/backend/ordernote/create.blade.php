@extends('admin.admin_master')
@section('admin')
<section class="content-main">
    <div class="content-header">
        <h2 class="content-title">Add Order Note</h2>
        <div class="">
            <a href="{{ route('order-note.index') }}" class="btn btn-primary"><i class="material-icons md-plus"></i> Order Note List</a>
        </div>
    </div>
    <div class="row justify-content-center">
    	<div class="col-sm-8">
    		<div class="card">
		        <div class="card-body">
		            <div class="row">
		                <div class="col-md-12">
		                    <form method="post" action="{{ route('order-note.store') }}">
		                    	@csrf
		                        <div class="mb-4">
		                           	<label for="name" class="col-form-label col-md-3" style="font-weight: bold;"> Order Note Name:</label>
		                            <input class="form-control" id="name" type="text" name="name" placeholder="Enter name" value="{{old('name')}}">
		                            @error('name')
                                        <p class="text-danger">{{$message}}</p>
                                    @enderror
		                        </div>

		                        <div class="mb-4">
		                            <div class="custom-control custom-switch">
		                                <input type="checkbox" class="form-check-input me-2 cursor" name="status" id="status" value="1">
		                                <label class="form-check-label cursor" for="status">Status</label>
		                            </div>
                                </div>

		                        <div class="row mb-4 justify-content-sm-end">
                                    <div class="col-lg-3 col-md-4 col-sm-5 col-6">
                                        <input type="submit" class="btn btn-primary" value="Submit">
                                    </div>
                                </div>
		                    </form>
		                </div>
		            </div>
		        </div>
		    </div>
    	</div>
    </div>
</section>
@endsection
