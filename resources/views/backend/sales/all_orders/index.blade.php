@extends('admin.admin_master')
@section('admin')

<style type="text/css">
    table, tbody, tfoot, thead, tr, th, td{
        border: 1px solid #dee2e6 !important;
    }
    th{
        font-weight: bolder !important;
    }
</style>

<section class="content-main">
    <div class="content-header">
        <div>
            <h2 class="content-title card-title">Order List</h2>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <!-- card-header end// -->
                <div class="card-body">
                    <form class="" action="" method="GET">
                    <div class="form-group row mb-3">
                        <div class="col-md-2">
                            <label class="col-form-label"><span>All Orders :</span></label>
                        </div>
                        <div class="col-md-2 mt-2">
                            <div class="custom_select">
                                {{-- <select class=" select-active select-nice form-select d-inline-block mb-lg-0 mr-5 mw-200" name="vendor_id" id="vendor_id">
                                    <option value="" selected="">Vendor</option>
                                    <option value="0">AA</option>
                                </select> --}}
                            </div>
                        </div>
                        <div class="col-md-2 mt-2">
                            <div class="custom_select">
                                <select class="form-select d-inline-block select-active select-nice mb-lg-0 mr-5 mw-200" name="delivery_status" id="delivery_status">
                                    <option value="" selected="">Delivery Status</option>
                                    <option value="pending" @if ($delivery_status == 'pending') selected @endif>Pending</option>
                                    <option value="confirmed" @if ($delivery_status == 'confirmed') selected @endif>Confirmed</option>
                                    <option value="processing" @if ($delivery_status == 'processing') selected @endif>Processing</option>
                                    <option value="picked_up" @if ($delivery_status == 'picked_up') selected @endif>Picked Up</option>
                                    <option value="shipped" @if ($delivery_status =='shipped') selected @endif>Shipped</option>
                                    <option value="delivered" @if ($delivery_status == 'delivered') selected @endif>Delivered</option>
                                    <option value="cancelled" @if ($delivery_status == 'cancelled') selected @endif>Cancel</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2 mt-2">
                            <div class="custom_select">
                               <select class=" select-active select-nice form-select d-inline-block mb-lg-0 mr-5 mw-200" name="payment_status" id="payment_status">
                                    <option value="" selected="">Payment Status</option>
                                    <option value="unpaid" @if ($payment_status == 'unpaid') selected @endif>Unpaid</option>
                                    <option value="paid" @if ($payment_status == 'paid') selected @endif>Paid</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2 mt-2">
                            <div class="custom_select">
                                <input type="text"   id="reportrange" class="form-control"  name="date" placeholder="Filter by date" data-format="DD-MM-Y" value="Filter by date" data-separator=" - " autocomplete="off">
                            </div>
                        </div>
                        <div class="col-md-2 mt-2">
                            <button class="btn btn-primary" type="submit">Filter</button>
                        </div>
                    </div>
                    <div class="table-responsive-sm">
                        <table  class="table table-bordered table-hover" width="100%">
                            <thead>
                                <tr>
                                    <th>Order Code</th>
                                    <th>Customer name</th>
                                    <th>Customer Phone</th>
                                    <th>Amount</th>
                                    <th>Delivery Status</th>
                                    <th>Payment Status</th>
                                    <th class="text-end">Options</th>
                                </tr>
                            </thead>
                            <tbody>
                            	@foreach ($orders as $key => $order)
                                <tr>
                                    <td>{{ $order->invoice_no }}</td>
                                    <!--<td><b>@if($order->user->role == 4) Walk-in Customer  @else  {{ $order->user->name ?? 'Walk-in Customer' }} @endif</b></td>-->
                                    <td><b>{{ $order->name ?? '' }}</b></td>
                                    <td>{{ $order->phone ?? 'No Phone' }}</td>
                                    <td>
                                        <?php 
                                            $discount_total = $order->grand_total-$order->discount;
                                            $total_ammount = $discount_total;
                                        ?>
                                        {{ $total_ammount }}
                                    </td>
                                    <td>
                                        @php
                                            $status = $order->delivery_status;
                                            if($order->delivery_status == 'cancelled') {
                                                $status = '<span class="badge rounded-pill alert-danger">Cancelled</span>';
                                            } elseif($order->delivery_status == 'pending') {
                                                $status = '<span class="text-danger">Pending</span>';
                                            }
                                        @endphp
                                        {!! $status !!}
                                    </td>

                                    <td>
                                    	<!-- @if ($order->payment_status == '1')
				                            <span class="badge rounded-pill alert-success">Paid</span>
				                            @else
				                            <span class="badge rounded-pill alert-danger">Un-Paid</span>
				                        @endif -->
                                        @php
			                                $status = $order->payment_status;
			                                if($order->payment_status == 'unpaid') {
			                                    $status = '<span class="badge rounded-pill alert-danger">Unpaid</span>';
			                                }
                                            elseif($order->payment_status == 'paid') {
			                                    $status = '<span class="badge rounded-pill alert-success">Paid</span>';
			                                }

			                            @endphp
                                        {!! $status !!}
                                    </td>
                                    <td class="text-end">
			                            <a  class="btn btn-primary btn-icon btn-circle btn-sm btn-xs" href="{{route('all_orders.show',$order->id) }}">
			                                <i class="fa-solid fa-eye"></i>
			                            </a>
			                            <a class="btn btn-primary btn-icon btn-circle btn-sm btn-xs" href="{{ route('invoice.download', $order->id) }}">
			                                <i class="fa-solid fa-download"></i>
			                            </a>
			                            <a href="{{ route('delete.orders',$order->id) }}" id="delete" class="btn btn-primary btn-icon btn-circle btn-sm btn-xs" data-href="#" >
			                                <i class="fa-solid fa-trash"></i>
			                            </a>
			                        </td>

                                   <!--  <td class="text-end">
                                        <a href="#" class="btn btn-md rounded font-sm">Detail</a>
                                        <div class="dropdown">
                                            <a href="#" data-bs-toggle="dropdown" class="btn btn-light rounded btn-sm font-sm"> <i class="material-icons md-more_horiz"></i> </a>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="#">View detail</a>
                                                <a class="dropdown-item" href="#">Edit info</a>
                                                <a class="dropdown-item text-danger" href="#">Delete</a>
                                            </div>
                                        </div>
                                    </td> -->
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="pagination-area mt-25 mb-50">
                            <nav aria-label="Page navigation example">
                                <ul class="pagination justify-content-end">
                                    {{ $orders->links() }}
                                </ul>
                            </nav>
                        </div>
                    </div>
                    </form>
                    <!-- table-responsive //end -->
                </div>
                <!-- card-body end// -->
            </div>
            <!-- card end// -->
        </div>
        <!-- <div class="col-md-3">
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="mb-3">Filter by</h5>
                    <form>
                        <div class="mb-4">
                            <label for="order_id" class="form-label">Order ID</label>
                            <input type="text" placeholder="Type here" class="form-control" id="order_id" />
                        </div>
                        <div class="mb-4">
                            <label for="order_customer" class="form-label">Customer</label>
                            <input type="text" placeholder="Type here" class="form-control" id="order_customer" />
                        </div>
                        <div class="mb-4">
                            <label class="form-label">Order Status</label>
                            <select class="form-select">
                                <option>Published</option>
                                <option>Draft</option>
                            </select>
                        </div>
                        <div class="mb-4">
                            <label for="order_total" class="form-label">Total</label>
                            <input type="text" placeholder="Type here" class="form-control" id="order_total" />
                        </div>
                        <div class="mb-4">
                            <label for="order_created_date" class="form-label">Date Added</label>
                            <input type="text" placeholder="Type here" class="form-control" id="order_created_date" />
                        </div>
                        <div class="mb-4">
                            <label for="order_modified_date" class="form-label">Date Modified</label>
                            <input type="text" placeholder="Type here" class="form-control" id="order_modified_date" />
                        </div>
                        <div class="mb-4">
                            <label for="order_customer_1" class="form-label">Customer</label>
                            <input type="text" placeholder="Type here" class="form-control" id="order_customer_1" />
                        </div>
                    </form>
                </div>
            </div>
        </div> -->
    </div>
</section>

@push('footer-script')



<script type="text/javascript">
$(function() {

    $('input[name="date"]').daterangepicker({
      autoUpdateInput: false,
      locale: {
          cancelLabel: 'Clear'
      }
  });

  $('input[name="date"]').on('apply.daterangepicker', function(ev, picker) {
      $(this).val(picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format('MM/DD/YYYY'));
  });

  // $('input[name="date"]').on('cancel.daterangepicker', function(ev, picker) {
  //     $(this).val('');
  // });


    var start = moment().subtract(29, 'days');
    var end = moment();

    // start = '';
    // end = '';


    $('input[name="date"]').daterangepicker({
      autoUpdateInput: false,
      locale: {
          cancelLabel: 'Clear'
      }
  });
    
    function cb(start, end) {
        $('#reportrange').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
    }

    $('#reportrange').daterangepicker({

        startDate: start,
        endDate: end,
        ranges: {
           'Today': [moment(), moment()],
           'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
           'Last 7 Days': [moment().subtract(6, 'days'), moment()],
           'Last 30 Days': [moment().subtract(29, 'days'), moment()],
           'This Month': [moment().startOf('month'), moment().endOf('month')],
           'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        }
    }, cb);

    cb(start, end);

});
</script>


@endpush

@endsection