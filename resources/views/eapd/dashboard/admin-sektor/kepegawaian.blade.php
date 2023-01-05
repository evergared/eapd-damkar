@extends('eapd.layouts.adminlte-dashboard',['title'=>'Kepegawaian Admin Sektor'])

@section('content')


@include('eapd.dashboard.komponen.breadcrumbs',[ 'halamanJudul'=>'Kepegawaian','halaman'=>'kepegawaian'])

<section class="content">
    <div class="container-fluid">
            <div class="row">



                <section class="d-flex justify-content-center col-lg-12 connectedSortable ui-sortable">

                  <div class="card">
                    <div class="card-header align-middle bg-info">
                      <h4>Data Pegawai <br class="d-block d-md-none">{{ auth()->user()->data->penempatan->nama_penempatan }}</h4>
                    </div>
                    <div class="card-body px-3 py-3">

                      <div class="mb-3 card collapse bg-gradient-secondary fade show active" id="info-kepegawaian-1">
                        <div class="card-body">
                          <div class="card-tools">
                              <button type="button" class="close" data-toggle="collapse"
                                  data-target="#info-kepegawaian-1" aria-label="Close">
                                  <span aria-hidden="true">×</span>
                              </button>
                          </div>
                          <div>
                            Dibawah ini merupakan daftar pegawai yang ada di <strong>{{auth()->user()->data->penempatan->nama_penempatan}}</strong>. <br>
                            Gunakan tabel dibawah untuk melakukan perubahan penempatan pos, grup jaga, status aktif pegawai, dan lain sebagainya. <br>
                            Perlu diingat lingkup data yang diubah merupakan lingkup kepegawaian tingkat sektor. <br>
                            Jika ada perubahan yang melebihi kendali data tingkat sektor, harap koordinasi dengan admin sudin. <br>
                            <ul class="mt-2">
                              <li>
                                Gunakan "Cari" untuk mencari data. Pencarian akan langsung dilakukan tanpa klik Enter.
                              </li>
                              <li>
                                Gunakan "Filter" untuk menyaring data.
                              </li>
                              <li>
                                Gunakan "Kolom" untuk menyembunyikan dan menampilkan kolom.
                              </li>
                              <li>
                                Jika anda menggunakan hp, klik tombol (+) untuk menampilkan data tambahan.
                              </li>
                            </ul>
                          </div>
                        </div>
                      </div>

                      @livewire('eapd.datatable.tabel-kepegawaian-admin-sektor')
                    </div>
                  </div>


                </section>

                {{-- modals --}}
                @livewire('eapd.modal.modal-edit-data-pegawai-tabel-admin-sektor')
                {{-- modals end --}}

            </div>
    </div>
</section>
@endsection

@once
    @push('stack-head')
        @livewireStyles
    @endpush
    @push('stack-body')
        @livewireScripts
        @include('helper.script-modal')
    @endpush
    

@endonce
