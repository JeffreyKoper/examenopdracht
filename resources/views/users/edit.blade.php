@extends('layouts.default')
@section('content')
    <div class="promo-edit">
        <div class="edit-form">
            <h2>Edit User</h2>
            <form action="{{ route('users.update', $user->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name" value="{{ $user->name }}" placeholder="Example: John Doe" required>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="text" id="email" name="email" value="{{ $user->email }}" placeholder="example: John.Doe@hotmail.com" required>
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="text" id="password" name="password" value="" placeholder="Password">
                </div>
                <div class="form-group">
                    <label for="Role">Role:</label>
                    <select id="Role" name="role" required>
                        <option value="admin">Admin</option>
                        <option value="user">User</option>
                    </select>
                </div>
                <div class="form-group">
                    <button type="submit">Update user</button>
                </div>
            </form>
        </div>
    </div>
@endsection
