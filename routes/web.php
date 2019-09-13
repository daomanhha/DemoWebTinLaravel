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
Route::group(['prefix' => 'admin'],function(){
	Route::group(['prefix' => 'theloai'],function(){
		//admin/theloai/hienthi
		Route::get('hienthi','theLoaiController@getItem')->name('theloai_hienthi');
		Route::get('them','theLoaiController@getthem');
		Route::post('them','theLoaiController@postthem')->name('theloai_post');
	});
});
