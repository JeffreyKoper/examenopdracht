@extends('layouts.default')
@section('content')
    <h1>Promo codes:</h1>
    <div class="promo">
        <table>
            <tr>
                <th>id</th>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
            @foreach($user_data as $data)
                <tr>
                    <td>{{$data->id}}</td>
                    <td>{{$data->name}}</td>
                    <td>{{$data->email}}</td>
                    <td>{{$data->role}}</td>
                    <td><a href="{{ route('users.edit', $data->id) }}"><button>Edit</button></a></td>
                    <td>
                        <form id="deleteForm{{$data->id}}" action="{{route('users.delete', $data->id)}}" method="POST" onsubmit="return confirm('Are you sure you want to delete this user?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Delete</button>
                        </form>                    
                    </td>
                </tr>
            @endforeach
        </table>
       <!-- <div class="create-section">
            <h2>Create a New user</h2>
            <div class="create-button">
                <form action="route('users.createForm')">
                    <button>Create New user</button>
                </form>
            </div>
        -->
        </div>
    </div>
@endsection
