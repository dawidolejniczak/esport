<script src="{{ asset('vendor/backpack/pnotify/pnotify.custom.min.js') }}"></script>

{{-- Bootstrap Notifications using Prologue Alerts --}}
<script type="text/javascript">
    jQuery(document).ready(function ($) {

        PNotify.prototype.options.styling = "bootstrap3";
        PNotify.prototype.options.styling = "fontawesome";

        @if(count($errors) > 0)
                @foreach ($errors->all() as $error)

$(function () {
            new PNotify({
                title: "Oh No",
                text: "{{ $error }}",
                type: "error",
                icon: false,
            });
        });

        @endforeach
        @endif

        @if(Session::has('message'))
            $(function () {
            new PNotify({
                // title: 'Regular Notice',
                text: "{{ Session::get('message') }}",
                type: "success",
                icon: false
            });
        });
        @endif

        // Additional Alerts
        @foreach (Alert::getMessages() as $type => $messages)
            @foreach ($messages as $message)

$(function () {
            new PNotify({
                // title: 'Regular Notice',
                text: "{{ $message }}",
                type: "{{ $type }}",
                icon: false
            });
        });

        @endforeach
        @endforeach
    });
</script>