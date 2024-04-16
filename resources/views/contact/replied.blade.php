@extends('layouts.default')
@section('content')
    <div class="message-container">
        <div class="message">
            <h2 class="message-title">Message number #{{ $info->id }}:</h2>
            <h1 class="message-subject">{{ $info->title }}</h1>
            <p class="message-body">{{ $info->description }}</p>
        </div>
        <div class="admin-reply">
            <h3 class="reply-label">Reply from the admin:</h3>
            <p class="admin-reply-text">{{$info->admin_reply}}</p>
        </div>
    </div>
@endsection
