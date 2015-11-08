<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <link href='http://fonts.googleapis.com/css?family=Marck+Script&subset=latin,cyrillic' rel='stylesheet' type='text/css'>
    <title>@yield('title', 'Wireworks.ru')</title>
    <meta name="Description" content="Украшения из проволоки хэнд-мейд.">
    <meta name="keywords" content="Украшения хэнд-мейд мастер-классы по работе с проволокой купить украшения хэнд-мейд уникальные украшения из проволоки">
    <meta name="Maria Babieva">
    <link type="text/css" href="{{ asset('/css/bootstrap.min.css') }}" rel="stylesheet" />
    <link type="text/css" href="{{ asset('/css/style.css') }}" rel="stylesheet" />
</head>
<body>
<div class="container">
    <div id = "header">
        <img src ="/media/img/logo.png" class="logo" />
        <div class="logotext">
        </div>
        <h1 class="logo_h1">Wireworks.ru</h1>
        <h2 class="motto">Stylish hand-made jewelry</h2>
        @if(Request::cookie('shoppingCart'))
            @include('template.cartBlock')
        @endif
    </div>
    <div class="topmenu">
        @section('navmenu')
        <a href="/">Главная</a>
        <a href="{{route('statics', 'workshop')}}">Воркшоп</a>
        <a href="">Мои работы</a>
        <a href="{{route('statics', 'about')}}">Обо мне</a>
        <a href="">Обратная связь</a>
        <a href="{{route('statics', 'delivery_n_cash')}}">Оплата и доставка</a>
        @show
    </div>
    <div class="content">
        <div class="col-md-3">
            <div class="menu">
                @section('leftmenu')
                    @foreach($categories as $category)
                        <a class="btn btn-default" href="{{route('category', $category->url)}}">{{$category->name}}</a>
                    @endforeach
                @show
            </div>
        </div>
        <div class="col-md-9">
            @yield('content')
        </div>
        <br style="clear:both" />
        <div id="footer">
            <div class="col-md-4">
                <a href="https://www.facebook.com/MariaBabieva" id="fb" title="Facebook"><img src="/media/img/fb.png" width="10%" alt="social buttons"></a>
                <a href="https://vk.com/lontra" id="vk" title="Вконтакте"><img src="/media/img/vk.png" width="10%" alt="social buttons"></a>
                <a href="http://www.livemaster.ru/yuuki" id="mf" title="Ярмарка Мастеров"><img src="/media/img/mf.png" width="10%" alt="social buttons"></a>
            </div>
            <div class="col-md-4">
            </div>
            <div class="col-md-4">
                <p>wireworks.ru &copy 2015.</p>
                <p>e-mail: <a href="mailto:egorgulidow@mail">koi_1@mail.ru</a></p>
            </div>
        </div>
    </div>
</div>
</body>
@section ('scripts')
    <script src="{{asset('/media/js/jquery-2.1.3.min.js')}}"></script>
    <script src="{{asset('/media/bootstrap/js/bootstrap.min.js')}}"></script>
    <script>
        $(function(){
            $('#fb').bind('mouseover', function(){$('#fb img').attr('src', '/media/img/fbc.png')});
            $('#fb').bind('mouseleave', function(){$('#fb img').attr('src', '/media/img/fb.png')});
            $('#vk').bind('mouseover', function(){$('#vk img').attr('src', '/media/img/vkc.png')});
            $('#vk').bind('mouseleave', function(){$('#vk img').attr('src', '/media/img/vk.png')});
            $('#mf').bind('mouseover', function(){$('#mf img').attr('src', '/media/img/mfc.png')});
            $('#mf').bind('mouseleave', function(){$('#mf img').attr('src', '/media/img/mf.png')});
        })
    </script>
    <script src="/media/js/entradaAdministradora.js"></script>
    <script src="/media/js/cart.js"></script>
@show
</html>