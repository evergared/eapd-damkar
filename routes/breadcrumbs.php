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

