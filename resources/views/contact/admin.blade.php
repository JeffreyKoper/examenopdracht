@extends('layouts.default')
@section('content')

<h1>INCOMING ISSUES:</h1>

<div class="contact_admin">
    <form class="admin_messages">
        @csrf
        <h1>Title Placeholder</h1>
        <p>Description Placeholder</p>
        <label for="">Reply Field</label>
        <textarea name="admin_reply" id="admin_reply" cols="30" rows="5"></textarea>
    </div>
</div>

    
@endsection