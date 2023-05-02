<div class="content-header">

    @php
        $mode_tes;
        $aktif;
        if(!isset($mode_tes))
            $mode_tes = false;

        if(!isset($aktif))
            $aktif = true;
    @endphp
    <div class="container-fluid">
        <!-- /.col -->
        @livewire('eapd.layout.layout-marquee-pengumuman-berjalan',["aktif" => $aktif, "mode_tes" => $mode_tes])
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</div>