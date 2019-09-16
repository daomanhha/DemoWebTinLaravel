<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TheLoai;
use App\LoaiTin;

class loaiTinController extends Controller
{
    public function getItem(){
    	$loaitin = LoaiTin::all();
        return view('admin.loaitin.hienthi',['Loaitins'=>$loaitin]);
    }
    public function getthem(){
        $theloai = TheLoai::all();
    	return view('admin.loaitin.them',['theloais'=>$theloai]);
    }
    public function postthem(Request $req){
        $this->validate($req,[
            'loaitin' => 'required|unique:LoaiTin,Ten|min:3|max:100',
            'idTheLoai' => 'required' 
        ],
        [
            'loaitin.required' => 'Bạn chưa nhập loại tin',
            'loaitin.unique' => 'Đã tồn tại loại tin',
            'loaitin.max' => 'từ 3 - 100 ký tự',
            'loaitin.min' => 'từ 3 - 100 ký tự',
            'idTheLoai.required' => 'Chưa chọn thể loại'
        ]);
        $loaitin = new LoaiTin;
        $loaitin->Ten = $req->loaitin;
        $loaitin->TenKhongDau = $req->loaitin;
        $loaitin->idTheLoai = $req->idTheLoai;
        $loaitin->save();
        return redirect('admin/loaitin/them')->with('thongbao', 'Bạn đã thêm thành công');
    }
    public function getsua($id){
    	$loaitin = LoaiTin::find($id);
        $theloai = $loaitin->theloai;
        $theloais = TheLoai::all();
        return view('admin.loaitin.sua',
            ['loaitin' => $loaitin,
            'theloai' => $theloai,
            'theloais' => $theloais]);
    }
    public function postsua(Request $req, $id){
    	$this->validate($req,[
            'loaitin' => 'required|unique:LoaiTin,Ten|min:3|max:100', 
        ],
        [
            'loaitin.required' => 'Bạn chưa nhập loại tin',
            'loaitin.unique' => 'Đã tồn tại loại tin',
            'loaitin.max' => 'từ 3 - 100 ký tự',
            'loaitin.min' => 'từ 3 - 100 ký tự',
        ]);
        $loaitin = LoaiTin::find($id);
        $loaitin->Ten = $req->loaitin;
        $loaitin->TenKhongDau = $req->loaitin;
        $loaitin->idTheLoai = $req->idTheLoai;
        $loaitin->save();
        return redirect('admin/loaitin/hienthi')->with('thongbao', 'Bạn đã sửa thành công');
    }
    public function delete($id){
        $loaitin = LoaiTin::find($id);
        $loaitin->delete();
        return redirect('admin/loaitin/hienthi')->with('thongbao', 'Bạn đã xóa thành công');
    }

}
