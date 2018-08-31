<?php

namespace App\Http\Controllers;

use App\Setting;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
	/**
	* 后台首页
	*/
	public function index()
	{
		return view('admin');
	}


	/**
	 * 后台设置页面
	 */
	public function setting()
	{
		//读取表中的数据
		$setting = Setting::first();

		return view('admin.setting', compact('setting'));
	}

	/**
	 * 保存设置
	 */
	public function update(Request $request)
	{
		$setting = Setting::first();

		if(!$setting){
			$setting = new Setting;
		}

		$setting -> name = $request->name;
		$setting -> intro = $request->intro;
		$setting -> content = $request->content;
		$setting -> keywords = $request->keywords;
		$setting -> description = $request->description;
		$setting -> title = $request->title;
		$setting -> domain = $request->domain;
		$setting -> qrcode = $request->input('qrcode', 'https://picsum.photos/400/300?image=2');

		if($setting->save()){
			return back()->with('success','设置成功');
		}else{
			return back()->with('error','设置失败!!');
		}
		
	}

	/**
	 * 登陆页面
	 */
	public function login()
	{
		return view('admin.login');
	}

	/**
	 * 登陆操作
	 */
	public function dologin(Request $request)
	{
		//获取用户的数据
		$user = User::where('username', $request->username)->first();

		if(!$user){
			return back()->with('error','登陆失败!');
		}

		//校验密码
		if(Hash::check($request->password, $user->password)){
			//写入session
			session(['username'=>$user->username, 'id'=>$user->id]);
			return redirect('/admin')->with('success','登陆成功');
		}else{
			return back()->with('error','登陆失败!');
		}
	}

	/**
	 * 退出登陆
	 */
	public function logout(Request $request)
	{
		$request->session()->flush();
		return redirect('/admin/login')->with('success','退出成功');
	}
}
