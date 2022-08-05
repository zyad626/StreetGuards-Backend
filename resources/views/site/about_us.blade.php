@extends('site.layouts.basic')

@section('title', __('About us'))
@section('content')
<div class='ui container'>

    <div class='columns'>
        <div class="column col-10 col-mx-auto section">
            <h5>About Us</h5>
            <div class='divider'></div>
            <p class='about'>
                This website aims at collecting crowdsourced data that can be used
                to encourage governorates to take actions for improving our streets
                and cities’ livability. Reports shall appear on the website without
                including any private details of the users.
            </p>
            <p></p>
            <h5>For more information, comments, inquiries, please fill this form</h5>
            <div class='divider'></div>
            <form action="{{ route('site.post-contact') }}" method='POST'>
                @csrf
                <div class="form-group">
                    <label class="form-label">Name</label>
                    <input class="form-input" type="text" name='name' required>
                </div>
                <div class="form-group">
                    <label class="form-label">Organization</label>
                    <input class="form-input" type="text"  name='organization' required>
                </div>
                <div class="form-group">
                    <label class="form-label">Email</label>
                    <input class="form-input" type="email"  name='email' required>
                </div>
                <div class="form-group">
                    <label class="form-label">Comment / Inquiry</label>
                    <textarea class="form-input" cols="30" rows="5"  name='message' required></textarea>
                </div>
                <div class="pt-2 float-right">
                    <button class="btn btn-primary" v-on:click="save" :disabled='valid == false'>Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection