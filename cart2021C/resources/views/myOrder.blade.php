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
                    <td>amount</td>
                    <td>Date & Time Of Publish</td>
                    <td>Payment Status</td>
                </strong></tr>
            </thead>
            <tbody>
                @foreach($myOrders as $myOrder)
                <tr>
                    <td>{{$myOrder->oid}}</td>
                    <td>{{$myOrder->amount}}</td>
                    <td>{{$myOrder->updated_at}}</td>
                    <td>{{$myOrder->paymentStatus}}</td>
                                                
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="d-md-flex justify-content-md-end">
        <a href="{{ route('pdfReport')}}" class="btn btn-secondary btn-xs">Download</a>
        </div>
        <br>
    </div>

    <div class="col-sm-2"></div>
</div>
@endsection