<div>
    <form enctype="multipart/form-data" wire:submit.prevent="update">
         <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="title">Title</label>
                    <input 
                    wire:model="title"
                    type="text"
                    required
                    value="{{ old('title') }}" 
                    class="form-control @error('title') is-invalid @enderror" placeholder="Enter a category page title">
                    @error('title')
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
