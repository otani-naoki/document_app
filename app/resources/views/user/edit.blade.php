@extends('layouts.layout_guide')

@section('content')
      <main class="mt-25">
        <form  action="{{route('users.update', $user->id)}}" method="post" enctype="multipart/form-data">
          @csrf
          @method('PUT')
            <div class="form-group">
              <label for="image">画像</label>
              @if(!$user->image)
              <img src="{{ asset('storage/images/buchada220200099.jpg') }}" alt="アイコン" class="rounded-circle w-25 h-50" >
              @else
              <img src="{{ asset('storage/images/'.$user->image) }}" alt="アイコン" class="rounded-circle w-25 h-50" >
              @endif
              <input type="file" name="image" class="form-control" id="image" aria-describedby="emailHelp">
            </div>
            <div class="form-group">
              <label for="name">User Name</label>
              <input type="text" name="name" class="form-control" id="name" placeholder="username" value="{{$user->name}}">
            </div>
            <div class="form-group">
              <label for="email">E-mail Adress</label>
              <input type="text" name="email" class="form-control" id="email" value="{{$user->email}}">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
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
