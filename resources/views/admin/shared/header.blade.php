
<div class='ui attached small compact inverted menu'>
    <div class='ui container'>
        <a class='item' href='{{ route('admin.home') }}'><i class='ui home icon'></i> Dashboard</a>
        
        <a class='item' href='{{ route('admin.admins') }}'><i class='ui user secret icon'></i> Admins</a>
        <a class='item' href='{{ route('admin.incidents') }}'><i class='ui road icon'></i> Incidents</a>

        <div class="right aligned menu">
            <a class='item' href='{{ route('admin.auth.logout') }}'><i class='ui sign-out icon'></i> Logout</a>
        </div>
    </div>
</div>
