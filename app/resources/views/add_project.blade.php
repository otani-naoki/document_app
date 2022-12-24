@extends('layouts.layout_system')

@section('content')
  <main>

      <p class="createProject">Create Project</p>
        
      <form action="{{ route('save.project')}}" method="POST">
        @csrf
        <div class="project-information-main">
              <div class="project-name">
                <label for='project-name' class='mt-2'>Project Name</label>
                <input type='text' name='projectName' class="form-control" />
              </div>
  
            <div class="auto-item-project">
              <div>
                <label for='author' class='mt-2'>Author</label>
                <input type='id' class="form-control" value="{{ $user->name }}"/>
                <input type="hidden" name="id" value="{{ $user->id }}"/>
              </div>
    
              <div>
                <label for='create-date' class='mt-2'>Start Date</label>
                <input type='date' name='startDate' class="form-control"/>
              </div>
            </div>
          </div>

          <p class="project-information">Project Information</p> 

          <div class="project-information-sub">
            <div class="object">
              <label for='object' class='mt-2'>Object</label>
              <input type='text' name='projectObject' class="form-control"/>
            </div>
            <div class="description-project">
              <label for='description-project' class='mt-2'>Description</label>
              <input type='text' name='projectDescription' class="form-control"/>
            </div>
          </div>
          <div class="save-project">
              <button type='submit'>Save</button>
          </div>
      </form>
  </main>
@endsection