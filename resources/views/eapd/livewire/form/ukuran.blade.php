<div>
    <div class="card card-warning">
        <div class="card-header">
          <h3 class="card-title">Ubah Data Ukuran</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
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
