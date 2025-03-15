
<h2 id="menu-categories-title" class="text-center text-light">{{$title}}</h2>
<div class="text-center text-light menu-explain">
    {{$foodDetails['titles'][0]->description}}
</div>
{{-- error and success--}}
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
@endauth
{{-- edit item--}}
@auth

<div class="container  ">
 
  <form action="{{route('add.item')}}" method="post" enctype="multipart/form-data">
     @csrf
     <div class="form-add-item">
     <div class="photo-add text-white"> <span>No file selected</span></div>
    <div class="form-add-item-input">
      <input type="text" maxlength="40" name="title" required placeholder="Enter new title item">
      <input type="text" maxlength="240"  name="description" required placeholder="Description item">
      <input type="number" name="price" step="0.01" min="0" required placeholder="Price">
      
      @if(( !isset($foodDetails['items']->last()->number)))
         @php
          $numberExtension=1;
         @endphp
     
   @else
   @php
    $numberExtension=(($foodDetails['items']->last()->number)+1);
    @endphp
   @endif
      
      <input type="text" name="number" hidden value="
      
      {{(int)$numberExtension}}
      ">
      <input type="text" name="letter" value="{{$food}}" hidden>
      <input id="extHidden" type="number" name="extension" value="4" hidden>
      <input id="file-upload" type="file" name="img" accept=".png, .jpg, .jpeg" hidden>
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
{{--end edit item falta terminar --}}
{{--start modal--}}
@auth
<section id="modal-category" class="modal-category-no-selected">
  <div class="modal-category-selected-content">
    <div class="modal-exit">
        <button class="modal-btn-exit"><svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-x-square-fill" viewBox="0 0 16 16">
          <path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zm3.354 4.646L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 1 1 .708-.708"/>
        </svg>
        </button>
    </div>
    <h2 class="model-h2">Edit Item</h2>
    <div class="selected-content">
    <div class="modal-selected">

      

      <div id="category-tile-modal-zone" class="category-tile-modal d-flex align-items-center bg-black">
          
            

      </div>
    
    </div>
    <div class="modal-section-form">
      <form id="edit-category-form" class="modal-form"  enctype="multipart/form-data" action="{{route('edit.item')}}" method="post">
        <div class="section-item-form text-white"></div>
        @csrf
        <input id="modal-title" type="text" maxlength="40" name="title" required placeholder="Enter new title item">
        <input id="modal-description" type="text" maxlength="240"  name="description" required placeholder="Description item">
        <input id="modal-price" type="number" name="price" step="0.01" min="0" required placeholder="Price">
        <input id="modal-number" type="text" name="number" hidden>
        <input type="text" name="letter" value="{{$food}}" hidden>
        <input id="modal-extHidden" type="number" name="extension" hidden>
        <input id="modal-file-upload" type="file" name="img" accept=".png, .jpg, .jpeg" hidden>
        <input id="item-selected-id" type="number" name="id" hidden>
        <label for="modal-file-upload">Select file</label>
      </form>
    </div>
    
  </div>
    <div class="modal-input-submit">
      <input id="model-submit-update" class="model-btn-update" type="submit" value="Update" form="edit-category-form">
    </div>
  </div>
</section>
@endauth
{{--fina modal--}}



<div class="container">
  <div class="row gy-3 gx-3">
    
    @foreach ($foodDetails['items'] as $item )
    @if(empty($item))
    @continue
    @endif
    <div class="menu-item-tile col-lg-6">
     
        <div id="flex-row" class="row">
          <div class="col-5 col-1-575">
            <div class="menu-item-photo">
              @auth
        
              <div class="items-tilde-btns">
                <button  class="items-tilde-btn-edit">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                  <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                  <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
                </svg>
                </button>
                <form id="form-delete-category" method="POST" action="{{route('delete.item')}}">
                  @csrf
                <button id="delete-item"  class="items-tilde-btn-delete">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                  <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>
                  <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/>
                </svg>
                </button>
                <input type="text" name="id" hidden value="{{$item->id}}"> 
               {{-- <input type="text" name="letter" hidden value="{{$item->letter}}">--}}
              </form>
              </div>
              @endauth
                <div class="description">{{$food}}{{$item->number}}</div>
                <img class="img-responsive" width="250" height="150" onerror="this.onerror=null;this.src='/images/restaurant/menu/default/item.jpg';" 
                
                @if(!($item->extension=='not found'))

                src= "/images/restaurant/menu/{{$food}}/{{$food}}{{$item->number}}.{{$item->extension}}"
        
                @else
                src='/images/restaurant/menu/default/item.jpg'
                @endif        
              
                alt="{{$item->name}}">

            </div>
            <div class="menu-item-price">${{$item->price}}</div>
          </div>
          <div class="menu-item-description col-sm-7">
            <h3 class="menu-item-title">{{$item->name}}</h3>
            <p class="menu-item-details">{{$item->description}}</p>
          </div>
        </div>
        <hr class="visible-xs">
      </div>
    @endforeach
  </div>
</div>
{{-- <script src="{{asset('restaurant/js/menu-items.js')}}"></script> --}}
