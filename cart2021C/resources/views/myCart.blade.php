@extends('layout')
@section('content')
<script>
    function cal(){
        var names = document.getElementsByName('subtotal[]');
        var subtotal = 0;
        var cboxes = document.getElementsByName('cid[]');
        var len = cboxes.length;  //get number of cid[] checkbox inside the page
        for(var i=0; i<len; i++){
            if(cboxes[i].checked){   //calculate if checked
                subtotal = parseFloat(names[i].value) + parseFloat(subtotal);
            }
        }
        document.getElementById('sub').value=subtotal.toFixed(2);
        console.log(subtotal);
        alert(subtotal);
    }
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<div class="row">
    <div class="col-sm-2">
    </div>

    <div class="col-sm-8">
    <br><br>
    <table class="table table-bordered">
        <thead>
            <tr>
                <td>&nbsp;</td>
                <td>Product Name</td>
                <td>Price</td>
                <td>Quantity</td>
                <td>Subtotal</td>
                <td>Action</td>
            </tr>
        </thead>
        <tbody>
            @foreach($carts as $cart)
            <tr>
                <td><input type="checkbox" name="cid[]" id="cid[]" value="{{$cart->cid}}" onclick="cal()"><input type="hidden" name="subtotal[]" id="subtotal[]" value="{{$cart->price * $cart->cartQTY}}"><img src="{{ asset('images/') }}/{{$cart->image}}" width="100" class="img-fluid" alt=""></td>
                <td>{{$cart->name}}</td>                     
                <td>{{$cart->price}}</td>
                <td>{{$cart->cartQTY}}</td>
                <td>{{$cart->price*$cart->cartQTY}}</td>
                <td><a href="{{ route('delete.cart.item',['id' =>$cart->id])}}" class="btn btn-danger btn-xs" onClick="return confirm('DO you confirm to Delete the Data?')">Delete</a></td>
                                          
            </tr>
            @endforeach
            <tr>
                <td clospan="4">&nbsp;</td>
                <td><input type="text" name="sub" id ="sub" value="0" size="7" readoly /></td>
                <td>&nbsp;</td>
            </tr>
        </tbody>
    </table>
    <br><br>
    </div>
    <div class="col-sm-2">

    </div>
</div>
@endsection