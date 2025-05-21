@php
session_start();
$menuCollection=[];
foreach ($menu as $item) {

  array_push($menuCollection,$item->letter);


}
$_SESSION['collection'] =$menuCollection;
@endphp

@auth
@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="container text-white text-center">
<h2>Welcome, {{ Auth::user()->nombre }}! You can manage categories and items.</h2>
<p><strong>Explanation:</strong> You can add new categories, delete them, and update them on the page. Also, you can enter a category, for example, SOUP, and see different items. You can add, update, and delete items. <strong>Feel free to modify anything, no problem—I have backups.</strong></p>
</div>
<div class="container  ">

  <form action="{{route('add.category')}}" method="post" enctype="multipart/form-data">
     @csrf
     <div class="form-add-item">
     <div class="photo-add text-white"> <span>No file selected</span></div>
     <input id="file-upload" type="file" hidden name="img" accept=".png, .jpg, .jpeg" >
    <div class="form-add-item-input">
      <input type="text" max="30" name="title-category" required placeholder="Enter new title category">
      <input id="extension-category" type="number" name="extension" hidden value="4" >{{--important input--}}
      <input type="text" max="255"  name="description" required placeholder="Description category">
      <input type="text" name="name" required placeholder="name, is unique">
      <input id="letter" type="text" name="letter" max="10" placeholder="you can combination letters max 10"  autocomplete="off" list="letters-list">
      <datalist id="letters-list"></datalist>
      <small id="error-message" style="color: red;"></small>
    </div>
    </div>

   <div class="form-add-item-foot-content">
    <div class="form-add-item-foot" >

      <label for="file-upload" class="custom-file-upload">
        Select file
      </label>

      <input type="submit" value="Add">
    </div>
  </div>


  </form>


</div>
@endauth
<h2 id="menu-categories-title" class="text-center text-light">Menu Categories</h2>
<div class="text-center text-light menu-explain">
  Substituting white rice with brown rice or fried rice after 3:00pm will be $1.50 for a pint and $2.50 for a quart.

</div>
@auth
<section id="modal-category" class="modal-category-no-selected">
    <div class="modal-category-selected-content">
      <div class="modal-exit">
          <button class="modal-btn-exit"><svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-x-square-fill" viewBox="0 0 16 16">
            <path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zm3.354 4.646L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 1 1 .708-.708"/>
          </svg>
          </button>
      </div>
      <h2 class="model-h2">Edit Category</h2>
      <div class="selected-content">
      <div class="modal-selected">



        <div id="category-tile-modal-zone" class="category-tile-modal">



        </div>

      </div>
      <div class="modal-section-form">
        <form id="edit-category-form" class="modal-form"  enctype="multipart/form-data" action="{{route('edit.category')}}" method="post">
          @csrf
          <input class="modal-name" type="text" name="modal-name" placeholder="Enter new name" maxlength="18" minlength="2" required>
          <input type="number" name="modal-id" id="modal-id" hidden>
          <input id="extension-modal-category" type="number" name="extension" hidden >
          <input class="modal-category" type="text" name="modal-category" hidden>
          <label for="modal-input-file">Select file</label>
          <input id="modal-input-file" type="file" name="modal-file"  accept="image/png, image/jpeg, image/jpg" hidden required>
        </form>
      </div>

    </div>
      <div class="modal-input-submit">
        <input id="model-submit-update" class="model-btn-update" type="submit" value="Update" form="edit-category-form">
      </div>
    </div>
</section>
@endauth
<div class="container">
  <div class="row gy-3 gx-3">
    @foreach ($menu as $item )
      <div class="col-xl-3 col-md-4 col-sm-6 col-12 item-menu-content">
        <div class="category-tilde">
        @auth

        <div class="category-tilde-btns">
          <button  class="category-tilde-btn-edit">
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
            <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
            <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
          </svg>
          </button>
          <form id="form-delete-category" method="POST" action="{{route('delete.category')}}">
            @csrf
          <button id="delete-category"  class="category-tilde-btn-delete">
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
            <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>
            <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/>
          </svg>
          </button>
          <input type="text" name="id" hidden value="{{$item->id}}">

          <input  type="text" name="letter" hidden value="{{$item->letter}}">

        </form>
        </div>

        @endauth
        <a class="item-menu" href="/home/cooking/menu/{{$item->letter}}">
          <div class="category-tile">


              {{-- cambiar --}}
            <img class="photo-item-menu" width="200" height="200" onerror="this.onerror=null;this.src='/storage/public/menu/default/category.jpg';"
            @if(!($item->extension=='4'))
            @if($item->extension=="2")
            src= "/storage/public/menu/{{$item->letter}}/{{$item->letter}}.jpg"
            @elseif($item->extension=="1")
            src= "/storage/public/menu/{{$item->letter}}/{{$item->letter}}.jpeg"
            @elseif($item->extension=="3")
            src= "/storage/public/menu/{{$item->letter}}/{{$item->letter}}.png"
            @endif
            @else
            src='/storage/public/menu/default/category.jpg'
            @endif

            alt="{{$item->name}}">

            <span class="item-name">{{$item->name}}</span>
            @auth
            <div class="item-id" data-id="{{$item->id}}" data-category="{{$item->letter}}" data-ext="{{$item->extension}}"></div>
            @endauth
          </div>
        </a>



      </div>
    </div>
    @endforeach
  </div>
</div>
