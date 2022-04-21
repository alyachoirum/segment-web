<?php

use App\Http\Controllers\Api\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\DepartemenController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostAuthController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\Auth\ForgotPasswordController;

use App\Http\Controllers\TestGenerateSchedulShiftController;

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

Route::get('/', [HomeController::class, 'landing_page'])->name('landing_page');

Route::get('/login_absensi', function () {
    return view('auth.login');
})->name('login_absensi');

Route::get('/lupa_password', function () {
    return view('auth.lupa_password');
})->name('lupa_password');

Route::post('postauth', [PostAuthController::class, 'postauth'])->name('postauth');
Route::get('reset_password', [PostAuthController::class, 'reset_password'])->name('reset_password');
Route::get('buat_password_baru', [PostAuthController::class, 'buat_password_baru'])->name('buat_password_baru');
Route::get('logout', [PostAuthController::class, 'logout'])->name('logout');

Route::post('forget-password', [ForgotPasswordController::class, 'submitForgetPasswordForm'])->name('forget.password.post');
Route::get('reset-password/{token}', [ForgotPasswordController::class, 'showResetPasswordForm'])->name('reset.password.get');
Route::post('reset-password', [ForgotPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post');

Route::get('/offline', function () {
    return view('offline');
});

// 1-SuperAdmin
// 2-VP
// 3-AVP
// 4-SPV
// 5-STAFF
// 6-FOREMAN
// 7-KAJAGA
// 8-SATPAM
// 9-SECURITY
// 10-PAMTUP
// 11-ADMIN
// 12-ADMIN APLIKASI


Route::group(['middleware' => ['auth', 'sesionMiddleware:1,2,3,4,5,6,7,8,9,10,11,12']], function () {

    //DASHBOARD
    Route::get('/dashboard_karyawan', [HomeController::class, 'dashboard_karyawan'])->name('dashboard_karyawan');

    //HEADER
    Route::get('/profile/{id_user}', [UserController::class, 'data_profile'])->name('data_profile'); //DONE
    Route::get('/profile_detail/{id_user}', [UserController::class, 'profile_detail'])->name('profile_detail'); //DONE
    Route::post('/profile_edit/{id_user}', [UserController::class, 'profile_edit'])->name('profile_edit'); //DONE
    Route::get('/change_password/{id_user}', [UserController::class, 'change_password'])->name('change_password'); //DONE
    Route::post('/change/password',  [UserController::class,'changePassword'])->name('profile.change.password');

    Route::get('/notifikasi/{id_user}', [UserController::class, 'notifikasi'])->name('notifikasi'); //DONE
    Route::post('/get_notifikasi', [UserController::class, 'get_notifikasi'])->name('get_notifikasi');
    Route::get('/find_notif', [UserController::class, 'find_notif'])->name('find_notif');

    //DATA AUTOFIELD
    Route::post('/data_autofield/{id}', [AbsensiController::class, 'data_autofield'])->name('data_autofield'); //DONE

    //DATA JADWAL TUKAR
    Route::post('/get_jadwal_tukar', [AbsensiController::class, 'get_jadwal_tukar'])->name('get_jadwal_tukar');

    Route::get('/list_presensi', [AbsensiController::class, 'list_presensi'])->name('list_presensi');
    Route::get('/detail_presensi/{id_bulan}', [AbsensiController::class, 'detail_presensi'])->name('detail_presensi');

    Route::post('/data_presensi_karyawan', [AbsensiController::class, 'data_presensi_karyawan'])->name('data_presensi_karyawan');
    Route::get('/data_presensi_karyawan_all/{id_bulan}', [AbsensiController::class, 'data_presensi_karyawan_all'])->name('data_presensi_karyawan_all');
    Route::get('/detail_presensi_karyawan_all', [AbsensiController::class, 'detail_presensi_karyawan_all'])->name('detail_presensi_karyawan_all');
    Route::get('/absensi_karyawan_print', [AbsensiController::class, 'absensi_karyawan_print'])->name('absensi_karyawan_print');

    //KEHADIRAN
    Route::get('/kehadiran', [AbsensiController::class, 'kehadiran'])->name('kehadiran');
    Route::get('/form_masuk/{nik}', [AbsensiController::class, 'form_masuk'])->name('form_masuk'); //DONE
    Route::post('/check_in', [AbsensiController::class, 'check_in'])->name('check_in');
    Route::get('/form_keluar', [AbsensiController::class, 'form_keluar'])->name('form_keluar');
    Route::get('/check_out/{id_presensi}', [AbsensiController::class, 'check_out'])->name('check_out');

    //ABSEN TIDAK MASUK
    Route::get('/absen', [AbsensiController::class, 'absen'])->name('absen');
    Route::get('/form_ijin/{nik}', [AbsensiController::class, 'form_ijin'])->name('form_ijin');//DONE
    Route::post('/ijin_submit', [AbsensiController::class, 'ijin_submit'])->name('ijin_submit');
    Route::get('/form_dispensasi/{nik}', [AbsensiController::class, 'form_dispensasi'])->name('form_dispensasi');//DONE
    Route::post('/dispensasi_submit', [AbsensiController::class, 'dispensasi_submit'])->name('dispensasi_submit');
    Route::get('/form_cuti/{nik}', [AbsensiController::class, 'form_cuti'])->name('form_cuti');//DONE
    Route::post('/cuti_submit', [AbsensiController::class, 'cuti_submit'])->name('cuti_submit');
    Route::get('/form_sakit/{nik}', [AbsensiController::class, 'form_sakit'])->name('form_sakit');//DONE
    Route::post('/sakit_submit', [AbsensiController::class, 'sakit_submit'])->name('sakit_submit');

    //PENGAJUAN
    Route::get('/pengajuan', [AbsensiController::class, 'pengajuan'])->name('pengajuan');
    Route::get('/list_pengajuan', [AbsensiController::class, 'list_pengajuan'])->name('list_pengajuan');
    Route::get('/form_tukar_shift/{nik}', [AbsensiController::class, 'form_tukar_shift'])->name('form_tukar_shift');
    Route::post('/tukar_shift_submit', [AbsensiController::class, 'tukar_shift_submit'])->name('tukar_shift_submit');
    Route::get('/form_lembur/{nik}', [AbsensiController::class, 'form_lembur'])->name('form_lembur');
    Route::post('/lembur_submit', [AbsensiController::class, 'lembur_submit'])->name('lembur_submit');
    Route::get('/form_lembur_khusus/{nik}', [AbsensiController::class, 'form_lembur_khusus'])->name('form_lembur_khusus');
    Route::post('/lembur_khusus_submit', [AbsensiController::class, 'lembur_khusus_submit'])->name('lembur_khusus_submit');


    //LIST DAN APPROVE DATA ABSEN TIDAK MASUK
    Route::get('/list_absen_tidakmasuk', [AbsensiController::class, 'list_absen_tidakmasuk'])->name('list_absen_tidakmasuk');
    Route::get('/data_absen_sudah_valid', [AbsensiController::class, 'data_absen_sudah_valid'])->name('data_absen_sudah_valid');
    Route::get('/data_absen_reject', [AbsensiController::class, 'data_absen_reject'])->name('data_absen_reject');
    Route::get('/detail_absen/{id_absensi}', [AbsensiController::class, 'detail_absen'])->name('detail_absen');
    Route::get('/approve_tidak_masuk/{id}', [AbsensiController::class, 'approve_tidak_masuk'])->name('approve_tidak_masuk');
    Route::get('/reject_tidak_masuk/{id}', [AbsensiController::class, 'reject_tidak_masuk'])->name('reject_tidak_masuk');


    //LIST DAN APPROVE DATA LEMBUR SPL
    Route::get('/list_lembur', [AbsensiController::class, 'list_lembur'])->name('list_lembur');
    Route::get('/data_lembur_sudah_valid', [AbsensiController::class, 'data_lembur_sudah_valid'])->name('data_lembur_sudah_valid');
    Route::get('/data_lembur_reject', [AbsensiController::class, 'data_lembur_reject'])->name('data_lembur_reject');
    Route::get('/detail_lembur/{id_lembur}', [AbsensiController::class, 'detail_lembur'])->name('detail_lembur');
    Route::get('/approve_lembur/{id}', [AbsensiController::class, 'approve_lembur'])->name('approve_lembur');
    Route::get('/reject_lembur/{id}', [AbsensiController::class, 'reject_lembur'])->name('reject_lembur');


    //LIST DAN APPROVE DATA LEMBUR KHUSUS
    Route::get('/list_lembur_khusus', [AbsensiController::class, 'list_lembur_khusus'])->name('list_lembur_khusus');
    Route::get('/data_lembur_khusus_sudah_valid', [AbsensiController::class, 'data_lembur_khusus_sudah_valid'])->name('data_lembur_khusus_sudah_valid');
    Route::get('/data_lembur_khusus_reject', [AbsensiController::class, 'data_lembur_khusus_reject'])->name('data_lembur_khusus_reject');
    Route::get('/detail_lembur_khusus/{id_lembur_khusus}', [AbsensiController::class, 'detail_lembur_khusus'])->name('detail_lembur_khusus');
    Route::get('/approve_lembur_khusus/{id}', [AbsensiController::class, 'approve_lembur_khusus'])->name('approve_lembur_khusus');
    Route::get('/reject_lembur_khusus/{id}', [AbsensiController::class, 'reject_lembur_khusus'])->name('reject_lembur_khusus');


    //LIST DAN APPROVE DATA TUKAR SHIFT
    Route::get('/list_tukar_shift', [AbsensiController::class, 'list_tukar_shift'])->name('list_tukar_shift');
    Route::get('/data_tukar_shift_sudah_valid', [AbsensiController::class, 'data_tukar_shift_sudah_valid'])->name('data_tukar_shift_sudah_valid');
    Route::get('/data_tukar_shift_reject', [AbsensiController::class, 'data_tukar_shift_reject'])->name('data_tukar_shift_reject');
    Route::get('/detail_tukar_shift/{id_tukar_shift}', [AbsensiController::class, 'detail_tukar_shift'])->name('detail_tukar_shift');
    Route::get('/approve_tukar_shift/{id}', [AbsensiController::class, 'approve_tukar_shift'])->name('approve_tukar_shift');
    Route::get('/reject_tukar_shift/{id}', [AbsensiController::class, 'reject_tukar_shift'])->name('reject_tukar_shift');

    //DATA AKUN USER
    Route::get('/akun_super_admin', [UserController::class, 'data_super_admin'])->name('data_super_admin');
    Route::get('/akun_vp', [UserController::class, 'data_vp'])->name('data_vp');
    Route::get('/akun_avp', [UserController::class, 'data_avp'])->name('data_avp');
    Route::get('/akun_supervisor', [UserController::class, 'data_supervisor'])->name('data_supervisor');
    Route::get('/akun_staff', [UserController::class, 'data_staff'])->name('data_staff');
    Route::get('/akun_foreman', [UserController::class, 'data_foreman'])->name('data_foreman');
    Route::get('/akun_kajaga', [UserController::class, 'data_kajaga'])->name('data_kajaga');
    Route::get('/akun_satpam', [UserController::class, 'data_satpam'])->name('data_satpam');
    Route::get('/akun_security', [UserController::class, 'data_security'])->name('data_security');
    Route::get('/akun_pamtup', [UserController::class, 'data_pamtup'])->name('data_pamtup');
    Route::get('/data_admin', [UserController::class, 'data_admin'])->name('data_admin');


    Route::post('/edit_user/{id_user}', [UserController::class, 'edit_user'])->name('edit_user');
    Route::get('/delete_user/{id_user}', [UserController::class, 'delete_user'])->name('delete_user');

    // Route::get('/akun_kepala_bagian', [UserController::class, 'data_kepala_bagian'])->name('data_kepala_bagian');
    // Route::get('/akun_kepala_seksi', [UserController::class, 'data_kepala_seksi'])->name('data_kepala_seksi');
    // Route::get('/akun_kepala_regu', [UserController::class, 'data_kepala_regu'])->name('data_kepala_regu');
    // Route::get('/akun_pelaksana', [UserController::class, 'data_pelaksana'])->name('data_pelaksana');


    //CRUD KATEGORI
    Route::get('/informasi_kategori', [KategoriController::class, 'data_kategori'])->name('data_kategori');
    Route::post('/tambah_kategori', [KategoriController::class, 'tambah_kategori'])->name('tambah_kategori');
    Route::post('/edit_kategori/{id_kategori}', [KategoriController::class, 'edit_kategori'])->name('edit_kategori');
    Route::get('/delete_kategori/{id_kategori}', [KategoriController::class, 'delete_kategori'])->name('delete_kategori');

    //CRUD DEPARTEMEN / UNIT KERJA
    Route::get('/informasi_departemen', [DepartemenController::class, 'data_departemen'])->name('data_departemen');
    Route::post('/tambah_departemen', [DepartemenController::class, 'tambah_departemen'])->name('tambah_departemen');
    Route::post('/edit_departemen/{id_departemen}', [DepartemenController::class, 'edit_departemen'])->name('edit_departemen');
    Route::get('/delete_departemen/{id_departemen}', [departemenController::class, 'delete_departemen'])->name('delete_departemen');

    Route::get('/data_karyawan', [AbsensiController::class, 'data_karyawan'])->name('data_karyawan');
    Route::post('/data_karyawan_filter', [AbsensiController::class, 'data_karyawan_filter'])->name('data_karyawan_filter');
    Route::post('/tambah_data_karyawan', [AbsensiController::class, 'tambah_data_karyawan'])->name('tambah_data_karyawan');

    Route::get('/data_jadwal', [AbsensiController::class, 'data_jadwal'])->name('data_jadwal');
    Route::get('/data_jadwal_karyawan/{id_regu}', [AbsensiController::class, 'data_jadwal_karyawan'])->name('data_jadwal_karyawan');

    Route::get('/dokumen', [AbsensiController::class, 'dokumen'])->name('dokumen');

    // MODUl LAPORAN
    Route::get('/laporan_publish', [LaporanController::class, 'data_laporan_publish'])->name('data_laporan_publish');
    Route::get('/detail_laporan/{id_laporan}', [LaporanController::class, 'detail_laporan'])->name('detail_laporan');

    Route::get('/tambah_data_laporan', [LaporanController::class, 'tambah_data_laporan'])->name('tambah_data_laporan');
    Route::get('/data_semua_laporan', [LaporanController::class, 'data_semua_laporan'])->name('data_semua_laporan');
    Route::get('/data_laporan_proses1', [LaporanController::class, 'data_laporan_proses1'])->name('data_laporan_proses1');
    Route::get('/data_laporan_proses2', [LaporanController::class, 'data_laporan_proses2'])->name('data_laporan_proses2');
    Route::get('/data_laporan_proses3', [LaporanController::class, 'data_laporan_proses3'])->name('data_laporan_proses3');
    Route::get('/data_laporan_selesai', [LaporanController::class, 'data_laporan_selesai'])->name('data_laporan_selesai');

    Route::get('/approve_laporan/{id}', [LaporanController::class, 'approval'])->name('approval');

    Route::post('/tambah_laporan', [LaporanController::class, 'tambah_laporan'])->name('tambah_laporan');
    Route::post('/edit_laporan/{id_laporan}', [LaporanController::class, 'edit_laporan'])->name('edit_laporan');
    Route::get('/delete_laporan/{id_laporan}', [LaporanController::class, 'delete_laporan'])->name('delete_laporan');

    Route::get('/data_berita', [BeritaController::class, 'data_berita'])->name('data_berita');
    Route::post('/tambah_berita', [BeritaController::class, 'tambah_berita'])->name('tambah_berita');
    Route::post('/edit_berita/{id_berita}', [BeritaController::class, 'edit_berita'])->name('edit_berita');
    Route::get('/delete_berita/{id_berita}', [BeritaController::class, 'delete_berita'])->name('delete_berita');

    Route::get('/struktur', [AbsensiController::class, 'struktur'])->name('struktur');

});

// 1-SuperAdmin
// 2-VP
// 3-AVP
// 4-SPV
// 5-STAFF
// 6-FOREMAN
// 7-KAJAGA
// 8-SATPAM
// 9-SECURITY
// 10-PAMTUP
// 11-ADMIN
// 12-ADMIN APLIKASI

Route::group(['middleware' => ['auth', 'sesionMiddleware:1,12']], function(){
    Route::get('/tambah_karyawan_excel', [AbsensiController::class, 'tambah_karyawan_excel'])->name('tambah_karyawan_excel');
    Route::post('/tambah_user', [UserController::class, 'tambah_user'])->name('tambah_user');
});

Route::group(['middleware' => ['auth', 'sesionMiddleware:1,2,3,12']], function () {

    Route::get('/list_rekap_zona', [AbsensiController::class, 'list_rekap_zona'])->name('list_rekap_zona');
    Route::post('/list_rekap_zona_filter', [AbsensiController::class, 'list_rekap_zona_filter'])->name('list_rekap_zona_filter');

});

Route::group(['middleware' => ['auth', 'sesionMiddleware:1,7,8,9,10,11']], function () {

});

//SUPER ADMIN VP AVP
Route::group(['middleware' => ['auth', 'sesionMiddleware:1,2,3']], function () {

    Route::get('/dashboard_eksekutif', [HomeController::class, 'dashboard_eksekutif'])->name('dashboard_eksekutif');

});

//SUPER ADMIN VP AVP SPV STAFF FOREMAN KAJAGA PAMTUP ADMIN APLIKASI
Route::group(['middleware' => ['auth', 'sesionMiddleware:1,2,3,4,5,6,7,10,12']], function () {

    Route::get('/dashboard_absensi', [HomeController::class, 'dashboard_absensi'])->name('dashboard_absensi');
    Route::post('/dashboard_absensi_filter', [HomeController::class, 'dashboard_absensi_filter'])->name('dashboard_absensi_filter');
    Route::get('/detail_absen_zona/{id_zona}', [HomeController::class, 'detail_absen_zona'])->name('detail_absen_zona');
    Route::get('/dashboard_laporan', [HomeController::class, 'dashboard_laporan'])->name('dashboard_laporan');

});

Route::group(['middleware' => ['auth', 'sesionMiddleware:2']], function () {

});

Route::group(['middleware' => ['auth', 'sesionMiddleware:3']], function () {
    Route::get('/dashboard_avp', [HomeController::class, 'dashboard_avp'])->name('dashboard_avp');

});

Route::group(['middleware' => ['auth', 'sesionMiddleware:4']], function () {
    Route::get('/dashboard_spv', [HomeController::class, 'dashboard_spv'])->name('dashboard_spv');

});

Route::group(['middleware' => ['auth', 'sesionMiddleware:5']], function () {

});

Route::group(['middleware' => ['auth', 'sesionMiddleware:6']], function () {

});

Route::group(['middleware' => ['auth', 'sesionMiddleware:7']], function () {
    Route::get('/dashboard_kajaga', [HomeController::class, 'dashboard_kajaga'])->name('dashboard_kajaga');
});

Route::group(['middleware' => ['auth', 'sesionMiddleware:8']], function () {

});

Route::group(['middleware' => ['auth', 'sesionMiddleware:8']], function () {

});

Route::group(['middleware' => ['auth', 'sesionMiddleware:9']], function () {

});

Route::group(['middleware' => ['auth', 'sesionMiddleware:10']], function () {

});

Route::group(['middleware' => ['auth', 'sesionMiddleware:11']], function () {

});

Route::group(['middleware' => ['auth', 'sesionMiddleware:12']], function () {

});


Route::post('/tambah_laporan_umum', [LaporanController::class, 'tambah_laporan_umum'])->name('tambah_laporan_umum');

Route::get('/test_gen_shift',[TestGenerateSchedulShiftController::class,'index']);

Route::get('/generate_cuti',[TestGenerateSchedulShiftController::class,'generate_cuti']);


Route::get('maps/android', function () {
    return view('mobile-maps');
});

Route::get('maps/android/absen', [HomeController::class, 'dash_absen'])->name('dash_absen');
Route::get('webview/detail_presensi/{id_bulan}',[AbsensiController::class, 'webview_detail_presensi'])->name('webview_detail_presensi');

Route::get('/lokasi', [LocationController::class, 'lokasi'])->name('lokasi');
