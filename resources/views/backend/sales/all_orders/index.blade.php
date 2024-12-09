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
                                    <select class=" select-active select-nice form-select d-inline-block mb-lg-0 mr-5 mw-200" name="note_status" id="note_status">
                                        <option value="" selected="">Note Status</option>
                                        @foreach($ordernotes as $ordernote)
                                            <option value="{{ $ordernote->name }}" @if($note_status == $ordernote->name) selected @endif>
                                                {{ $ordernote->name }}
                                            </option>
                                        @endforeach
                                    </select>
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
                                    <input type="text" name="date_range" class="form-control" placeholder="Select date" id="date" value="">
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
                                        <th>Note Status</th>
                                        <th>Created Date</th>
                                        <th class="text-end">Options</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orders as $key => $order)
                                    <tr>
                                        <td>{{ $order->invoice_no }}</td>
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
                                        <td>{{ $order->note_status }}</td>
                                        <td>{{ $order->created_at ? $order->created_at->format('Y-m-d g:i:s A') : '' }}</td>
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
    </div>
</section>

@push('footer-script')
<script type="text/javascript">
    $(function() {
        $('input[name="date_range"]').daterangepicker({
            timePicker: true,
            timePicker24Hour: false,
            locale: {
                format: 'YYYY-MM-DD h:mm A'
            }
        });
    });
</script>
@endpush
@endsection
