@extends('layouts.default')
@section('content')
<div class="dashboard">
    <div class="dashboard_info">
        <ul class="account">
            <li>Name: {{$data->name}}</li>
            <li>Email: {{$data->email}}</li>
            <li class="role">Role: {{$data->role}}</li>
        </ul>
    </div>
    <div class="dashboard_buttons">
        <button class="edit">Edit Account Information</button>
        <form method="post" action="{{route('user.delete')}}">
            @csrf
            <button type="submit" class="delete">Delete Account</button>
        </form>
        @if($data->role == "admin")
        <button class="create">Create New Account</button>
        @endif
    </div>
    <div class="dashboard_edit">
        <br>
        <form method="POST" action="{{route('user.update')}}" class="dashboard_edit_form">
            @csrf
            <h4>Edit your account:</h4>
            <label for="accountName">Name</label>
            <input type="text" name="accountName" id="accountName" value="{{$data->name}}">
            <label for="accountEmail">Email</label>
            <input type="email" name="accountEmail" id="accountEmail" value="{{$data->email}}">
            <button type="submit">Save</button>
        </form>
    </div>
    @if($data->role == "admin")
    <div class="dashboard_create">
        <br>
        <form method="POST" action="{{route('user.create')}}" class="dashboard_edit_form">
            @csrf
            <h4>Create new User:</h4>
            <label for="accountName">Name</label>
            <input type="text" name="accountName" id="accountName">
            <label for="accountEmail">Email</label>
            <input type="email" name="accountEmail" id="accountEmail">
            <label for="accountPassword">Password</label>
            <input type="password" name="accountPassword" id="accountPassword">
            <label for="accountRole">Role:</label>
            <select name="accountRole">
                <option value="admin">admin</option>
                <option value="user">user</option>
            </select>
            <button type="submit">Save</button>
        </form>
    </div>
    @endif
</div>
<div class="order_history">
    @foreach ($order_data as $order)
<div class="orders">
    <h2>Order #{{$order->id}}</h2>
    <table>
        @foreach ($order->products as $product)
        <tr>
            <td><img src="{{$product->image}}" alt="{{$product->name}}" height="50%" width="50%"></td>
            <td>{{$product->name}}</td>
            <td>Amount placeholder</td>
            <td>€{{$product->price}}</td>
        </tr>
        @endforeach
    </table>
    <h2>Total Price: € {{$order->total_price}}</h2>
    @if($order->code_used != NULL)
    <h3> code used: {{$order->code}}</h3>
    <h2> Total Price incl. discounts: € {{$order->discounted_price}}</h2>
    @endif
    <h2>Delivered on: {{$order->delivery_date}}</h2>
    <a class="disclaimer" href="{{@route('contact')}}">Not delivered? Let us know! Click here to be sent to the contact page.</a>
</div>
@endforeach
</div>
<script src="js/dashboard_script.js"></script>
@endsection
