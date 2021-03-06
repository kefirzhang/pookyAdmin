<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Category;
use App\Http\Requests;
use Illuminate\Support\Facades\Storage;


class CategoryController extends Controller
{
    public function index(Request $request)
    {

        $parent_id = isset($request->parent_id) ? $request->parent_id : 0;
        $records = Category::where('parent_id', $parent_id)->orderBy('order', 'asc')->paginate(env('LIST_PAGE_SIZE'));
        $categoryTree = Category::categoryTree(true);

        //获取所有的父类
        foreach ($records as &$record) {
            if ($record->parent_id == '0') {
                $record->parent_name = '顶级分类';
            } elseif (isset($categoryTree[$record->id])) {
                $record->parent_name = $categoryTree[$record->id]['name'];
            } else {
                $record->parent_name = '';
            }
        }
        return view('module.category.index', ['records' => $records, 'parent_id' => $parent_id]);

    }

    public function create()
    {
        $topCategoryList = Category::where('parent_id', 0)->orderBy('id', 'desc')->get();
        return view('module.category.create', ['topCategoryList' => $topCategoryList]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'parent_id' => 'required',
            'name' => 'required|max:255',
            'description' => 'required',
            'order' => 'required',
        ]);
        $category = new Category;
        $category->parent_id = $request->parent_id;
        $category->name = $request->name;
        $category->alias_name = $request->alias_name;
        $category->description = $request->description;
        $category->order = $request->order;
        $category->options = json_encode($request->options);

        if (!$request->hasFile('cover')) {
            $category->cover = 'default.png';
        } elseif ($request->hasFile('cover') && $request->file('cover')->isValid()) {
            $category->cover = $request->cover->store('uploads/' . date("Ym"));
        } else {
            return redirect()->back()->withInput()->withErrors('图片有误！');
        }

        if ($category->save()) {
            return redirect()->back()->withInput()->withErrors('保存成功！');
        } else {
            return redirect()->back()->withInput()->withErrors('保存失败！');
        }
    }

    public function destroy($id)
    {
        Category::find($id)->delete();
        return redirect()->back()->withInput()->withErrors('删除成功！');
    }

    public function edit($id)
    {
        $topCategoryList = Category::where('parent_id', 0)->orderBy('id', 'desc')->get();
        $category = Category::find($id);
        $category->options = json_decode($category->options, true);
        return view('module.category.edit', ['record' => $category, 'topCategoryList' => $topCategoryList]);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'parent_id' => 'required',
            'name' => 'required|max:255',
            'description' => 'required',
            'order' => 'required',
        ]);
        $category = Category::find($id);
        $category->parent_id = $request->parent_id;
        $category->name = $request->name;
        $category->alias_name = $request->alias_name;
        $category->description = $request->description;
        $category->order = $request->order;
        $category->options = json_encode($request->options);

        if ($request->hasFile('cover') && $request->file('cover')->isValid()) {
            if ($category->cover != 'default.png') {
                Storage::delete($category->cover);
            }
            $category->cover = $request->cover->store('uploads/' . date("Ym"));
        }

        if ($category->save()) {
            return redirect()->back()->withInput()->withErrors('保存成功！');
        } else {
            return redirect()->back()->withInput()->withErrors('更新失败！');
        }
    }

    public function show($id)
    {
        $category = Category::find($id);
        $category->options = json_decode($category->options, true);
        if ($category->parent_id != 0) {
            $parent_info = Category::find($category->parent_id);
            $category->parent_name = $parent_info->name;
        } else {
            $category->parent_name = '顶级分类';
        }
        return view('module.category.info', ['record' => $category]);
    }
}
