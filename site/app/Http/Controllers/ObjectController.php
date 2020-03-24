<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Model\Category;
use App\Model\Item;
class ObjectController extends Controller
{
    public function index(){
        $items          = Item::orderBy('id','desc')->paginate(env('ADMIN_PAGE_SIZE'));
        $categorysTree  = Category::categoryTree(true);
        foreach ($items as &$item){
            $item->category_name = $categorysTree[$item->category_id]['name'];
        }
        return view('admin/item/index',['items'=>$items]);
    }
    public function create(){
        $categorys = Category::orderBy('id','desc')->get();
        return view('admin/item/create',['categorys'=>$categorys,'item_type'=>Item::$item_type]);
    }
    public function store(Request $request){
        $this->validate($request, [
            'category_id'   => 'required',
            'name'          => 'required|max:255',
            'description'   => 'required',
            'type'          => 'required',
            'period_type'   => 'required',
            'order'         => 'required',
        ]);
        $item = new Item;
        $item->suid         = uniqid();
        $item->category_id  = $request->category_id;
        $item->name         = $request->name;
        $item->en_name      = $request->en_name;
        $item->alias_name     = $request->alias_name;
        $item->alias_en_name  = $request->alias_en_name;
        $item->description  = $request->description;
        $item->type         = $request->type;
        $item->period_type  = $request->period_type;
        $item->official_site    = $request->official_site;
        $item->official_update_time  = $request->official_update_time;
        $item->order        = $request->order;
        $item->ext_info     = $request->ext_info;
        $item->seo_title = $request->seo_title;
        $item->seo_keywords = $request->seo_keywords;
        $item->seo_description = $request->seo_description;
        $item->user_id      = $request->user()->id;
        if(!$request->hasFile('cover')){
            $item->cover = 'default.jpg';
        }elseif($request->hasFile('cover') && $request->file('cover')->isValid()){
            $item->cover = $request->cover->store(date("Y").'/'.date("m"));
        }else{
            return redirect()->back()->withInput()->withErrors('图片有误！');
        }
        if ($item->save()) {
            return redirect()->back()->withInput()->withErrors('保存成功！');
            //return redirect('admin/item')->withInput()->withErrors('保存成功！');
        } else {
            return redirect()->back()->withInput()->withErrors('保存失败！');
        }
    }
    public function destroy($id){
        Item::find($id)->delete();
        return redirect()->back()->withInput()->withErrors('删除成功！');
    }

    public function edit($id){
        $categorys = Category::orderBy('order','desc')->get();
        $item      = Item::find($id);
        return view('admin/item/edit',['categorys'=>$categorys,'item'=>$item,'item_type'=>Item::$item_type]);
    }

    public function update(Request $request,$id){
        $this->validate($request, [
            'category_id'   => 'required',
            'name'          => 'required|max:255',
            'description'   => 'required',
            'type'          => 'required',
            'period_type'   => 'required',
            'order'         => 'required',
        ]);

        $item = Item::find($id);
        $item->category_id  = $request->category_id;
        $item->name         = $request->name;
        $item->en_name      = $request->en_name;
        $item->alias_name     = $request->alias_name;
        $item->alias_en_name  = $request->alias_en_name;
        $item->description  = $request->description;
        $item->type         = $request->type;
        $item->period_type  = $request->period_type;
        $item->official_site    = $request->official_site;
        $item->official_update_time  = $request->official_update_time;
        $item->order        = $request->order;
        $item->ext_info     = $request->ext_info;
        $item->seo_title = $request->seo_title;
        $item->seo_keywords = $request->seo_keywords;
        $item->seo_description = $request->seo_description;
        $item->user_id      = $request->user()->id;

        if($request->hasFile('cover') && $request->file('cover')->isValid()){
            $item->cover = $request->cover->store(date("Y").'/'.date("m"));
        }
        if ($item->save()) {
            return redirect()->back()->withInput()->withErrors('保存成功！');
            //return redirect('admin/item')->withInput()->withErrors('保存成功！');
        } else {
            return redirect()->back()->withInput()->withErrors('更新失败！');
        }
    }

    public function show($id){
        $item = Item::find($id);
        $category = Category::find($item->category_id);
        $item->category_name = $category->name;
        $item->type = Item::$item_type['type'][$item->type];
        $item->period_type = Item::$item_type['period_type'][$item->period_type];
        return view('admin/item/info',['item'=>$item]);
    }
}
