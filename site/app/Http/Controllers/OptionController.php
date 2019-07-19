<?php
/**
 * @desc 示例流程 Controller Model view curd
 */
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Option;

class OptionController extends Controller
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
            'name'      => 'required|max:255',
            'value'     => 'required',
            'autoload'  => 'required',
        ]);
        $option = new Option;
        $option->name       = $request->name;
        $option->value      = $request->value;
        $option->autoload   = $request->autoload;
        if ($option->save()) {
            return redirect()->back()->withInput()->withErrors('保存成功！');
        } else {
            return redirect()->back()->withInput()->withErrors('保存失败！');
        }
    }

    public function index()
    {
        $records = Option::all();
        return view('module.option.index', ['records' => $records]);
    }

    public function create(Request $request)
    {
        return view('module.option.create');
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name'      => 'required|max:255',
            'value'     => 'required',
            'autoload'  => 'required',
        ]);
        $option = Option::find($id);
        $option->name = $request->name;
        $option->value = $request->value;
        $option->autoload = $request->autoload;

        if ($option->save()) {
            return redirect()->back()->withInput()->withErrors('更新成功！');
        } else {
            return redirect()->back()->withInput()->withErrors('更新失败！');
        }
    }

    public function show($id)
    {

        $record = Option::find($id);

        return view('module.option.show',['record'=>$record]);
    }

    public function destroy($id)
    {
        Option::find($id)->delete();
        return redirect()->back()->withInput()->withErrors('删除成功！');
    }

    public function edit($id)
    {
        $record = Option::find($id);
        return view('module.option.edit', ['record' => $record]);
    }

}
