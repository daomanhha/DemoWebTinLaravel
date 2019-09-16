<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TheLoai;
use App\LoaiTin;
use App\TinTuc;

class tinTucController extends Controller
{
    public function getItem(){
    	$tintucs = TinTuc::all();
        return view('admin.tintuc.hienthi',['tintucs'=>$tintucs]);
    }
    public function getthem(){
        $theloai = TheLoai::all();
    	return view('admin.tintuc.them',['theloais'=>$theloai]);
    }
    public function getajax(Request $req){
        $loaitins = LoaiTin::where('idTheLoai',$req->id)->get();
        if(count($loaitins) > 0){
            foreach ($loaitins as $loaitin) {
            echo '<option value="'.$loaitin->id.'">'.$loaitin->Ten.'</option>';
          }
        }
        else echo '<option value="">Mời chọn thể loại</option>';

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
        $tintuc = TinTuc::find($id);
        $tintuc->delete();
        return redirect('admin/loaitin/hienthi')->with('thongbao', 'Bạn đã xóa thành công');
    }

}
