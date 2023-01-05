<div wire:ignore.self class="modal fade" id="modal-kepegawaian">
                  <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h4 class="modal-title">Edit Data {{$nama}}</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <div class="col-12">
                          <div class="card card-primary card-outline card-tabs">
                            <div class="card-header p-0 pt-1 border-bottom-0">
                              <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
                                <li class="nav-item">
                                  <a class="nav-link active" id="custom-tabs-three-home-tab" data-toggle="pill" href="#custom-tabs-three-home" role="tab" aria-controls="custom-tabs-three-home" aria-selected="true">Ubah Penempatan</a>
                                </li>
                                <li class="nav-item">
                                  <a class="nav-link" id="custom-tabs-three-profile-tab" data-toggle="pill" href="#custom-tabs-three-profile" role="tab" aria-controls="custom-tabs-three-profile" aria-selected="false">Ubah Password</a>
                                </li>
                                
                              </ul>
                            </div>
                            <div class="card-body">
                              <div class="tab-content" id="custom-tabs-three-tabContent">
                                <div class="tab-pane fade show active" id="custom-tabs-three-home" role="tabpanel" aria-labelledby="custom-tabs-three-home-tab">

                                    <div class="card bg-gradient-secondary">
                                        
                                    </div>

                                    <div class="accordion" id="accordion">
                                        <div class="card">
                                            <div class="card-header" id="heading-accordion-data-pegawai">
                                                <h3 class="mb-0">
                                                    <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" 
                                                        data-target="#accordion-data-pegawai" aria-expanded="true" aria-controls="accordion-data-pegawai">
                                                        Data Pegawai
                                                    </button>
                                                </h3>
                                            </div>
                                            <div id="accordion-data-pegawai" class="collapse" aria-labelledby="heading-accordion-data-pegawai" data-parent="#accordion">
                                                    <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Nama</label>
                                                                <input class="form-control" type="text" wire:model='nama'>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>NIK</label>
                                                                <input class="form-control" type="text" wire:model='nik'>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>NRK</label>
                                                                <input class="form-control" type="text" wire:model='nrk'>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>No Telp</label>
                                                                <input class="form-control" type="text" wire:model='telp'>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Email</label>
                                                                <input class="form-control" type="text" wire:model='email'>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                  <div class="card card-default collapse fade show active">
                                    <div class="card-header">
                                      <h3 class="card-title">Data Penempatan</h3>
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body">
                                      <div class="row">
                                        <div class="col-md-6">
                                            
                                          <div class="form-group">
                                            <label>Pos</label>
                                            <select wire:model='penempatan' class="form-control select2bs4" style="width: 100%;">
                                              <option disabled value="">Pilih Penempatan</option>
                                                    {{-- generate list pos penempatan start --}}
                                                    @forelse ($list_penempatan as $p)

                                                        {{-- Khusus Pegawai yang tidak terikat dengan penempatan pos --}}
                                                        {{-- Jika value = nama sektor --}}
                                                        @if ($p['value'] == auth()->user()->data->sektor)

                                                            {{-- Cek apakah pegawai merupakan petugas lapangan (grup != non grup) --}}
                                                            @if (!in_array($grup,["A","B","C"]))
                                                                {{-- Jika ya, maka tampilkan opsi untuk nama sektor --}}
                                                                {{-- Jika tidak, maka lewati --}}
                                                                <option value="{{$p['value']}}">{{$p['text']}}</option>
                                                            @endif
                                                        
                                                        {{-- Jika value != nama sektor --}}
                                                        @else
                                                            <option value="{{$p['value']}}">{{$p['text']}}</option>
                                                        @endif
                                                    @empty
                                    
                                                    @endforelse

                                                    {{-- generate list pos penempatan end --}}
                                            </select>
                                          </div>
                                          <div class="form-group">
                                            <label>Grup Jaga</label>
                                            <select wire:model='grup' wire:change='selectGrupDirubah' class="form-control select2bs4" style="width: 100%;">
                                              <option disabled value="">Pilih Grup</option>
                                              @forelse ($list_grup as $g)
                                                  <option value="{{$g['value']}}">{{$g['text']}}</option>
                                              @empty
                                                  
                                              @endforelse
                                            </select>
                                          </div>
                                          <button type="button" class="btn btn-primary">Save changes</button>
                                        </div>
                                      </div>
                                      <!-- /.row -->
                                    </div>
                                    <!-- /.card-body -->
                                  </div>
                                </div>
                                <div class="tab-pane fade" id="custom-tabs-three-profile" role="tabpanel" aria-labelledby="custom-tabs-three-profile-tab">
                                  <div class="card card-default">
                                    <div class="card-header">
                                      <h3 class="card-title">Agus Suripto</h3>
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body">
                                      <div class="row">
                                        <div class="col-md-6">
                                          <div class="form-group">
                                            <label>Password Baru</label>
                                            <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Masukan Password">
                                          </div>
                                          <button type="button" class="btn btn-primary">Save changes</button>
                                        </div>
                                      </div>
                                      <!-- /.row -->
                                    </div>
                                    <!-- /.card-body -->
                                  </div>
                                </div>
                                
                              </div>
                            </div>
                            <!-- /.card -->
                          </div>
                        </div>
                      </div>
                      <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                      </div>
                    </div>
                    <!-- /.modal-content -->
                  </div>
                  <!-- /.modal-dialog -->
                </div>