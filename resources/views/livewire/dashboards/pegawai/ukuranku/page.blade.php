
@include('eapd.dashboard.komponen.breadcrumbs',['halamanJudul'=>'Daftar Ukuran APD','halaman'=>'ukuran'])

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 mt-2">
                <div class="card">
                    <div class="card-body">
                        
                            <div class="card card-warning">
                                <div class="card-header">
                                  <h3 class="card-title">Ubah Data Ukuran</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                        
                                  <div  class="card bg-secondary collapse fade show active" id="info-form-ukuran" wire:ignore.self>
                                    <div class="card-body">
                                      <div class="card-tools">
                                          <button type="button" class="close" data-toggle="collapse"
                                              data-target="#info-form-ukuran" aria-label="Close">
                                              <span aria-hidden="true">×</span>
                                          </button>
                                      </div>
                                      <div>
                                        Dibawah ini merupakan form untuk mengganti data ukuran anda.<br>
                                        Data yang dimasukan akan digunakan untuk dasar pengadaan APD berikutnya. <br>
                                        Pastikan bahwa data yang dimasukan sesuai dengan ukuran anda.<br>
                                      </div>
                                    </div>
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
                        
                                  <form>
                                    <div>
                                      <small><strong>Terakhir Diisi : <i>{{$tanggal}}</i></strong></small>
                                    </div>
                                    <div class="row">
                                      <div class="col-sm-6">
                                        <!-- select -->
                                        <div class="form-group">
                                          <label>Fire Jacket</label>
                                          <select class="form-control" wire:model="ukuranFireJacket">
                                            <option value="">Pilih Ukuran</option>
                                            @foreach ($opsiFireJacket as $item)
                                                <option>{{$item}}</option>   
                                            @endforeach
                                          </select>
                                        </div>
                                      </div>
                                      <div class="col-sm-6">
                                        <div class="form-group">
                                          <label>Jumpsuit Rescue</label>
                                          <select class="form-control" wire:model="ukuranJumpsuit">
                                            <option value="">Pilih Ukuran</option>
                                            @foreach ($opsiJumpsuit as $item)
                                                <option>{{$item}}</option>   
                                            @endforeach
                                          </select>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                              <label>Fire Gloves</label>
                                              <select class="form-control" wire:model="ukuranFireGloves">
                                                <option value="">Pilih Ukuran</option>
                                            @foreach ($opsiFireGloves as $item)
                                                <option>{{$item}}</option>   
                                            @endforeach
                                              </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                              <label>Rescue Gloves</label>
                                              <select class="form-control" wire:model="ukuranRescueGloves">
                                                <option value="">Pilih Ukuran</option>
                                            @foreach ($opsiRescueGloves as $item)
                                                <option>{{$item}}</option>   
                                            @endforeach
                                              </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                              <label>Fire Boots</label>
                                              <select class="form-control" wire:model="ukuranFireBoots">
                                                <option value="">Pilih Ukuran</option>
                                            @foreach ($opsiFireBoots as $item)
                                                <option>{{$item}}</option>   
                                            @endforeach
                                              </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                              <label>Rescue Boots</label>
                                              <select class="form-control" wire:model="ukuranRescueBoots">
                                                <option value="">Pilih Ukuran</option>
                                            @foreach ($opsiRescueBoots as $item)
                                                <option>{{$item}}</option>   
                                            @endforeach
                                              </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                              <label>Water Rescue Boots</label>
                                              <select class="form-control" wire:model="ukuranWaterRescueBoots">
                                                <option value="">Pilih Ukuran</option>
                                            @foreach ($opsiRescueBoots as $item)
                                                <option>{{$item}}</option>   
                                            @endforeach
                                              </select>
                                            </div>
                                        </div>
                                    </div>
                                  </form>
                                </div>
                                <!-- /.card-body -->
                                <div class="form-group mt-4">
                                    <button class="btn btn-primary btn-md" type="submit" wire:click="simpan">Simpan Perubahan</button>
                                    <button class="btn btn-secondary btn-md" type="button" >Reset Input</button>
                                </div>
                              </div>
                        

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
