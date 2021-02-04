@extends('admin.templates.default')
@section('title', 'Post') 
@section('subtitle', 'Edit a Post') 
@section('content')
@php
  $subcategory = DB::table('subcategoryposts')->where('categorypost_id',$post->categorypost_id)->get();
@endphp
<div class="content-header">
    <div class="container-fluid">
        <div class="mb-2 row">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">@yield('title')</h1>
            </div>
            <div class="col-sm-6 ">
                <ol class="breadcrumb float-sm-right">
                    
                </ol>
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.posts.index') }}">@yield('title')</a>
                    </li>
                    <li class="breadcrumb-item active">@yield('subtitle')</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<section class="content">
    <div class="container-fluid">
        <form id="post-form" enctype="multipart/form-data"  action="{{ route('admin.posts.update', $post) }}" method="POST">
         @csrf
         @method('PUT')
         <div class="row">
                <div class="col-lg-8 col-md-8 col-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Create  <small> a Post</small></h3>
                            
                            <div class="card-tools">
                                <a href="{{ route('admin.posts.index') }}" class="btn btn-warning btn-sm" >Back</a>
                                
                                <button type="button" class="btn btn-tool btn-sm" data-card-widget="collapse" data-toggle="tooltip"
                                title="Collapse">
                                <i class="fas fa-minus"></i></button>
                                <button type="button" class="btn btn-tool btn-sm" data-card-widget="remove" data-toggle="tooltip"
                                title="Remove">
                                <i class="fas fa-times"></i></button>
                            </div>
                            
                        </div>
                        
                        
                        <div class="card-body">
                            <div class="form-group">
                                <label for="title">Title <font style="color: red">*</font></label>
                                <input id="title" name="title" type="text" class="form-control @error('title') is-invalid @enderror" placeholder="Title" value="{{ old('title') ?? $post->title }}">
                                @error('title')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group ">
                                <label for="setarticle_id">Post series </label>
                                <div class="input-group">
                                    <select class="form-select select2bs4 @error('setarticle_id') is-invalid @enderror" name="setarticle_id" id="setarticle_id">
                                        <option value="" holder>Select Post series<option>
                                            @foreach ($global_setarticle as $item)
                                                <option value="{{ $item->id }}"
                                                    @if($item->id == $post->setarticle_id)
                                                    selected
                                                    @endif
                                                    >{{  $item->title }}
                                                </option>
                                            @endforeach
                                    </select>
                                    @error('setarticle_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                    <button class="btn btn-outline-secondary" type="button">Add New</button>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="headline">
                                    Headline : 
                                    </label><br/>
                                    <div class="mr-2 form-check d-inline">
                                        <input {{$post->headline == 1 ? "checked" : ""}} value= 1 
                                        class="form-check-input" type="radio" id="headline" name="headline">
                                        <label for="headline" class="form-check-label">Active</label>
                                    </div>
                                    <div class="form-check d-inline">
                                        <input {{$post->headline == 0 ? "checked" : ""}} value= 0 
                                        class="form-check-input" type="radio" id="headline" name="headline">
                                        <label for="headline" class="form-check-label">Inactive</label>
                                    </div>
                             </div>
                            <div class="form-group">
                                <label for="selection">
                                    Primary / Selection : 
                                    </label><br/>
                                    <div class="mr-2 form-check d-inline">
                                        <input {{$post->selection == 1 ? "checked" : ""}} value= 1 
                                        class="form-check-input" type="radio" id="selection" name="selection">
                                        <label for="selection" class="form-check-label">Primary</label>
                                    </div>
                                    <div class="form-check d-inline">
                                        <input {{$post->selection == 0 ? "checked" : ""}} value= 0 
                                        class="form-check-input" type="radio" id="selection" name="selection">
                                        <label for="selection" class="form-check-label">Selection</label>
                                    </div>
                             </div>
                           
                           
                            <div class="form-group">
                                <label for="content">Content <font style="color: red">*</font></label>
                                <textarea name="content" id="content" class="form-control my-editor @error('content') is-invalid @enderror" placeholder="Content" rows="20">{{ old('content') ?? $post->content }}</textarea>
                                @error('content')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="video">Video</label>
                                <input id="video" name="video" type="text" class="form-control @error('video') is-invalid @enderror" placeholder="Video" value="{{ old('video') ?? $post->video }}">
                                <span class="font-italic"> Example: https://www.youtube.com/embed/DfMz1NMIVe4</span>
                                @error('video')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="caption_video">Caption Video</label>
                                <textarea name="caption_video" id="caption_video" class="form-control  @error('caption_video') is-invalid @enderror" placeholder="Caption Video" >{{ old('caption_video') ?? $post->caption_video }}</textarea>
                                @error('caption_video')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            @if ($post->video)
                                <div class="border-0 rounded-lg shadow-sm card h-100 single-service ">
                                    <div class="text-center card-body">
                                        <iframe width="560" height="315" src="{{ $post->video }}" 
                                        frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" 
                                        allowfullscreen></iframe>
                                        <h6 class="fw-lighter fst-italic">{{ $post->caption_video }}</h6>
                                    </div>
                                </div>
                            @endif
                        </div>
                        
                    </div>
                </div>

                <div class="col-lg-4 col-md-4 col-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Save</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool btn-sm" data-card-widget="collapse" data-toggle="tooltip"
                                title="Collapse">
                                <i class="fas fa-minus"></i></button>
                                <button type="button" class="btn btn-tool btn-sm" data-card-widget="remove" data-toggle="tooltip"
                                title="Remove">
                                <i class="fas fa-times"></i></button>
                            </div>
                        </div>
                        <div class="text-center card-body">
                            <div class="form-group">
                                <input type="text" name="status" id="status" hidden> 
                                <label for="status">
                                    Status : 
                                    @if ($post->status == 1)
                                    <font style="color: rgb(18, 168, 13)">Publish</font>
                                    @else
                                    <font style="color: rgb(58, 40, 224)"> Draft</font>
                                    @endif
                                </label>
                            </div>
                            <button id="draft-btn" type="submit" class="btn btn-primary">Draft</button>
                            <button id="publish-btn" type="submit" class="btn btn-success ">Publish</button>
                        </div>
                    </div>
                     
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Category <font style="color: red">*</font></h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool btn-sm" data-card-widget="collapse" data-toggle="tooltip"
                                title="Collapse">
                                <i class="fas fa-minus"></i></button>
                                <button type="button" class="btn btn-tool btn-sm" data-card-widget="remove" data-toggle="tooltip"
                                title="Remove">
                                <i class="fas fa-times"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group ">
                                <select class="form-control select2bs4 @error('categorypost_id') is-invalid @enderror" name="categorypost_id" id="categorypost_id">
                                    <option value="" holder>Select Category <option>
                                        @foreach ($categoryposts as $item)
                                        <option value="{{ $item->id }}"
                                            @if($item->id == $post->categorypost_id)
                                            selected
                                            @endif
                                            >{{  $item->title }}</option>
                                        @endforeach
                                    </select>
                                    @error('categorypost_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                            </div>
                            <div class="form-group ">
                                <select class="form-control select2bs4 @error('subcategorypost_id') is-invalid @enderror" name="subcategorypost_id" id="subcategorypost_id">
                                    <option disabled="" selected="">Sub Category <option>
                                        @foreach($subcategory as $row)
                                            <option value="{{ $row->id }}"
                                            @if($row->id == $post->subcategorypost_id)
                                            selected
                                            @endif
                                            >{{ $row->title  }} </option>
                                        @endforeach
                                    </select>
                                    @error('subcategorypost_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                            </div>
                        </div>
                    </div>   
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Tags</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool btn-sm" data-card-widget="collapse" data-toggle="tooltip"
                                title="Collapse">
                                <i class="fas fa-minus"></i></button>
                                <button type="button" class="btn btn-tool btn-sm" data-card-widget="remove" data-toggle="tooltip"
                                title="Remove">
                                <i class="fas fa-times"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group ">
                                <select class="form-control select2"name="tags[]"  multiple="multiple" data-placeholder="Select a Tags" style="width: 100%;">
                                    @foreach ($tags as $tag)
                                    <option value="{{$tag->id}}" {{ in_array($tag->id, $post->tags()->pluck('id')->toArray()) ? 'selected' : '' }}> {{ $tag->title }}</option>
                                    @endforeach
                                </select>
                                </div>
                        </div>
                    </div>   

                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Feature Image</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool btn-sm" data-card-widget="collapse" data-toggle="tooltip"
                                title="Collapse">
                                <i class="fas fa-minus"></i></button>
                                <button type="button" class="btn btn-tool btn-sm" data-card-widget="remove" data-toggle="tooltip"
                                title="Remove">
                                <i class="fas fa-times"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="text-center form-group">
                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                <div class="fileinput-new img-thumbnail" style="max-width: 190px;">
                                    {{-- <img src="{{ asset('/assets/admin/dist/img/no_image.png') }}"  alt="..."> --}}
                                    <img src="{{ ($post->imageThumbUrl) ? $post->imageThumbUrl : '/assets/admin/dist/img/no_image.png' }}"  alt="...">
                                </div>
                                <div class="fileinput-preview fileinput-exists img-thumbnail" style="max-width: 200px;"></div>
                                <div>
                                    <span class="btn btn-outline-secondary btn-file"><span class="fileinput-new">Select image</span><span class="fileinput-exists">Change</span>
                                    <input type="file" class="@error('image') is-invalid @enderror" name="image" value="{{ old('image') }}"></span>
                                    <a href="#" class="btn btn-outline-secondary fileinput-exists" data-dismiss="fileinput">Remove</a>
                                </div>
                            </div>
                            @error('image')
                            <div class="invalid-feedback" style="display: block">
                                {{ $message }}
                            </div>
                            @enderror
                            </div>
                            <div class="form-group">
                                <label for="caption_image">Caption Image</label>
                                <textarea name="caption_image" id="caption_image" class="form-control @error('caption_image') is-invalid @enderror" placeholder="Caption Image" >{{ old('caption_image') ?? $post->caption_image }}</textarea>
                                @error('caption_image')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                   
                </div>
            </div>
        </form>
                
        </div>
    </section>
    @endsection
    
    @push('styles')
    <!-- Jasny Bootstrap 4 -->
    <link rel="stylesheet" href="{{ asset('assets/admin/plugins/jasny-bootstrap/4.0.0/css/jasny-bootstrap.min.css') }}"> 
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('assets/admin/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tinymce/4.9.0/skins/lightgray/content.inline.min.css" integrity="sha512-k8zpu91d1x2N1b4BAu7SfWoAYWPvi0m0lDCGCmhezsCpZjnJ5iqT90Z7dQo+xF8X8nAcT4HXOqjH8TwobVgmEA==" crossorigin="anonymous" />
    @endpush
    @push('scripts')
    <!-- Jasny Bootstrap 4 -->
    <script src="{{ asset('assets/admin/plugins/jasny-bootstrap/4.0.0/js/jasny-bootstrap.min.js') }}"></script>
    <!-- Select2 -->
    <script src="{{ asset('assets/admin/plugins/select2/js/select2.full.min.js') }}"></script>
    
    <!-- TinyMCE -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/4.9.0/tinymce.min.js" integrity="sha512-e6EdqJ92oqMqtStGx+mkt4+HrtuyC1Y3FFoq8fHgh6kwWoI1Jz62esALsobk27iRI9tv3U0KkUnCAfJgi6HpZw==" crossorigin="anonymous"></script>
    
     {{-- This is for Category  --}}
     <script type="text/javascript">
        $(document).ready(function() {
              $('select[name="categorypost_id"]').on('change', function(){
                  var categorypost_id = $(this).val();
                  if(categorypost_id) {
                      $.ajax({
                          url: "{{  url('/backend/get/subcategorypost/') }}/"+categorypost_id,
                          type:"GET",
                          dataType:"json",
                          success:function(data) {
                             $("#subcategorypost_id").empty();
                               $.each(data,function(key,value){
                                   $("#subcategorypost_id").append('<option value="'+value.id+'">'+value.title+'</option>');
                                   });
                                 // console.log(data)
                          },
                         
                      });
                  } else {
                      alert('danger');
                  }
              });
          });
     </script>
    
    <script>
        $(function () {
            //Initialize Select2 Elements
            $('.select2').select2()
            
            //Initialize Select2 Elements
            $('.select2bs4').select2({
                theme: 'bootstrap4'
            });
            
            //Save Draft        
            $('#draft-btn').click(function(e) {
                e.preventDefault();
                $('#status').val(0);
                $('#post-form').submit();
            });
            //Save Publish        
            $('#publish-btn').click(function(e) {
                e.preventDefault();
                $('#status').val(1);
                $('#post-form').submit();
            });
            
            // Editor Tiny MCE
            var editor_config = {
                path_absolute : "/",
                selector: "textarea.my-editor",
                plugins: [
                        "advlist autolink autosave link image lists charmap print preview hr anchor pagebreak spellchecker",
                        "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
                        "table contextmenu directionality emoticons template textcolor paste fullpage textcolor"
                ],
                toolbar1: "newdocument fullpage | bold italic underline strikethrough | alignleft aligncenter alignright alignjustify | styleselect formatselect fontselect fontsizeselect ",
                toolbar2: "cut copy paste | searchreplace | bullist numlist | outdent indent blockquote | undo redo | link unlink anchor image media code | inserttime preview | forecolor backcolor",
                toolbar3: "table | hr removeformat | subscript superscript | charmap emoticons | print fullscreen | ltr rtl | spellchecker | visualchars visualblocks nonbreaking template pagebreak restoredraft",
                relative_urls: false,
                file_browser_callback : function(field_name, url, type, win) {
                    var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
                    var y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;
                    
                    var cmsURL = editor_config.path_absolute + 'laravel-filemanager?field_name=' + field_name;
                    if (type == 'image') {
                        cmsURL = cmsURL + "&type=Images";
                    } else {
                        cmsURL = cmsURL + "&type=Files";
                    }
                    
                    tinyMCE.activeEditor.windowManager.open({
                        file : cmsURL,
                        title : 'Filemanager',
                        width : x * 0.8,
                        height : y * 0.8,
                        resizable : "yes",
                        close_previous : "no"
                    });
                }
            };
            
            tinymce.init(editor_config);
            
        });
    </script>
    @endpush