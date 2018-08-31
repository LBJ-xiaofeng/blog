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


//登陆页面
Route::get('/admin/login', 'AdminController@login');

//登陆操作
Route::post('/admin/login', 'AdminController@dologin');



//后台路由
Route::group(['middleware'=>'admin'],function(){
	//后台首页
	Route::get('/admin', 'AdminController@index');

	//后台设置
	Route::get('/admin/setting', 'AdminController@setting');

	//用户管理
	Route::resource('user', 'UserController');

	//文章
	Route::resource('article', 'ArticleController');

	//标签
	Route::resource('tag', 'TagController');

	//分类
	Route::resource('cate','CateController');

	//友情链接
	Route::resource('link','LinkController');


	Route::post('/admin/setting', 'AdminController@update');


	Route::get('/admin/logout', 'AdminController@logout');

});

//前台首页

Route::get('/', 'HomeControll@index');

//文章列表
Route::get('/articles', 'ArticleController@list');

//关于作者
Route::get('/aboutme', 'UserController@me');

//详情页
Route::get('/{id}.html', 'ArticleController@show');

//留言
Route::get('/welcome', 'HomeController@welcome');




