@extends('admin.layouts.base')

@section('title', 'Files')

@section('content')
    <div class='ui grid'>
        <div class='ui ten wide column'>
            <h3 class='ui header'>
                <i class='ui file icon'></i>
                Files
            </h3>
        </div>
    </div>
    <div class='ui divider'></div>
    <div class="ui grid">
        @foreach ($files as $file)
            <div class="ui three wide column">
                <a href="{{ route('admin.files.view', $file->id) }}" target="_blank" >
                @if($file->isImage())
                    <img src="{{ route('admin.files.view', $file->id) }}" class='ui medium image'>
                @else
                    {{ $file->name }}
                @endif
                </a>
            </div>

        @endforeach
    </div>
    {{ $files->appends(request()->except('page'))->links() }}
@endsection


