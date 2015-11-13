@if (count($errors) > 0)
    @foreach ($errors->all() as $error)
        @include ('web.atoms.alerts.default', [
            'status' => 'error',
            'message' => $error
        ])
    @endforeach
@endif