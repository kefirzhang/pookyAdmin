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
        $object = Objects::find($instance->object_id);
        $instance->object_name = $object->name;
        $metas_x = Meta::where(['object_id'=>$instance->object_id,'type'=>'1'])->orderBy('order','asc')->orderBy('id','asc')->get();
        $metas_y = Meta::where(['object_id'=>$instance->object_id,'type'=>'2'])->orderBy('order','asc')->orderBy('id','asc')->get();
        $cells = Cell::getInstanceCell($instance_id);
        return view('module.cell.info',['instance'=>$instance,'metas_x'=>$metas_x,'metas_y'=>$metas_y,'cells'=>$cells]);
    }
    public function store(Request $request){
        $instance = Instance::find($request->instance_id);
        $object = Objects::find($instance->object_id);
        $xMetas = Meta::getMetas($object->id,1);
        $data = array();
        //新上传的数据
        if(isset($request->cell)){
            foreach ($request->cell as $x=>$x_value){
                foreach ($x_value as $y=>$value){
                    $content = '';
                    if($xMetas[$x]['content_type'] == 2){//如果是图片类型
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
