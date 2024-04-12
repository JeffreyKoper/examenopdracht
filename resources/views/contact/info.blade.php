@extends('layouts.default')
@section('content')
<div class="contact_info">
<form class="contact_info_items" action="" method="post">
    <h3>Message number #{{$info->id}}:</h3>
    <h1>{{$info->title}}</h1>
    <p>{{$info->description}}</p>
    <textarea name="adminReply" id="adminReply" cols="30" rows="10"></textarea>
    <button type="submit">Send Reply</button>
</form>
</div>

@endsection