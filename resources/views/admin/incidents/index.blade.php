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
    </div>
    <div class='ui divider'></div>
    <table class='ui small compact striped table'>
        <thead>
            <tr>
                <th>{{ __('admin_incidents.date') }}</th>
                <th>{{ __('admin_incidents.type') }}</th>
                <th>{{ __('admin_incidents.location') }}</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($incidents as $incident)
            <tr>
                <td>{{ $incident->date }}</td>
                <td>{{ __('admin_incidents.'.$incident->type) }}</td>
                <td>{{ $incident->location['lat'] }} , {{ $incident->location['lng'] }}</td>
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


