<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TheLoai;

class theLoaiController extends Controller
{
    public function getItem(){
    	$theLoais = TheLoai::all();
    	return view('admin.theloai.hienthi',['theLoais'=>$theLoais]);
    }
    public function getthem(){
    	return view('admin.theloai.them');
    }
    public function postthem(Request $req){
    	$this->validate($req,[
    		'Name' => 'required|min:3|max:100'
    	],
    	[
    		'Name.required' => 'bạn chưa nhập tên',
    		'Name.min' => 'độ dài phải từ 3 - 100',
    		'Name.max' => 'độ dài phải từ 3 - 100'
    	]);
    	//nếu validate sai sẽ về trang trước nó là thêm 1 tham số $errors
    	//nếu validate đúng
    	$newTheloai = new Theloai; //dùng TheLoai bình thường sẽ là cả table TheLoai còn new là tạo 1 TheLoai mới
    	$newTheloai->Ten = $req->Name;
    	$newTheloai->TenKhongDau = $req->Name;
    	$newTheloai->save();
    	return redirect()->route('theloai_post')->with('thanhcong','Đã thêm thành công');
    }	
}
