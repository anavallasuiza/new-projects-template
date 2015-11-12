@if ($flash = Session::get('flash-message'))

    {{ Session::forget('flash-message') }}

    @include ('web.atoms.alerts.default', $flash)

@endif

@if (Session::has('status'))
    @include ('web.atoms.alerts.default', [
            'status' => 'success',
            'message' => Session::get('status')
        ])
@endif
