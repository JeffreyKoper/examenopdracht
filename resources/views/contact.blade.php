@extends('layouts.default')
@section('content')
    <h1>CONTACT:</h1>
    @auth
    <form class="contact" action="/sendMessage" method="POST">
        @csrf
        <h3 class="contact_header">Got a complaint? Stuck with a issue? Let us know! The form below will automatically send your message to our customer service team. You'll be able to find replies in your dashboard inbox.</h3>
        <div class="contact_items">
            <label for="message_title">Title</label>
            <input maxlength="35" name="title" type="text" id="message_title">
            <label for="message_description">Message</label>
            <textarea name="description" maxlength="1000" id="" cols="30" rows="10" id="message_description"></textarea>
            <button type="submit">Send</button>
        </div>
    </form>
    @endauth
    @guest
        <div class="contact">
            <button type="submit"><a href="{{route('login')}}">Login to be able to contact us!</a></button>
        </div>
    @endguest
@endsection