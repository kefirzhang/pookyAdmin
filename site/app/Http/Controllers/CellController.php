<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Model\Objects;
use App\Model\Meta;
use App\Model\Instance;
use App\Model\Cell;
use DB;

class CellController extends Controller
{
    //$id 为instance 的id
    public function show($instance_id){
        $instance = Instance::find($instance_id);
        $item = Item::find($instance->item_id);
        $instance->item_name = $item->name;
        $units_x = Unit::where(['item_id'=>$instance->item_id,'type'=>'1'])->orderBy('order','desc')->orderBy('id','desc')->get();
        $units_y = Unit::where(['item_id'=>$instance->item_id,'type'=>'2'])->orderBy('order','desc')->orderBy('id','desc')->get();
        $cells = Cell::getInstanceCell($instance_id);
        return view('admin/cell/info',['instance'=>$instance,'units_x'=>$units_x,'units_y'=>$units_y,'cells'=>$cells]);
    }
    public function store(Request $request){
        $instance = Instance::find($request->instance_id);
        $item = Item::find($instance->item_id);
        $xUnits = Unit::getUnits($item->id,1);
        $data = array();
        //新上传的数据
        if(isset($request->cell)){
            foreach ($request->cell as $x=>$x_value){
                foreach ($x_value as $y=>$value){
                    $content = '';
                    if($xUnits[$x]['content_type'] == 2){//如果是图片类型
                        if($request->cell[$x][$y]->isValid()){ //如果基本校验没有问题
                            $content = $request->cell[$x][$y]->store(date("Y").'/'.date("m")); //内容为保存的路径
                        }
                    }else{
                        $content = $value;
                    }
                    $data[] = array(
                        'instance_id'=>$request->instance_id,
                        'unit_x_id'=>$x,
                        'unit_y_id'=>$y,
                        'content'=>$content,
                        'user_id'=>$request->user()->id,
                        'created_at'=>date("Y-m-d H:i:s",time()),
                        'updated_at'=>date("Y-m-d H:i:s",time()),
                    );
                }
            }
        }
        if(isset($request->cover)){
            foreach ($request->cover as $x=>$x_value){ //图片补丁 如果更新图片
                foreach ($x_value as $y=>$value){
                    if(!isset($request->cell[$x][$y])){
                        $data[] = array(
                            'instance_id'=>$request->instance_id,
                            'unit_x_id'=>$x,
                            'unit_y_id'=>$y,
                            'content'=>$request->cover[$x][$y],
                            'user_id'=>$request->user()->id,
                            'created_at'=>date("Y-m-d H:i:s",time()),
                            'updated_at'=>date("Y-m-d H:i:s",time()),
                        );
                    }
                }
            }
        }
        DB::transaction(function() use($request,$data){
            DB::table('cell')->where( 'instance_id','=',$request->instance_id )->delete();
            DB::table('cell')->insert($data);
        });
        return redirect()->back()->withInput()->withErrors('保存成功！');
    }
}
