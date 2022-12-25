{{--

Script yang dibutuhkan untuk interaksi modal dengan livewire.

letakkan 1x saja di layout atau di halaman dimana modal akan digunakan

Script ini akan dipanggil oleh link atau button dengan cara memanggil function modal di onclick, contoh :
<a onclick="modal('testmodal','')"></a>

parameter pertama merupakan id dari modal yang akan dipanggil, pastikan nama listener pada komponen livewire modal
tersebut sama dengan id ini.

parameter kedua merupakan data yang ingin kita kirim ke komponen livewire modal tersebut.

pastikan masukan ini di div modal : wire:ignore.self
contoh penerapan :
<div wire:ignore.self class="modal" tabindex="-1" role="dialog" id="testmodal"></div>

agar modal tidak hilang sendiri dan layar dapat diklik setelah modal dipanggil.

--}}


<script>
    //     $(document).on('hidden.bs.modal', '.modal',
//   () => $('.modal:visible').length && $(document.body).addClass('modal-open'));

// $(document).on('show.bs.modal', '.modal', function() {
//   const zIndex = 1040 + 10 * $('.modal:visible').length;
//   $(this).css('z-index', zIndex);
//   setTimeout(() => $('.modal-backdrop').not('.modal-stack').css('z-index', zIndex - 1).addClass('modal-stack'));
// });

    function modal(modalId,data = null, eventName = modalId)
    {
        // javascript tidak memiliki associative array,
        // jadi pastikan menggunakan array biasa 
        // jika akan passing parameter ke component
        // dan pastikan juga untuk mengingat urutan ke berapa masing-masing data

        Livewire.emit(eventName,data)
        $('#'+modalId).modal('show')
    }




</script>