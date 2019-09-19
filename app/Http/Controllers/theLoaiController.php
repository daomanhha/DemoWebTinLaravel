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
    		'Name' => 'required|unique:Theloai,Ten|min:3|max:100'
    	],
    	[
    		'Name.required' => 'bạn chưa nhập tên',
    		'Name.unique' => 'Đã tồn tại thể loại',
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
    public function getsua($id){
    	$theloai = TheLoai::find($id); //trả về 1 obj TheLoai
    	return view('admin.theloai.sua',['theloai' => $theloai]);
    }
    public function postsua(Request $req,$id){
    	$theLoai = TheLoai::find($id);
    	$this->validate($req,[
    		'Name' => 'required |unique:TheLoai,Ten| min : 3 | max : 100' //unique:tênbảngko phan biet hoa thuong,field chú ý dấu cách
    	],
    	[
    		'Name.required'=>'Bạn chưa nhập tên',
    		'Name.unique' => 'Đã tồn tại thể loại',
    		'Name.min' => 'Độ dài từ 3 - 100',
    		'Name.max' => 'Độ dài từ 3 - 100'
    	]);
    	$theLoai->Ten = $req->Name;
    	$theLoai->TenKhongDau = $req->Name;
    	$theLoai->save();

    	return redirect('admin/theloai/sua/'.$theLoai->id)->with('thongbao', 'Sửa thành công');
    }
    public function delete($id){
    	$theloai = TheLoai::find($id);
    	$theloai->delete();
    	return redirect('admin/theloai/hienthi')->with('thongbao','Xóa Thành Công');
    }	
}
