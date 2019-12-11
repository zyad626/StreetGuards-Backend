@extends('admin.layouts.empty')

@section('content')
<div class="ui container">
    <div class="page-centered">
        <form method="post" class="ui form block" action="" id='login-form'>
            {{csrf_field()}}
            <div class="field">
                <label>User Name</label>
                <input type="text" name="username" />
            </div>
            <div class="field">
                <label>Password</label>
                <input type="password" name="password" />
            </div>

            <div class="app-message"></div>
            <input class="ui positive button" type="submit" value="sign in" />
        </form>
    </div>
</div>
@endsection
