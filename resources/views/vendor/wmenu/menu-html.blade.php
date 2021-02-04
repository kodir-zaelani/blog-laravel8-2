<?php
$currentUrl = url()->current();
?>


<div class="row">
	<div class="col">
		<div class="card">
			<div class="card-header">
				<form method="get" action="{{ $currentUrl }}">
					<label for="menu" class="pr-3 selected-menu">Select the menu you want to edit:</label>
					
					{!! Menu::select('menu', $menulist) !!}
					
					<span class="px-3 submit-btn">
						<input type="submit" class="button-secondary" value="Choose">
					</span>
					<span class="add-new-menu-action"> or <a href="{{ $currentUrl }}?action=edit&menu=0">Create new menu</a>. </span>
				</form>
			</div>
		</div>
	</div>
</div>


<div class="row">
		
		<div class="col-md-5 col-lg-5 col-12">
			@if(request()->has('menu')  && !empty(request()->input("menu")))
			<div class="card card-secondary">
				<div class="card-header">
					<h3 class="card-title"> Link</h3>
					<div class="card-tools">
						<button type="button" class="btn btn-tool btn-sm" data-card-widget="collapse" data-toggle="tooltip"
						title="Collapse">
						<i class="fas fa-minus"></i></button>
					</div>
				</div>
				<div class="card-body">
					<form id="nav-menu-meta" action="" class="nav-menu-meta" method="post" enctype="multipart/form-data">
						<div class="form-group">
							<label for="custom-menu-item-url">URL <font style="color: red">*</font></label>
							<input id="custom-menu-item-url" name="url" type="text" class="form-control @error('url') is-invalid @enderror" placeholder="URL" value="{{ old('url') }}">
						</div>
						<div class="form-group">
							<label for="custom-menu-item-name">Label <font style="color: red">*</font></label>
							<input id="custom-menu-item-name" name="label" type="text" class="form-control @error('label') is-invalid @enderror" placeholder="Label" value="{{ old('label') }}">
						</div>
						@if(!empty($roles))
						<div class="form-group">
							<label class="howto" for="custom-menu-item-name"> <span>Role</span>&nbsp;
								<select id="custom-menu-item-role" name="role">
									<option value="0">Select Role</option>
									@foreach($roles as $role)
									<option value="{{ $role->$role_pk }}">{{ ucfirst($role->$role_title_field) }}</option>
									@endforeach
								</select>
							</label>
						</div>
						@endif
						<a  href="#" onclick="addcustommenu()"  class="btn btn-success btn-block">
							Add menu item
						</a>
						<span class="spinner" id="spincustomu"></span>
						
					</form>
				</div>
			</div>
			
			<div class="card card-primary card-tabs">
				<div class="p-0 pt-1 card-header">
				  <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
					<li class="px-3 pt-2 text-right"><button type="button" class="btn btn-tool btn-sm" data-card-widget="collapse" data-toggle="tooltip"
						title="Collapse">
						<i class="fas fa-minus"></i></button>
					</li>
					<li class="nav-item">
					  <a class="nav-link active" id="custom-tabs-one-home-tab" data-toggle="pill" href="#custom-tabs-one-home" role="tab" aria-controls="custom-tabs-one-home" aria-selected="true">Category</a>
					</li>
					<li class="nav-item">
					  <a class="nav-link" id="custom-tabs-one-profile-tab" data-toggle="pill" href="#custom-tabs-one-profile" role="tab" aria-controls="custom-tabs-one-profile" aria-selected="false">Page</a>
					</li>
					<li class="nav-item">
					  <a class="nav-link" id="custom-tabs-one-messages-tab" data-toggle="pill" href="#custom-tabs-one-messages" role="tab" aria-controls="custom-tabs-one-messages" aria-selected="false">Post</a>
					</li>
					
				  </ul>
				  
				</div>
				<div class="card-body">
				  <div class="tab-content" id="custom-tabs-one-tabContent">
					<div class="tab-pane fade show active" id="custom-tabs-one-home" role="tabpanel" aria-labelledby="custom-tabs-one-home-tab">
						<p> 
							<button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-sm-category">
								Right Click end copy link address <i class="fas fa-exclamation-triangle"></i>
							  </button> 
						</p>
						@foreach ($global_categories as $category)
							@if ($category->post->count()>0)
							<p>
								<span class="px-2 py-2 mr-3 badge badge-danger right">{{  $category->post->count()  }}</span>
								<a href="{{ url('') }}/post/category/{{ $category->slug }}" target="_blank">
									{{ $category->title }}
								</a> <br>
								<span>post{{ $category->link }}</span>
								
							</p>
							@endif
						@endforeach	
						{{-- <hr>
						<p><a href="{{ url('') }}/post/set-article" target="_blank"><font style="color: rgb(14, 138, 14)"><strong>All Category</strong></font></a></p> --}}
					</div>
					<div class="tab-pane fade" id="custom-tabs-one-profile" role="tabpanel" aria-labelledby="custom-tabs-one-profile-tab">
						<p> 
							<button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-sm-page">
								Right Click end copy link address <i class="fas fa-exclamation-triangle"></i>
							  </button> 
						</p>
						@foreach ($global_pages as $page)
						<p>
							<a href="{{ url('') }}/page/{{ $page->slug }}" target="_blank">{{ $page->title }}</a><br>
							<span>{{ $page->link }}</span>
						</p>
						@endforeach	
						
					</div>
					<div class="tab-pane fade" id="custom-tabs-one-messages" role="tabpanel" aria-labelledby="custom-tabs-one-messages-tab">
						<p> 
							<button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-sm-setarticle">
								Right Click end copy link address <i class="fas fa-exclamation-triangle"></i>
							  </button> 
						</p>
						{{-- @foreach ($global_setarticle as $setarticle)
							@if ($setarticle->post->count()>0)
							<p>
								<span class="px-2 py-2 mr-3 badge badge-danger right">{{  $setarticle->post->count()  }}</span>
								<a href="{{ url('') }}/post/setarticle/{{ $setarticle->slug }}" target="_blank">{{ $setarticle->title }}</a>
							</p>
							@endif
						@endforeach	 --}}
						<hr>
						<p><a href="{{ url('') }}/post/postall" target="_blank"><font style="color: rgb(14, 138, 14)"><strong>All Post</strong></font></a></p>
					</div>
				  </div>
				</div>
				<!-- /.card -->
			  </div>
			
			@endif
		</div>
		
		<div class="col-md-7 col-lg-7 col-12">
			<div class="card card-secondary">
				<div class="card-header">
					<h3 class="card-title">Menu Structure</h3>
					<div class="card-tools">
						<button type="button" class="btn btn-tool btn-sm" data-card-widget="collapse" data-toggle="tooltip"
						title="Collapse">
						<i class="fas fa-minus"></i></button>
					</div>
				</div>

				<form id="update-nav-menu" action="" method="post" enctype="multipart/form-data">
					
					<div class="card-body">
						<div class="form-group row">
							<label for="menu-name" class="col-sm-2 col-form-label">Name: </label>
							<div class="col-sm-5">
								<input type="texte" class="form-control" name="menu-name" id="menu-name" placeholder="Enter menu name"
								title="Enter menu name" value="@if(isset($indmenu)){{$indmenu->name}}@endif">
								<input type="hidden" id="idmenu" value="@if(isset($indmenu)){{$indmenu->id}}@endif" />
							</div>
							<div class="col-sm-3">
								@if(request()->has('action'))
								<a onclick="createnewmenu()" name="save_menu" id="save_menu_header" class="btn btn-primary" style="color: white">Create menu</a>
								@elseif(request()->has("menu"))
								<a onclick="getmenus()" name="save_menu" id="save_menu_header" class="btn btn-primary" style="color: white">Save menu</a>
								<span class="spinner" id="spincustomu2"></span>
								@else
								<a onclick="createnewmenu()" name="save_menu" id="save_menu_header" class="btn btn-primary" style="color: white">Create menu</a>
								@endif
							</div>
						</div>
						@if(request()->has("menu"))
						<p class="card-text">
							Place each item in the order you prefer. Click on the arrow to the right of the item to display more configuration options.
						</p>
						@else 
						<h3>Menu Creation</h3>
						<p class="card-text">
							Please enter the name and select "Create menu" button
						</p>
						@endif
						{{-- start structur --}}
						<div id="hwpwrap">
							<div class="custom-wp-admin wp-admin wp-core-ui js menu-max-depth-0 nav-menus-php auto-fold admin-bar">
								<div id="wpwrap">
									<div id="wpcontent">
										<div id="wpbody">
											<div id="wpbody-content">
												
												<ul class="menu ui-sortable" id="menu-to-edit">
													@if(isset($menus))
													@foreach($menus as $m)
													<li id="menu-item-{{$m->id}}" class="menu-item menu-item-depth-{{$m->depth}} menu-item-page menu-item-edit-inactive pending" style="display: list-item;">
														<dl class="menu-item-bar">
															<dt class="menu-item-handle">
																<span class="item-title"> <span class="menu-item-title"> <span id="menutitletemp_{{$m->id}}">{{$m->label}}</span> <span style="color: transparent;">|{{$m->id}}|</span> </span> <span class="is-submenu" style="@if($m->depth==0)display: none;@endif">Subelement</span> </span>
																<span class="item-controls"> <span class="item-type">Link</span> <span class="item-order hide-if-js"> <a href="{{ $currentUrl }}?action=move-up-menu-item&menu-item={{$m->id}}&_wpnonce=8b3eb7ac44" class="item-move-up"><abbr title="Move Up">↑</abbr></a> | <a href="{{ $currentUrl }}?action=move-down-menu-item&menu-item={{$m->id}}&_wpnonce=8b3eb7ac44" class="item-move-down"><abbr title="Move Down">↓</abbr></a> </span> <a class="item-edit" id="edit-{{$m->id}}" title=" " href="{{ $currentUrl }}?edit-menu-item={{$m->id}}#menu-item-settings-{{$m->id}}"> </a> </span>
															</dt>
														</dl>
														
														<div class="menu-item-settings" id="menu-item-settings-{{$m->id}}">
															<input type="hidden" class="edit-menu-item-id" name="menuid_{{$m->id}}" value="{{$m->id}}" />
															<p class="description description-thin">
																<label for="edit-menu-item-title-{{$m->id}}"> Label
																	<br>
																	<input type="text" id="idlabelmenu_{{$m->id}}" class="widefat edit-menu-item-title" name="idlabelmenu_{{$m->id}}" value="{{$m->label}}">
																</label>
															</p>
															
															<p class="field-css-classes description description-thin">
																<label for="edit-menu-item-classes-{{$m->id}}"> Class CSS (optional)
																	<br>
																	<input type="text" id="clases_menu_{{$m->id}}" class="widefat code edit-menu-item-classes" name="clases_menu_{{$m->id}}" value="{{$m->class}}">
																</label>
															</p>
															
															<p class="field-css-url description description-wide">
																<label for="edit-menu-item-url-{{$m->id}}"> Url
																	<br>
																	<input type="text" id="url_menu_{{$m->id}}" class="widefat code edit-menu-item-url" id="url_menu_{{$m->id}}" value="{{$m->link}}">
																</label>
															</p>
															
															@if(!empty($roles))
															<p class="field-css-role description description-wide">
																<label for="edit-menu-item-role-{{$m->id}}"> Role
																	<br>
																	<select id="role_menu_{{$m->id}}" class="widefat code edit-menu-item-role" name="role_menu_[{{$m->id}}]" >
																		<option value="0">Select Role</option>
																		@foreach($roles as $role)
																		<option @if($role->id == $m->role_id) selected @endif value="{{ $role->$role_pk }}">{{ ucwords($role->$role_title_field) }}</option>
																		@endforeach
																	</select>
																</label>
															</p>
															@endif
															
															<p class="field-move hide-if-no-js description description-wide">
																<label> <span>Move</span> <a href="{{ $currentUrl }}" class="menus-move-up" style="display: none;">Move up</a> <a href="{{ $currentUrl }}" class="menus-move-down" title="Mover uno abajo" style="display: inline;">Move Down</a> <a href="{{ $currentUrl }}" class="menus-move-left" style="display: none;"></a> <a href="{{ $currentUrl }}" class="menus-move-right" style="display: none;"></a> <a href="{{ $currentUrl }}" class="menus-move-top" style="display: none;">Top</a> </label>
															</p>
															
															<div class="menu-item-actions description-wide submitbox">
																
																<a class="item-delete submitdelete deletion" id="delete-{{$m->id}}" href="{{ $currentUrl }}?action=delete-menu-item&menu-item={{$m->id}}&_wpnonce=2844002501">Delete</a>
																<span class="meta-sep hide-if-no-js"> | </span>
																<a class="item-cancel submitcancel hide-if-no-js button-secondary" id="cancel-{{$m->id}}" href="{{ $currentUrl }}?edit-menu-item={{$m->id}}&cancel=1424297719#menu-item-settings-{{$m->id}}">Cancel</a>
																<span class="meta-sep hide-if-no-js"> | </span>
																<a onclick="getmenus()" class="button button-primary updatemenu" id="update-{{$m->id}}" href="javascript:void(0)">Update item</a>
																
															</div>
															
														</div>
														<ul class="menu-item-transport"></ul>
													</li>
													@endforeach
													@endif
												</ul>

											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						{{-- end structur --}}
						
					</div>
					
					<div class="text-right card-footer">
						<div class="major-publishing-actions">
							@if(request()->has('action'))
							<a onclick="createnewmenu()" name="save_menu" id="save_menu_header" class="btn btn-primary menu-save" style="color: white">Create menu</a>
							@elseif(request()->has("menu"))
							<a class="mr-5 submitdelete deletion menu-delete" onclick="deletemenu()" href="javascript:void(9)">Delete menu</a>
							<a onclick="getmenus()" name="save_menu" id="save_menu_header" class="btn btn-primary menu-save" style="color: white">Save menu</a>
							<span class="spinner" id="spincustomu2"></span>
							@else
							<div class="publishing-action">
								<a onclick="createnewmenu()" name="save_menu" id="save_menu_header" class="btn btn-primary menu-save" style="color: white">Create menu</a>
							</div>
							@endif
						</div>
					</div>
				</form>	
			</div>
		</div>
		
