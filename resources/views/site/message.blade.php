@extends('site.layouts.basic')

@section('title', __($messageTitle))
@section('content')
<div class='ui container'>

    <div class='columns'>
        <div class="column col-10 col-mx-auto section">
            <h5>
                {{ $messageTitle }}
            </h5>
            <p>
                {{ $message }}
            </p>
        </div>
    </div>
@endsection