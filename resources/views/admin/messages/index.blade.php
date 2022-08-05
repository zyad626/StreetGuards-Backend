@extends('admin.layouts.base')

@section('title', 'Messages')

@section('content')

    <div class='ui grid'>
        <div class='ui ten wide column'>
            <h3 class='ui header'>
                    <i class='ui envelope icon'></i>
                    {{ __('admin_messages.messages') }}
            </h3>
        </div>
    </div>
    <div class='ui divider'></div>
    <table class='ui small compact striped table'>
        <thead>
            <tr>
                <th>{{ __('admin_messages.date') }}</th>
                <th>{{ __('admin_messages.name') }}</th>
                <th>{{ __('admin_messages.email') }}</th>
                <th>{{ __('admin_messages.organization') }}</th>
                <th>{{ __('admin_messages.message') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($messages as $message)
            <tr>
                <td>{{ $message->created_at }}</td>
                <td>{{ $message->name }}</td>
                <td>{{ $message->email }}</td>
                <td>{{ $message->organization }}</td>
                <td>{{ $message->message }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $messages->appends(request()->except('page'))->links() }}
@endsection


