@extends('layouts.layout_guide')

@section('content')
      <main>
        <div class="login_line">
         @if(Auth::check())
         <a href="{{route('home')}}"><button class="login_button">System</button></a>
         @else
         <a href="{{route('login')}}"><button class="login_button">Login</button></a>
         @endif
         <img src="{{ asset('storage/images/buchada220200099.jpg') }}" class="systemImagePhoto">
       </div>

        <div class=userGuide_link>
        <p>User Guide</p>
        <a href="{{route('guideDownloadLink')}}">Download File Here</a>
        </div>

        <div class=userGuide_view>
          <iframe src="{{ asset('storage/files/UserGuide_YYYYMMDD.pdf') }}"></iframe>
        </div>

        {{-- @if(isset($user))
        @if($user->role == "admin")
        <div>  <!---管理者のみの予定--->
           <button class="userGuide_upload">Upload</button>
        </div>
        @endif
        @endif --}}


           <!-----User Guide uploadモーダル---------------------->

           {{-- <form method="post" action="{{route('guideCreateLink')}}" enctype="multipart/form-data">

             <div class="over-lay"></div>
              
               <div class="useGuideUpdateModal">
                    <h3>Please Update System Guide</h3>
                    <p>Choose File</p>
                    @csrf
                    <input type="file" name="pdf" class="guideChooseFile"/>
                    <button type="submit" value="登録" class="modal-submit-btn">upload</button>
                </div>
              </div>

            </form> --}}
              
           <!-----User Guide uploadモーダル---------------------->

        <div class=middle></div>

      </main>

      <footer>
         <div class=footer>
            <p>System Name</p>
            <div class="sns">
               Follow us from below
            </div>
            <div class="footer-bottom">
               System - Information | © XXXXXX 20XX System
            </div>
         </div>
      </footer>
@endsection
