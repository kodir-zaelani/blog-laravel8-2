<div>
    {{-- ModelId: {{ $modelId }} --}}
    <form  wire:submit.prevent="update">
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
            <div class="col-md-12"> 
                <button wire:click="update" class="btn btn-primary">Update</button>
            </div>
        </div>
    </form>
</div>
