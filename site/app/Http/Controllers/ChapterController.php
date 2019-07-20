<?php
/**
 * @desc 示例流程 Controller Model view curd
 */
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use App\Model\Chapter;

class ChapterController extends Controller
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
        $chapter = new Chapter;
        $chapter->name       = $request->name;
        $chapter->value      = $request->value;
        $chapter->autoload   = $request->autoload;
        if ($chapter->save()) {
            return redirect()->back()->withInput()->withErrors('保存成功！');
        } else {
            return redirect()->back()->withInput()->withErrors('保存失败！');
        }
    }

    public function index()
    {
        $records = Chapter::all();
        return view('module.chapter.index', ['records' => $records]);
    }

    public function create(Request $request)
    {
        return view('module.chapter.create');
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name'      => 'required|max:255',
            'value'     => 'required',
            'autoload'  => 'required',
        ]);
        $chapter = Chapter::find($id);
        $chapter->name = $request->name;
        $chapter->value = $request->value;
        $chapter->autoload = $request->autoload;

        if ($chapter->save()) {
            return redirect()->back()->withInput()->withErrors('更新成功！');
        } else {
            return redirect()->back()->withInput()->withErrors('更新失败！');
        }
    }

    public function show($id)
    {

        $record = Chapter::find($id);

        return view('module.chapter.show',['record'=>$record]);
    }

    public function destroy($id)
    {
        Chapter::find($id)->delete();
        return redirect()->back()->withInput()->withErrors('删除成功！');
    }

    public function edit($id)
    {
        $record = Chapter::find($id);
        return view('module.chapter.edit', ['record' => $record]);
    }

}
