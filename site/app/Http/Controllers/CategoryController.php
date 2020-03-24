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
        $categorys = Category::where('parent_id', $parent_id)->orderBy('id', 'desc')->paginate(20);
        $categorysTree = Category::categoryTree(true);
        foreach ($categorys as &$category) {
            $category->parent_name = $categorysTree[$category->parent_id]['name'];
        }
        return view('module.category.index', ['categorys' => $categorys, 'parent_id' => $parent_id]);

    }

    public function create()
    {
        $categorys = Category::where('parent_id', 0)->orderBy('id', 'desc')->get();
        return view('admin/category/create', ['categorys' => $categorys]);
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
        $category->suid = uniqid();
        $category->parent_id = $request->parent_id;
        $category->name = $request->name;
        $category->description = $request->description;
        $category->order = $request->order;
        $category->seo_title = $request->seo_title;
        $category->seo_keywords = $request->seo_keywords;
        $category->seo_description = $request->seo_description;
        $category->user_id = $request->user()->id;
        if (!$request->hasFile('cover')) {
            $category->cover = 'default.jpg';
        } elseif ($request->hasFile('cover') && $request->file('cover')->isValid()) {
            $category->cover = $request->cover->store(date("Y") . '/' . date("m"));
        } else {
            return redirect()->back()->withInput()->withErrors('图片有误！');
        }
        if ($category->save()) {
            return redirect()->back()->withInput()->withErrors('保存成功！');
            //return redirect('admin/category')->withInput()->withErrors('保存成功！');
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
        $top_categorys = Category::where('parent_id', 0)->orderBy('id', 'desc')->get();
        $category = Category::find($id);
        return view('admin/category/edit', ['category' => $category, 'top_categorys' => $top_categorys]);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'parent_id' => 'required',
            'name' => 'required|max:255',
            'description' => 'required',
            'order' => 'required',
        ]);
        $category = Category::find($id);;
        $category->parent_id = $request->parent_id;
        $category->name = $request->name;
        $category->description = $request->description;
        $category->order = $request->order;
        $category->seo_title = $request->seo_title;
        $category->seo_keywords = $request->seo_keywords;
        $category->seo_description = $request->seo_description;
        $category->user_id = $request->user()->id;

        if ($request->hasFile('cover') && $request->file('cover')->isValid()) {
            Storage::delete($category->cover);
            $category->cover = $request->cover->store(date("Y") . '/' . date("m"));
        }

        if ($category->save()) {
            return redirect()->back()->withInput()->withErrors('保存成功！');
            //return redirect('admin/category')->withInput()->withErrors('保存成功！');
        } else {
            return redirect()->back()->withInput()->withErrors('更新失败！');
        }
    }

    public function show($id)
    {
        $category = Category::find($id);
        if ($category->parent_id != 0) {
            $parent_info = Category::find($category->parent_id);
            $category->parent_name = $parent_info->name;
        } else {
            $category->parent_name = '顶级分类';
        }
        return view('admin/category/info', ['category' => $category]);
    }
}