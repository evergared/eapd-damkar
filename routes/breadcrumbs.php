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
