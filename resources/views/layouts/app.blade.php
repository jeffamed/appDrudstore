<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="img/favicon.png">
    <title>Farmacia - Farmared's 257</title>
    <!-- Main styles for this application -->
    <link href="{{ config('app.env') === 'production' ? secure_asset('css/coreui.css') : asset('css/coreui.css') }}" rel="stylesheet">
</head>

<body class="app header-fixed sidebar-fixed aside-menu-fixed aside-menu-hidden">
<div id="app" class="bg-login">
</div>
<!-- Bootstrap and necessary plugins -->
<script src="{{ config('app.env') === 'production' ? secure_asset('js/app.js') : asset('js/app.js') }}"></script>
<script src="{{ config('app.env') === 'production' ? secure_asset('js/coreui.js') : asset('js/coreui.js') }}"></script>
</body>

</html>
