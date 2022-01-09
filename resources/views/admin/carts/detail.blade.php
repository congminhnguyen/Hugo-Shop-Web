@extends('admin.users.main')

@section('content')
    <div class="customer mt-3">
        <ul>
            <li>Customer Name: <strong>{{ $customer->name }}</strong></li>
            <li>Phone: <strong>{{ $customer->phone }}</strong></li>
            <li>Address: <strong>{{ $customer->address }}</strong></li>
            <li>Email: <strong>{{ $customer->email }}</strong></li>
            <li>Note: <strong>{{ $customer->content }}</strong></li>
            <li>Status: {!! \App\Helpers\Helper::statusOrder($customer->status) !!}</strong></li>
        </ul>
    </div>

    <div class="carts">
        @php $total = 0; @endphp
        <table class="table">
            <tbody>
            <tr class="table_head">
                <th class="column-1">IMG</th>
                <th class="column-2">Product</th>
                <th class="column-3">Price</th>
                <th class="column-4">Quantity</th>
                <th class="column-5">Total</th>
            </tr>

            @foreach($carts as $key => $cart)
                @php
                    $price = $cart->price * $cart->pty;
                    $total += $price;
                @endphp
                <tr>
                    <td class="column-1">
                        <div class="how-itemcart1">
                            <img src="{{ $cart->product->thumb }}" alt="IMG" style="width: 100px">
                        </div>
                    </td>
                    <td class="column-2">{{ $cart->product->name }}</td>
                    <td class="column-3">{{ number_format($cart->price, 0, '', '.') }}</td>
                    <td class="column-4">{{ $cart->pty }}</td>
                    <td class="column-5">{{ number_format($price, 0, '', '.') }}</td>
                </tr>
            @endforeach
                <tr>
                    <td colspan="4" class="text-right"><b>Total Money:</b></td>
                    <td>{{ number_format($total, 0, '', '.') }}</td>
                </tr>
            </tbody>
        </table>
        <hr>
        <div class="container">
            <form action="" method="POST">
                <label for="status">Choose a status:</label>
                <select name="status" id="status">
                  <option value="Pending">Pending</option>
                  <option value="Shipping">Shipping</option>
                  <option value="Complete">Complete</option>
                </select>
                <input type="submit" value="Submit">
                @csrf
              </form>
        </div>  
    </div>
@endsection