<div class="card p-2">
    <div
        class=" card-header pb-0 d-flex flex-sm-row flex-column justify-content-md-between align-items-start justify-content-start ">
        <h4 class="card-title mb-50 pt-0">Last Orders</h4>
    </div>
    <div class="card-body p-0 px-1">
        <div class="table-responsive">
            <table class="table  nowrap scroll-horizontal-vertical myTable table-striped w-100">
                <thead class="">
                    <tr class="text-center">
                        <th>ID</th>
                        <th>Email</th>
                        <th>Amount</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                    <tr class="text-center">
                        <td>#{{$order->id}}</td>
                        <td>{{$order->user->email}}</td>
                        <td>{{ number_format($order->amount ,2, ',', '.') }}</td>
                        <td>
                            <span class="p-25   
                                @if ($order->status == '0') 
                                    btn btn-info text-bold-600 
                                @elseif($order->status =='1')   
                                    alert alert-success text-success text-bold-600 
                                @elseif($order->status >= '2') 
                                    alert alert-danger text-danger text-bold-600 
                                @endif">{{$order->status()}}
                            </span>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>