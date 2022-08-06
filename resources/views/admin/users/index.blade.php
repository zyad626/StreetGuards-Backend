@extends('admin.layouts.base')

@section('title', 'users')

@section('content')

    <div class='ui grid'>
        <div class='ui ten wide column'>
            <h3 class='ui header'>
                    {{ __('admin_users.users') }}
                
            </h3>
        </div>
        <div class='ui five wide right aligned column'>
            <a href="{{ route('admin.users.download') }}" class='ui blue button'>
                <i class='ui file excel icon'></i> Export
            </a>
        </div>
    </div>
    <div class='ui divider'></div>

        <form action="{{ route('admin.users') }}" class='ui form'>
            <div class='ui fields'>
                <input type="hidden" name='type' value='{{ request('type') }}'>
                <div class='ui five wide field'>
                    <input type="text" name='keyword' placeholder="search keyword" value='{{ request('keyword') }}'>
                </div>
                <div class='ui field'>    
                    <button class='ui blue small button'>
                        search
                    </button>
                </div>
            </div>
        </form>
    <table class='ui small compact striped table'>
        <thead>
            <tr>
                <th>{{ __('id') }}</th>
                <th>{{ __('name') }}</th>
                <th>{{ __('email') }}</th>   
                <th>{{ __('gender') }}</th>
                <th>{{ __('birthDate') }}</th>
                <th>{{ __('profession') }}</th>
                <th>{{ __('isExpert') }}</th>
                <th>{{ __('isTransportationExpert') }}</th>
                <th>{{ __('carOwnership') }}</th>
                <th>{{ __('drivingExperience') }}</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
            <tr>
                <td>{{ $user->userId }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->gender }}</td>
                <td>{{ $user->birthDate }}</td>
                <td>{{ $user->profession }}</td>
                <td>{{ $user->isExpert }}</td>
                <td>{{ $user->isTransportationExpert }}</td>
                <td>{{ $user->carOwnership }}</td>
                <td>{{ $user->drivingExperience }}</td>
    
                <td>
                    <a 
                        class='ui small red button' href="{{ route('admin.users.delete', $user->id) }}"
                        onclick = 'return confirm("Are you sure?");' 
                    >
                        <i class='ui close icon'></i>
                        {{ __('Delete') }}
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $users->appends(request()->except('page'))->links() }}
@endsection


