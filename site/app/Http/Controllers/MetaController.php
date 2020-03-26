<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Model\Objects;
use App\Model\Meta;
use App\Model\Category;
class MetaController extends Controller
{
    //$id 为object 的id
    public function show($object_id){
        $metas = Meta::where('object_id',$object_id)->orderBy('type','asc')->orderBy('order','desc')->get();
        $object = Objects::find($object_id);
        //$object->type = Objects::$object_type['type'][$object->type];
        //$object->period_type = Objects::$object_type['period_type'][$object->period_type];
        //$category = Category::find($object->category_id);
        //$object->category_name = $category->name;
        return view('module.meta.info',['object'=>$object,'metas'=>$metas]);
    }
    public function store(Request $request){
        $pre_unit_ids = Meta::where('object_Id',$request->object_id)->pluck('id')->toArray();
        $object_id = $request->object_id;
        $request->id = $request->id?$request->id:array();
        if(count($request->name) == 0){
            return redirect()->back()->withInput()->withErrors('至少有一个配置项！');
        }
        foreach ($request->name as $key=>$name){
            if(isset($request->id[$key])){ //如果是老的 类型 名称 排序 都没有变化 那么就直接跳过
                $unit = Meta::find($request->id[$key]);
                if($unit->type == $request->type[$key]
                    && $unit->name  == $request->name[$key]
                    && $unit->order == $request->order[$key]
                    && $unit->content_type == $request->content_type[$key]
                    && $unit->ext_name == $request->ext_name[$key]
                ){
                    continue;
                }
            }else{
                $unit = new Meta();
                $unit->suid     = uniqid();
            }
            $unit->object_id  = $object_id;
            $unit->type     = $request->type[$key];
            $unit->content_type     = $request->content_type[$key];
            $unit->name     = $request->name[$key];
            $unit->ext_name     = $request->ext_name[$key];
            $unit->order    = $request->order[$key];
            $unit->user_id  = $request->user()->id;
            if (!$unit->save()) {
                return redirect()->back()->withInput()->withErrors('新增失败！');
            }
        }
        //删除不需要的配置项
        $diff_ids = array_diff($pre_unit_ids, $request->id);
        if($diff_ids){
            Meta::destroy($diff_ids);
        }
        return redirect()->back()->withInput()->withErrors('保存成功！');
    }
}
