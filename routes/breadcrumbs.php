<?php // routes/breadcrumbs.php

// Note: Laravel will automatically resolve `Breadcrumbs::` without
// this import. This is nice for IDE syntax and refactoring.
use Diglactic\Breadcrumbs\Breadcrumbs;

// This import is also not required, and you could replace `BreadcrumbTrail $trail`
//  with `$trail`. This is nice for IDE type checking and completion.
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

// contoh
// Home
Breadcrumbs::for('home', function (BreadcrumbTrail $trail) {
    $trail->push('Home', route('home'));
});

// Home > Blog
Breadcrumbs::for('blog', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Blog', route('blog'));
});

// Home > Blog > [Category]
Breadcrumbs::for('category', function (BreadcrumbTrail $trail, $category) {
    $trail->parent('blog');
    $trail->push($category->title, route('category', $category));
});



// ref : https://packagist.org/packages/diglactic/laravel-breadcrumbs

// eapd
// Pegawai 
Breadcrumbs::for('dashboard', function (BreadcrumbTrail $trail) {
    $trail->push('Dashboard', route('dashboard'));
});

Breadcrumbs::for('profil', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Profil', route('profil'));
});

Breadcrumbs::for('apdku', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('APDku', route('apdku'));
});

Breadcrumbs::for('ukuran', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('UKURANku', route('ukuran'));
});

Breadcrumbs::for('progress-apd', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Progress Input APD Anggota', route('progress-apd'));
});

Breadcrumbs::for('progress-ukuran', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Progress Input Ukuran Anggota', route('progress-ukuran'));
});

Breadcrumbs::for('data-apd', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Data Input APD Anggota', route('data-apd'));
});

Breadcrumbs::for('data-ukuran', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Data Input Ukuran Anggota', route('data-ukuran'));
});


// admin

Breadcrumbs::for('admin-dashboard', function (BreadcrumbTrail $trail) {
    $trail->push('Dashboard Admin', route('admin-dashboard'));
});

Breadcrumbs::for('admin-progress-apd', function (BreadcrumbTrail $trail) {
    $trail->parent('admin-dashboard');
    $trail->push('Inputan APD Pegawai Periode Ini', route('admin-progress-apd'));
});

Breadcrumbs::for('admin-progress-ukuran', function (BreadcrumbTrail $trail) {
    $trail->parent('admin-dashboard');
    $trail->push('Inputan Ukuran Pegawai Periode Ini', route('admin-progress-ukuran'));
});

Breadcrumbs::for('admin-data-apd-inputan', function (BreadcrumbTrail $trail) {
    $trail->parent('admin-dashboard');
    $trail->push('Data Inputan APD Pegawai', route('admin-data-apd-inputan'));
});

Breadcrumbs::for('admin-data-apd-no_seri', function (BreadcrumbTrail $trail) {
    $trail->parent('admin-dashboard');
    $trail->push('Data Nomer Seri APD', route('admin-data-apd-no_seri'));
});

Breadcrumbs::for('admin-data-apd-pensiunan', function (BreadcrumbTrail $trail) {
    $trail->parent('admin-dashboard');
    $trail->push('Data Inputan APD Pegawai Pensiunan', route('admin-data-apd-pensiunan'));
});

Breadcrumbs::for('admin-data-apd-rekap', function (BreadcrumbTrail $trail) {
    $trail->parent('admin-dashboard');
    $trail->push('Rekap Data Inputan APD Pegawai', route('admin-data-apd-rekap'));
});

Breadcrumbs::for('admin-data-ukuran-inputan', function (BreadcrumbTrail $trail) {
    $trail->parent('admin-dashboard');
    $trail->push('Data Ukuran Pegawai', route('admin-data-ukuran-inputan'));
});

Breadcrumbs::for('admin-data-ukuran-rekap', function (BreadcrumbTrail $trail) {
    $trail->parent('admin-dashboard');
    $trail->push('Rekap Data Ukuran Pegawai', route('admin-data-ukuran-rekap'));
});

Breadcrumbs::for('admin-pengaturan-apd-barang', function (BreadcrumbTrail $trail) {
    $trail->parent('admin-dashboard');
    $trail->push('Atur Barang APD', route('admin-pengaturan-apd-barang'));
});

Breadcrumbs::for('admin-pengaturan-jenis-barang', function (BreadcrumbTrail $trail) {
    $trail->parent('admin-dashboard');
    $trail->push('Atur Jenis APD', route('admin-pengaturan-jenis-barang'));
});

Breadcrumbs::for('admin-pengaturan-kepegawaian', function (BreadcrumbTrail $trail) {
    $trail->parent('admin-dashboard');
    $trail->push('Kepegawaian Web EAPD', route('admin-pengaturan-kepegawaian'));
});

Breadcrumbs::for('admin-pengaturan-periode', function (BreadcrumbTrail $trail) {
    $trail->parent('admin-dashboard');
    $trail->push('Atur Periode Input APD', route('admin-pengaturan-periode'));
});

Breadcrumbs::for('admin-pengaturan-user', function (BreadcrumbTrail $trail) {
    $trail->parent('admin-dashboard');
    $trail->push('Atur Akun User', route('admin-pengaturan-user'));
});

