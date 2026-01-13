<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Tema Dokumen Frontend Route (harus di atas untuk prioritas)
Route::get('/tema-dokumen/{id}/{slug}', 'PublicController@regulasiByTema')->name('tema-dokumen.show');

// V2
Route::get('/v2', 'V2\LandingController@index')->name('v2.landing-page');
Route::get('/faq', 'V2\FaqController@index')->name('v2.faq');
Route::get('/sop', 'V2\SopController@index')->name('v2.sop');
Route::get('/galeri', 'V2\GaleriController@index')->name('v2.galeri');

// Public
Route::get('', 'PublicController@index')->name('index');
Route::get('/visi-misi', 'PublicController@visimisi')->name('visimisi');
Route::get('/tupoksi', 'PublicController@tupoksi')->name('tupoksi');
Route::get('/tim-pengelola', 'PublicController@tim')->name('tim');
Route::get('/sambutan', 'PublicController@sambutan')->name('sambutan');
Route::get('/inovasi', 'PublicController@inovasi')->name('inovasi');
Route::get('/makna-logo', 'PublicController@maknaLogo')->name('makna-logo');
Route::get('/sejarah-banjarbaru', 'PublicController@sejarahbjb')->name('sejarahbjb');
Route::get('/sejarah', 'PublicController@sejarah')->name('sejarah');
Route::get('/sk', 'PublicController@sk')->name('sk');
Route::get('/perwalipengelola', 'PublicController@perwalipengelola')->name('perwalipengelola');
Route::get('/pustaka', 'PublicController@pustaka')->name('pustaka');
Route::get('/susunan-organisasi', 'PublicController@susunanorganisasi')->name('susunanorganisasi');
Route::get('/kontak', 'PublicController@kontak')->name('kontak');
Route::get('/artikel', 'PublicController@artikel')->name('artikel');
Route::get('/pengumuman', 'PublicController@pengumuman')->name('pengumuman');
Route::get('/kegiatan', 'PublicController@kegiatan')->name('kegiatan');
Route::get('/kegiatan/cat/{kategori}', 'PublicController@kegiatan')->name('kegiatan.category');
Route::get('/kegiatan/{id}/{slug}', 'PublicController@kegiatanbyid')->where('slug', '.*');
Route::get('/monograf-hukum', 'PublicController@buku')->name('monograf-hukum');
Route::get('/monograf-hukum/{id}/{slug}', 'PublicController@detailBuku')->name('monograf-hukum.detail');
Route::get('/propemperda', 'PublicController@propemperda')->name('propemperda');

Route::get('/perda', 'PublicController@perda')->name('perda');

Route::get('/perwal', 'PublicController@perwal')->name('perwal');
Route::get('/perwal/{id}/{slug}', 'PublicController@perwal')->name('perwal.detail');

Route::get('/keputusan-wali-kota', 'PublicController@kepWalikota')->name('keputusan-wali-kota');
Route::view('/404', 'pages.404-two')->name('404');
Route::post('/bye', 'Auth\LogoutController@bye')->name('logout.bye');
Route::get('lang/{language}', 'LocalizationController@switch')->name('localization.switch');
Route::get('/sync/jdihsync.php', 'PublicController@sync')->name('sync');

Route::get('/putusanpengadilan-negeri', 'PublicController@putusanNegeri')->name('putusanpengadilan-negeri');
Route::get('/putusanpengadilan-tu-negara', 'PublicController@putusanTU')->name('putusanpengadilan-tu-negara');

Route::get('produk-hukum/{kategori}/{id}/{slug}', 'PublicController@halamanHukum')->name('halaman-hukum');

Route::get('/home/{jenis}/{idjenis}/all/{text}', function ($jenis, $idjenis, $text) {
    return redirect('/' . $jenis . '?s=' . $text . '&det=true');
});

Route::get('/home/{$}/1/all/01 Tahun 2000', 'PublicController@sync')->name('sync.legacy');

// Auth routes - define explicitly before catch-all routes
Route::get('/login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('/login', 'Auth\LoginController@login')->name('login.post');
Route::post('/logout', 'Auth\LoginController@logout')->name('logout');

// Admin
Route::middleware('auth')->group(function () {
    Route::namespace('Admin')->prefix('dashboard')->name('admin.')->group(function () {
        // Dashboard
        Route::get('/', 'DashboardController@index')->name('dashboard');
        Route::get('/profile', 'DashboardController@profile')->name('profile');
        // Roles
        Route::resource('/roles', 'RolesController')->only(['index']);
        // Users
        Route::resource('/users', 'UsersController')->only(['index']);
        // Kategori
        Route::resource('/kategori', 'KategoriController')->only(['index']);
        // Buku
        Route::resource('/buku', 'BukuController')->only(['index']);
        // Halaman
        Route::resource('/halaman', 'HalamanController')->only(['index']);
        // Kegiatan
        Route::resource('/kegiatan', 'KegiatanController')->only(['index']);
        // Propemperda
        Route::resource('/propemperda', 'PropemperdaController')->only(['index']);
        // Perda
        Route::resource('/perda', 'PerdaController')->only(['index']);
        // Perwal
        Route::resource('/perwal', 'PerwalController')->only(['index']);
        // Keputusan Wali Kota
        Route::resource('/kep-walikota', 'KepWalikotaController')->only(['index']);
        // Slide
        Route::resource('/slide', 'SlideController')->only(['index']);
        // Putusan
        Route::resource('/putusan', 'PutusanController')->only(['index']);
        // Jadwal
        Route::resource('/jadwal', 'JadwalController')->only(['index']);
        // Artikel
        Route::resource('/artikel', 'ArtikelController')->only(['index']);
        // Penghargaan
        Route::resource('/penghargaan', 'PenghargaanController')->only(['index']);
        // Relaas
        Route::resource('/relaas', 'RelaasController')->only(['index']);
        // BukuTamu
        Route::resource('/buku-tamu', 'BukuTamuController')->only(['index']);
        // Tema Dokumen
        Route::resource('/tema-dokumen', 'TemaDokumenController')->only(['index']);
        // Faq
        Route::resource('/faq', 'FaqController')->only(['index']);
        // Galeri
        Route::resource('/galeri', 'GaleriController')->only(['index']);
        // Penghargaan V2
        Route::resource('/penghargaan-v2', 'PenghargaanV2Controller')->only(['index']);
        // Relaas V2
        Route::resource('/relaas-v2', 'RelaasV2Controller')->only(['index']);
        // SOP
        Route::resource('/sop', 'SopController')->only(['index']);
        
        // Dashboard catch-all routes (only within /dashboard)
        Route::get('{first}/{second}/{third}', 'RoutingController@thirdLevel')->name('third');
        Route::get('{first}/{second}', 'RoutingController@secondLevel')->name('second');
        Route::get('{any}', 'RoutingController@root')->name('any');
    });
});

// landing
// Route::get('', 'RoutingController@index')->name('index');
