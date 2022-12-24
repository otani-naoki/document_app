@extends('layouts.layout_guide')

@section('content')
      <main class="mt-25">
        <form  class="editUserInformation" action="{{route('users.update', $user->id)}}" method="post" enctype="multipart/form-data">
          @csrf
          @method('PUT')
            <div class="form-group" >
              <label class="yourIcon" for="image">Your Image</label>
              @if(!$user->image)
              <img src="{{ asset('storage/images/hitogata.jpg') }}" alt="アイコン" class="rounded-circle w-25 h-50" >
              @else
              <img src="{{ asset('storage/images/'.$user->image) }}" alt="アイコン" class="rounded-circle w-25 h-50" >
              @endif
              <input type="file" class="selectNewIcon" name="image" id="image" aria-describedby="emailHelp">
            </div>
            <div class="form-group editUserName">
              <label for="name">User Name</label>
              <input type="text" name="name" class="form-control" id="name" placeholder="username" value="{{$user->name}}">
            </div>
            <div class="form-group editUserAddress">
              <label for="email">E-mail Address</label>
              <input type="text" name="email" class="form-control" id="email" value="{{$user->email}}">
            </div>
            <button type="submit" class="btn btn-primary changeUserInformation">Change Information</button>
          </form>

      </main>
@endsection

<style>
    body{position: relative}
    main{
        position: absolute;
        top:20%;
        }
</style>
