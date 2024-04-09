@extends('layouts.default')
@section('content')


<h1>CONTACT</h1>
<form class="contact" action="/sendMessage" method="POST">
    @csrf
    <div class="contact_items">
        <label for="">Title</label>
        <input maxlength="35" name="title" type="text">
        <label for="">Message</label>
        <textarea name="description" maxlength="1000" id="" cols="30" rows="10"></textarea>
    
    <button type="submit">Send</button>
    </div>
</form>

@endsection