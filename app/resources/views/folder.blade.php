@extends('layouts.layout_system')

@section('content')
<main>
    <div class="project-title">
       @if(isset($projectName))
       <p>{{$projectName->title}}</p>
       @endif
    </div>

    <div class="addFolderAll">
        <button class="addFolderButton">Add Folder ⊹</button>
    </div>

    @if(isset($folders))
    <table class="folderTable">

      @foreach($projectName->folders as $folders)
      <tr>
        <td class="folderLine">▶ {{$folders->title}}</td>
      </tr>
      @foreach($folders->documents as $d)
      <tr>
        <td class="documentsLine">
          <a href="{{route('documentPageLink', ['id'=> $d->id])}}">{{$d->title}}</a>
        </td>
      </tr>

      @endforeach
      @endforeach

       {{-- @foreach ($folders as $folder)
         <tr>
            <td class="folderLine">{{$folder->title}}</td>
            @if(isset($documents))
            @foreach ($documents as $document)
              <tr><td><a href="{{route('documentPageLink', ['id'=> $folder->id])}}">{{$document->title}}</a></td></tr>
            @endforeach
            @endif
        </tr>
       @endforeach --}}

       

       
    </table>
    @endif

    <!-----Folder uploadモーダル---------------------->
    @if(isset($projectName))
    <form method="post" action="{{route('save.folder',['id' => $projectName->id])}}">
        <div class="over-lay-folder"></div>
         
           <div class="addFolderModal">
               <h3>Folder Name</h3>
               @csrf
               <input type='text' name='folderName'/>
               <button type="submit" value="登録" class="folder-modal-submit-btn">Add</button>         
           </div>
         </div>
    </form>
    @endif
    <!-----Folder uploadモーダル---------------------->

</main>
@endsection