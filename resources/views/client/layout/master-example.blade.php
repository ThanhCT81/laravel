<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <style>
        header {
            height: 200px;
            background: red;
        }

        footer {
            height: 200px;
            background: red;
        }

        main {
            display: flex;
        }

        aside {
            width: 20%;
            height: 200px;
            background: blue;
        }

        .content {
            width: 80%;
            height: 200px;
            background: green;
        }
    </style>
</head>

<body>
    @include('client.pages.header')
    <nav>Navigation</nav>
    <main>
        <aside>
            @section('side-bar')
                Side bar of master layout
            @show
        </aside>
        <div class="content">
            @yield('content')
        </div>
    </main>
    @include('client.pages.footer')
</body>

</html>
@yield('js-custom')
