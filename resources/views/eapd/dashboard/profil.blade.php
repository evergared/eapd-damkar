@extends('eapd.layouts.adminlte-dashboard',['title'=>'Profil'])



@section('content')

@include('eapd.dashboard.komponen.breadcrumbs')

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 mt-2">
                <div class="card">
                    <div class="card-body">

                        @livewireStyles
                        @livewire('eapd.form.form-profil')

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@push('stack-body')
@livewireScripts
@endpush