@extends('layouts.layout_system')

@section('content')
  <main>
    <p class="upload-document">Upload Document</p>

  <form action="{{route('save.file')}}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="upload-area">
      <div class="drag_and_drop">
          <i class="fas fa-cloud-upload-alt"></i>
          <p>Drag and drop a file or click</p>
          <input type="file" name="upload_file" id="input-files">
      </div>
    </div>
      <div class="main-items">
        <div class="select-item">
          <div class="select-project">
            <label for='selectProject' class='mt-2'>Select Project</label>
            <select type='text' name='select-project' class="form-control" id='selectProject' value="">
            @if(isset($selectProjects))
            @foreach($selectProjects as $selectProject)
              <option value="{{ $selectProject->id }}" selected>{{ $selectProject->title }}</option>
            @endforeach
            @endif
          </select>
          </div>

          <div class="select-folder">
            <label for='selectFolder' class='mt-2'>Select Folder</label>
            <select type='text' name='select_folder' class="form-control" id='selectFolder' value="">
            {{-- @if(isset($selectFolders)) --}}
            {{-- @foreach($selectFolders as $selectFolder) --}}
              <option ></option>
            {{-- @endforeach
            @endif --}}
            </select>
          </div>
        </div>

        <div class="auto-item-file">
          <div>
            <label for='author' class='mt-2'>Author</label>
            <input type='text' name='author' class="form-control" id='author' value="{{ $user->name }}"/>
          </div>

          <div>
            <label for='createDate' class='mt-2'>Create Date</label>
            <input type='text' name='creteDate' class="form-control" id='createDate' value="{{ $today }}"/>
          </div>
        </div>
      </div>

      <p class="document-information">Document Information</p> 

      <div class="document-information-sub">
        <div class="document-date">
          <label for='document-date' class='mt-2'>Document Date</label>
          <input type='date' name='documentDate'class="form-control"/>
        </div>
        <div class="description">
          <label for='description' class='mt-2' >Description</label>
          <input type='text' name='documentDescription' class="form-control" vertical-align="top"/>
        </div>
      </div>
      <div class="save-document">
        <input type="submit" id="submit-btn" value="Save">
      </div>
  
  </form>

  </main>

  <script type="text/javascript">

$(function () {
   //都道府県 が変更された場合
   $('[name=select-project]').on('change', function () {
       let id=$(this).val();
    
       $.ajax({
           headers: {
               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
           },
           type: "POST",
           url: "/ajax/selectFolder",
           data: { "project_id": id },
           dataType: "json",
       }).done(function (data) {
     
           //selectタグ（子） の option値 を一旦削除
           $('#selectFolder option').remove();
           //戻って来た data の値をそれそれ optionタグ として生成し、
           // city に optionタグ を追加する
           $.each(data, function (index,value) {
             console.log(data);
               $('#selectFolder').append($('<option>').text(value.title).attr('value', value.id));
           });
           

       }).fail(function () {
           console.log("失敗");
       });
   });
 });

  // 	//Projectのイベントハンドラ
	// $('select#selectProject').change(function(){
	// 	var val = $('select#selectProject option:selected').val();
	// 	var label = $('select#selectProject option:selected').text();
	// 	$('label#selectProject').text(label);
	// 	$('select#selectFolder').change();
	// });

	// //Folderのイベントハンドラ
	// $('select#selectFolder').change(function(){
	// 	var val = $('select#selectFolder option:selected').val();
	// 	var label = $('select#selectFolder option:selected').text();
	// });

	// //初期表示にlabelに今選択している値を設定する
	// $('select#selectProject').change();

  </script>
@endsection