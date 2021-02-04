<div>
    <form enctype="multipart/form-data" wire:submit.prevent="update">
         <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input 
                    wire:model="name"
                    type="text"
                    name="" 
                    required
                    value="{{ old('name') }}" 
                    class="form-control @error('name') is-invalid @enderror" placeholder="Enter a user name">
                    @error('name')
                    <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input 
                    wire:model="email"
                    type="email"
                    name="" 
                    required
                    value="{{ old('email') }}" 
                    class="form-control @error('email') is-invalid @enderror" placeholder="Enter a user email">
                    @error('email')
                    <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label class="font-weight-bold">ROLE : </label>
                    
                    @foreach ($roles as $role)
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" wire:model="role[]"  name="" value="{{ $role->name }}" id="check-{{ $role->id }}" >
                        <label class="form-check-label" for="check-{{ $role->id }}">
                            {{ $role->name }}
                        </label>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label for="password">Password</label>
                    <input 
                    wire:model="password"
                    type="password"
                    name="" 
                    required
                    value="{{ old('password') }}" 
                    class="form-control @error('password') is-invalid @enderror" placeholder="Enter a user password">
                    @error('password')
                    <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label for="password_confirmation">Password Confirmation</label>
                    <input 
                    wire:model="password_confirmation"
                    type="password"
                    name="" 
                    required
                    value="{{ old('password_confirmation') }}" 
                    class="form-control @error('password_confirmation') is-invalid @enderror" placeholder="Enter a user password confirmation">
                    @error('password_confirmation')
                    <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            
            <div class="col-md-12"> 
                <button wire:click="update" class="btn btn-primary">Update</button>
            </div>
        </div>
    </form>
</div>
