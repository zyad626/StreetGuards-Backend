@extends('admin.layouts.base')

@section('content')

    <div class='ui breadcrumb'>
        <a class='section' href='{{ route('admin.admins') }}'>{{ __('admin_admins.admins') }}</a>
        <div class='divider'> / </div>
        <div class='section'>{{ __('admin_admins.create') }}</div>
    </div>
    <div class='ui hidden divider'></div>
    <div class='ui segment'>
        <h2>{{ __('admin_admins.create') }}</h2>
        @include('admin.admins.form')
    </div>
@endsection
