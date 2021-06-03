@extends('admin.layouts.base')

@section('title', 'Incidents')

@section('content')

<div class='ui breadcrumb'>
    <a class='section' href='{{ route('admin.incidents') }}'>{{ __('admin_incidents.incidents') }}</a>
    <div class='divider'> / </div>
    <div class='section'>{{ $incident->id }}</div>
    <div class='divider'> / </div>
    <div class='section'>{{ __('admin_incidents.details') }}</div>
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
                    @if ($incident->contact)
                    <div class='ui label'>
                        <i class='icon user'></i> 
                        {{ $incident->contact }}
                    </div>
                    @endif
                </td>
            </tr>
            <tr>
                <td><b>Location</b></td>
                <td>
                    <div class='ui label'>
                        {{ $incident->location['lat'] }}, {{ $incident->location['lng'] }}
                    </div>
                </td>
            </tr>
            @if ($incident->type == 'crash_near_miss')
                <?php $crashData = $incident->crash_data?>
                <tr>
                    <td><b>Type</b></td>
                    <td>Crash / Near Miss</td>
                </tr>
                <tr>
                    <td><b>Is Crash</b></td>
                    <td>{{ $crashData['type'] }}</td>
                </tr>
                <tr>
                    <td><b>Number Of Involved</b></td>
                    <td>
                        @if (!empty($crashData['number_involved_bikes']))
                        <div class='ui red large label'>
                            <i class='ui bicycle icon'></i>
                            {{ $crashData['number_involved_bikes'] }}
                        </div>
                        @endif

                        @if (!empty($crashData['number_involved_vehicles']))
                        <div class='ui red large label'>
                            <i class='ui car icon'></i>
                            {{ $crashData['number_involved_vehicles'] }}
                        </div>
                        @endif

                        @if (!empty($crashData['number_involved_pedestrians']))
                        <div class='ui red large label'>
                            <i class='ui male icon'></i>
                            {{ $crashData['number_involved_pedestrians'] }}
                        </div>
                        @endif
                    </td>
                </tr>
                <tr>
                    <td><b>Reporter Involved</b></td>
                    <td>
                        @if (!empty($crashData['reporter_involved']))
                        <div class='ui label green'>
                            <i class='ui check icon'></i>
                            yes
                        </div>
                        @else
                        <div class='ui label red'>
                            <i class='ui close icon'></i>
                            No
                        </div>
                        @endif
                    </td>
                </tr>
                @if (!empty($crashData['reporter_type']))
                <?php $reporterType = $crashData['reporter_type']; ?>
                <tr>
                    <td><b>Reporter Type</b></td>
                    <td>
                        <i class="ui icon {{ __('admin_incidents.reporter_type_icons.'.$reporterType) }}"></i>                    
                        {{ $reporterType }}
                    </td>
                </tr>
                @endif
                @if (!empty($crashData['type_of_collision']))
                <tr>
                    <td><b>Type of Collision</b></td>
                    <td>                  
                        {{ $crashData['type_of_collision'] }}
                        <div class='ui label'>
                            @if (!empty($crashData['type_of_collision_explain'])) 
                                {{ $crashData['type_of_collision_explain'] }}
                            @endif
                        </div>

                    </td>
                </tr>
                @endif
                <tr>
                    <td><b>{{ __('admin_incidents.number_of_injuries') }}</b></td>
                    <td>{{ $crashData['number_of_injuries'] }}</td>
                </tr>
                <tr>
                    <td><b>{{ __('admin_incidents.number_of_fatalities') }}</b></td>
                    <td>{{ $crashData['number_of_fatalities'] }}</td>
                </tr>
            @endif
            @if ($incident->type == 'hazard')
            <tr>
                <td><b>Type</b></td>
                <td>{{ $incident->hazard_data['type'] }}</td>
            </tr>
            @endif

            @if ($incident->type == 'threatening')
            <tr>
                <td><b>Type</b></td>
                <td>{{ $incident->threatening_data['type'] }}</td>
            </tr>
            @endif

            <tr>
                <td><b>Description</b></td>
                <td>
                    <div class='ui label'>
                        {{ $incident->description }}
                    </div>
                </td>
            </tr>
            <tr>
                <td><b>Files / Uploads</b></td>
                <td>
                    
                    <?php $files = $incident->files ?>
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
        <iframe
            width="600"
            height="450"
            frameborder="0" style="border:0"
            src="https://www.google.com/maps/embed/v1/place?key=AIzaSyA_1fyKerAdiVuPk8GOGBV11O0ZrFGvB8g
              &q={{ $incident->location['lat'] }},{{ $incident->location['lng'] }}&zoom=14" allowfullscreen>
          </iframe>
    </div>
</div>

@endsection