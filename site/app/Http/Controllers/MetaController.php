<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Model\Item;
use App\Model\Unit;
use App\Model\Category;
class MetaController extends Controller
{
    //$id 为item 的id
    public function show($item_id){
        $units = Unit::where('item_id',$item_id)->orderBy('type','asc')->orderBy('order','desc')->get();
        $item = Item::find($item_id);
        $item->type = Item::$item_type['type'][$item->type];
        $item->period_type = Item::$item_type['period_type'][$item->period_type];
        $category = Category::find($item->category_id);
        $item->category_name = $category->name;
        return view('admin/unit/info',['item'=>$item,'units'=>$units]);
    }
    public function store(Request $request){
        $pre_unit_ids = Unit::where('item_Id',$request->item_id)->pluck('id')->toArray();
        $item_id = $request->item_id;
        $request->id = $request->id?$request->id:array();
        if(count($request->name) == 0){
            return redirect()->back()->withInput()->withErrors('至少有一个配置项！');
        }
        foreach ($request->name as $key=>$name){
            if(isset($request->id[$key])){ //如果是老的 类型 名称 排序 都没有变化 那么就直接跳过
                $unit = Unit::find($request->id[$key]);
                if($unit->type == $request->type[$key]
                    && $unit->name  == $request->name[$key]
                    && $unit->order == $request->order[$key]
                    && $unit->content_type == $request->content_type[$key]
                    && $unit->ext_name == $request->ext_name[$key]
                ){
                    continue;
                }
            }else{
                $unit = new Unit();
                $unit->suid     = uniqid();
            }
            $unit->item_id  = $item_id;
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
            Unit::destroy($diff_ids);
        }
        return redirect()->back()->withInput()->withErrors('保存成功！');
    }
}
