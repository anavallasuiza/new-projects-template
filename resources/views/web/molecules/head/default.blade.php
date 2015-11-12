<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />

<title>{{ Meta::meta('title') }}</title>

<meta name="description" content="{{ Meta::meta('description') }}">

<link rel="stylesheet" href="{{ asset('assets/web/css/style.css') }}" />

<script type="text/javascript">
    var require = {
        baseUrl: '{{ asset('assets/web/js') }}'
    };

    var htmlClasses = document.querySelector('html').classList;

    htmlClasses.remove('no-js');
    htmlClasses.add('js');

</script>

<meta http-equiv="X-UA-Compatible" content="IE=Edge" />
