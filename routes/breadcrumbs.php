<?php

use DaveJamesMiller\Breadcrumbs\BreadcrumbsGenerator as Crumbs;

Breadcrumbs::register('home', function (Crumbs $crumbs) {
   $crumbs->push('Home', route('home'));
});

Breadcrumbs::register('login', function (Crumbs $crumbs) {
    $crumbs->parent('home');
    $crumbs->push('Login', route('login'));
});

Breadcrumbs::register('register', function (Crumbs $crumbs){
    $crumbs->parent('home');
    $crumbs->push('Register', route('register'));
});

Breadcrumbs::register('password_request', function (Crumbs $crumbs){
    $crumbs->parent('login');
    $crumbs->push('Password', route('password.request'));
});

Breadcrumbs::register('password_reset', function (Crumbs $crumbs){
    $crumbs->parent('password.reset');
    $crumbs->push('Password', route('password.reset'));
});

Breadcrumbs::register('cabinet', function (Crumbs $crumbs) {
    $crumbs->parent('home');
    $crumbs->push('Cabinet', route('cabinet'));
});

Breadcrumbs::register('admin.home', function (Crumbs $crumbs) {
    $crumbs->parent('home');
    $crumbs->push('Admin', route('admin.home'));
});

Breadcrumbs::register('admin.users.index', function (Crumbs $crumbs) {
    $crumbs->parent('admin.home');
    $crumbs->push('Users', route('admin.users.index'));
});

Breadcrumbs::register('admin.users.create', function (Crumbs $crumbs) {
    $crumbs->parent('admin.users.index');
    $crumbs->push('Create', route('admin.users.create'));
});

Breadcrumbs::register('admin.users.show', function (Crumbs $crumbs, \App\Entity\User $user) {
    $crumbs->parent('admin.users.index');
    $crumbs->push('Show', route('admin.users.show', compact('user')));
});

Breadcrumbs::register('admin.users.edit', function (Crumbs $crumbs) {
    $crumbs->parent('admin.users.index');
    $crumbs->push('Edit', route('admin.users.edit'));
});
