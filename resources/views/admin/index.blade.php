@extends('admin.admin_master')
@push('css')
<style>
    canvas {
        border: 1px dotted red;
    }

    .chart-container {
        position: relative;
        margin: auto;
        height: 80vh;
        width: 80vw;
    }
</style>
@endpush
@section('admin')
 <section class="content-main">
    <div class="content-header">
        <div>
            <h2 class="content-title card-title">Dashboard</h2>
            <p>Whole data about your business here</p>
        </div>
        <div>
            <a href="{{ route('pos.index') }}" class="btn btn-primary"><i class="text-muted material-icons md-post_add"></i>Pos</a>
        </div>
    </div>
    <div class="row">
        @if(Auth::guard('admin')->user()->role != '2')
        <div class="col-lg-3">
            <div class="card card-body mb-4">
                <article class="icontext">
                    <span class="icon icon-sm rounded-circle bg-primary-light"><i class="text-primary material-icons md-monetization_on"></i></span>
                    <div class="text">
                        <h6 class="mb-1 card-title">Revenue</h6>
                        <span>৳ {{ number_format($orderCount->total_sell, 2) }}</span>
                        <span class="text-sm"> Shipping fees are not included </span>
                    </div>
                </article>
            </div>
        </div>
        @endif
        @if(Auth::guard('admin')->user()->role != '2')
        <div class="col-lg-3">
            <div class="card card-body mb-4">
                <article class="icontext">
                    <span class="icon icon-sm rounded-circle bg-success-light"><i class="text-success material-icons md-local_shipping"></i></span>
                    <div class="text">
                        <h6 class="mb-1 card-title">Orders</h6>
                        <span>{{ number_format($orderCount->total_orders) }}</span>
                        <span class="text-sm"> Excluding orders in transit </span>
                    </div>
                </article>
            </div>
        </div>
        @endif
        <div class="col-lg-3">
            <div class="card card-body mb-4">
                <article class="icontext">
                    <span class="icon icon-sm rounded-circle bg-warning-light"><i class="text-warning material-icons md-qr_code"></i></span>
                    <div class="text">
                        <h6 class="mb-1 card-title">Products</h6>
                        <span>{{ number_format($productCount->total_products) }}</span>
                        <span class="text-sm"> In {{ number_format($categoryCount->total_categories) }} Categories </span>
                    </div>
                </article>
            </div>
        </div>
        @if(Auth::guard('admin')->user()->role != '2')
        <div class="col-lg-3">
            <div class="card card-body mb-4">
                <article class="icontext">
                    <span class="icon icon-sm rounded-circle bg-info-light"><i class="text-info material-icons md-people"></i></span>
                    <div class="text">
                        <h6 class="mb-1 card-title">Customers</h6>
                        <span>{{ number_format($userCount->total_users) }}</span>
                        <span class="text-sm"> Who are active. </span>
                    </div>
                </article>
            </div>
        </div>
        @endif

        <div class="col-lg-3">
            <div class="card card-body mb-4">
                <article class="icontext">
                    <span class="icon icon-sm rounded-circle bg-warning-light"><i class="text-warning material-icons md-local_police"></i></span>
                    <div class="text">
                        <h6 class="mb-1 card-title">Brands</h6>
                        <span>{{ number_format($brandCount->total_brands) }}</span>
                        <span class="text-sm"> All brands </span>
                    </div>
                </article>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="card card-body mb-4">
                <article class="icontext">
                    <span class="icon icon-sm rounded-circle bg-danger"><i class="text-white material-icons md-qr_code"></i></span>
                    <div class="text">
                        <h6 class="mb-1 card-title">Low Stocks</h6>
                        <span>{{ number_format($lowStockCount->total_low_stocks) }}</span>
                        <span class="text-sm"> Products having stock <= 5 </span>
                    </div>
                </article>
            </div>
        </div>
    </div>

    <div class="card mb-4">
        <header class="card-header">
            <h2 class="text-white">Order History</h2>
        </header>

        <div class="chart-container">
            <canvas id="chart"></canvas>
        </div>
    </div>
</section>
@endsection
@push('footer-script')
<script type="text/javascript" src="https://canvasjs.com/assets/script/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="https://canvasjs.com/assets/script/jquery.canvasjs.min.js"></script>
<script type="text/javascript">
    var orderData = @json($orderData);

    var labels = orderData.map(data => data.upazilla_name);
    var orderCounts = orderData.map(data => data.order_count);

    var data = {
        labels: labels,
        datasets: [{
            label: "Area wise Order List",
            backgroundColor: "rgba(54, 162, 235, 0.2)",
            borderColor: "rgba(54, 162, 235, 1)",
            borderWidth: 2,
            hoverBackgroundColor: "rgba(54, 162, 235, 0.4)",
            hoverBorderColor: "rgba(54, 162, 235, 1)",
            data: orderCounts,
        }]
    };

    var options = {
        maintainAspectRatio: false,
        scales: {
            y: {
                stacked: true,
                grid: {
                    display: true,
                    color: "rgba(54, 162, 235, 0.2)"
                }
            },
            x: {
                grid: {
                    display: false
                }
            }
        }
    };

    new Chart('chart', {
        type: 'bar',
        options: options,
        data: data
    });
</script>
@endpush
