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
use App\TheLoai;
Route::get('/', function () {
    return view('welcome');
});
//test
Route::get('testDb',function(){
	$loaitins = TheLoai::find(1)->loaitin;// trả về 1 mảng gồm các collection(obj LoaiTin)-ứng với mỗi dòng dl của loại tin
	$loaitins2 = TheLoai::where('id',1)->get();//trả về 1 mảng các giá trị TheLoai
	foreach ($loaitins2 as $value) {
		$abc = $value->loaitin;
		foreach ($abc as $loaitin) { //các collection là 1 obj
		echo $loaitin->Ten.'</br>';
		}
	}
	// foreach ($loaitins as $loaitin) { //các collection là 1 obj
	// 	echo $loaitin.'</br>';
	// }
});
Route::get('testDb2',function(){
	$loaiTin = TheLoai::find(1)->loaitin;
	var_dump($loaiTin);
});

Route::get('thu',function(){
	return view('admin.theloai.sua');
});

//group Admin
Route::get('admin/login', 'userController@getLogin');
Route::post('admin/login', 'userController@postLogin');
Route::get('admin/logout', 'userController@Logout');
Route::group(['prefix' => 'admin', 'middleware' => 'authCheck'],function(){
	Route::group(['prefix' => 'theloai'],function(){
		//admin/theloai/hienthi
		Route::get('hienthi','theLoaiController@getItem')->name('theloai_hienthi');
		Route::get('them','theLoaiController@getthem');
		Route::post('them','theLoaiController@postthem')->name('theloai_post');
		Route::get('sua/{id}','theLoaiController@getsua')->name('theloai_getsua');
		Route::post('sua/{id}','theLoaiController@postsua')->name('theloai_postsua');
		Route::get('delete/{id}', 'theLoaiController@delete');
	});
	Route::group(['prefix' => 'loaitin'],function(){
		Route::get('hienthi', 'loaiTinController@getItem');
		Route::get('them', 'loaiTinController@getthem');
		Route::post('them', 'loaiTinController@postthem');
		Route::get('sua/{id}', 'loaiTinController@getsua');
		Route::post('sua/{id}', 'loaiTinController@postsua');
		Route::get('delete/{id}', 'loaiTinController@delete');
	});
	Route::group(['prefix' => 'tintuc'],function(){
		Route::get('hienthi', 'tinTucController@getItem');
		Route::get('them', 'tinTucController@getthem');
		Route::post('them', 'tinTucController@postthem');
		Route::get('sua/{id}', 'tinTucController@getsua');
		Route::post('sua/{id}', 'tinTucController@postsua');
		Route::get('delete/{id}', 'tinTucController@delete');
	});
	Route::group(['prefix' => 'ajax'],function(){
		Route::get('tintuc/{id}', 'tinTucController@getajax');
	});
	Route::group(['prefix' => 'user'],function(){
		Route::get('hienthi', 'userController@getItem');
		Route::get('sua/{id}', 'userController@getsua');
		Route::post('sua/{id}', 'userController@postsua');
		Route::get('them', 'userController@getthem');
		Route::post('them', 'userController@postthem');
	});
});
