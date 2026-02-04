<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Origin, Content-Type, Authorization, X-Auth-Token');
header('Access-Control-Allow-Methods: GET, POST, PUT, PATCH, DELETE, HEAD, OPTIONS');

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('login', 'API\AuthController@login')
    ->name('api.login');
Route::post('register', 'API\AuthController@register')->name('api.register');
// Public fetch
Route::post('client-download', 'PublicController@addDownloaded')->name('client-download');
Route::post('buku/publicfetch', 'API\BukuController@publicfetch')->name('api.buku.publicfetch');
Route::post('propemperda/publicfetch', 'API\PropemperdaController@publicfetch')->name('api.propemperda.publicfetch');
Route::post('perda/publicfetch', 'API\PerdaController@publicfetch')->name('api.perda.publicfetch');
Route::post('perwal/publicfetch', 'API\PerwalController@publicfetch')->name('api.perwal.publicfetch');
Route::post('keputusan-wali-kota/publicfetch', 'API\KepWalikotaController@publicfetch')->name('api.kep-walikota.publicfetch');
Route::post('putusanpengadilan-negeri/publicfetch', 'API\PutusanController@publicfetch')->name('api.putusan.publicfetch');
Route::post('putusanpengadilan-tu-negara/publicfetch', 'API\PutusanController@publicfetchtu')->name('api.putusan.publicfetchtu');
Route::post('artikel/publicfetch', 'API\ArtikelController@publicfetch')->name('api.artikel.publicfetch');
Route::get('skm', 'API\SkmController@publicfetch')->name('api.skm.publicfetch');
Route::post('skm', 'API\SkmController@store')->name('api.skm');
Route::get('galeri', 'API\GaleriController@publicfetch')->name('api.galeri.publicfetch');

// Kecamatan - Public Routes
Route::get('kecamatan', 'API\KecamatanController@index')->name('api.kecamatan.index');

// Kelurahan Sadar Hukum - Public Routes
Route::get('kelurahan-sadar-hukum', 'API\KelurahanSadarHukumController@index')->name('api.kelurahan-sadar-hukum.index');
Route::get('kelurahan-sadar-hukum/map', 'API\KelurahanSadarHukumController@getMapData')->name('api.kelurahan-sadar-hukum.map');
Route::get('kelurahan-sadar-hukum/{id}', 'API\KelurahanSadarHukumController@show')->name('api.kelurahan-sadar-hukum.show');
Route::get('kelurahan-sadar-hukum/{id}/agenda', 'API\KelurahanSadarHukumController@getAgenda')->name('api.kelurahan-sadar-hukum.agenda');
Route::get('kelurahan-sadar-hukum/{id}/infografis', 'API\KelurahanSadarHukumController@getInfografis')->name('api.kelurahan-sadar-hukum.infografis');

// Route pembersihan cover buku
Route::get('buku/clean-covers', 'API\BukuController@cleanCoverPaths')->name('buku.clean-covers');

// Chat AI Routes
Route::post('chat/message', 'API\ChatController@ask')->name('api.chat.message');
Route::get('chat/examples', 'API\ChatController@getExamples')->name('api.chat.examples');

// Tema Dokumen Routes
Route::get('tema-dokumen', 'API\TemaDokumenController@index')->name('api.tema-dokumen.index');
Route::get('tema-dokumen/active', 'API\TemaDokumenController@getActive')->name('api.tema-dokumen.active');
Route::get('tema-dokumen/{id}', 'API\TemaDokumenController@show')->name('api.tema-dokumen.show');
Route::get('tema-dokumen/slug/{slug}', 'API\TemaDokumenController@temaWithRegulasiBySlug');
Route::get('tema-dokumen/{id}/regulasi', 'API\TemaDokumenController@getRegulasiByTema')->name('api.tema-dokumen.regulasi');

// Regulasi Tema Routes
Route::get('regulasi/{id}/tema', 'API\RegulasiTemaController@show');
Route::post('regulasi/{id}/tema', 'API\RegulasiTemaController@update');

