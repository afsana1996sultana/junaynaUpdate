@extends('admin.admin_master')
@push('css')
    <style>
        .card-header {
            background-color: #fff !important;
            padding: 10px 20px;
        }
        footer.main-footer {
            height: 28px !important;
            padding-top: 0 !important;
        }
        div.dataTables_wrapper div.dataTables_paginate {
            margin-bottom: 20px !important;
        }
    </style>
    <link rel="stylesheet" href="{{asset('backend/assets/css/bootstrap.min.css')}}">
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script

@endpush
@section('admin')
    <section class="content-main">
        <div class="content-header">
            <h2 class="content-title">Product List <span class="badge rounded-pill alert-success">
                </span></h2>
            <div>
                <a href="{{ route('product.add') }}" class="btn btn-primary"><i class="material-icons md-plus"></i>Add
                    Product</a>
            </div>
        </div>
        </div>
        <div class="card mb-4">
            <div class="card-header p-3">
                <div class="title">
                    <div class="row">
                        <div class="col-md-8 float-left">
                            <h4 class="float-left">Product List
                                <a href="{{ route('product.all') }}" class="btn btn-info"><i class="fa fa-arrow-right"></i></a>
                            </h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive table-responsive" >
                    <table class="table table-bordered user_datatable  mb-5 user__table" style="min-width:100%">
                        <thead>
                        <tr>
                            <th scope="col">Sl</th>
                            <th scope="col">Product Image</th>
                            <th scope="col">Name (English)</th>
                            <th scope="col">Name (Bangla)</th>
                            <th scope="col">Category</th>
                            <th scope="col">Product Price </th>
                            <th scope="col">Quantity </th>
                            <th scope="col">Discount </th>
                            <th scope="col">Featured</th>
                            <th scope="col">Status</th>
                            <th scope="col" class="text-end">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
                <!-- table-responsive //end -->
            </div>
            <!-- card-body end// -->
        </div>
    </section>
@endsection





@push('footer-script')

<script>
$(document).ready(function(){
    $("#post-search").on('keyup',function(){

        var query = $(this).val();
        //console.log("query",query);
        $.ajax({
            url: "{{ route('product.all') }}",
            type: "GET",
            data: { query: query },
            success: function(response){
                console.log("response",response.data);
                $("tbody").html(response.data);
                $(".pagination").html(response.links); // Assuming your pagination element has the class "pagination"
            }
        });
    });
});
</script>
 <script type="text/javascript">
    $.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
    </script>

<script type="text/javascript">
    $(function () {
        var table = $('.user_datatable').DataTable({
            stateSave: true,
            responsive: true,
            serverSide: true,
            processing: true,
            ajax: "{{route('product.all')}}",
            columns: [
                {data: "DT_RowIndex", name: "DT_RowIndex", searchable: false, orderable: false},
                {data: 'product_image', name: 'product_image', searchable: true, orderable: true,},
                {data: 'name_en', name: 'name_en', searchable: true, orderable: true,},
                {data: 'name_bn', name: 'name_bn', searchable: true, orderable: true,},
                {data: 'category', name: 'category', searchable: true, orderable: true,},
                {data: 'regular_price', name: 'regular_price', searchable: true, orderable: true,},
                {data: 'quantity', name: 'quantity', searchable: true, orderable: true,},
                {data: 'discount', name: 'discount', searchable: true, orderable: true,},
                {data: 'featured', name: 'featured', searchable: true, orderable: true,},
                {data: 'status', name: 'status', searchable: true, orderable: true,},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });
    });
</script>
@endpush