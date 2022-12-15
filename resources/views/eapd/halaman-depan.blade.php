@extends('eapd.layouts.securex')

@section('content')


<!-- Navbar Start -->
<nav id="navtop" class="navbar navbar-expand-lg bg-white navbar-light sticky-top p-0 px-4 px-lg-5">
    <a class="navbar-brand d-flex align-items-center">
        <img src="{{asset('damkar/logo_dki.png')}}" class="w-75 h-75" alt="">
        <img src="{{asset('damkar/logo_damkar_dki.png')}}" class="w-75 h-75" alt="">

    </a>
    <h2 class="text-center text-primary h5">Dinas Penanggulangan Kebakaran dan Penyelamatan</h2>
    <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
        <div class="navbar-nav ms-auto py-4 py-lg-0">
            <a href="index.html" class="nav-item nav-link active">Home</a>
            <a href="#exampleModal" class="nav-item nav-link" data-toggle="modal" data-target="#exampleModal"
                data-whatever="@getbootstrap">Login</a>
        </div>
    </div>
</nav>
<!-- Navbar End -->


<!-- Carousel Start -->
<div class="container-fluid p-0 pb-5">
    <div class="owl-carousel header-carousel position-relative">
        <div class="owl-carousel-item position-relative">
            <img class="img-fluid" src="{{asset('damkar/brand2_sm.jpg')}}" alt="">
            <div class="carousel-inner">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-12 col-lg-8 text-center">
                            <div class="d-flex justify-content-around">
                                <div class="pb-5">
                                    <h1 class="display-3 text-white animated slideInDown mb-4">Kata sambutan</h1>
                                    <p class=" text-white mb-4 animated slideInLeft">Kepala Dinas Penanggulangan
                                        Kebakaran dan
                                        Penyelamatan</p>
                                    <a class="btn" href="#sambutan"><i
                                            class="fa fa-arrow-right text-white me-3"></i>Klik disini!</a>
                                </div>
                                <div style="height: 30%; width:30%;">
                                    <img src="{{asset('damkar/kadis.jpg')}}" class="animated slideInLeft">
                                </div>
                            </div>

                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                data-target="#exampleModal" data-whatever="@getbootstrap">Login</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="owl-carousel-item position-relative">
            <img class="img-fluid" src="{{asset('damkar/landing_page1.jpg')}}" alt="">
        </div>
    </div>
</div>
<!-- Carousel End -->


<!-- Facts Start -->

<div class="pt-4" id="sambutan"></div>
<div></div>
<!-- About Start -->
<div class="container-fluid bg-light overflow-hidden my-5 px-lg-0">
    <div class="container about px-lg-0">
        <div class="row g-0 mx-lg-0 justify-content-center">
            <div class="g-0 mx-lg-5 " style="width: 80%;">
                <p class="mt-8 mb-8">Kepala Dinas Penanggulangan Kebakaran dan Penyelamatan</p>
                <br>
                <a class="text-gray-800 hover:text-gray-900">Provinsi DKI Jakarta</a>
                <article>
                    <p style="text-align:justify;">Saya mengucapkan terima kasih dan apresiasi setinggi-tingginya
                        kepada tim
                        pelaksana E-APD. Ini
                        adalah suatu pembuktian kebersamaan yang sudah terjalin. Meskipun tidak masuk dalam anggaran
                        APBD, atas inisiatif dan kreativitas teman-teman semua, Saya bangga dan salut karena sistem
                        E-APD
                        sudah diresmikan.</p><br>
                    <p style="text-align:justify;">Kunci dari segala operasional adalah keselamatan bagi anggota
                        saat melaksanakan
                        tugas dan fungsi.
                        Tentunya harus diiringi ketersediaan prasarana dan sarana penyelamatan diri. Dengan adanya
                        sistem
                        E-APD, memudahkan pendataan dan pemenuhan APD petugas operasional di Dinas Penanggulangan
                        Kebakaran dan Penyelamatan Provinsi DKI Jakarta agar bisa melayani masyarakat secara
                        profesional dan
                        aman sehingga petugas bisa kembali pulang ke keluarganya dengan selamat.</p><br>
                    <p style="text-align:justify;">Saya mengucapkan terima kasih kepada seluruh petugas operasional
                        yang secara konsisten sudah
                        bekerja secara profesional. Ingat, anda semua adalah garda terdepan dimana tidak hanya untuk
                        DKI Jakarta namun juga terhadap Negara Kesatuan Republik Indonesia. Oleh karena itu, jangan
                        sampai APD anda tidak lengkap. Segera lakukan pendataan APD anda melalui sistem E-APD.</p>
                    <br>
                    <p style="text-align:justify;">Saya berpesan setelah APD diberikan, gunakanlah sesuai dengan
                        ketentuan dan juga dirawat.
                        Laporkan kondisi APD anda ke sistem E-APD baik dalam kondisi baik/rusak/hilang. Jika memang
                        kondisi APD dirasa membahayakan saat menjalankan tugas, silahkan laporkan ke sistem E-APD
                        secara rinci agar bisa dilakukan tindak lanjut.</p><br>
                    <p style="text-align:justify;">Saya berharap seluruh jajaran menyampaikan data pemenuhan APD
                        secara benar, jujur, akurat dan
                        terupdate karena akan berdampak pada informasi untuk pengambilan kebijakan dari segi
                        perencanaan dan segi kebutuhan kelengkapan APD. Saya akan melakukan pengawasan dan
                        pengecekan
                        terhadap data APD petugas operasional. Semoga melalui sistem ini, menjadi sarana dalam
                        menyampaikan apa yang menjadi kebutuhan petugas operasional khususnya dalam hal APD.</p><br>
                    <p style="text-align:justify;">Semoga eksistensi kita di tengah masyarakat semakin dicintai.
                        Tujuan kita semua
                        adalah satu dan sama yaitu menjadikan DKI Jakarta menjadi kota yang aman dari
                        segala macam bencana.</p><br>
                    <p style="text-align:right;">Jakarta, 24 Juni 2022</p><br>

                    <p style="text-align:right;">Kepala Dinas Penanggulangan Kebakaran dan Penyelamatan</p><br>

                    <p style="text-align:right;">Drs. Satriadi Gunawan, M.Si.</p><br>
                </article>
            </div>
        </div>
    </div>
