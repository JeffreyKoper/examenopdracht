@extends('layouts.default')
@section('content')
    <h1>INCOMING ISSUES:</h1>
    <div class="contact_admin">
        @foreach($contacts as $contact)
            <form class="admin_messages" action="{{route('contact.adminInfo', ['id' => $contact->id]) }}">
                @csrf
                <h2>{{$contact->title}}</h2>
                <p class="messageDescription">{{$contact->description}}</p>
                <input type="hidden" name="messageId" value="{{$contact->id}}">
                <button type="submit">More info</button>
            </form>
        @endforeach
    </div>
    <script src="{{ asset('js/contact_script.js') }}"></script>
@endsection