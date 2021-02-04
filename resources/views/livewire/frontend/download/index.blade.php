<div>
    <div class="cta-header pt-5">
        <div class="container-fluid">
            <div class="row justify-content-center pt-5">
                <div class="col-lg-6 col-md-6 col-12">
                    <div class="cta-header-title text-center">
                        <h2 class="py-4 text-uppercase font-weight-bold">DAFTAR UNDUH</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row py-2">
            <div class="col-md-12">
                <div class="card card-primary">
                    
                    <div class="card-body ">
                        
                        <div class="my-3 row">
                            <div class="col">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                      <label class="mr-2" for="inputGroupSelect01">Show</label>
                                    </div>
                                    <select wire:model="paginate" class="custom-select py-1 " id="inputGroupSelect01">
                                      <option selected value="5">5</option>
                                      <option value="10">10</option>
                                      <option value="25">25</option>
                                      <option value="50">50</option>
                                      <option value="100">100</option>
                                    </select>
                                    <div class="input-group-append">
                                        <label class="ml-2" for="inputGroupSelect01">entries</label>
                                      </div>
                                    
                                  </div>
                                  
                        
                            </div>
                            {{-- <div class="col">
                                Sort Column: {{ $sortColumn }} | Sort Direction: {{ $sortDirection }}
                            </div> --}}
                            <div class="col">
                                <div class="float-right">
                                    <div class="input-group" style="">
                                        <input type="text" wire:model="search" 
                                        wire:keydown.escape="resetSearch"
                                        wire:keydown.tab="resetSearch" class="form-control float-right" placeholder="Title Search...">
                                        <div class="input-group-append">
                                          <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
    
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-12">
                                <div class="table-responsive">
                                    <table id="dataTable" class="table table-bordered" style="width=100%">
                                    <thead class="text-center thead-dark"">
                                        <th width="4%" scope="col">#</th>
                                        <th scope="col" >Title</th>
                                        <th scope="col" width="10%">Action</th>
                                    </thead>
                                    <tbody>
                                        {{-- @if (count($downloadfiles))  --}}
                                        @foreach ($downloadfiles as $no => $downloadfile)
                                        <tr>
                                            <th class="text-right" scope="row">{{ $no + $downloadfiles->firstItem() }}</th>
                                            <td>
                                                {{ $downloadfile->title }}<br>
                                                
                                            </td>
                                            <td class="text-center">
                                                @if ($downloadfile->file )
                                                    <a href="{{ url('/uploads/downloadfiles', $downloadfile->file) }}" target="_blank" class="btn btn-sm btn-success"><i class="far fa-eye"></i></a>
                                                @else
                                                    <a href="{{ $downloadfile->linkfile }}" target="_blank" class="btn btn-sm btn-success"><i class="far fa-eye"></i></a>
                                                @endif
                                                {{-- <a href="{{ route('download.detail', $downloadfile) }}" target="_blank" class="btn btn-sm btn-warning"><i class="far fa-eye"></i></a> --}}
                                              
                                            </td>
                                        </tr>
                                        @endforeach
                                       
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        
                        <div class="mt-3 row justify-content-center">
                            <div class="col-md-8 col-lg-8 col-12">
                                {{ $downloadfiles->links() }}
                            </div>
                           <div class="col-md-4 col-lg-4 col-12">
                            <div class="text-center">
                                Page : {{ $downloadfiles->currentPage() }} | Show {{ $downloadfiles->count() }}  of {{ $downloadfiles->total() }}
                            </div>
                           </div>
                        </div>
                       
                    </div>
                </div>
            </div>
        </div> 
    </div>
    
</div>