</div>
<!-- About End -->

<!-- modal -->
{{-- @todo --}}
<div>
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="">Login</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="form-group">
                            <label for="nrk" class="col-form-label">NRK/N-PJLP:</label>
                            <input type="text" class="border rounded-full form-control" id="nrk" name="nrk"
                                :value="old('nrk')" required autofocus>

                            @error('nrk')
                            <small class="text-red">{{ $message }}</small>
                            @enderror

                        </div>
                        <div class="form-group">
                            <label for="password" class="col-form-label">Password:</label>
                            <input type="password" class="border rounded-full form-control" id="password"
                                name="password" required autocomplete="current-password">

                            @error('password')
                            <small class="text-red">{{ $message }}</small>
                            @enderror
                        </div>

                        <!-- Remember Me -->
                        <div class="block mt-4">
                            <label for="remember_me" class="inline-flex items-center">
                                <input id="remember_me" type="checkbox"
                                    class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                    name="remember">
                                <span class="ml-2 text-sm text-gray-600">{{ __('tes.login_modal_remember') }}</span>
                            </label>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- modal end -->



<!-- Footer Start -->
<div class="container-fluid bg-dark text-secondary footer mt-5 py-5 wow fadeIn" data-wow-delay="0.1s">
    <div class="container py-5">
        <div class="row g-5">
            <div class="col-lg-3 col-md-6">
                <h5 class="text-light mb-4">Address</h5>
                <p class="btn btn-link" onclick=" window.open('https://maps.app.goo.gl/VfJXBYsU7FN6wgce6?g_st=iw')">
                    Maps</p>
                <p class="mb-2"><i class="fa fa-phone-alt me-3"></i>Layanan Kedaruratan 112</p>
                <p class="mb-2"><i class="fa fa-phone-alt me-3"></i>021-63858213</p>
                <p class="mb-2"><i class="fa fa-phone-alt me-3"></i>021-63855357</p>
                <p class="mb-2"><i class="fa fa-envelope me-3"></i>jakfire@gmail.com</p>
                <div class="d-flex pt-2">
                    <a class="btn btn-square btn-outline-secondary rounded-circle me-2" href=""><i
                            class="fab fa-twitter"></i></a>
                    <a class="btn btn-square btn-outline-secondary rounded-circle me-2" href=""><i
                            class="fab fa-facebook-f"></i></a>
                    <a class="btn btn-square btn-outline-secondary rounded-circle me-2" href=""><i
                            class="fab fa-youtube"></i></a>
                    <a class="btn btn-square btn-outline-secondary rounded-circle me-2" href=""><i
                            class="fab fa-linkedin-in"></i></a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection


@push('javascript')
<!-- JavaScript Libraries -->
<script>
    $('#exampleModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            var recipient = button.data('whatever') // Extract info from data-* attributes
            // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
            // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
            var modal = $(this)
            modal.find('.modal-title').text('New message to ' + recipient)
            modal.find('.modal-body input').val(recipient)
        })
</script>
<script src="https://code.jquery.com/jquery-3.6.1.min.js"
    integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{asset('securex/lib/wow/wow.min.js')}}"></script>
<script src="{{asset('securex/lib/easing/easing.min.js')}}"></script>
<script src="{{asset('securex/lib/waypoints/waypoints.min.js')}}"></script>
<script src="{{asset('securex/lib/counterup/counterup.min.js')}}"></script>
<script src="{{asset('securex/lib/owlcarousel/owl.carousel.min.js')}}"></script>
<script src="{{asset('securex/lib/isotope/isotope.pkgd.min.js')}}"></script>
<script src="{{asset('securex/lib/lightbox/js/lightbox.min.js')}}"></script>

<!-- Template Javascript -->
<script src="{{asset('securex/js/securex.js')}}"></script>
{{-- @vite('resources/js/securex.js') --}}
<script src="https://code.jquery.com/jquery-3.6.1.slim.min.js"
    integrity="sha256-w8CvhFs7iHNVUtnSP0YKEg00p9Ih13rlL9zGqvLdePA=" crossorigin="anonymous"></script>

<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
    integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
    integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
</script>
@endpush