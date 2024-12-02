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
                                <div class="col-sm-3">
                                    <div class="custom_select">
                                        <select name="brand_id" id="brand_id" class="form-control select-active w-100 form-select select-nice" onchange="filter()">
                                            <option value="">-- Select Brand --</option>
                                            @foreach($brands as $brand)
                                                <option value="{{ $brand->id }}">{{ $brand->name_en }}</option>
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
            <div class="row product_wrapper" id="product_wrapper">
                @foreach($products as $product)
                    <div class="col-sm-2 col-xs-6 product-thumb" onclick="addToList({{ $product->id }})">
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
                @endforeach
            </div>
        </div>
        <div class="col-sm-4">
            <form action="{{ route('pos.store') }}" method="POST">
                @csrf
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="d-flex border-bottom pb-3">
                            <div class="flex-grow-1">
                                <select name="customer_id" id="customer_id" class="form-control select-active w-100 form-select select-nice" required>
                                    <option value="">-- Select Customer --</option>
                                    @foreach($customers as $customer)
                                        <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="button" class="btn btn-success" data-target="#new-customer" data-toggle="modal">
                                <i class="material-icons md-local_shipping"></i>
                            </button>
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
                                        <td style="float: right;">৳ <span id="subtotal_text">0.00</span></td>
                                        <input type="hidden" id="subtotal" name="subtotal" value="0">
                                    </tr>
                                    <tr>
                                        <td>Tax</td>
                                        <td style="float: right;">৳ 0.00</td>
                                    </tr>
                                    <tr>
                                        <td>Shipping</td>
                                        <td style="float: right;">৳ 0.00</td>
                                    </tr>
                                    <tr>
                                        <td>Discount</td>
                                        <td style="float: right;">৳ 0.00</td>
                                    </tr>
                                </tbody>
                            </table>
                            <hr>
                            <table class="table">
                                <tbody>
                                    <tr style="font-size: 20px; font-weight: bold">
                                        <td>Total</td>
                                        <td style="float: right;">৳ <span id="total_text">0.00</span></td>
                                        <input type="hidden" id="total" name="total" value="0">
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
                    </div>
                    <!-- card-body end// -->
                </div>
            </form>
        </div>
    </div>
</section>
@endsection

@push('footer-script')
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
                    console.log(data);

                    // Start Sweertaleart Message
                    const Toast = Swal.mixin({
                        toast:true,
                        position: 'top-end',
                        icon: 'success',
                        showConfirmButton: false,
                        timer: 1200
                    })

                    // if($.isEmptyObject(data.error)){
                    //     Toast.fire({
                    //       type:'success',
                    //       title: data.success
                    //     })
                    // }else{
                    //     Toast.fire({
                    //       type:'error',
                    //       title: data.error
                    //     })
                    // }
                    // Start Sweertaleart Message

                    var price = parseFloat(data.regular_price);
                    if(parseFloat(data.discount_price) > 0){
                        if(data.discount_type == 1){
                            price = parseFloat(data.regular_price - data.discount_price);
                        }else if(data.discount_type == 2){
                            price = parseFloat(data.regular_price - (data.regular_price * data.discount_price / 100));
                        }
                    }

                    var subtotal = parseFloat($('#subtotal').val());
                    var total =  parseFloat($('#total').val());

                    subtotal = parseFloat(subtotal + price).toFixed(2);
                    total = parseFloat(total + price).toFixed(2);

                    $('#subtotal').val(subtotal);
                    $('#total').val(total);

                    $('#subtotal_text').html(subtotal);
                    $('#total_text').html(total);

                    $('#no_product_text').html('');

                    html = `<div id="${data.id}"><ul class="list-group list-group-flush">
                                <li class="list-group-item py-0 pl-2">
                                    <div class="row gutters-5 align-items-center">
                                        <div class="col-1">
                                            <div class="row no-gutters align-items-center flex-column aiz-plus-minus">
                                                <button class="btn btn-default" type="button" data-type="plus" data-field="qty-0" onclick="cart_increase(${data.id})">
                                                    <i class="material-icons md-plus"></i>
                                                </button>
                                                <input type="text" name="qty[]" id="qty${data.id}" class="col border-0 text-center flex-grow-1 fs-16 input-number" placeholder="1" value="1" min="1" max="999" onchange="updateQuantity(0)">
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

            var subtotal = parseFloat($('#subtotal').val());
            var total =  parseFloat($('#total').val());

            //alert(price);

            subtotal = parseFloat(subtotal - (price*qty)).toFixed(2);
            total = parseFloat(total - (price*qty)).toFixed(2);

            //alert(subtotal);


            $('#subtotal').val(subtotal);
            $('#total').val(total);

            $('#subtotal_text').html(subtotal);
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

            var subtotal = parseFloat($('#subtotal').val());
            var total =  parseFloat($('#total').val());

            subtotal = subtotal + price;
            total = total + price;

            $('#subtotal').val(subtotal);
            $('#total').val(total);

            $('#subtotal_text').html(subtotal);
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

                var subtotal = parseFloat($('#subtotal').val());
                var total =  parseFloat($('#total').val());

                subtotal = parseFloat(subtotal - price).toFixed(2);
                total = parseFloat(total - price).toFixed(2);

                $('#subtotal').val(subtotal);
                $('#total').val(total);

                $('#subtotal_text').html(subtotal);
                $('#total_text').html(total);
            }
        }

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
    </script>
@endpush
