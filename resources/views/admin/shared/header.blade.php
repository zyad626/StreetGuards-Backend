
<div class='ui attached small compact inverted menu'>
    <div class='ui container'>
        <a class='item' href='{{ route('admin.home') }}'><i class='ui home icon'></i> Dashboard</a>
        
        <a class='item' href='{{ route('admin.admins') }}'><i class='ui user secret icon'></i> Admins</a>
        <a class='item' href='{{ route('admin.users') }}'><i class='ui user icon'></i> Users</a>
        <a class='item' href='{{ route('admin.incidents', ["type" => 'crash_near_miss']) }}'><i class='ui car icon'></i> Crash / Near Miss</a>
        <a class='item' href='{{ route('admin.incidents', ["type" => 'hazard']) }}'><i class='ui road icon'></i> Hazards</a>
        <a class='item' href='{{ route('admin.incidents', ["type" => 'threatening']) }}'><i class='ui frown icon'></i> Threatening incidents</a>
        <a class='item' href='{{ route('admin.map') }}'><i class='ui map icon'></i> Map</a>
        <a class='item' href='{{ route('admin.messages') }}'><i class='ui envelope icon'></i> Messages</a>

        <div class="right aligned menu">
            <a class='item' href='{{ route('admin.auth.logout') }}'><i class='ui sign-out icon'></i> Logout</a>
        </div>
    </div>
</div>
