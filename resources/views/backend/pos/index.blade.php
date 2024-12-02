@extends('admin.admin_master')
@section('admin')
@push('css')
<style>
    .table {
        margin-bottom: 0.5rem;
    }
    .table > :not(caption) > * > * {
        padding: 0.1rem 0.4rem;
    }
    .product-price {
        font-size: 12px;
    }
    .product-thumb {
        cursor: pointer!important;
    }
    .btn-circle {
        width: 30px;
        height: 30px;
        background-color: #d56666;
        vertical-align: center !important;
        border: none;
        float: right;
        color: #fff;
        border-radius: 50%;
    }
    .material-icons {
        vertical-align: middle !important;
        font-size: 15px !important;
    }
    
    .select2-container--default .select2-selection--single {
        border-radius: 0px !important;
    }
    .select2-container--default {
        width: 100% !important;
    }
    .flex-grow-1 {
        margin-right: 10px;
    }

    .product_wrapper .card-body {
        padding: 0.4rem 0.4rem;
    }
    .modal-open .modal{
        background: #000000a8 !important; 
    }
</style>
@endpush
<section class="content-main">
    <div class="row">
        <div class="col-sm-8">
            <div class="row">
                <div class="card mb-4">
                    <div class="card-body">
                        <form action="">
                            <div class="row">
                                <div class="col-sm-6">
                                    <input class="form-control" type="text" name="search_term" id="search_term" placeholder="Search by Name" onkeyup="filter()">
                                </div>
                                <div class="col-sm-3">
                                    <div class="custom_select">
                                        <select name="category_id" id="category_id" class="form-control select-active w-100 form-select select-nice" onchange="filter()">
                                            <option value="">-- Select Category --</option>
                                            @foreach($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->name_en }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </form>
                        
                    </div>
                    <!-- card-body end// -->
                </div>
            </div>
            <div class="row product_wrapper product-row" id="product_wrapper">
                @foreach($products as $product)
                    @if($product->is_varient)
                        @foreach ($product->stocks as $key => $stock)
                            <div class="col-sm-2 col-xs-6 product-thumb product-row-list" onclick="addToList({{ $stock->id }})">
                                <div class="card mb-4">
                                    <div class="card-body">
                                        <div class="product-image">
                                            @if($stock->image && $stock->image != '' && $stock->image != 'Null')
                                                <img class="default-img" src="{{ asset($stock->image) }}" alt="" />
                                            @else
                                                <img class="default-img" src="{{ asset('upload/no_image.jpg') }}" alt="" />
                                            @endif
                                        </div>
                                        <p style="font-size: 10px; font-weight: bold; line-height: 15px; height: 30px;">
                                            <?php $p_name_en =  strip_tags(html_entity_decode($product->name_en))?>
                                            {{ Str::limit($p_name_en, $limit = 30, $end = '. . .') }}
                                        </p>
                                        <p style="font-size: 10px; font-weight: bold; line-height: 10px; height: 15px;">
                                            Size: {{ $stock->varient }}
                                        </p>
                                        <p style="font-size: 10px; font-weight: bold; line-height: 10px; height: 15px;">
                                            Stock: {{ $stock->qty }}
                                        </p>
                                        <div>
                                            <!--{{-- @if ($product->discount_price > 0)-->
                                            <!--    @php-->
                                            <!--        if($product->discount_type == 1){-->
                                            <!--            $price_after_discount = $product->regular_price - $product->discount_price;-->
                                            <!--        }elseif($product->discount_type == 2){-->
                                            <!--            $price_after_discount = $product->regular_price - ($product->regular_price * $product->discount_price / 100);-->
                                            <!--        }-->
                                            <!--    @endphp-->
                                            <!--    <div class="product-price">-->
                                            <!--        <del class="old-price">৳{{ $stock->price }}</del>-->
                                            <!--        <span class="price text-primary">৳{{ $price_after_discount }}</span>-->
                                            <!--    </div>-->
                                            <!--@else-->
                                            <!--    <div class="product-price">-->
                                            <!--        <span class="price text-primary">৳{{ $stock->price }}</span>-->
                                            <!--    </div>-->
                                            <!--@endif --}}-->
                                            <div class="product-price">
                                                <span class="price text-primary">৳{{ $stock->price }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="col-sm-2 col-xs-6 product-thumb product-row-list" onclick="addToList({{ $product->id }})">
                            <div class="card mb-4">
                                <div class="card-body">
                                    <div class="product-image">
                                        @if($product->product_thumbnail && $product->product_thumbnail != '' && $product->product_thumbnail != 'Null')
                                            <img class="default-img" src="{{ asset($product->product_thumbnail) }}" alt="" />
                                        @else
                                            <img class="default-img" src="{{ asset('upload/no_image.jpg') }}" alt="" />
                                        @endif
                                    </div>
                                    <p style="font-size: 10px; font-weight: bold; line-height: 15px; height: 30px;">
                                        <?php $p_name_en =  strip_tags(html_entity_decode($product->name_en))?>
                                        {{ Str::limit($p_name_en, $limit = 30, $end = '. . .') }}
                                    </p>
                                    <p style="font-size: 10px; font-weight: bold; line-height: 10px; height: 15px;">
                                            Stock: {{ $product->stock_qty }}
                                        </p>
                                    <div>
                                        @if ($product->discount_price > 0)
                                            @php
                                                if($product->discount_type == 1){
                                                    $price_after_discount = $product->regular_price - $product->discount_price;
                                                }elseif($product->discount_type == 2){
                                                    $price_after_discount = $product->regular_price - ($product->regular_price * $product->discount_price / 100);
                                                }
                                            @endphp
                                            <div class="product-price">
                                                <del class="old-price">৳{{ $product->regular_price }}</del>
                                                <span class="price text-primary">৳{{ $price_after_discount }}</span>
                                            </div>
                                        @else
                                            <div class="product-price">
                                                <span class="price text-primary">৳{{ $product->regular_price }}</span>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
            <button class="btn btn-xs d-flex mx-auto my-4" id="seemore">Load More <i class="fi-rs-arrow-small-right"></i></button>
        </div>
        <div class="col-sm-4">
            <div class="card mb-4">
                <div class="card-body">
                    <div class="mb-3">
                        <!-- <input class="form-control" type="text" name="barcode_search_term" id="barcode_search_term" placeholder="Search by Barcode" oninput="barcode()"> -->
                    </div>
                    <form action="{{ route('pos.store') }}" method="POST">
                        @csrf
                        <div class="d-flex border-bottom pb-3">
                            <div class="flex-grow-1">
                                <select name="customer_id" id="customer_id" class="form-control select-active w-100 form-select select-nice" required>
                                    <option value="0">-- Walking Customer --</option>
                                    @foreach($customers as $customer)
                                        <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <a style="background-color: #454847; "class="btn btn-sm float-end" data-bs-toggle="modal" data-bs-target="#customer1"><i class="fa-solid fa-plus text-white"></i></a>
                        </div>
                        <div>
                            <div class="row" id="checkout_list">
                                <div class="text-center pt-10 pb-10" id="no_product_text">
                                    <span>No Product Added</span>
                                </div>
                                <hr>
                            </div>
                        </div>
                        <div class="row">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td>Sub Total</td>
                                        <td style="float: right;" class="my-2"><input type="number" id="subtotal_text" name="subtotal" class="form-control" readonly value="0.00"></td>
                                    </tr>
                                    <tr>
                                        <td>Discount</td>
                                        {{-- <td style="float: right;">৳ 0.00</td> --}}
                                        <td style="float: right;" class="my-2"> <input type="number" id="discount" name="discount" class="form-control" value="0.00" /></td>
                                    </tr>
                                    <tr>
                                        <td>Paid Amount</td>
                                        <td style="float: right;" class="my-2"> <input type="number" id="paid_amount" name="paid_amount" class="form-control" value="0.00" /></td>
                                    </tr>
                                    <tr>
                                        <td>Due Amount</td>
                                        <td style="float: right;" class="my-2"> <input type="number" id="due_amount" name="due_amount" readonly class="form-control" value="0.00" /></td>
                                    </tr>
                                    <tr>
                                        <td>Sale By</td>
                                        <td style="" class="my-2">
                                            <select name="staff_id" class="form-control select-active w-100 form-select select-nice">
                                                <option value="0">-- Select Staff --</option>
                                                @foreach($staffs as $staff)
                                                    <option value="{{ $staff->id }}">{{ $staff->user->name }}</option>
                                                @endforeach
                                            </select> 
                                        </td>
                                    </tr>
                                    <div class="clearfix"></div>
                                    <input type="hidden" id="posProducts">
                                </tbody>
                            </table>
                            <hr>
                            <table class="table">
                                <tbody>
                                    <tr style="font-size: 20px; font-weight: bold">
                                        <td>Total</td>
                                        <td style="float: right;">৳ <span id="total_text">0.00</span></td>
                                        <input type="hidden" id="total" name="grand_total" value="0">
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">

                            </div>
                            <div class="col-sm-6">
                                <input type="submit" class="btn btn-primary" value="Place Order" style="float: right;">
                            </div>
                        </div>
                    </form>
                </div>
                <!-- card-body end// -->
            </div>
        </div>
    </div>
</section>


<!--  Customer Modal -->
<div class="modal fade" id="customer1" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header card-header">
          <h3>Customer Create</h3>
          <button type="button" class="btn-close bg-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form method="POST" enctype="multipart/form-data" id="customer_store" action="" >
                <input type="hidden" name="_token" id="csrf" value="{{Session::token()}}">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="mb-1">
                            <label class="col-form-label" style="font-weight: bold;">Name: <span class="text-danger">*</span></label>
                            <input class="form-control" type="text" id="name" name="name" required placeholder="Write Customer Name">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="mb-1">
                            <label class="col-form-label" style="font-weight: bold;">Phone: <span class="text-danger">*</span></label>
                            <input type="text" placeholder="Write Phone" id="phone" name="phone" required class="form-control" >
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="mb-1">
                            <label class="col-form-label" style="font-weight: bold;">Email:</label>
                            <input type="email" placeholder="Write Email" id="email" name="email" class="form-control" >
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="mb-1">
                            <label class="col-form-label" style="font-weight: bold;">Address: <span class="text-danger">*</span></label>
                            <input type="text" placeholder="Write Address" id="address" name="address" required class="form-control" >
                        </div>
                    </div>
                    <div class="mb-1 mt-2">
                        <img id="showImage" class="rounded avatar-lg" src="{{ (!empty($editData->profile_image))? url('upload/admin_images/'.$editData->profile_image):url('upload/no_image.jpg') }}" alt="Card image cap" width="100px" height="80px;">
                    </div>
                    <div class="mb-1">
                        <label for="image" class="col-form-label" style="font-weight: bold;">Profile Image:</label>
                        <input name="profile_image" class="form-control" type="file" id="image">
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="Close" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" id="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection

@push('footer-script')
    <!-- Ajax Update Category Store -->
    <script type="text/javascript">
        $(document).ready(function (e) {
            
            $('#customer_store').submit(function(e) {
                e.preventDefault();
                var formData = new FormData(this);
                $.ajax({
                    type:'POST',
                    url: "{{ route('customer.ajax.store.pos') }}",
                    data: formData,
                    cache:false,
                    contentType: false,
                    processData: false,
                    success: (data) => {
                        //console.log(data);
                        $('select[name="customer_id"]').html('<option value="" selected="" disabled="">-- Select Customer --</option>');
                        $.each(data.customers, function(key, value){
                            $('select[name="customer_id"]').append('<option value="'+ value.id +'">' + value.name + '</option>');
                        });

                        // console.log(data);
                        $('#showImage').val('');
                        $('#phone').val('');
                        $('#email').val('');
                        $('#address').val('');
                        this.reset();

                        if ($.isEmptyObject(data.error)) {
                            const Toast = Swal.mixin({
                                toast: true,
                                position: 'top-end',
                                icon: 'success',
                                showConfirmButton: false,
                                timer: 2000
                            })
                            Toast.fire({
                                type: 'success',
                                title: data.success
                            })
                        }else{
                            const Toast = Swal.mixin({
                                toast: true,
                                position: 'top-end',
                                icon: 'error',
                                showConfirmButton: false,
                                timer: 2000
                            })
                            Swal.fire({
                                icon: 'error',
                                title: data.error,
                            })
                        }
                        // End Message
                        $('#Close').click();
                    },
                    
                    error: function(data){
                        $.each(data.responseJSON.errors, function(key, value){
                            // console.log(value);
                            var Toast = Swal.mixin({
                                toast: true,
                                position: 'top-end',
                                icon: 'error',
                                showConfirmButton: false,
                                timer: 2000,
                            })
                            Toast.fire({
                                title: value
                            })
                    
                        });

                    }
                });
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $('body').addClass('aside-mini');
        });

        function addToList(id){
            //alert(id);
            $.ajax({
                type:'GET',
                url:'/admin/pos/product/'+id,
                dataType:'json',
                success:function(data){
                    //console.log(data);

                    var posProducts = $('#posProducts').val();

                    if(posProducts){
                        var productIds = posProducts.split(',');
                        if(productIds.includes('product_'+id)){
                            cart_increase(id);
                            return false;
                        }
                    }

                    // Start Sweertaleart Message
                    const Toast = Swal.mixin({
                        toast:true,
                        position: 'top-end',
                        icon: 'success',
                        showConfirmButton: false,
                        timer: 1200
                    })

                    var price = parseFloat(data.regular_price);
                    // console.log(price);
                    if(parseFloat(data.discount_price) > 0){
                        if(data.discount_type == 1){
                            price = parseFloat(data.regular_price - data.discount_price);
                        }else if(data.discount_type == 2){
                            price = parseFloat(data.regular_price - (data.regular_price * data.discount_price / 100));
                        }
                    }

                    var subtotal = parseFloat($('#subtotal_text').val());
                    //console.log(subtotal);
                    var total =  parseFloat($('#total').val());

                    subtotal = parseFloat(subtotal + price).toFixed(2);
                    total = parseFloat(total + price).toFixed(2);
                    

                    $('#due_amount').val(subtotal);
                    $('#subtotal_text').val(subtotal);
                    $('#total').val(total);
                    $('#total_text').html(total);

                    $('#no_product_text').html('');

                    if(posProducts){
                        posProducts += ',product_' + id;
                    }else{
                        posProducts = 'product_'+id;
                    }

                    $('#posProducts').val(posProducts);

                    html = `<div id="${data.id}"><ul class="list-group list-group-flush">
                                <li class="list-group-item py-0 pl-2">
                                    <div class="row gutters-5 align-items-center">
                                        <div class="col-1">
                                            <div class="row no-gutters align-items-center flex-column aiz-plus-minus">
                                                <button class="btn btn-default" type="button" data-type="plus" data-field="qty-0" onclick="cart_increase(${data.id})">
                                                    <i class="material-icons md-plus"></i>
                                                </button>
                                                <input type="text" name="qty[]" id="qty${data.id}" readonly class="col border-0 text-center flex-grow-1 fs-16 input-number" placeholder="1" value="1" min="1" max="999" onchange="updateQuantity(0)">
                                                <button class="btn btn-default" type="button" data-type="plus" data-field="qty-0" onclick="cart_decrease(${data.id})">
                                                    <i class="material-icons md-minus"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="text-truncate-2">${data.name_en}</div>
                                            <input type="hidden" name="product_id[]" value="${data.id}">
                                        </div>
                                        <div class="col-3">
                                            <div class="fs-12 opacity-60">${price} x <span id="itemMultiplyQtyTxt${data.id}">1</span></div>
                                            <div class="fs-15 fw-600" id="itemTotalPriceTxt${data.id}">${price}</div>
                                            <input type="hidden" name="price[]" id="price${data.id}" value="${price}">
                                        </div>
                                        <div class="col-2">
                                            <button type="button" class="btn-circle" onclick="removeItem(${data.id})">
                                                <i class="material-icons md-delete"></i>
                                            </button>
                                        </div>
                                    </div>
                                </li>
                            </ul><hr><div>`;
                    $('#checkout_list').append(html);

                }
            });
        }

        function removeItem(id){
            var qty = parseInt($('#qty'+id).val());
            var price = parseFloat($('#price'+id).val());

            var subtotal = parseFloat($('#subtotal_text').val());
            var total =  parseFloat($('#total').val());

            //alert(price);

            subtotal = parseFloat(subtotal - (price*qty)).toFixed(2);
            total = parseFloat(total - (price*qty)).toFixed(2);

            //alert(subtotal);
            $(document).on("change", "#discount", function() {
                var paid_amount = $('#paid_amount').val();
                var discount_amount = $('#discount').val();
                var due_amount = $('#due_amount').val();
                var total_amount_due = $('#total').val();
                var subtotal_dicount = parseFloat(subtotal - discount_amount).toFixed(2);
                if(paid_amount == 0 || paid_amount == 0.00){
                    $('#due_amount').val(subtotal_dicount);
                    $('#total_text').html(subtotal_dicount);
                    $('#total').val(subtotal_dicount);
                }else{
                    var subtotal_dicount_paid = parseFloat(subtotal_dicount - paid_amount).toFixed(2);
                    $('#due_amount').val(subtotal_dicount_paid);
                    $('#total_text').html(subtotal_dicount);
                    $('#total').val(subtotal_dicount);
                }
            });

            $(document).on("change", "#paid_amount", function() {
                var discount_amount = $('#discount').val();
                var paid_amount = $('#paid_amount').val();
                if(discount_amount == 0 || discount_amount == 0.00){
                    var subtotal_due = parseFloat(subtotal - paid_amount).toFixed(2);
                    $('#due_amount').val(subtotal_due);
                }else{
                    var discount_amount = $('#discount').val();
                    var paid_amount = $('#paid_amount').val();
                    var subtotal_due = parseFloat((subtotal - discount_amount) - paid_amount).toFixed(2);
                    $('#due_amount').val(subtotal_due);
                }
            });


            $('#paid_amount').val(0.00);
            $('#discount').val(0.00);
            $('#subtotal_text').val(subtotal);
            $('#due_amount').val(subtotal);
            $('#total').val(total);

            $('#total_text').html(total);

            $('#'+id).html('');
        }

        function cart_increase(id){
            var qty = parseInt($('#qty'+id).val());
            var price = parseFloat($('#price'+id).val());
            $('#qty'+id).val(qty+1);
            $('#itemMultiplyQtyTxt'+id).html(qty+1);

            var totalPrice = price * (qty+1);
            $('#itemTotalPriceTxt'+id).html(totalPrice);

            var subtotal = parseFloat($('#subtotal_text').val());
            var total =  parseFloat($('#total').val());
            var due = parseFloat($('#due_amount').val());

            subtotal = subtotal + price;
            total = total + price;
            due = due + price;

            $('#subtotal_text').val(subtotal);
            $('#due_amount').val(due);
            $('#total').val(total);

            $('#total_text').html(total);
        }

        function cart_decrease(id){
            var qty = parseInt($('#qty'+id).val());
            if(qty > 1){
                $('#qty'+id).val(qty-1);

                var price = parseFloat($('#price'+id).val());
                $('#itemMultiplyQtyTxt'+id).html(qty-1);

                var totalPrice = price * (qty-1);
                $('#itemTotalPriceTxt'+id).html(totalPrice);

                var subtotal = parseFloat($('#subtotal_text').val());
                var total =  parseFloat($('#total').val());

                subtotal = parseFloat(subtotal - price).toFixed(2);
                total = parseFloat(total - price).toFixed(2);
                
                $('#subtotal_text').val(subtotal);
                $('#due_amount').val(subtotal);
                $('#total').val(total);

                $('#total_text').html(total);
            }
        }

        $(document).on("keyup", "#discount", function() {
            var subtotal = parseFloat($('#subtotal_text').val());
            var paid_amount = $('#paid_amount').val();
            var discount_amount = $('#discount').val();
            var due_amount = $('#due_amount').val();
            var total_amount_due = $('#total').val();
            if(paid_amount == 0 || paid_amount == 0.00){
                var subtotal_dicount = parseFloat(subtotal - discount_amount).toFixed(2);
                $('#due_amount').val(subtotal_dicount);
                $('#total_text').html(subtotal_dicount);
                $('#total').val(subtotal_dicount);
            }else{
                var subtotal_dicount = parseFloat(subtotal - discount_amount).toFixed(2);
                var subtotal_dicount_paid = parseFloat(subtotal_dicount - paid_amount).toFixed(2);
                $('#due_amount').val(subtotal_dicount_paid);
                $('#total_text').html(subtotal_dicount);
                $('#total').val(subtotal_dicount);
            }
        });

        $(document).on("keyup", "#paid_amount", function() {
            var subtotal = parseFloat($('#subtotal_text').val());
            var discount_amount = $('#discount').val();
            var paid_amount = $('#paid_amount').val();
            if(discount_amount == 0 || discount_amount == 0.00){
                var subtotal_due = parseFloat(subtotal - paid_amount).toFixed(2);
                $('#due_amount').val(subtotal_due);
            }else{
                var discount_amount = $('#discount').val();
                var paid_amount = $('#paid_amount').val();
                var subtotal_due = parseFloat((subtotal - discount_amount) - paid_amount).toFixed(2);
                $('#due_amount').val(subtotal_due);
            }
        });

        function filter() {
            var search_term = $('#search_term').val();
            var category_id = $('#category_id').val();
            var brand_id = $('#brand_id').val();

            var url = '/admin/pos/get-products?filter=1';
            var search_status = 0;
            if(search_term){
                if (/\S/.test(search_term)) {
                    search_term = search_term.replace(/^\s+/g, '');
                    search_term = search_term.replace(/\s+$/g, '');
                    url += '&search_term='+search_term;
                    //alert( '--'+search_term+'--' );
                    search_status = 1;
                }
            }
            if(category_id){
                url += '&category_id='+category_id;
                //alert( category_id );
                search_status = 1;
            }
            if(brand_id){
                url += '&brand_id='+brand_id;
                //alert( brand_id );
                search_status = 1;
            }

            if(search_status == 0){
                url = '/admin/pos/get-products';
            }

            $.ajax({
                type:'GET',
                url:url,
                dataType:'json',
                success:function(data){
                    console.log(data);
                    var html = '';
                    if(Object.keys(data).length > 0){
                        $.each(data, function(key,value){
                            var product_name = value.name_en;
                            product_name = product_name.slice(0, 30) + (product_name.length > 30 ? "..." : "");

                            var price_after_discount = value.regular_price;
                            if(value.discount_type == 1){
                                price_after_discount = value.regular_price - value.discount_price;
                            }else if(value.discount_type == 2){
                                price_after_discount = value.regular_price - (value.regular_price * value.discount_price / 100);
                            }

                            html += `<div class="col-sm-2 col-xs-6 product-thumb" onclick="addToList(${value.id})">
                                        <div class="card mb-4">
                                            <div class="card-body">
                                                <div class="product-image">`;
                                                    if(value.product_thumbnail && value.product_thumbnail != '' && value.product_thumbnail != 'Null'){
                            html  +=                    `<img class="default-img" src="/${value.product_thumbnail}" alt="" />`;
                                                    }else{
                            html  +=                     `<img class="default-img" src="/upload/no_image.jpg" alt="" />`;
                                                    }
                            html  +=            `</div>
                                                <p style="font-size: 10px; font-weight: bold; line-height: 15px; height: 30px;">
                                                    ${product_name}
                                                </p>
                                                <div>`;
                                                    if (value.discount_price > 0){
                                                            
                            html  +=                    `<div class="product-price">
                                                                <del class="old-price">৳ ${value.regular_price }</del>
                                                                <span class="price text-primary">৳ ${price_after_discount }</span>
                                                            </div>`;
                                                        }else{
                            html  +=                        `<div class="product-price">
                                                                <span class="price text-primary">৳ ${value.regular_price }</span>
                                                            </div>`;
                                                        }
                            html  +=            `</div>
                                            </div>
                                        </div>
                                    </div>`;

                        });
                    }else{
                        html = '<div class="text-center"><p>No products found!</p></div>'
                    }
                    $('#product_wrapper').html(html);
                }
            });
        };
        // function barcode() {
        //     var barcode_search_term = $('#barcode_search_term').val();
        //     $.ajax({
        //         type:'GET',
        //         url:'/admin/pos/barcode-product/'+barcode_search_term,
        //         dataType:'json',
        //         success:function(abc){
        //             addToList(abc.id);
        //             $('#barcode_search_term').val(null);
        //         }
        //     });
        // }
    </script>
    <script>
        /* ================ Load More Product show ============ */
        $(".product-row .product-row-list").hide(); 
        $(".product-row .product-row-list").slice(0, 18).show();
        $("#seemore").click(function(){
            $(".product-row .product-row-list:hidden").slice(0, 18).slideDown();
            if ($(".product-row .product-row-list:hidden").length == 0) {
                $("#load").fadeOut('slow');
            }
        });
    </script>
@endpush