Route::middleware('auth.api.or.web')->group(function () {
    Route::name('api.')->group(function () {
        // Auth
        Route::post('changepassword', 'API\AuthController@changePassword')->name('changepassword');
        Route::post('logout', 'API\AuthController@logout')->name('logout');

        // Roles
        Route::post('roles/fetch', 'API\RolesController@fetch')->name('roles.fetch');
        Route::resource('roles', 'API\RolesController')->only(['store', 'edit', 'update', 'destroy']);

        // Users
        Route::post('users/fetch', 'API\UsersController@fetch')->name('users.fetch');
        Route::resource('users', 'API\UsersController')->only(['store', 'edit', 'update', 'destroy']);

        // Kategori
        Route::post('kategori/fetch', 'API\KategoriController@fetch')->name('kategori.fetch');
        Route::resource('kategori', 'API\KategoriController')->only(['store', 'edit', 'update', 'destroy']);

        // Buku
        Route::post('buku/fetch', 'API\BukuController@fetch')->name('buku.fetch');
        Route::resource('buku', 'API\BukuController')->only(['store', 'edit', 'update', 'destroy']);

        // Halaman
        Route::post('halaman/fetch', 'API\HalamanController@fetch')->name('halaman.fetch');
        Route::resource('halaman', 'API\HalamanController')->only(['store', 'edit', 'update', 'destroy']);

        // Kegiatan
        Route::post('kegiatan/fetch', 'API\KegiatanController@fetch')->name('kegiatan.fetch');
        Route::resource('kegiatan', 'API\KegiatanController')->only(['store', 'edit', 'update', 'destroy']);

        // Propemperda
        Route::post('propemperda/fetch', 'API\PropemperdaController@fetch')->name('propemperda.fetch');
        Route::resource('propemperda', 'API\PropemperdaController')->only(['store', 'edit', 'update', 'destroy']);

        // Perda
        Route::post('perda/fetch', 'API\PerdaController@fetch')->name('perda.fetch');
        Route::get('perda/searchforuc', 'API\PerdaController@searchforuc')->name('perda.searchforuc');
        Route::get('perda/{id}/edituc', 'API\PerdaController@edituc')->name('perda.edituc');
        Route::put('perda/updateuc', 'API\PerdaController@updateuc')->name('perda.updateuc');
        Route::resource('perda', 'API\PerdaController')->only(['store', 'edit', 'update', 'destroy']);

        // Perwal
        Route::post('perwal/fetch', 'API\PerwalController@fetch')->name('perwal.fetch');
        Route::get('perwal/searchforuc', 'API\PerwalController@searchforuc')->name('perwal.searchforuc');
        Route::get('perwal/{id}/edituc', 'API\PerwalController@edituc')->name('perwal.edituc');
        Route::put('perwal/updateuc', 'API\PerwalController@updateuc')->name('perwal.updateuc');
        Route::resource('perwal', 'API\PerwalController')->only(['store', 'edit', 'update', 'destroy']);

        // Keputusan Walikota
        Route::post('kep-walikota/fetch', 'API\KepWalikotaController@fetch')->name('kep-walikota.fetch');
        Route::get('kep-walikota/searchforuc', 'API\KepWalikotaController@searchforuc')->name('kep-walikota.searchforuc');
        Route::get('kep-walikota/{id}/edituc', 'API\KepWalikotaController@edituc')->name('kep-walikota.edituc');
        Route::put('kep-walikota/updateuc', 'API\KepWalikotaController@updateuc')->name('kep-walikota.updateuc');
        Route::resource('kep-walikota', 'API\KepWalikotaController')->only(['store', 'edit', 'update', 'destroy']);

        // Putusan
        Route::post('putusan/fetch', 'API\PutusanController@fetch')->name('putusan.fetch');
        Route::get('putusan/searchforuc', 'API\PutusanController@searchforuc')->name('putusan.searchforuc');
        Route::get('putusan/{id}/edituc', 'API\PutusanController@edituc')->name('putusan.edituc');
        Route::put('putusan/updateuc', 'API\PutusanController@updateuc')->name('putusan.updateuc');
        Route::resource('putusan', 'API\PutusanController')->only(['store', 'edit', 'update', 'destroy']);

        // Artikel
        Route::post('artikel/fetch', 'API\ArtikelController@fetch')->name('artikel.fetch');
        Route::resource('artikel', 'API\ArtikelController')->only(['store', 'edit', 'update', 'destroy']);

        // Slide
        Route::post('slide/fetch', 'API\SlideController@fetch')->name('slide.fetch');
        Route::resource('slide', 'API\SlideController')->only(['store', 'edit', 'update', 'destroy']);

        // Jadwal
        Route::post('jadwal/fetch', 'API\JadwalController@fetch')->name('jadwal.fetch');
        Route::resource('jadwal', 'API\JadwalController')->only(['store', 'edit', 'update', 'destroy']);

        // Tema Dokumen - Admin routes
        Route::post('tema-dokumen/fetch', 'API\TemaDokumenController@fetch')->name('tema-dokumen.fetch');
        Route::post('tema-dokumen/link-regulasi', 'API\TemaDokumenController@linkRegulasiToTema')->name('tema-dokumen.link-regulasi');
        Route::post('tema-dokumen/unlink-regulasi', 'API\TemaDokumenController@unlinkRegulasiFromTema')->name('tema-dokumen.unlink-regulasi');
        Route::resource('tema-dokumen', 'API\TemaDokumenController')->only(['store', 'update', 'destroy']);

        // Faq
        Route::post('faq/fetch', 'API\FaqController@fetch')->name('faq.fetch');
        Route::resource('faq', 'API\FaqController')->only(['store', 'edit', 'update', 'destroy']);

        // Galeri
        Route::post('galeri/fetch', 'API\GaleriController@fetch')->name('galeri.fetch');
        Route::resource('galeri', 'API\GaleriController')->only(['store', 'edit', 'update', 'destroy']);

        // Penghargaan V2
        Route::post('penghargaanV2/fetch', 'API\PenghargaanV2Controller@fetch')->name('penghargaanV2.fetch');
        Route::resource('penghargaanV2', 'API\PenghargaanV2Controller')->only(['store', 'edit', 'update', 'destroy']);

        // Relaas V2
        Route::post('relaasV2/fetch', 'API\RelaasV2Controller@fetch')->name('relaasV2.fetch');
        Route::resource('relaasV2', 'API\RelaasV2Controller')->only(['store', 'edit', 'update', 'destroy']);

        // SOP
        Route::post('sop/fetch', 'API\SopController@fetch')->name('sop.fetch');
        Route::resource('sop', 'API\SopController')->only(['store', 'edit', 'update', 'destroy']);

        // Kelurahan Sadar Hukum - Admin Routes
        Route::post('kelurahan-sadar-hukum/fetch', 'API\KelurahanSadarHukumController@fetch')->name('kelurahan-sadar-hukum.fetch');
        Route::post('kelurahan-sadar-hukum/upload-infografis', 'API\KelurahanSadarHukumController@uploadInfografis')->name('kelurahan-sadar-hukum.upload-infografis');
        Route::delete('kelurahan-sadar-hukum/infografis/{id}', 'API\KelurahanSadarHukumController@deleteInfografis')->name('kelurahan-sadar-hukum.delete-infografis');
        Route::resource('kelurahan-sadar-hukum', 'API\KelurahanSadarHukumController')->only(['store', 'edit', 'update', 'destroy']);
    });
});
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});