@extends('layout')
@section('content')
<div class="row">
    <div class="col-sm-2">
    </div>

    <div class="col-sm-8">
    <br><br>
    <table class="table table-bordered">
        <thead>
            <tr><strong>
                <td>ID</td>
                <td>User Name</td>
                <td>amount</td>
                <td>Date time</td>
                <td>Payment Status</td>
            </strong></tr>
        </thead>
        <tbody>
            @foreach($myOrders as $myOrder)
            <tr>
                <td>{{$myOrder->oid}}</td>
                <td>{{$myOrder->name}}</td>
                <td>{{$myOrder->amount}}</td>
                <td>{{$myOrder->updated_at}}</td>
                <td>{{$myOrder->paymentStatus}}</td>
                                            
            </tr>
            @endforeach
        </tbody>
    </table>
    <br><br>
    </div>

    <div class="col-sm-2">

    </div>
</div>
@endsection