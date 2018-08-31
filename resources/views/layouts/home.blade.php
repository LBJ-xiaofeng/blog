<!doctype html>
<html>

<head>
    <meta charset="gbk">
    <title>首页_{{$settings->title}}</title>
    <meta name="keywords" content="{{$settings->keywords}}" />
    <meta name="description" content="{{$settings->description}}" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="/css/base.css" rel="stylesheet">
    <link href="/css/index.css" rel="stylesheet">
    <link href="/css/info.css" rel="stylesheet">
    <link href="/css/m.css" rel="stylesheet">
    <script src="/js/jquery.min.js" type="text/javascript"></script>
    <script type="text/javascript" src="/js/comm.js"></script>
    <!--[if lt IE 9]>
<script src="/js/modernizr.js"></script>
<![endif]-->
</head>

<body>
    @include('layouts.home._top')
    <article>
        @include('layouts.home._left')

        @section('content')
        
        @show
    </article>
    
    <footer>
        <p>Design by <a href="http://www.yangqq.com" target="_blank">{{$settings->title}}</a> <a href="/">蜀ICP备11002373号-1</a></p>
    </footer>

    <a href="#" class="cd-top">Top</a>
</body>

</html>