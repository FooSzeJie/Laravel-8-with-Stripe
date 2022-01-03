<html>
    <head>
        <title>Southern Online</title>
    </head>

    <body>
        <h1>Order list</h1>
        <div>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <td>Order ID</td>
                        <td>Amount</td>
                        <td>Date & Time Of Publish</td>
                        <td>Payment Status</td>
                    </tr>
                </thead>

                <tbody>
                    @foreach($orders as $order)
                    <tr>
                        <td>{{$order->oid}}</td>
                        <td>{{$order->amount}}</td>
                        <td>{{$order->updated_at}}</td>
                        <td>{{$order->paymentStatus}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </body>
</html>