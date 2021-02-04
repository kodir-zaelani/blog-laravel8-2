<div>
            <div class="row">
                <div class="col-md-3">
                    
                    <!-- Profile Image -->
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                @if (auth()->user()->photo)
                                    <img class="profile-user-img img-fluid img-circle"
                                    src="{{ url('') }}/uploads/photos/users/photos_thumb/{{ auth()->user()->photo }}"
                                    alt="{{ auth()->user()->name }}">
                                @else
                                    <img src="{{ url('') }}/assets/admin/dist/img/avatar.png" class="profile-user-img img-fluid img-circle" alt="{{ auth()->user()->name }}">
                                @endif
                               
                            </div>
                            
                            <h3 class="text-center profile-username">{{ auth()->user()->name }}</h3>
                            
                            <ul class="mb-3 list-group list-group-unbordered">
                                <li class="list-group-item">
                                    <b>Followers</b> <a class="float-right">1,322</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Following</b> <a class="float-right">543</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Friends</b> <a class="float-right">13,287</a>
                                </li>
                            </ul>
                            
                            {{-- <a href="#" class="btn btn-primary btn-block"><b>Change Image</b></a> --}}
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                    
                    <!-- About Me Box -->
                    <!-- /.card -->
                </div>
                <!-- /.col -->
                <div class="col-md-9">
                    <div class="card">
                        
                        <div class="p-2 card-header">
                            Settings
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <form wire:submit.prevent="update"  class="form-horizontal" >
                                <div class="form-group row">
                                    <label for="inputName" class="col-sm-3 col-form-label">Name</label>
                                    <div class="col-sm-9">
                                        <input wire:model="name" type="text"  class="form-control @error('name') is-invalid @enderror" placeholder="Enter a full name">
                                        @error('name')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputName" class="col-sm-3 col-form-label">Bio</label>
                                    <div class="col-sm-9">
                                        <textarea wire:model="bio" id="" cols="30" rows="5" class="form-control @error('bio') is-invalid @enderror" placeholder="Enter a full bio"></textarea>
                                       
                                        @error('bio')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="photo" class="col-sm-3 col-form-label">Photo</label>
                                    <div class="col-sm-9">
                                        <input wire:model="photo" type="file"  class=" @error('photo') is-invalid @enderror" >
                                        @error('photo')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
        
                                <div class="form-group row">
                                    <label  class="col-sm-3 col-form-label">New Password</label>
                                    <div class="col-sm-9">
                                        <input wire:model="password" type="password" class="form-control @error('password') is-invalid @enderror" />
                                        @error('password') <span  <span class="invalid-feedback">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                
                                <div class="form-group row">
                                    @if (!empty($password))
                                    <label  class="col-sm-3 col-form-label">Password Confirmation</label>
                                    <div class="col-sm-9">
                                        <input wire:model="password_confirmation" type="password" class="form-control" />
                                        @error('password_confirmation') <span  <span class="invalid-feedback">{{ $message }}</span> @enderror
                                    </div>
        
                                    <label  class="col-sm-3 col-form-label">Current Password</label>
                                    <div class="col-sm-9">
                                        <input wire:model="current_password_for_password" type="password" class="form-control  @error('current_password_for_password') is-invalid @enderror" />
                                        @error('current_password_for_password') <span  <span class="invalid-feedback">{{ $message }}</span> @enderror
                                    </div>
                                    @endif
                                </div>
                                
                                <div class="form-group row">
                                    <div class="offset-sm-2 col-sm-9">
                                        <button wire:click="update" class="btn btn-danger mr-3">Update</button>
                                        <a href="{{ route('admin.dashboard') }}" class="btn btn-info"><i class="fa fa-dashboard" aria-hidden="true"></i>Dashboard</a>
                                    </div>
                                </div>
                            </form>
                        </div><!-- /.card-body -->
                    </div>
                    <!-- /.nav-tabs-custom -->
                </div>
                <!-- /.col -->
            </div>

    
    
    @push('styles')
        <!-- Jasny Bootstrap 4 -->
        <link rel="stylesheet" href="{{ asset('assets/admin/plugins/jasny-bootstrap/4.0.0/css/jasny-bootstrap.min.css') }}"> 
    @endpush

    @push('scripts')
         <!-- Jasny Bootstrap 4 -->
        <script src="{{ asset('assets/admin/plugins/jasny-bootstrap/4.0.0/js/jasny-bootstrap.min.js') }}"></script>
    @endpush
</div>
