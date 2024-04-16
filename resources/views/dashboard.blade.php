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
                <a href="{{@route('contact.admin')}}">Admin Messageboard</a>
            @endif
        </div>
        <div class="dashboard_edit">
            <br>
            <form method="POST" action="{{route('user.update')}}" class="dashboard_edit_form">
                @csrf
                <h4>Edit your account information:</h4>
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
    <div class="titles">
        <h1>Previous Orders:</h1>
        <h1>Your Inbox:</h1>
    </div>
    <div class="bottom_section">
        <div class="order_list">
            @if($orderData->isEmpty())
                <div class="order_history">
                    <h2 class="orders"> You don't have any past purchases made on this account.</h2>
                </div>
            @else
                <div class="order_pagination">
                    {{ $orderData->links() }}
                </div>
                @foreach ($orderData as $order)
                    <div class="order_history">
                        <div class="orders">
                            <h2>Order #{{$order->id}}</h2>
                            <table>
                                <tr>
                                    <th>Product Image</th>
                                    <th>Name</th>
                                    <th>Amount</th>
                                    <th>Price</th>
                                </tr>
                                @foreach ($order->products as $product)
                                    <tr>
                                        <td align="center"><img src="{{$product->img_filepath}}" alt="{{$product->product_name}}"></td>
                                        <td>{{$product->product_name}}</td>
                                        <td>{{$product->pivot->amount}}</td>
                                        <td>€ {{number_format($product->pivot->product_cart_price, 2)}}</td>
                                    </tr>
                                @endforeach
                            </table>
                            <h2>Total Price incl. tax: € {{number_format($order->total_price, 2) }}</h2>
                            @if($order->code_used != NULL)
                                <h3> code used: {{$order->code_used}}</h3>
                                <h2> Total Price incl. discounts: € {{number_format($order->discounted_price, 2)}}</h2>
                            @endif
                            <h3>ordered on: {{$order->updated_at}} (UTC+2)</h3>
                            <h3>Delivered on: {{$order->delivery_date}}</h3>
                            <a class="disclaimer" href="{{ route('contact') }}">Not delivered? Let us know! Click here to be sent to the contact page.</a>
                        </div>
                    </div>
                @endforeach
                <div class="order_pagination">
                    {{ $orderData->links() }}
                </div>
            @endif
        </div>
        <div class="contact_messages">
            @if($contacts->isEmpty())
                <div class="contact_messages_list">
                    <p>You haven't send any messages on this account.</p>
                </div>
            @else
                <p class="disclaimer">Note that messages that haven't been updated in the last 10 days will be removed from your inbox. You can still find them by typing the ID in the url(https/www.WardrobeWonders/contact/message/{id here}), or by contacting support again.</p>
                @foreach ($contacts as $contact)
                    <div class="contact_messages_list">
                        <h2>{{$contact->title}}</h2>
                        <p class="inboxText">{{$contact->description}}</p>
                        @if($contact->admin_reply != NULL)
                            <a href="{{@route('contact.info', ['id' => $contact->id])}}" class="contact_messages_link">This message got a reply! click to view it!</a>
                        @endif
                    </div>
                @endforeach
            @endif
        </div>
    </div>
    <script src="js/dashboard_script.js"></script>
@endsection