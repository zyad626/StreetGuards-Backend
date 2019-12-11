@extends('admin.layouts.base')

@section('title', 'Admins')

@section('content')

    <div class='ui grid'>
        <div class='ui ten wide column'>
            <h3 class='ui header'>
                    <i class='ui secret user icon'></i>
                    {{ __('admin_admins.admins') }}
            </h3>
        </div>
        <div class='ui six wide right aligned column'>
            <a href="{{ route('admin.admins.create') }}" class='ui blue button'>
                <i class='ui plus icon'></i>
                {{ __('admin_admins.create') }}
            </a>
        </div>
    </div>
    <div class='ui divider'></div>
    <table class='ui small compact striped table'>
        <thead>
            <tr>
                <th>{{ __('admin_admins.login_name') }}</th>
                <th>{{ __('admin_admins.email') }}</th>
                <th>{{ __('admin_admins.is_active') }}</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($admins as $admin)
            <tr>
                <td>{{ $admin->login_name }}</td>
                <td>{{ $admin->email }}</td>
                <td>
                    @if ($admin->is_active)
                    <div class='ui green label'>
                        {{ __('admin_admins.active') }}
                    </div>
                    @else
                    <div class='ui disabled label'>
                        {{ __('admin_admins.inactive') }}
                    </div>
                    @endif
                </td>
                <td>
                    <a class='ui small green button' href="{{ route('admin.admins.edit', $admin->id) }}">
                        <i class='ui edit icon'></i>
                        {{ __('admin_admins.edit') }}
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $admins->appends(request()->except('page'))->links() }}

@endsection


