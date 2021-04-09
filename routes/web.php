<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ChangePasswordController;
use App\Models\User;
use App\Models\MultiPic;
use Illuminate\Support\Facades\DB;

Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/', function () {
    $brands = DB::table('brands')->get();
    $abouts = DB::table('home_abouts')->first();
    $images = MultiPic::all();
    return view('home', compact('brands', 'abouts', 'images'));
});

Route::get('/home', function () {
    echo " This is Home Page ";
});

Route::get('/about', function () {
    return view('about');
});

//For Category Route

Route::get('/contact', [ContactController::class, 'index'])->name('con');

Route::get('/category/all', [CategoryController::class, 'AllCat'])->name('all.category');

Route::post('/category/add', [CategoryController::class, 'AddCat'])->name('store.category');

Route::get('/category/edit/{id}', [CategoryController::class, 'Edit']);

Route::post('/category/update/{id}', [CategoryController::class, 'Update']);

Route::get('/softdelete/category/{id}', [CategoryController::class, 'SoftDelete']);

Route::get('/category/restore/{id}', [CategoryController::class, 'Restore']);

Route::get('/pdelete/category/{id}', [CategoryController::class, 'Pdelete']);

// For Brand Route

Route::get('/brand/all', [BrandController::class, 'AllBrand'])->name('all.brand');

Route::post('/brand/add', [BrandController::class, 'AddBrand'])->name('store.brand');

Route::get('/brand/edit/{id}', [BrandController::class, 'Edit']);

Route::post('/brand/update/{id}', [BrandController::class, 'Update']);

Route::get('/brand/delete/{id}', [BrandController::class, 'Delete']);

// Multi Image Route
Route::get('/multi/image', [BrandController::class, 'MultiPic'])->name('multi.image');

Route::post('/multi/add', [BrandController::class, 'StoreImg'])->name('store.image');

// Admin All Route
Route::get('/home/slider', [HomeController::class, 'HomeSlider'])->name('home.slider');

Route::get('/add/slider', [HomeController::class, 'AddSlider'])->name('add.slider');

Route::post('/store/slider', [HomeController::class, 'StoreSlider'])->name('store.slider');

// Home About All Route
Route::get('/home/about', [AboutController::class, 'HomeAbout'])->name('home.about');

Route::get('/add/about', [AboutController::class, 'AddAbout'])->name('add.about');

Route::post('/store/about', [AboutController::class, 'StoreAbout'])->name('store.about');

Route::get('/about/edit/{id}', [AboutController::class, 'EditAbout']);

Route::post('/update/homeabout/{id}', [AboutController::class, 'UpdateAbout']);

Route::get('/about/delete/{id}', [AboutController::class, 'deleteAbout']);

// Portfolio Route
Route::get('/portfolio', [AboutController::class, 'Portfolio'])->name('portfolio');

//Admin Contact Route
Route::get('/admin/contact', [ContactController::class, 'Contact'])->name('admin.contact');

Route::get('/admin/add/contact', [ContactController::class, 'AdminAddContact'])->name('add.contact');

Route::post('/admin/store/contact', [ContactController::class, 'AdminStoreContact'])->name('store.contact');

Route::get('/admin/message', [ContactController::class, 'AdminMessage'])->name('admin.message');

//Home Contact Page Route
Route::get('/contact', [ContactController::class, 'HomeContact'])->name('contact');

Route::post('/contact/form', [ContactController::class, 'ContactForm'])->name('contact.form');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    // $users = User::all();
    // $users = DB::table('users')->get();
    return view('admin.index');
})->name('dashboard');

Route::get('/user/logout', [BrandController::class, 'Logout'])->name('user.logout');

// Change Password and user Profile Route
Route::get('/user/password', [ChangePasswordController::class, 'ChangePassword'])->name('change.password');

Route::post('/password/update', [ChangePasswordController::class, 'UpdatePassword'])->name('password.update');

// User Profile
Route::get('/user/profile', [ChangePasswordController::class, 'ProfileUpdate'])->name('profile.update');

Route::post('/user/profile/update', [ChangePasswordController::class, 'UpdateUserProfile'])->name('update.user.profile');

