@extends('layouts.layout_system')

@section('content')
  <main>
     <div class="sideBar">
        <div class="favoritesTab">
          <a href="{{route('favoritesLink')}}">Favorites<a>
        </div>
        <div class="documentsTab">
          <a href="{{route('documentLink')}}">Documents<a>
       </div>
     </div>

     <div class="systemTopDisplay">
       <div class="systemTopDisplayTitle">
          Documents
       </div>

       <div>
         <form class="systemTopDisplaySearch" method="GET" action="{{route('searchDocumentsLink')}}">
           <div>
            <input type="search" placeholder="Document Name" name="search" value="@if (isset($serch)) {{ $serch }} @endif">
           </div>
           <div>
              <button class="SearchButton" type="submit">Search</button>
              <button class="SearchClearButton">
                <a href="{{route('searchDocumentsLink')}}" class="text-white">Clear</a>
              </button>
           </div>
          </form>
        </div>

       @if(isset($documents))
       <table class="documentTable">
          @foreach($documents as $document)
          <tr>
            <td class="documentLine">
              <a href="{{route('documentPageLink', ['id'=> $document['id']])}}">
                {{$document['title']}}
              </a>
            </td>
          </tr>
          @endforeach
       </table>
       @endif
     </div>
        

  </main>
@endsection
