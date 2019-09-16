<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TheLoai;
use App\LoaiTin;
use App\TinTuc;
use Illuminate\Support\Str;

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
            'TheLoai' => 'required',
            'LoaiTin' => 'required',
            'tieude' => 'required|min:3|max:100',
            'tomtat' => 'required|min:3'
        ],
        [
            'TheLoai.required'=> 'Mời bạn chọn thể loại',
            'LoaiTin.required' => 'Mời bạn chọn loại tin',
            'tieude.required' => 'Mời bạn nhập tiêu đề',
            'tomtat.required' => 'Mời bạn nhập tóm tắt',
            'tieude.min'=> 'tiêu đề lớn hơn 3 ký tự',
            'tomtat.min' => 'tóm tắt lớn hơn 3 ký tự'
        ]);
        $tintuc = new TinTuc;
        $tintuc->TieuDe = $req->tieude;
        $tintuc->TieuDeKhongDau = $req->tieude;
        $tintuc->TomTat = $req->tomtat;
        $tintuc->NoiDung = $req->tomtat;
        $tintuc->idLoaiTin = $req->LoaiTin;
        if($req->hasFile('img')){
            $file = $req->file('img');
            $name = $file->getClientOriginalName();
            $ten = Str::random(4).'_'.$name;
            while(file_exists('upload/tintuc/'.$ten)){
                $ten = Str::random(4).'_'.$name;
            }
            $file->move(
                'upload/tintuc',
                $ten);
            $tintuc->Hinh = $ten;
        }else{
            $tintuc->Hinh = "";
        }
        $tintuc->NoiBat = $req->rdoStatus;
        $tintuc->SoLuotXem = 0;
        $tintuc->save();
        return redirect('admin/tintuc/them')->with('thongbao', 'Bạn đã thêm thành công');
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
        return redirect('admin/tintuc/hienthi')->with('thongbao', 'Bạn đã xóa thành công');
    }

}
