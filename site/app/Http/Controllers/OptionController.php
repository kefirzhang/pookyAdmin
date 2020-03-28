<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Option;
use App\Http\Requests;
use Illuminate\Support\Facades\Storage;


class OptionController extends Controller
{
    public function index(Request $request)
    {
        $records = Option::orderBy('id', 'desc')->paginate(env('LIST_PAGE_SIZE'));
        return view('module.option.index', ['records' => $records]);

    }

    public function create()
    {
        return view('module.option.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            'alias_name' => 'required|max:255',
            'value' => 'required',
            'autoload' => 'required',
        ]);
        $option = new Option;
        $option->name = $request->name;
        $option->alias_name = $request->alias_name;
        $option->value = $request->value;
        $option->autoload = $request->autoload;
        if ($option->save()) {
            return redirect()->back()->withInput()->withErrors('保存成功！');
        } else {
            return redirect()->back()->withInput()->withErrors('保存失败！');
        }
    }

    public function destroy($id)
    {
        Option::find($id)->delete();
        return redirect()->back()->withInput()->withErrors('删除成功！');
    }

    public function edit($id)
    {
        $option = Option::find($id);
        return view('module.option.edit', ['record' => $option]);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            'alias_name' => 'required|max:255',
            'value' => 'required',
            'autoload' => 'required',
        ]);
        $option = Option::find($id);
        $option->name = $request->name;
        $option->alias_name = $request->alias_name;
        $option->value = $request->value;
        $option->autoload = $request->autoload;

        if ($option->save()) {
            return redirect()->back()->withInput()->withErrors('保存成功！');
        } else {
            return redirect()->back()->withInput()->withErrors('更新失败！');
        }
    }

    public function show($id)
    {
        $option = Option::find($id);
        return view('module.option.info', ['record' => $option]);
    }
}
