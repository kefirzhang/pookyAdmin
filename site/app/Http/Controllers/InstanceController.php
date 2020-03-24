<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Model\Category;
use App\Model\Item;

use App\Model\Instance;

class InstanceController extends Controller
{
    public function index(){
        $instances = Instance::orderBy('order','desc')->orderBy('id','desc')->paginate(env('ADMIN_PAGE_SIZE'));
        $items = Item::getItemTree();
        foreach ($instances as $key=>$instance){
            $instance->item_name = $items[$instance->item_id]['name'];
        }
        return view('admin/instance/index',['instances'=>$instances]);
    }
    public function create(){
        $items = Item::orderBy('order','desc')->get();
        return view('admin/instance/create',['items'=>$items]);
    }
    public function store(Request $request){
        $this->validate($request, [
            'item_id'   => 'required',
            'name'          => 'required|max:255',
            'description'   => 'required',
            'period'        => 'required',
            'show_date'        => 'required',
            'order'         => 'required',
        ]);
        $instance = new Instance();
        $instance->suid         = uniqid();
        $instance->item_id      = $request->item_id;
        $instance->name         = $request->name;
        $instance->description  = $request->description;
        $instance->period       = $request->period;
        $instance->order        = $request->order;
        $instance->show_date     = $request->show_date;
        $instance->seo_title    = $request->seo_title;
        $instance->seo_keywords = $request->seo_keywords;
        $instance->seo_description  = $request->seo_description;
        $instance->user_id      = $request->user()->id;
        if(!$request->hasFile('cover')){
            $instance->cover = 'default.jpg';
        }elseif($request->hasFile('cover') && $request->file('cover')->isValid()){
            $instance->cover = $request->cover->store(date("Y").'/'.date("m"));
        }else{
            return redirect()->back()->withInput()->withErrors('图片有误！');
        }
        if ($instance->save()) {
            return redirect()->back()->withInput()->withErrors('保存成功！');
            //return redirect('admin/instance')->withInput()->withErrors('保存成功！');
        } else {
            return redirect()->back()->withInput()->withErrors('保存失败！');
        }
    }
    public function destroy($id){
        Instance::find($id)->delete();
        return redirect()->back()->withInput()->withErrors('删除成功！');
    }

    public function edit($id){
        $items = Item::orderBy('order','desc')->get();
        $instance  = Instance::find($id);
        return view('admin/instance/edit',['items'=>$items,'instance'=>$instance]);
    }

    public function update(Request $request,$id){
        $this->validate($request, [
            'item_id'   => 'required',
            'name'          => 'required|max:255',
            'description'   => 'required',
            'period'        => 'required',
            'show_date'        => 'required',
            'order'         => 'required',
        ]);

        $instance = Instance::find($id);

        $instance->item_id      = $request->item_id;
        $instance->name         = $request->name;
        $instance->description  = $request->description;
        $instance->period       = $request->period;
        $instance->order        = $request->order;
        $instance->show_date     = $request->show_date;
        $instance->seo_title    = $request->seo_title;
        $instance->seo_keywords = $request->seo_keywords;
        $instance->seo_description  = $request->seo_description;
        $instance->user_id      = $request->user()->id;
        if($request->hasFile('cover') && $request->file('cover')->isValid()){
            $instance->cover = $request->cover->store(date("Y").'/'.date("m"));
        }


        if ($instance->save()) {
            return redirect()->back()->withInput()->withErrors('保存成功！');
            //return redirect('admin/instance')->withInput()->withErrors('保存成功！');
        } else {
            return redirect()->back()->withInput()->withErrors('更新失败！');
        }
    }

    public function show($id){
        $instance = Instance::find($id);
        $item_info = Item::find($instance->item_id);
        $instance->item_name = $item_info->name;
        return view('admin/instance/info',['instance'=>$instance]);
    }
}
