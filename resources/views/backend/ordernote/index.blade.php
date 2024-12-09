@extends('admin.admin_master')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<section class="content-main">
    <div class="content-header">
        <h3 class="content-title">Order Note list <span class="badge rounded-pill alert-success"> {{ count($ordernotes) }} </span></h3>
        <div>
            <a href="{{ route('order-note.create') }}" class="btn btn-primary"><i class="material-icons md-plus"></i>Order Note Create</a>
        </div>
    </div>
    </div>
    <div class="card mb-4">
        <div class="card-body">
            <div class="table-responsive-sm">
                <table id="example" class="table table-bordered table-striped" width="100%">
                    <thead>
                        <tr>
                            <th scope="col">Sl</th>
                            <th scope="col">Name</th>
                            <th scope="col">Status</th>
                            <th scope="col" class="text-end">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($ordernotes as $key => $ordernote)
                        <tr>
                            <td> {{ $key+1}} </td>
                            <td> {{ $ordernote->name ?? ' ' }} </td>
                            <td>
                                @if($ordernote->status == 1)
                                  <a href="{{ route('order-note.in_active',['id'=>$ordernote->id]) }}">
                                    <span class="badge rounded-pill alert-success">Active</span>
                                  </a>
                                @else
                                  <a href="{{ route('order-note.active',['id'=>$ordernote->id]) }}" > <span class="badge rounded-pill alert-danger">Disable</span></a>
                                @endif
                            </td>
                            <td class="text-end">
                                <div class="dropdown">
                                    <a href="#" data-bs-toggle="dropdown" class="btn btn-light rounded btn-sm font-sm"> <i class="material-icons md-more_horiz"></i> </a>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="{{ route('order-note.edit', $ordernote->id)}}">Edit info</a>
                                        <a class="dropdown-item text-danger" href="{{ route('order-note.delete', $ordernote->id)}}" id="delete">Delete</a>
                                    </div>
                                </div>
                                <!-- dropdown //end -->
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- table-responsive //end -->
        </div>
        <!-- card-body end// -->
    </div>
</section>
@endsection
