<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,
                               user-scalable=no,
                               initial-scale=0.75,
                               maximum-scale=0.75,
                               minimum-scale=0.75">
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="shortcut icon" href="/images/system/favico.png" type="image/png">
<link rel="stylesheet" href="/css/normalize.css">
<link rel="stylesheet" href="/css/jquery-ui.min.css">
<link rel="stylesheet" href="/css/bootstrap/bootstrap.min.css">
<link rel="stylesheet" href="/css/header.css?v={{ time() }}">
<link rel="stylesheet" href="/css/menu.css?v={{ time() }}">
<link rel="stylesheet" href="/css/style.css?v={{ time() }}">
<link rel="stylesheet" href="/css/search.css">
<script>
    const session = {!! auth()->user() ? '"'.auth()->user()->name.'"' : 'null' !!};
    const session_id = {!! auth()->user()?->id ?? 'null' !!};
</script>
<script type="text/javascript" src="/js/jquery-3.5.1.js"></script>
<script type="text/javascript" src="/js/jquery-ui.min.js"></script>
<script type="text/javascript" src="/js/bootstrap/bootstrap.min.js"></script>
<script type="text/javascript" src="/js/helpers.js?v={{ time() }}"></script>
