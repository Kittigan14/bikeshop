@extends("layouts.master")
@section('title') BikeShop | ตะกร้าสินค้า @stop
@section('content')

<link rel="stylesheet" href="{{ asset('css/Cart.css') }}">

    <h1>สินค้าในตะกร้า</h1>
    <div class="breadcrumb">
        <li><a href="{{ URL::to('home') }}"><i class="fa fa-home"></i> หน้าร้าน</a></li>
        <li class="active">สินค้าในตะกร้า</li>
    </div>

    <div class="panel panel-default">
        @if(count($cart_items))
            <?php $sum_price = 0 ?>
            <?php $sum_qty = 0 ?>

        <table class="table table-hover" id="table-cart">
            <thead>
                <tr>
                    <th class="head-list" >รูปสินค้า </th>
                    <th class="head-list" >รหัส</th>
                    <th class="head-list" >ชื่อสินค้า </th>
                    <th class="head-list" >จํานวน</th>
                    <th class="head-list" >ราคา</th>
                    <th class="head-list" ></th>
                </tr>
            </thead>

            <tbody>
                @foreach($cart_items as $c)
                <tr>
                    <td><img src="{{ asset($c['image_url']) }}" height="36"></td>
                    <td>{{ $c['code'] }}</td>
                    <td>{{ $c['name'] }}</td>
                    <td>
                        {{-- <input type="number" id="quantity" name="quantity" min="1" class="form-control" value="{{ $c['qty'] }}" onKeyUp="updateCart({{$c['id']}}, this.value)"> --}}
                        <input type="number" id="quantity" name="quantity" min="1" class="form-control" value="{{ $c['qty'] }}" onChange="updateCart({{$c['id']}}, this.value)">
                    </td>

                    <td class="bs-price">{{ number_format($c['price'], 0) }}</td>

                    <td class="btn-container">
                        <a href="{{ URL::to('cart/delete/'.$c['id']) }}" class="btn btn-danger">
                            <i class="fa-solid fa-trash"></i>
                        </a>
                    </td>

                </tr>
                <?php $sum_price += (is_numeric($c['price']) ? $c['price'] : 0) * (is_numeric($c['qty']) ? $c['qty'] : 0) ?>
                <?php $sum_qty += is_numeric($c['qty']) ? $c['qty'] : 0 ?>


                @endforeach
            </tbody>

            <tfoot>
                <tr>
                    <th colspan="3">รวม</th>
                    <th>{{ number_format($sum_qty, 0) }}</th>
                    <th>{{ number_format($sum_price, 0) }}</th>
                    <th></th>
                </tr>
            </tfoot>
        </table>

        @else
            <div class="panel-body"><strong>ไม่พบรายการสินค้า !</strong></div>
        @endif
    </div>

    <!-- buttons -->
    <div class="pull-left">
        <a href="{{ URL::to('/home') }}" class="btn btn-danger" id="button-action">
            <i class="fa fa-chevron-left"></i>ย้อนกลับ 
        </a>
    </div>


    <div class="pull-right">
        <a href="{{ URL::to('cart/checkout') }}" class="btn btn-primary" id="button-action">ชําระเงิน
            <i class="fa fa-chevron-right"></i>
        </a>
    </div>


<script>
    function updateCart(id, qty) {
        if (!isNaN(qty) && qty > 0) window.location.href = '/cart/update/' + id + '/' + qty;
        else alert('Please enter a valid quantity.');
    }
</script>

@endsection
