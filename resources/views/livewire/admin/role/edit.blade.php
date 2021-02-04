<div>
    <form enctype="multipart/form-data" wire:submit.prevent="update">
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
                
                @foreach ($permissions as $item)
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" 
                    wire:model="permissions[]"
                    {{-- name="permissions[]"  --}}
                    value="{{ $item->name }}" 
                    id="check-{{ $item->id }}"
                    {{-- @if($model->permissions->contains($permission)) checked @endif --}}
                    >
                    <label class="form-check-label" for="check-{{ $item->id }}">
                        {{ $item->name }}
                    </label>
                </div>
                @endforeach
            </div>
            <div class="col-md-12"> 
                <button wire:click="update" class="btn btn-primary">Update</button>
            </div>
        </div>
    </form>
</div>
