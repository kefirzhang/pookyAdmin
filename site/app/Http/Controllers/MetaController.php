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
    public function show($object_id)
    {
        $metas = Meta::where('object_id', $object_id)->orderBy('type', 'asc')->orderBy('order', 'desc')->get();
        $object = Objects::find($object_id);
        //$object->type = Objects::$object_type['type'][$object->type];
        //$object->period_type = Objects::$object_type['period_type'][$object->period_type];
        //$category = Category::find($object->category_id);
        //$object->category_name = $category->name;
        return view('module.meta.info', ['object' => $object, 'metas' => $metas]);
    }

    public function store(Request $request)
    {

        $object_id = $request->object_id;
        $pre_meta_ids = Meta::where('object_id', $object_id)->pluck('id')->toArray(); //上一次的配置项

        $request->id = $request->id ? $request->id : []; //是否有新增 如果为空 则全部为新增
        if (count($request->name) == 0) {
            return redirect()->back()->withInput()->withErrors('至少有一个配置项！');
        }
        foreach ($request->name as $key => $name) {
            if (isset($request->id[$key])) { //如果是老的 类型 名称 排序 都没有变化 那么就直接跳过
                //  TODO 这里可以一次性 查出 遍历 待优化
                $meta = Meta::find($request->id[$key]);
                if ($meta->type == $request->type[$key]
                    && $meta->name == $request->name[$key]
                    && $meta->order == $request->order[$key]
                    && $meta->content_type == $request->content_type[$key]
                    && $meta->alias_name == $request->alias_name[$key]
                ) {
                    continue;
                }
            }else {
                $meta = new Meta();
            }
            // 新建
            $meta->object_id = $object_id;
            $meta->type = $request->type[$key];
            $meta->content_type = $request->content_type[$key];
            $meta->name = $request->name[$key];
            $meta->alias_name = $request->alias_name[$key];
            $meta->order = $request->order[$key];
            if (!$meta->save()) {
                return redirect()->back()->withInput()->withErrors('新增失败！');
            }
        }
        //删除不需要的配置项
        $diff_ids = array_diff($pre_meta_ids, $request->id);
        if ($diff_ids) {
            Meta::destroy($diff_ids);
        }
        return redirect()->back()->withInput()->withErrors('保存成功！');
    }
}
