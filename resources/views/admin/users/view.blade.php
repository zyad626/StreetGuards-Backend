@extends('admin.layouts.base')

@section('title', 'users')

@section('content')

<div class='ui breadcrumb'>
    <a class='section' href='{{ route('admin.users') }}'>{{ __('admin_users.users') }}</a>
    <div class='divider'> / </div>
    <div class='section'>{{ $user->id }}</div>
    <div class='divider'> / </div>
    <div class='section'>{{ __('admin_users.details') }}</div>
</div>
<div class='ui divider'></div>    
<div class='ui two column stackable grid'>
    <div class='column'>
        <table class='ui very basic table'>
            <thead>
                <tr>
                    <th colspan="2">Details</th>
                </tr>
            </thead>
            <tbody>

            <tr>
                <td><b>Contact</b></td>
                <td>
                    @if ($user->contact)
                    <div class='ui label'>
                        <i class='icon user'></i> 
                        {{ $user->contact }}
                    </div>
                    @endif
                </td>
            </tr>

 
        


            <tr>
                <td><b>Description</b></td>
                <td>
                    <div class='ui label'>
                        {{ $user->description }}
                    </div>
                </td>
            </tr>
            <tr>
                <td><b>Files / Uploads</b></td>
                <td>
                    
                    <?php $files = $user->files ?>
                    @foreach ($files as $file)
                        <div class='ui basic segment'>

                            <a href="{{ route('admin.files.view', $file->id) }}" target="_blank" >
                            @if($file->isImage())
                                <img src="{{ route('admin.files.view', $file->id) }}" class='ui medium image'>
                                @else
                                {{ $file->name }}
                                @endif
                            </a>
                        </div>

                    @endforeach
                    
                </td>
            </tr>
            </tbody>
        </table>
    </div>
    <div class='ui three column'>
    
    </div>
</div>

@endsection