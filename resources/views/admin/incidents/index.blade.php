@extends('admin.layouts.base')

@section('title', 'Incidents')

@section('content')

    <div class='ui grid'>
        <div class='ui ten wide column'>
            <h3 class='ui header'>
                    @if ($type = request('type'))
                    <i class='ui {{ __('admin_incidents.incidents_type_icons.'.$type) }} icon'></i>
                    {{ __('admin_incidents.incidents_types.'.$type) }}
                    @else
                    {{ __('admin_incidents.incidents') }}
                    @endif
            </h3>
        </div>
        <div class='ui five wide right aligned column'>
            <a href="{{ route('admin.incidents.download', ['type' => request('type')]) }}" class='ui blue button'>
                <i class='ui file excel icon'></i> Export
            </a>
        </div>
    </div>
    <div class='ui divider'></div>

        <form action="{{ route('admin.incidents') }}" class='ui form'>
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
                <th>{{ __('admin_incidents.id') }}</th>
                <th>{{ __('admin_incidents.date') }}</th>
                <th>{{ __('admin_incidents.type') }}</th>
                <th>{{ __('admin_incidents.uploads') }}</th>
                <th>{{ __('admin_incidents.location') }}</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($incidents as $incident)
            <tr>
                <td>{{ $incident->id }}</td>
                <td>{{ $incident->date }}</td>
                <td>{{ __('admin_incidents.'.$incident->type) }}</td>
                <td>{{ count($incident->file_ids ?? []) }}</td>
                <td>
                    {{ $incident->location['lat'] }} , {{ $incident->location['lng'] }}
                    <a href="https://maps.google.com?q={{ $incident->location['lat'] }} , {{ $incident->location['lng'] }}" target="_blank">
                        <i class='external link icon'></i>
                        <i class='map icon'></i>
                    </a>
                </td>
                <td>
                    <a class='ui small green button' href="{{ route('admin.incidents.view', $incident->id) }}">
                        <i class='ui eye icon'></i>
                        {{ __('admin_incidents.view') }}
                    </a>
                    <a 
                        class='ui small red button' href="{{ route('admin.incidents.delete', $incident->id) }}"
                        onclick = 'return confirm("Are you sure?");' 
                    >
                        <i class='ui close icon'></i>
                        {{ __('admin_incidents.delete') }}
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $incidents->appends(request()->except('page'))->links() }}
@endsection


