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
// Pegawai Biasa
Breadcrumbs::for('dashboard', function (BreadcrumbTrail $trail) {
    $trail->push('Dashboard', route('dashboard'));
});

Breadcrumbs::for('profil', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Profil', route('profil'));
});

Breadcrumbs::for('request-item', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Request Item', route('request-item'));
});

Breadcrumbs::for('apdku', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('APDku', route('apdku'));
});

// Admin Sektor
Breadcrumbs::for('print-laporan', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Print Laporan', route('print-laporan'));
});
Breadcrumbs::for('kepegawaian', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Kepegawaian', route('kepegawaian'));
});
Breadcrumbs::for('progres-sektor', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Progres Sektor', route('progres-sektor'));
});
Breadcrumbs::for('progres-sudin', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Progres Sudin', route('progres-sektor'));
});
Breadcrumbs::for('progres-dinas', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Progres Dinas', route('progres-sektor'));
});
Breadcrumbs::for('ukuran', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Daftar Ukuran APD', route('ukuran'));
});
Breadcrumbs::for('data-ukuran', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Data Ukuran APD', route('data-ukuran'));
});
Breadcrumbs::for('data-distribusi', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Data Distribusi', route('data-distribusi'));
});
