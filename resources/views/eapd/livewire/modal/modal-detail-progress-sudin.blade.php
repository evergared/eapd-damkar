<div>
    <div class="modal fade" id="modal-progres-sudin" wire:ignore.self>
        <div class="modal-dialog modal-xl">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Progres Input Tardi</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="table-responsive p-0" style="height: 300px;">
                <table class="table table-head-fixed text-nowrap">
                  <thead class="text-center">
                      <tr>
                          <th>#</th>
                          <th >Item</th>
                          <th class="text-center">Foto yang diupload</th>
                          <th class="text-center" style="width:30%;">Pesan</th>
                          <th>Status</th>
                          <th>#</th>
                      </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td class="text-center text-wrap my-auto align-middle">1</td>
                      <td class="text-center text-wrap my-auto align-middle">Fire Jacket</td>
                      <td><img src="" alt="">test image</td>
                      <td class="text-center text-wrap my-auto align-middle"><textarea class=""  placeholder="Enter ..."></textarea></td>
                      <td class="text-center text-wrap my-auto align-middle">
                        <div class="col-md-12">
                          <select class="">
                          <option>Validasi</option>
                          <option>Tolak</option>
                          <option>Ubah</option>
                          </select>
                        </div>
                      </td>
                      <td><button type="button" class="btn btn-secondary">Save</button></td>
                    </tr>
                  </tbody>
                </table>
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

{{-- <script>
    window.addEventListener('ModalProgresSudin', event=> {
            modal('modal-progres-sudin')
        })
</script> --}}
</div>
