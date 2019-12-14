@extends('admin.layouts.base')

@section('title', 'Incidents')

@section('content')

    <div class='ui grid'>
        <div class='ui ten wide column'>
            <h3 class='ui header'>
                    <i class='ui secret user icon'></i>
                    {{ __('admin_incidents.incidents') }}
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
                <th>{{ __('admin_incidents.data') }}</th>
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
                    <div class='uid label'>
                        {{ __('admin_incidents.road_type') }} {{  __('admin_incidents.road_types.'.$incident->road_type) }}
                    </div>
                </td>
                <td>
                    <a class='ui small green button' href="{{ route('admin.incidents.view', $incident->id) }}">
                        <i class='ui eye icon'></i>
                        {{ __('admin_incidents.view') }}
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $incidents->appends(request()->except('page'))->links() }}
@endsection


