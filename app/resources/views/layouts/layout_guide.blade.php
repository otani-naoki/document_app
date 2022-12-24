<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Documment System') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
         <!---Boostrapでインストールしたファイル--->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
         <!---自分で作成したCSSファイル--->
    <link rel="stylesheet" href="{{ asset('css/guide_style.css') }}">
</head>

<!---ここから表示される---->

   <body>
      <header class="header_top">
        <div class="head_line">
          <div class="head_line_items">
            <button>Contact</button>
            <button>Support</button>
            <button>Language</button>
          </div>
        </div>

        <div class="systemName_line">
            <a href="{{ url('/') }}">
               System Name
            </a>
        </div>
      </header>
       
        <!----------------extendする内容---------------------->
        @yield('content')
        <!----------------extendする内容---------------------->


        
<!---ここまで表示される---->

     <!----jQueryライブラリをダウンロードせず読み込み---->
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
     <!----JavaScriptファイルを読み込む---->
     <script src="{{ asset('js/guide_script.js') }}"></script> 

   </body>
</html>