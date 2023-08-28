<?php

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

// ***************** Frontend ************************
Route::get('/', 'ComproController@home')->name('home');
Route::get('/tentang-kami', 'ComproController@tentangKami')->name('tentangkami');
Route::get('/program-kami/{nama}','ComproController@programKami')->name('program');
Route::get('/berita','ComproController@beritaKabar')->name('berita');
Route::get('/berita/{nama}','ComproController@detailBerita')->name('detail.berita');
Route::get('/hubungi-kami','ComproController@hubungiKami')->name('hubungi.kami');

//********** Donasi *************
Route::get('/donasi','DonasiController@donasiKonsumen')->name('donasi.konsumen');
Route::get('/donasi/{key}','DonasiController@donasiKonsumenDetail')->name('donasi.konsumen.detail');
Route::get('/donasi/{id}/buat-donasi','DonasiController@buatDonasiKonsumen')->name('donasi.konsumen.buat_donasi');
Route::post('/donasi/submit-donasi','DonasiController@submitDonasi')->name('donasi.submitdonasi');
Route::get('/donasi/result/callback','DonasiController@donasiCallback')->name('donasi.callbackdonasi.get');

// ***************** End of Frontend ************************

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();

	Route::group(['middleware' => ['admin.user']], function () {
	    // ***************** Donasi **********************
		Route::get('/donasi', 'DonasiController@index')->name('donasi.index');
		Route::get('/buat-donasi','DonasiController@buatDonasi')->name('donasi.buat_donasi');
		Route::post('/save-donasi','DonasiController@simpanDonasi')->name('donasi.save');
		Route::get('/donasi/detail/{id}','DonasiController@detailDonasi')->name('donasi.detail_data');
		Route::get('/donasi/edit/{id}','DonasiController@editDonasi')->name('donasi.edit_data');
		Route::get('/donasi/nonaktif/{id}/{param}','DonasiController@nonaktifDonasi')->name('donasi.nonaktif');
		
		Route::get('/donasi/tambah-detail-kabar/{id}','DonasiController@tambahKabarDonasi')->name('donasi.kabar.tambah');
		Route::get('/donasi/ubah-detail-kabar/{id}/{id_kabar}','DonasiController@ubahKabarDonasi')->name('donasi.kabar.ubah');
		Route::post('/donasi/detail/save-kabar','DonasiController@simpanKabarDonasi')->name('donasi.kabar.save');
	});
});
