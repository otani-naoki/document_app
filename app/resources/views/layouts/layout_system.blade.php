<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Document System') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <!----jQueryライブラリをダウンロードせず読み込み---->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!----JavaScriptファイルを読み込む---->
    <script src="{{ asset('js/system_script.js') }}"></script> 

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
         <!---Boostrapでインストールしたファイル--->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
         <!---自分で作成したCSSファイル--->
    <link rel="stylesheet" href="{{ asset('css/system_style.css') }}">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css">
</head>

<!---ここから表示される---->

  <body> 
    <header>
      <nav class="systemHeader">
          <div class="systemName">
              <a href="{{ url('/') }}">System Name</a>
          </div>

          <div class="d-flex justify-content-end" id="userInformation">
            <div class="userName">
                <p>{{$user->name}}</p>
            </div>
            <div class="userSystem">
              @if(!$user->image)
              <img src="{{ asset('storage/images/hitogata.jpg') }}" alt="アイコン" class="rounded-circle w-47.5 h-50" >
              @else
              <img src="{{ asset('storage/images/'.$user->image) }}" alt="アイコン" class="rounded-circle w-47.5 h-50" >
              @endif
            </div>
          </div>
      </nav>
      <nav class="systemBar">
           <a href="{{route('home')}}"  class="homeLink">Home</a>
           <a href="{{route('projectLink')}}" class="projectLink">Project</a>
           <a href="{{route('createFileLink')}}"><button class="createButton">Create</button></a>
      </nav>
    </header>

    <!---ここから取り込み（メイン）---->
    @yield('content')

    <!---ここまで取り込み（メイン）---->

    <!---User情報モーダル ------------>
    <div>

      <div class="over-lay-user"></div>

      <div class="card useSystemUpdateModal" style="width: 18rem;">

        <div class="d-flex justify-content-center" id="setImage">
          @if(!$user->image)
          <img src="{{ asset('storage/images/hitogata.jpg') }}" alt="アイコン" class="rounded-circle w-50 h-auto " >
          @else
          <img src="{{ asset('storage/images/'.$user->image) }}" alt="アイコン" class="rounded-circle w-25 h-50" >
          @endif
            <div>
              <p id="setUsrName">{{$user->name}}</p>
              <p id="setAddress">{{$user->email}}</p>
            </div>
        </div>
        <div class="card-body">
            <a href="{{route('users.edit', $user->id)}}" class="btn btn-primary mb-2 d-block" id="changeInformation">Change your information</a>
            <a class="btn btn-primary d-block" id="logout"
              href="{{ route('logout') }}"
              onclick="event.preventDefault();
              document.getElementById('logout-form').submit();">
              {{ __('Logout') }}
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </div>
      </div>
    </div>
    <!---User情報モーダル ------------>
    
<!---ここまで表示される---->



   </body>
</html>