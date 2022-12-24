@extends('layouts.layout_system')

@section('content')
<main>
    <div class="file-title">
        <p>{{$document->title}}</p>
    </div>

    <div class="document-download">
      <a href="{{route('fileDownloadLink', ['id' => $document->id])}}"><button>Download</button></a>
    </div>
    <div class="favorite-mark">
        <button onclick="like({{$document->id}})">
            @if($like)
            <p class="favorite-marke">
            <span class="js-like-toggle loved">
                <i class="fas fa-heart"></i>
            </span>
            </p>
            @else
            <p class="favorite-marke">
            <span class="js-like-toggle">
                <i class="fas fa-heart"></i>
            </span>
            </p>
            @endif
        </button>
    </div>

    <iframe class="documentView" src="{{ asset('storage/files/'.$document->file)  }}"></iframe>


    <div class="file-information">
        <div class="file-information-top">
           INFROMATION
        </div>
        <label for='projectName_file' class='file-projectName'>Project Name</label>
        <input type='text' name='projectName_file' class="form-control projectName_file" value="{{$document->folder->project->title}}" disabled/>
        <label for='folderName_file' class='file-projectName'>Folder Name</label>
        <input type='text' name='folderName_file' class="form-control folderName_file" value="{{$document->folder->title}}" disabled/>
        <label for='documentDate_file' class='file-projectName'>Document Date</label>
        <input type='text' name='documentDate_file' class="form-control documentDate_file" value="{{$document->date}}" disabled/>
        <label for='author_file' class='file-projectName'>Author</label>
        <input type='text' name='author_file' class="form-control author_file" value="{{$user->name}}" disabled/>
        <label for='createDate_file' class='file-projectName'>Create Date</label>
        <input type='text' name='createDate_file' class="form-control createDate_file" value="{{$document->created_at}}" disabled/>
        <label for='description_file' class='file-projectName'>Description</label>
        <input type='text' name='description_file' class="form-control" id="description_file" value="{{$document->memo}}" disabled/>
      </div>

     

</main>

<script>
    function like(documentId) {
  $.ajax({
    headers: {
      "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
    url: `/like/${documentId}`,
    type: "POST",
  })
    .done(function (data, status, xhr) {
      console.log(data);

      //lovedクラスを追加
      $this.toggleClass('loved'); 

    })
    .fail(function (xhr, status, error) {
      console.log();
    });
}
</script>
<style>
    .loved i {
    color: red !important;
    }
    .favorite-mark p{
        margin-bottom:0;
    }
</style>

@endsection