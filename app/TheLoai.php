<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TheLoai extends Model
{
    protected $table = 'theloai';
    public function loaitin(){
    	return $this->hasMany('App\LoaiTin', 'idTheLoai', 'id');
    }
 	//kết nối với tin tuc hasManyThrough
    
}
