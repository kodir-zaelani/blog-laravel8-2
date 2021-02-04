<div>
    <form enctype="multipart/form-data" wire:submit.prevent="store">
         <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="title">Title</label>
                    <input 
                    wire:model="title"
                    type="text"
                    required
                    value="{{ old('title') }}" 
                    class="form-control @error('title') is-invalid @enderror" placeholder="Enter a contact title">
                    @error('title')
                    <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="file">
                        File : 
                    </label><br/>
                    <div class="mr-2 form-check d-inline">
                        <input class="form-check-input" type="radio" checked="checked" name="r1" onchange="show(this.value)" />
                        <label for="file" class="form-check-label">Upload</label>
                    </div>
                    <div class="form-check d-inline">
                        <input class="form-check-input" type="radio" name="r1" id="e1" onchange="show2()" />
                        <label for="file" class="form-check-label">Link</label>
                    </div>
                </div>
               
                <div class="form-group" id="sh1">
                    <label for="file">File Upload</label><br>
                    <input id="file" wire:click="file" type="file"   class=" @error('file') is-invalid @enderror" >
                    @error('file')
                    <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                
                <div class="form-group" id="sh2" style="display:none;">
                    <label for="linkfile">Link File</label>
                    <input id="linkfile"
                    
                    wire:click="linkfile"
                    type="text"
                    value="{{ old('linkfile') }}" 
                    class="form-control @error('linkfile') is-invalid @enderror" placeholder="Enter a contact link file">
                    @error('linkfile')
                    <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-md-12"> 
                <button wire:click="store" class="btn btn-primary">Save</button>
            </div>
        </div>
    </form>
</div>
