@extends('layouts.layout_system')

@section('content')
  <main>

    <div class="Project">
        <p>Project<p> <!--一時的にリンク-->
    </div>
    
    @if(isset( $projectItems ))
      <table class=projectsTable>

        @foreach ($projectItems as $projectItem)
        <tr>
          <td class="projectsLine">

            <div class="projectView">
              <a href="{{route('folderPageLink', ['id' => $projectItem['id']])}}" class="projectTitle">{{$projectItem['title']}}</a>
              <!-- ['id' => $projectItem['id']：プロジェクトのID継承-->
              <div class="projectDetail" id="detail">
                <div class="projectDetail_fixed">
                <div class="authorView_project">
                    <h5>Author</h5>
                    <p>{{ $user->name }}</p>
                </div>
                <div class="startDateView_project">
                    <h5>Start Date</h5>
                    <p>{{ $projectItem['date'] }}</p>
                  </div>
                  <div class="objectView_project">
                    <h5>Object</h5>
                    <p>{{ $projectItem['object'] }}</p>
                  </div>
                </div>
                <div class="descriptionView_project">
                  <h5>Description</h5>
                  <p>{{ $projectItem['memo'] }}</p>
                </div>
              </div>

            </div>

            @if($user->role == "admin")
                <a href="{{route('projectEditLink',$projectItem['id'])}}"><button class="projectEdit">Edit</button></a>
                <button type="submit" data-project_id="{{$projectItem['id']}}" class="projectDelete">Delete</button>
            @endif
        
          </td>
        </tr>
        @endforeach
        
      </table>
    @endif
   
    @if($user->role == "admin")
    <div class="addProjectAll">
       <a href="{{route('addProjectLink')}}"><button class="addProjectButton">Add Project ⊹</button></a>
    </div>
    @endif

  </main>

  <script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });


    // ここから非同期処理の記述
    $(function() {    
    //削除ボタンに"btn-danger"クラスを設定しているため、ボタンが押された場合に開始されます
      $('.projectDelete').on('click', function() {
          var deleteConfirm = confirm('削除してよろしいでしょうか？');
    //　メッセージをOKした時（true)の場合、次に進みます 
          if(deleteConfirm == true) {
          var clickEle = $(this)
    //$(this)は自身（今回は押されたボタンのinputタグ)を参照します
    //　"clickEle"に対して、inputタグの設定が全て代入されます
          var projectID = clickEle.attr('data-project_id');
    //attr()」は、HTML要素の属性を取得したり設定することができるメソッドです
    //今回はinputタグの"data-user_id"という属性の値を取得します
    //"data-user_id"にはレコードの"id"が設定されているので
    // 削除するレコードを指定するためのidの値をここで取得します

    // .ajaxメソッドでルーティングを通じて、コントローラへ非同期通信を行います。
    //見本ではレコードを削除するコントローラへ通信を送るためにはweb.phpを参照すると
    //通信方法は"post"に設定し、URL（送信先）を'/destroy/{id}'にする必要があります
                            
    $.ajax({
            type: 'POST',
            url: '/project/destroy/'+projectID, //userID にはレコードのIDが代入されています
            data: {'id':projectID},
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },         
        })
        .done(function(data){
          console.log(data);
          clickEle.parents('tr').remove();
        }).fail(function(data){
          console.log(data)});                         
              //”削除しても良いですか”のメッセージで”いいえ”を選択すると次に進み処理がキャンセルされます
        } else {
          (function(e) {
            e.preventDefault()
          });
        };
      });
    });
  
  </script>
@endsection

