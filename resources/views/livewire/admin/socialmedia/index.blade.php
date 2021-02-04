<div>
    <div class="row">
        <div class="col-12">
          <!-- Custom Tabs -->
          <div class="card">
            <div class="card-header d-flex p-0">
              <h3 class="card-title p-3">Social Media</h3>
              <ul class="nav nav-pills ml-auto p-2">
                <li class="nav-item"><a class="nav-link active" href="#tab_1" data-toggle="tab">Facebook</a></li>
                <li class="nav-item"><a class="nav-link" href="#tab_2" data-toggle="tab">Instagram</a></li>
                <li class="nav-item"><a class="nav-link" href="#tab_3" data-toggle="tab">Twitter</a></li>
                <li class="nav-item"><a class="nav-link" href="#tab_4" data-toggle="tab">Whatsapp & Telegram</a></li>
                
              </ul>
            </div><!-- /.card-header -->
            <div class="card-body">
              <div class="tab-content">
                <div class="tab-pane active" id="tab_1">
                    <form  wire:submit.prevent="update">
                        <div class="form-group">
                            <label for="facebook">Url</label>
                            <input 
                            wire:model.lazy="facebook"
                            type="text"
                            required
                            value="{{ old('facebook') }}" 
                            class="form-control @error('facebook') is-invalid @enderror" placeholder="Enter a contact facebook">
                            @error('facebook')
                            <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="facebook_embed">Facebook Embed </label>
                            <textarea wire:model.lazy="facebook_embed"  class="form-control my-editor" placeholder="Facebook Embed" rows="10"></textarea>
                            @error('facebook_embed')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group"> 
                            <button wire:click="update" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
                <!-- /.tab-pane -->
                <div class="tab-pane" id="tab_2">
                    <form  wire:submit.prevent="update">
                        <div class="form-group">
                            <label for="instagram">Url</label>
                            <input 
                            wire:model.lazy="instagram"
                            type="text"
                            required
                            class="form-control @error('instagram') is-invalid @enderror" placeholder="Enter a contact instagram">
                            @error('instagram')
                            <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="instagram_embed">Instagram Embed </label>
                            <textarea wire:model.lazy="instagram_embed"  class="form-control my-editor" placeholder="Facebook Embed" rows="10"></textarea>
                            @error('instagram_embed')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group"> 
                            <button wire:click="update" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
                <!-- /.tab-pane -->
                <div class="tab-pane" id="tab_3">
                    <form  wire:submit.prevent="update">
                        <div class="form-group">
                            <label for="twitter">Url</label>
                            <input 
                            wire:model.lazy="twitter"
                            type="text"
                            required
                            class="form-control @error('twitter') is-invalid @enderror" placeholder="Enter a contact twitter">
                            @error('twitter')
                            <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="twitter_embed">Twitter Embed </label>
                            <textarea wire:model.lazy="twitter_embed"  class="form-control my-editor" placeholder="Facebook Embed" rows="10"></textarea>
                            @error('twitter_embed')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group"> 
                            <button wire:click="update" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
                <!-- /.tab-pane -->
                <div class="tab-pane" id="tab_4">
                    <form  wire:submit.prevent="update">
                        <div class="form-group">
                            <label for="whatapps">Whatapps</label>
                            <input 
                            wire:model.lazy="whatapps"
                            type="text"
                            
                            class="form-control @error('whatapps') is-invalid @enderror" placeholder="Enter a contact whatapps">
                            @error('whatapps')
                            <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="telegram">Telegram</label>
                            <input 
                            wire:model.lazy="telegram"
                            type="text"
                            
                            class="form-control @error('telegram') is-invalid @enderror" placeholder="Enter a contact telegram">
                            @error('telegram')
                            <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group"> 
                            <button wire:click="update" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
                <!-- /.tab-pane -->
              </div>
              <!-- /.tab-content -->
            </div><!-- /.card-body -->
          </div>
          <!-- ./card -->
        </div>
        <!-- /.col -->
      </div>
        
    
    @push('styles')
    <!-- Sweet Alert -->
    <link rel="stylesheet" href="{{ asset('assets/admin/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css')}}">
    @endpush
    @push('scripts')
    <!-- Sweet Alert -->
    <script src="{{ asset('assets/admin/plugins/sweetalert2/sweetalert2.min.js')}}"></script>
    <script>
        // Sweet Alert
        window.addEventListener('swal',function(e){
            Swal.fire(e.detail);
        });

        //flash message
        @if(session()-> has('success'))

        swal.fire({
            icon: "success",
            title: "BERHASIL!",
            text: "{{ session('success') }}",
            // timer: 1500,
            showConfirmButton: true,
            showCancelButton: false,
        });
        @elseif(session()-> has('error'))
        swal.fire({
            icon: "error",
            title: "GAGAL!",
            text: "{{ session('error') }}",
            // timer: 1500,
            showConfirmButton: true,
            showCancelButton: false,
        });
        @endif
    </script>

    @endpush
</div>
