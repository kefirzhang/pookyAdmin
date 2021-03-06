<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Instance;
use App\Model\Objects;
use App\Http\Requests;
use Illuminate\Support\Facades\Storage;


class InstanceController extends Controller
{
    public function index(Request $request)
    {
        $object_id = isset($request->object_id) ? $request->object_id : 0;
        if ($object_id) {
            $records = Instance::where('object_id', $object_id)->orderBy('id', 'desc')->paginate(env('LIST_PAGE_SIZE'));
        } else {
            $records = Instance::orderBy('id', 'desc')->paginate(env('LIST_PAGE_SIZE'));
        }
        return view('module.instance.index', ['records' => $records, 'object_id' => $object_id]);

    }

    public function create()
    {
        $objectList = Objects::orderBy('id', 'desc')->get();
        return view('module.instance.create', ['objectList' => $objectList]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'object_id' => 'required',
            'name' => 'required|max:255',
            'description' => 'required',
            'order' => 'required',
        ]);
        $instance = new Instance;
        $instance->object_id = $request->object_id;
        $instance->name = $request->name;
        $instance->description = $request->description;
        $instance->order = $request->order;
        $instance->options = json_encode($request->options);

        if (!$request->hasFile('cover')) {
            $instance->cover = 'default.png';
        } elseif ($request->hasFile('cover') && $request->file('cover')->isValid()) {
            $instance->cover = $request->cover->store('uploads/' . date("Ym"));
        } else {
            return redirect()->back()->withInput()->withErrors('图片有误！');
        }

        if ($instance->save()) {
            return redirect()->back()->withInput()->withErrors('保存成功！');
        } else {
            return redirect()->back()->withInput()->withErrors('保存失败！');
        }
    }

    public function destroy($id)
    {
        Instance::find($id)->delete();
        return redirect()->back()->withInput()->withErrors('删除成功！');
    }

    public function edit($id)
    {
        $objectList = Objects::orderBy('id', 'desc')->get();
        $instance = Instance::find($id);
        $instance->options = json_decode($instance->options, true);
        return view('module.instance.edit', ['record' => $instance, 'objectList' => $objectList]);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'object_id' => 'required',
            'name' => 'required|max:255',
            'description' => 'required',
            'order' => 'required',
        ]);
        $instance = Instance::find($id);
        $instance->object_id = $request->object_id;
        $instance->name = $request->name;
        $instance->description = $request->description;
        $instance->cover = $request->cover;
        $instance->order = $request->order;
        $instance->options = json_encode($request->options);

        if ($request->hasFile('cover') && $request->file('cover')->isValid()) {
            if ($instance->cover != 'default.png') {
                Storage::delete($instance->cover);
            }
            $instance->cover = $request->cover->store('uploads/' . date("Ym"));
        }

        if ($instance->save()) {
            return redirect()->back()->withInput()->withErrors('保存成功！');
        } else {
            return redirect()->back()->withInput()->withErrors('更新失败！');
        }
    }

    public function show($id)
    {
        $instance = Instance::find($id);
        $instance->options = json_decode($instance->options, true);
        if ($instance->object_id != 0) {
            $object_info = Objects::find($instance->object_id);
            $instance->object_name = $object_info->name;
        } else {
            $instance->object_name = '顶级分类';
        }
        return view('module.instance.info', ['record' => $instance]);
    }
}
