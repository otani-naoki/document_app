@extends('layouts.layout_system')

@section('content')
  <main>

      <p class="createProject_edit">Edit Project</p>
        
      <form action="{{ route('update.project', $project->id)}}" method="POST">
        @csrf
        <div class="project-information-main">
              <div class="project-name">
                <label for='project-name' class='mt-2'>Project Name</label>
                <input type='text' name='projectName' class="form-control" value="{{$project->title}}" disabled/>
              </div>
          </div>

          <p class="project-information_edit">Project Information</p> 

          <div class="project-information-sub">
            <div class="object">
              <label for='object' class='mt-2'>Object</label>
              <input type='text' name='projectObject' class="form-control" value="{{$project->object}}"/>
            </div>
            <div class="description-project">
              <label for='description-project' class='mt-2'>Description</label>
              <input type='text' name='projectDescription' class="form-control" value="{{$project->memo}}"/>
            </div>
          </div>
          <div class="save-project">
              <button type='submit'>Save</button>
          </div>
      </form>
  </main>
@endsection