<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Comment;
use Illuminate\Support\Facades\Auth;

class userController extends Controller
{
   public function getItem(){
       $users = User::all();
       return view('admin.user.hienthi',['users'=>$users]);
   }
   public function getsua($id){
   		return view('admin.user.sua');
   }
   public function getthem(){
   		return view('admin.user.them');
   }
   public function postthem(Request $req){
   		$this->validate($req,[
   			'name' => 'required|min:1|max:100',
   			'email' => 'required|email|unique:users,email',
   			'password' => 'required|min:3|max:100',
   			'repassword' => 'required|same:password'
   		],
   		[
   			'name.required' => 'mời nhập tên',
   			'name.min' => 'độ dài tên từ 1-100',
   			'name.max' => 'độ dài tên từ 1-100',
   			'email.required' => 'mời nhập email',
   			'email.email' => 'không đúng định dạng email',
   			'email.unique' => 'đã trùng email',
   			'password.required' => 'mời nhập pass',
   			'password.min' => 'độ dài password từ 3-100',
   			'password.max' => 'độ dài password từ 3-100',
   			'repassword.required' => 'mời nhập lại password',
   			'repassword.same' => 'password không giống nhau' 
   		]);
   		$user = new User;
   		$user->name = $req->name;
   		$user->email = $req->email;
   		$user->password = bcrypt($req->password);
   		$user->quyen = $req->rdoStatus;
   		$user->save();
   		return redirect('admin/user/them')->with('thongbao','thêm user thành công');
   }
	public function getLogin(){
		return view('admin.Authentication.login');
	}
	public function postLogin(Request $req){
		$this->validate($req,[
			'email' => 'required|email',
			'password' => 'required'
		],
		[	
			'email.required' => 'Mời nhập email',
			'email.email' => 'Không đúng định dạng email',
			'password.required' => 'Mời nhập pass'
		]);
		if(Auth::attempt(['email'=>trim($req->email),'password'=>trim($req->password)])){
			return redirect('admin/theloai/hienthi'); //mật khẩu phải được mã hóa bằng bcrypt()
		}else{
			return redirect('admin/login')->with('thongbaoloi','sai tài khoản hoặc mật khẩu');
		}
	}
	public function Logout(){
		if(Auth::check()){
			Auth::logout();
		}
		return redirect('admin/login');
	}
}	
