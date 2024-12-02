@extends('admin.admin_master')
@section('admin')
<section class="content-main">
    <div class="content-header">
        <h3 class="content-title">Account Ledgers <span class="badge rounded-pill alert-success"> {{ count($account_ledgers) }} </span></h3>
        <div>
            <a href="{{ route('accounts.ledgers.create') }}" class="btn btn-primary"><i class="material-icons md-plus"></i>Add New</a>
        </div>
    </div>
    </div>
    <div class="card mb-4">
        <div class="card-body">
            <div class="table-responsive">
               <table id="example" class="table table-bordered table-striped" width="100%">
                    <thead>
                        <tr>
                            <th scope="col">Sl</th>
                            <th scope="col">Account Head</th> 
                            <th scope="col">Particulars</th> 
                            <th scope="col">Created At</th>
                            <th scope="col">Deposit</th>
                            <th scope="col">Expense</th>
                            <th scope="col">Balance</th>
                            <th scope="col" class="text-end">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($account_ledgers as $key => $ledger)
                        <tr>
                            <td> {{ $key+1}} </td>
                            <td> {{ $ledger->account_head->title }} </td>
                            <td> {{ $ledger->particulars }} </td>
                            <td> {{ $ledger->created_at }} </td>
                            <td> {{ $ledger->credit }} </td>
                            <td> {{ $ledger->debit }} </td>
                            <td> {{ $ledger->balance }} </td>
                            <td class="text-end">
                                <div class="dropdown">
                                    <a href="#" data-bs-toggle="dropdown" class="btn btn-light rounded btn-sm font-sm"> <i class="material-icons md-more_horiz"></i> </a>
                                    <div class="dropdown-menu">
                                        @if(Auth::guard('admin')->user()->role == '1' || in_array('52', json_decode(Auth::guard('admin')->user()->staff->role->permissions)))
                                            <a class="dropdown-item text-danger" href="{{ route('accounts.ledgers.delete',$ledger->id) }}" id="delete">Delete</a>
                                        @endif
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

@push('footer-script')
    <script>
        $(document).ready(function(){
            $(document).on('click', '.viweBtn', function(){
                var p_name = $(this).closest('tr').find('.p_name').text();
                // alert(p_name);
                $.ajax({
                    type: "POST",
                    url: "",
                    data: {
                        'checking_view': true,
                        'p_name': p_name,
                    },
                    success: function(response){
                        console.log(response);
                    }
                });
            });
        });
    </script>
@endpush