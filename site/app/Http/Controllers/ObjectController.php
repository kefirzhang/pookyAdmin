<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Objects;
use App\Model\Category;
use App\Http\Requests;
use Illuminate\Support\Facades\Storage;


class ObjectController extends Controller
{
    public function index(Request $request)
    {
        $records = Objects::paginate(20);
        return view('module.object.index', ['records' => $records]);

    }

    public function create()
    {
        $categoryList = Category::categoryTree(true);

        return view('module.object.create', ['categoryList' => $categoryList]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'category_id' => 'required',
            'name' => 'required|max:255',
            'description' => 'required',
            'type' => 'required',
            'order' => 'required',
        ]);
        $object = new Objects;
        $object->category_id = $request->category_id;
        $object->name = $request->name;
        $object->alias_name = $request->alias_name;
        $object->description = $request->description;
        $object->type = $request->type;
        $object->cover = $request->cover;
        $object->order = $request->order;
        $object->options = json_encode($request->options);

        /*
        if (!$request->hasFile('cover')) {
            $object->cover = 'default.jpg';
        } elseif ($request->hasFile('cover') && $request->file('cover')->isValid()) {
            $object->cover = $request->cover->store(date("Y") . '/' . date("m"));
        } else {
            return redirect()->back()->withInput()->withErrors('图片有误！');
        }
        */

        if ($object->save()) {
            return redirect()->back()->withInput()->withErrors('保存成功！');
        } else {
            return redirect()->back()->withInput()->withErrors('保存失败！');
        }
    }

    public function destroy($id)
    {
        Objects::find($id)->delete();
        return redirect()->back()->withInput()->withErrors('删除成功！');
    }

    public function edit($id)
    {
        $categoryList = Category::categoryTree(true);
        $object = Objects::find($id);
        $object->options = json_decode($object->options, true);
        return view('module.object.edit', ['record' => $object, 'categoryList' => $categoryList]);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'category_id' => 'required',
            'name' => 'required|max:255',
            'description' => 'required',
            'type' => 'required',
            'order' => 'required',
        ]);
        $object = Objects::find($id);
        $object->category_id = $request->category_id;
        $object->name = $request->name;
        $object->alias_name = $request->alias_name;
        $object->description = $request->description;
        $object->type = $request->type;
        $object->cover = $request->cover;
        $object->order = $request->order;
        $object->options = json_encode($request->options);
        /*
        if ($request->hasFile('cover') && $request->file('cover')->isValid()) {
            Storage::delete($object->cover);
            $object->cover = $request->cover->store(date("Y") . '/' . date("m"));
        }
        */
        if ($object->save()) {
            return redirect()->back()->withInput()->withErrors('保存成功！');
        } else {
            return redirect()->back()->withInput()->withErrors('更新失败！');
        }
    }

    public function show($id)
    {
        $object = Objects::find($id);
        $object->options = json_decode($object->options, true);

        if ($object->category_id != 0) {
            $category_info = Category::find($object->category_id);
            $object->category_name = $category_info->name;
        } else {
            $object->category_name = '顶级分类';
        }
        return view('module.object.info', ['record' => $object]);
    }
}