</div>

<div class="modal fade" id="modal-sm-category">
	<div class="modal-dialog modal-sm">
	  <div class="modal-content">
		<div class="modal-header">
		  <h4 class="modal-title">Category Link</h4>
		  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		  </button>
		</div>
		<div class="modal-body">
		  <p>Right Click end copy link address</p>
		  <img src="{{ url('') }}/assets/help/img/category-link.png" class="img-thumbnail">
		</div>
		
	  </div>
	  <!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
  </div>
<div class="modal fade" id="modal-sm-page">
	<div class="modal-dialog modal-sm">
	  <div class="modal-content">
		<div class="modal-header">
		  <h4 class="modal-title">Page Link</h4>
		  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		  </button>
		</div>
		<div class="modal-body">
		  <p>Right Click end copy link address</p>
		  <img src="{{ url('') }}/assets/help/img/page-link.png" class="img-thumbnail">
		</div>
		
	  </div>
	  <!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
  </div>
<div class="modal fade" id="modal-sm-setarticle">
	<div class="modal-dialog modal-sm">
	  <div class="modal-content">
		<div class="modal-header">
		  <h4 class="modal-title">Post Set Link</h4>
		  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		  </button>
		</div>
		<div class="modal-body">
		  <p>Right Click end copy link address</p>
		  <img src="{{ url('') }}/assets/help/img/article-set.png" class="img-thumbnail">
		</div>
		
	  </div>
	  <!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
  </div>

