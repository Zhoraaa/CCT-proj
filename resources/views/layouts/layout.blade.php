<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    {{-- Bootstrap --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous">
    </script>
    {{-- TineMCE --}}
    <script src="https://cdn.tiny.cloud/1/2aarpxpfwjlqbd84vzbvv6tzgbcquwc0enavyueu9lmd5dqj/tinymce/6/tinymce.min.js"
        referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector: '#tinyMCE',
            language: 'ru',
            menubar: 'edit format insert view',
            plugins: 'mentions anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount checklist mediaembed casechange export formatpainter pageembed permanentpen footnotes advtemplate advtable advcode editimage tableofcontents mergetags powerpaste tinymcespellchecker autocorrect a11ychecker typography inlinecss',
            toolbar: 'undo redo | blocks fontsize | bold italic underline strikethrough removeformat  | link image media table mergetags | align lineheight | tinycomments | checklist numlist bullist indent outdent | emoticons charmap',
        });
    </script>
    {{-- Local --}}
    <link rel="stylesheet" href="{{ asset('style.css') }}">
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">
            <img src="{{ asset('public.img.logo.png') }}" alt="Логотип">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown"
            aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="{{ @route('home') }}">Главная</a>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown"
                        aria-expanded="false">
                        О проекте
                    </a>
                    <div class="dropdown-menu bg-dark">
                        <a class="dropdown-item text-white hov-gray" href="{{-- @route('news') --}}">Новости</a>
                        <a class="dropdown-item text-white hov-gray" href="{{-- @route('articles') --}}">Полезная
                            информация</a>
                        <a class="dropdown-item text-white hov-gray" href="#">О нас</a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ @route('forum') }}">Форум</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ @route('shop') }}">Мерч</a>
                </li>
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ @route('auth') }}">Вход</a>
                    </li>
                @endguest
                @auth
                @if (auth()->user()->role === 1)
                <li class="nav-item">
                    <a class="nav-link" href="{{ @route('usrRedaction') }}">Администрирование</a>
                </li>
                @endif
                    <li class="nav-item">
                        <a class="nav-link" href="{{ @route('cart') }}">Корзина</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ @route('user') }}">Личный кабинет</a>
                    </li>
                    <li class="nav-item">
                        <form action="{{ @route('logout') }}" method="POST">
                            @csrf
                            <button class="nav-link bg-dark border-0 " href="#">Выход</button>
                        </form>
                    </li>
                @endauth
            </ul>
        </div>
    </nav>

    @yield('body')

</body>

</html>
