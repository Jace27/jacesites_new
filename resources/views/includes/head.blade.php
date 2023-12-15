<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,
                               user-scalable=no,
                               initial-scale=0.75,
                               maximum-scale=0.75,
                               minimum-scale=0.75">
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="/css/normalize.css">
<link rel="stylesheet" href="/css/jquery-ui.min.css">
<link rel="stylesheet" href="/css/bootstrap/bootstrap.min.css">
<link rel="stylesheet" href="/css/header.css?v={{ time() }}">
<link rel="stylesheet" href="/css/menu.css?v={{ time() }}">
<link rel="stylesheet" href="/css/style.css?v={{ time() }}">
<link rel="stylesheet" href="/css/search.css">
<script>
    let session = {!! auth()->user() ? '"'.auth()->user()->name.'"' : 'null' !!};
</script>
<link rel="shortcut icon" href="/images/system/favico.png" type="image/png">
