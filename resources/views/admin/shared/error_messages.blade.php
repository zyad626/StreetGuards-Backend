
<div class="ui {{ $errors->any() ? "visible":"" }} error message">
        <ul class="list">
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        @endif
    </ul>
</div>
