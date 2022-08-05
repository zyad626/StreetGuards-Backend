@extends('admin.layouts.base')

@section('content')

    <div class='ui breadcrumb'>
        <a class='section' href='{{ route('admin.admins') }}'>{{ __('admin_admins.admins') }}</a>
        <div class='divider'> / </div>
        <div class='section'>{{ $admin->login_name }}</div>
        <div class='divider'> / </div>
        <div class='section'>{{ __('admin_admins.edit') }}</div>
    </div>
    <div class='ui hidden divider'></div>
    <div class='ui segment'>
        <h2>{{ __('admin_admins.edit_admin') }}</h2>
        @include('admin.admins.form')
    </div>
@endsection
