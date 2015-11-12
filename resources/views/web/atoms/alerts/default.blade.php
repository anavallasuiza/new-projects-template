{{-- Status: success / error / warning / info --}}
<div class="alert-outer-wrapper">
    <div class="wrapper">
        <div class="at-alert-box {{ $status }}">
            {!! $message !!}
            <button class="button button-close action-close" data-action="hide" data-target="parent"><span class="accessibility-text">{{ __('Pechar') }}</span></button>
        </div>
    </div>
</div>