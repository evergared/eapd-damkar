<div wire:ignore.self class="modal fade" id="modal-kepegawaian">
                  <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h4 class="modal-title">Ubah Data {{$cache_nama}}</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <div class="col-12">
                          
                          {{-- Form status start --}}
                          <div wire:loading wire:target='inisiasiModal,simpanPerubahanData'>
                              <div class="spinner-border spinner-border-md text-info" role="status"></div>
                              <span class="text-info">Memproses...</span>
                          </div>

                          @if (session()->has('form-fail'))
                              <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{session('form-fail')}}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                          @endif
                          
                          @if (session()->has('form-success'))
                              <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{session('form-success')}}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                          @endif
                          {{-- Form status end --}}


                          <div class="card card-primary card-outline card-tabs">
                            <div class="card-header p-0 pt-1 border-bottom-0">
                              <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
                                <li class="nav-item">
                                  <a class="nav-link active" id="custom-tabs-three-home-tab" data-toggle="pill" href="#custom-tabs-three-home" role="tab" aria-controls="custom-tabs-three-home" aria-selected="true" wire:ignore.self>Ubah Data</a>
                                </li>
                                <li class="nav-item">
                                  <a class="nav-link" id="custom-tabs-three-profile-tab" data-toggle="pill" href="#custom-tabs-three-profile" role="tab" aria-controls="custom-tabs-three-profile" aria-selected="false" wire:ignore.self>Ubah Password</a>
                                </li>
                                
                              </ul>
                            </div>
                            <div class="card-body">
                              <div class="tab-content" id="custom-tabs-three-tabContent">

                                {{-- Bagian ubah data start --}}
                                <div class="tab-pane fade show active" id="custom-tabs-three-home" role="tabpanel" aria-labelledby="custom-tabs-three-home-tab" wire:ignore.self>

                                    <div  class="accordion" id="accordion">
                                        <div class="card">
                                            <div class="card-header" id="heading-accordion-data-pegawai">
                                                <h3 class="mb-0">
                                                    <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" 
                                                        data-target="#accordion-data-pegawai" aria-expanded="true" aria-controls="accordion-data-pegawai">
                                                        Data Pegawai
                                                    </button>
                                                </h3>
                                            </div>
                                            <div id="accordion-data-pegawai" class="collapse" aria-labelledby="heading-accordion-data-pegawai" data-parent="#accordion" wire:ignore.self>
                                                    <div class="card-body">
                                                    <div class="row">

                                                        <div  class="card bg-secondary collapse fade show active" id="info-data-pegawai" wire:ignore.self>
                                                          <div class="card-body">
                                                            <div class="card-tools">
                                                                <button type="button" class="close" data-toggle="collapse"
                                                                    data-target="#info-data-pegawai" aria-label="Close">
                                                                    <span aria-hidden="true">×</span>
                                                                </button>
                                                            </div>
                                                            <div>
                                                              Dibawah ini merupakan data dasar yang dimiliki pegawai. <br>
                                                              Gunakan kendali dibawah untuk mengganti jika ada kesalahan data pegawai. <br>
                                                              {{-- Sistem akan memberi notifikasi kepada admin dinas ketika ada perubahan data <br> --}}
                                                              {{-- yang dilakukan melalui kendali ini. <br> --}}
                                                              <strong>Hanya ganti data jika diperlukan.</strong>
                                                            </div>
                                                          </div>
                                                        </div>

                                                        {{-- Form input untuk data pegawai start --}}
                                                        <div class="col-sm-6 col-md-8 col-lg-10">
                                                            <div class="form-group">
                                                                <label>Nama</label>
                                                                <input class="form-control" type="text" wire:model.lazy='nama'>
                                                                @if ($nama != $cache_nama && $cache_nama != "")
                                                                  <small class="text-info">Sebelumnya <strong>{{ ($cache_nama == "") ? 'kosong' : $cache_nama}}</strong></small> <br>
                                                                @endif
                                                                @if (session()->has('warning-nama'))
                                                                    <small class="text-warning"><strong>{{session('warning-nama')}}</strong></small> <br>
                                                                @endif
                                                                @error('nama')
                                                                    <small class="text-danger"><strong>{{$message}}</strong></small> <br>
                                                                @enderror
                                                            </div>
                                                            <div class="form-group">
                                                                <label>NIP / NIK</label>
                                                                <input class="form-control" type="text" wire:model.lazy='nip'>
                                                                @if ($nip != $cache_nip)
                                                                  <small class="text-info">Sebelumnya <strong>{{($cache_nip == "") ? 'kosong' : $cache_nip}}</strong></small> <br>
                                                                @endif
                                                                @if (session()->has('warning-nip'))
                                                                    <small class="text-warning"><strong>{{session('warning-nip')}}</strong></small> <br>
                                                                @endif
                                                                @error('nip')
                                                                    <small class="text-danger"><strong>{{$message}}</strong></small> <br>
                                                                @enderror
                                                            </div>
                                                            <div class="form-group">
                                                                <label>NRK / No PJLP</label>
                                                                <input class="form-control" type="text" wire:model.lazy='nrk'>
                                                                @if ($nrk != $cache_nrk)
                                                                  <small class="text-info">Sebelumnya <strong>{{($cache_nrk == "")? 'kosong' : $cache_nrk }}</strong></small> <br>
                                                                @endif
                                                                @if (session()->has('warning-nrk'))
                                                                    <small class="text-warning"><strong>{{session('warning-nrk')}}</strong></small> <br>
                                                                @endif
                                                                @error('nrk')
                                                                    <small class="text-danger"><strong>{{$message}}</strong></small> <br>
                                                                @enderror
                                                            </div>
                                                            <div class="form-group">
                                                                <label>No Telp</label>
                                                                <input class="form-control" type="text" wire:model.lazy='telp'>
                                                                @if ($telp != $cache_telp)
                                                                  <small class="text-info">Sebelumnya <strong>{{($cache_telp == "")? 'kosong' : $cache_telp}}</strong></small> <br>
                                                                @endif
                                                                @if (session()->has('warning-telp'))
                                                                    <small class="text-warning"><strong>{{session('warning-telp')}}</strong></small> <br>
                                                                @endif
                                                                @error('telp')
                                                                    <small class="text-danger"><strong>{{$message}}</strong></small> <br>
                                                                @enderror
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Email</label>
                                                                <input class="form-control" type="text" wire:model.lazy='email'>
                                                                @if ($email != $cache_email)
                                                                  <small class="text-info">Sebelumnya <strong>{{($cache_email == "")? 'kosong' : $cache_email}}</strong></small> <br>
                                                                @endif
                                                                @if (session()->has('warning-email'))
                                                                    <small class="text-warning"><strong>{{session('warning-email')}}</strong></small> <br>
                                                                @endif
                                                                @error('email')
                                                                    <small class="text-danger"><strong>{{$message}}</strong></small> <br>
                                                                @enderror
                                                            </div>
                                                            <div class="form-group">
                                                              <label>Status Aktif Pegawai</label>
                                                              <select wire:model='aktif' class="form-control select2bs4">
                                                                <option disabled  value="">Pilih Status Aktif Pegawai</option>
                                                                <option value="{{$list_aktif[0]['value']}}">{{$list_aktif[0]['text']}}</option>
                                                                <option value="{{$list_aktif[1]['value']}}">{{$list_aktif[1]['text']}}</option>
                                                              </select>
                                                              @if ($aktif != $cache_aktif && $cache_aktif != "")
                                                                  <small class="text-info">Sebelumnya <strong>{{$list_aktif[array_search($cache_aktif,array_column($list_aktif,'value'))]['text']}}</strong></small> <br>
                                                                @endif
                                                                @if (session()->has('warning-aktif'))
                                                                    <small class="text-warning"><strong>{{session('warning-aktif')}}</strong></small> <br>
                                                                @endif
                                                                @error('aktif')
                                                                    <small class="text-danger"><strong>{{$message}}</strong></small> <br>
                                                                @enderror
                                                            </div>
                                                            @if ($this->dataPegawaiAdaYangDirubah())
                                                              <div class="form-group">
                                                                <label>Keterangan Perubahan</label>
                                                                <textarea class="form-control" wire:model='keterangan' cols="20" rows="10" placeholder="(Opsional) Beri keterangan terhadap perubahan data yang dilakukan."></textarea>
                                                              </div>                                                                
                                                            @endif
                                                        </div>
                                                        {{-- Form input untuk data pegawai end --}}

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                  <div class="card card-default collapse fade show active" wire:ignore.self>
                                    <div class="card-header">
                                      <h3 class="card-title">Data Penempatan</h3>
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body">
                                      <div class="row">

                                        {{-- Form input untuk data penempatan start --}}
                                        <div class="col-md-6">
                                          <div class="form-group">
                                            <label>Jabatan Pegawai</label>
                                            <h5>{{$jabatan_pegawai}}</h5>
                                          </div>
                                          <div class="form-group">
                                            <label>Pos</label>
                                            <select wire:model='penempatan' wire:change='koreksiPenempatanDanGrup' class="form-control select2bs4" style="width: 100%;">
                                              <option disabled value="">Pilih Penempatan</option>
                                                    {{-- generate list pos penempatan start --}}
                                                    @forelse ($list_penempatan as $p)

                                                        @if($tipe_jabatan_user != $tipe_jabatan_personil)
                                                        {{-- Jika user bukan personil, jangan tampilkan pos dan kantor sektor, tampilkan nama sektor saja --}}
                                                          @if ($p['value'] == auth()->user()->data->sektor)
                                                            <option value="{{$p['value']}}">{{$p['text']}}</option>
                                                          @endif
                                                        @else
                                                        {{-- Jika user personil, tampilkan pos dan kantor sektor, tapi tidak nama sektor --}}
                                                          @if ($p['value'] != auth()->user()->data->sektor)
                                                            <option value="{{$p['value']}}">{{$p['text']}}</option>
                                                          @endif
                                                        @endif
                                                    @empty
                                    
                                                    @endforelse

                                                    {{-- generate list pos penempatan end --}}
                                            </select>
                                            @if ($penempatan != $cache_penempatan && $cache_penempatan != "")
                                              <small class="text-info">Sebelumnya <strong>{{$list_penempatan[array_search($cache_penempatan,array_column($list_penempatan,'value'))]['text']}}</strong></small> <br>
                                            @endif
                                            @if (session()->has('warning-penempatan'))
                                                <small class="text-warning"><strong>{{session('warning-penempatan')}}</strong></small> <br>
                                            @endif
                                            @error('penempatan')
                                                <small class="text-danger"><strong>{{$message}}</strong></small> <br>
                                            @enderror
                                          </div>
                                          <div class="form-group">
                                            <label>Grup Jaga</label>
                                            <select wire:model='grup' wire:change='koreksiPenempatanDanGrup' class="form-control select2bs4" style="width: 100%;">
                                              <option disabled value="">Pilih Grup</option>


                                              {{-- Generate list grup jaga start --}}
                                              @forelse ($list_grup as $g)
                                                  @if ( ($tipe_jabatan_user != $tipe_jabatan_personil) && ($tipe_jabatan_user != $tipe_jabatan_danton))
                                                  {{-- Jika user bukan personil atau danton, jangan tampilkan grup abc, tapi tampilkan non grup saja --}}
                                                      @if (!in_array($g['value'],['A','B','C']))
                                                        <option value="{{$g['value']}}">{{$g['text']}}</option>
                                                      @endif
                                                  @else
                                                  {{-- Jika user adalah personil atau danton, tampilkan grup abc, tapi jangan tampilkan non grup --}}
                                                      @if (in_array($g['value'],['A','B','C']))
                                                        <option value="{{$g['value']}}">{{$g['text']}}</option>
                                                      @endif
                                                  @endif
                                              @empty
                                                  
                                              @endforelse
                                              {{-- Generate list grup jaga end --}}


                                            </select>
                                            @if ($grup != $cache_grup && $cache_grup != "")
                                              <small class="text-info">Sebelumnya <strong>{{$list_grup[array_search($cache_grup,array_column($list_grup,'value'))]['text']}}</strong></small> <br>
                                            @endif
                                            @if (session()->has('warning-grup'))
                                                <small class="text-warning"><strong>{{session('warning-grup')}}</strong></small> <br>
                                            @endif
                                            @error('grup')
                                                <small class="text-danger"><strong>{{$message}}</strong></small> <br>
                                            @enderror
                                          </div>
                                        </div>
                                          {{-- Form input untuk data penempatan end --}}

                                      </div>
                                      <!-- /.row -->
                                    </div>
                                    <!-- /.card-body -->
                                  </div>
                                    <button wire:click='simpanPerubahanData' type="button" class="btn btn-primary">Save changes</button>
                                </div>
                                {{-- Bagian ubah data end --}}

                                {{-- Bagian ubah password start --}}
                                <div class="tab-pane fade" id="custom-tabs-three-profile" role="tabpanel" aria-labelledby="custom-tabs-three-profile-tab" wire:ignore.self>

                                  @if (!$user_ditemukan)
                                        <div class="jumbotron text-center">
                                          Akun user untuk <strong>{{$cache_nama}}</strong> tidak ditemukan. <br>
                                          Pastikan pegawai tersebut memiliki akun di database, masih aktif atau belum pensiun. <br>
                                          Koordinasikan dengan admin sudin dan admin dinas jika ada kesalahan data.
                                        </div>
                                  @else
                                      <div class="card card-default">
                                        <div class="card-body">

                                          <div  class="card bg-secondary collapse fade show active" id="info-data-password" wire:ignore.self>
                                            <div class="card-body">
                                              <div class="card-tools">
                                                  <button type="button" class="close" data-toggle="collapse"
                                                      data-target="#info-data-password" aria-label="Close">
                                                      <span aria-hidden="true">×</span>
                                                  </button>
                                              </div>
                                              <div>
                                                Dibawah ini adalah kendali untuk mengubah password akun pegawai. <br>
                                                Gunakan kendali dibawah untuk mengubah atau mereset password pegawai. <br>
                                                Kendali ini hanya muncul untuk pegawai yang memiliki akun di web ini. <br>
                                                Password default adalah <strong>123456</strong>.
                                              </div>
                                            </div>
                                          </div>

                                          <div class="row">
                                            <div class="col-md-6">
                                              <div class="form-group">
                                                <label>Password Baru</label>
                                                <input type="text" class="form-control" wire:model.defer='password' placeholder="Masukan Password">
                                                @error('password')
                                                <small class="text-danger"><strong>{{$message}}</strong></small> <br>
                                                @enderror
                                              </div>
                                              <button wire:click='simpanPerubahanPassword' type="button" class="btn btn-primary">Save changes</button>
                                            </div>
                                          </div>
                                          <!-- /.row -->
                                        </div>
                                        <!-- /.card-body -->
                                      </div>
                                  @endif

                                  
                                </div>
                                {{-- Bagian ubah password end --}}


                              </div>
                            </div>
                            <!-- /.card -->
                          </div>
                        </div>
                      </div>
                      <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                      </div>
                    </div>
                    <!-- /.modal-content -->
                  </div>
                  <!-- /.modal-dialog -->
                </div>