<div class="container-fluid">
    <div class="col-xs-12">
        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if(Session::has('message'))
            <div class="alert alert-success">
                {{ Session::get('message') }}
            </div>
        @endif
        @if(Session::has('dropdown'))
            <script>
                var dropdown_class = '.' + '{{ Session::get('dropdown') }}';
                $(dropdown_class).addClass('open');
            </script>
        @endif
    </div>
</div>