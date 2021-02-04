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
                <div class="form-group" wire:ignore>
                    <label>i Class</label>
                    <select class="select2 form-control @error('iclass') is-invalid @enderror"
                        wire:model.lazy="iclass">
                        <option value="">-- select class --</option>
                        <option value="badge bg-primary">Primary</option>
                        <option value="badge bg-secondary">Secondary</option>
                        <option value="badge bg-success">Success</option>
                        <option value="badge bg-danger">Danger</option>
                        <option value="badge bg-warning">Warning</option>
                        <option value="badge bg-info">Info</option>
                        <option value="badge bg-light">Light</option>
                        <option value="badge bg-dark">Dark</span>
                        </option>
                    </select>
                    @error('iclass')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>
            <div class="col-md-12"> 
                <button wire:click="store" class="btn btn-primary">Save</button>
            </div>
        </div>
    </form>

    @push('styles')
         <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('assets/admin/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    @endpush
    @push('scripts')
        
    <script>
        $(document).ready(function () {
            //category
            $('.select2').select2({
                theme: 'bootstrap4',
                width: 'style'
            });
            $('.select2').on('change', function (e) {
                @this.set('iclass', e.target.value);
            });
        });
    </script>
    @endpush
</div>
