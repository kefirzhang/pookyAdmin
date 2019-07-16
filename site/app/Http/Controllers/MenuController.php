<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Menu;

class MenuController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'p_id'      => 'required',
            'name'      => 'required|max:255',
            'action'    => 'required',
            'target'    => 'required',
        ]);
        $menu = new Menu;
        $menu->p_id = $request->p_id;
        $menu->name = $request->name;
        $menu->action = $request->action;
        $menu->target = $request->target;
        if ($menu->save()) {
            return redirect()->back()->withInput()->withErrors('保存成功！');
        } else {
            return redirect()->back()->withInput()->withErrors('保存失败！');
        }
    }

    public function index()
    {
        $records = Menu::all();
        return view('module.menu.index',['records'=>$records]);
    }

    public function create(Request $request)
    {
        return Menu::tree();
        return view('module.menu.create');
    }

    public function update(Request $request,$id)
    {
    }

    public function show($id)
    {
        $category = Category::find($id);
        if($category->parent_id != 0){
            $parent_info = Category::find($category->parent_id);
            $category->parent_name = $parent_info->name;
        } else {
            $category->parent_name = '顶级分类';
        }
        return view('admin/category/info',['category'=>$category]);

        return view('module.menu.show');
    }

    public function destroy($id)
    {
        Menu::find($id)->delete();
        return redirect()->back()->withInput()->withErrors('删除成功！');
    }

    public function edit($id)
    {
        $record = Menu::find($id);
        return view('module.menu.create',['record'=>$record]);
    }

}
