<?php
/**
 * @desc 示例流程 Controller Model view curd
 */

namespace App\Http\Controllers;

use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;
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
        View::share('metaData', Chapter::getMetaData());
    }

    public function store(Request $request)
    {
        $this->validate($request, Chapter::getValidateRule());
        $chapter = new Chapter;
        foreach (Chapter::getMetaData() as $meta) {
            $chapter->{$meta['name']} = $request->{$meta['name']};
        }
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
        $this->validate($request, Chapter::getValidateRule());
        $chapter = Chapter::find($id);
        foreach (Chapter::getMetaData() as $meta) {
            $chapter->{$meta['name']} = $request->{$meta['name']};
        }

        if ($chapter->save()) {
            return redirect()->back()->withInput()->withErrors('更新成功！');
        } else {
            return redirect()->back()->withInput()->withErrors('更新失败！');
        }
    }

    public function show($id)
    {

        $record = Chapter::find($id);

        return view('module.chapter.show', ['record' => $record]);
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
