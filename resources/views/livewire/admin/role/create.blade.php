<div>
    <form enctype="multipart/form-data" wire:submit.prevent="store">
         <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input 
                    wire:model="name"
                    type="text"
                    required
                    value="{{ old('name') }}" 
                    class="form-control @error('name') is-invalid @enderror" placeholder="Enter a contact name">
                    @error('name')
                    <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="form-group">
                <label class="font-weight-bold">PERMISSIONS:</label> <br/>
                
                @foreach ($permissions as $permission)
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" 
                    wire:model="permission"
                    {{-- name="permissions[]"  --}}
                    value="{{ $permission->name }}" 
                    id="check-{{ $permission->id }}">
                    <label class="form-check-label" for="check-{{ $permission->id }}">
                        {{ $permission->name }}
                    </label>
                </div>
                @endforeach
            </div>
            <div class="col-md-12"> 
                <button wire:click="store" class="btn btn-primary">Save</button>
            </div>
        </div>
    </form>
</div>
