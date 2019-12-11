<form class='ui form scroll-error' method='post' action="{{ $action }}">
    @include('admin.shared.error_messages')
    {{ csrf_field() }}
    <div class='ui required field'>
        <label>{{ __('admin_admins.login_name') }}</label>
        <input type="text" name='login_name' value='{{ old('login_name', $admin->login_name) }}'>
    </div>

    <div class='ui required field'>
        <label>{{ __('admin_admins.email') }}</label>
        <input type="text" name='email' value='{{ old('email', $admin->email) }}'>
    </div>

    <div class='ui required field'>
        <label>{{ __('admin_admins.password') }}</label>
        <input type="password" name='password'>
    </div>

    <div class='ui required field'>
        <label>{{ __('admin_admins.repeat_password') }}</label>
        <input type="password" name='password_confirmation'>
    </div>

    <div class='ui field'>
        <div class='ui checkbox'>
            <input type="checkbox" name='is_active' {{ old('is_active', $admin->is_active) ? 'checked' : '' }}>
            <label>Is Active</label>
        </div>
    </div>
    
    <input class='ui green button' type="submit" value='{{ __('admin_app.save') }}'>
</form>
