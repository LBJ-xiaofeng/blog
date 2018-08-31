<?php

namespace App\Http\Controllers;

use App\Article;
use App\Cate;
use App\Setting;
use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //读取数据库 获取用户数据
        $articles = Article::orderBy('id','desc')
            ->where('title','like', '%'.request()->keywords.'%')
            ->paginate(10);
        //解析模板显示用户数据
        return view('admin.article.index', ['articles'=>$articles]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //读取分类信息
        $cates = Cate::all();

        //读取标签信息
        $tags = Tag::all();

        return view('admin.article.create', [
            'cates'=>$cates,
            'tags' => $tags
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //插入数据
        $article = new Article;

        $article -> title = $request -> title;
        $article -> cate_id = $request -> cate_id;
        $article -> intro = $request -> intro;
        $article -> content = $request -> content;
        $article -> user_id = 1;

        //文件上传
        //检测是否有文件上传
        if ($request->hasFile('image')) {
            $article->image = '/'.$request->image->store('uploads/'.date('Ymd'));
        }

        DB::beginTransaction();

        //插入
        if($article->save()){
            //处理标签
            /**
            foreach ($request->tag_id as $key => $value) {
                DB::table('article_tag')->insert([
                    'article_id'=>$article->id, 
                    'tag_id' => $value
                ]);
            }
             */
            try{
                $res = $article->tags()->sync($request->tag_id);
                DB::commit();
                return redirect('/article')->with('success','添加成功');
            }catch(\Exception $e){
                DB::rollback();
                return back()->with('error','添加失败!');
            }
        }else{
            return back()->with('error','添加失败!');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //读取文章内容
        $article = Article::findOrFail($id);

        //增加阅读数
        $article->views += 1;
        $article -> save();

        //读取分类内容
        $cates = Cate::all();
        // foreach ($cates as $key => $value) {
        //     $cates[$key]->total = DB::table('articles')->where('cate_id', $value->id)->count();
        // }

        //读取标签内容
        $tags = Tag::all();

        //读取推荐文章内容
        $recoms = Article::where('recom','1')->take(8)->orderBy('id','desc')->get();

        //读取阅读排行内容
        $views = Article::orderBy('views','desc')->take(8)->get();

        //上一篇文章
        $prev = Article::where('id','<',$article->id)->orderBy('id','desc')->first();

        //下一篇文章
        $next = Article::where('id','>',$article->id)->orderBy('id','asc')->first();

        //网站设置
        $settings = Setting::first();

        return view('home.article.show', compact('article','cates','tags','recoms','views','prev','next','settings'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $article = Article::findOrFail($id);

        $tags = Tag::all();

        $cates = Cate::all();

        return view('admin.article.edit', compact('article','tags','cates'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //更新数据
        $article = Article::findOrFail($id);

        $article -> title = $request -> title;
        $article -> cate_id = $request -> cate_id;
        $article -> intro = $request -> intro;
        $article -> content = $request -> content;

        //文件上传
        //检测是否有文件上传
        if ($request->hasFile('image')) {
            $article->image = '/'.$request->image->store('uploads/'.date('Ymd'));
        }

        DB::beginTransaction();

        //插入
        if($article->save()){
            try{
                $res = $article->tags()->sync($request->tag_id);
                DB::commit();
                return redirect('/article')->with('success','更新成功');
            }catch(\Exception $e){
                DB::rollback();
                return back()->with('error','更新失败!');
            }
        }else{
            return back()->with('error','更新失败!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $article = Article::findOrFail($id);

        if($article->delete()){
            return back()->with('success','删除成功');
        }else{
            return back()->with('error','删除失败!');
        }
    }
}
