<?php
/**
 * @desc 示例流程 Controller Model view curd
 */

namespace App\Http\Controllers;

use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;
use App\Model\Spider;

class SpiderController extends Controller
{
    public $metaData = [
        'b_id' => ['name' => 'b_id', 'show_name' => '图书ID', 'type' => 'text', 'list_show' => true],
        'site_url' => ['name' => 'site_url', 'show_name' => '站点地址', 'type' => 'text', 'list_show' => true],
        'info_url' => ['name' => 'info_url', 'show_name' => '详情地址', 'type' => 'text', 'list_show' => false],
        'list_url' => ['name' => 'list_url', 'show_name' => '列表地址', 'type' => 'text', 'list_show' => true],
        'detail_url' => ['name' => 'detail_url', 'show_name' => '详情地址', 'type' => 'text', 'list_show' => false],
        'info_rule' => ['name' => 'info_rule', 'show_name' => '详情规则', 'type' => 'text', 'list_show' => false],
        'list_rule' => ['name' => 'list_rule', 'show_name' => '列表规则', 'type' => 'text', 'list_show' => true],
        'detail_rule' => ['name' => 'detail_rule', 'show_name' => '详情规则', 'type' => 'text', 'list_show' => true],
        'order' => ['name' => 'order', 'show_name' => '排序', 'type' => 'text', 'list_show' => true],

    ];

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        View::share('metaData', $this->metaData);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'b_id' => 'required',
            'site_url' => 'required',
            'info_url' => 'required',
            'list_url' => 'required',
            'detail_url' => 'required',
            'info_rule' => 'required',
            'list_rule' => 'required',
            'detail_rule' => 'required',
            'order' => 'required',
        ]);
        $spider = new Spider;
        foreach ($this->metaData as $meta) {
            $spider->{$meta['name']} = $request->{$meta['name']};
        }
        if ($spider->save()) {
            return redirect()->back()->withInput()->withErrors('保存成功！');
        } else {
            return redirect()->back()->withInput()->withErrors('保存失败！');
        }
    }

    public function index(Request $request)
    {
        $b_id = $request->input('b_id', 0);
        if ($b_id) {
            $records = Spider::where('b_id', $b_id)->paginate(200);
        } else {
            $records = Spider::all();
        }
        //$records = Spider::all();
        return view('module.spider.index', ['records' => $records]);
    }

    public function create(Request $request)
    {
        return view('module.spider.create');
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'b_id' => 'required',
            'site_url' => 'required',
            'info_url' => 'required',
            'list_url' => 'required',
            'detail_url' => 'required',
            'info_rule' => 'required',
            'list_rule' => 'required',
            'detail_rule' => 'required',
            'order' => 'required',
        ]);
        $spider = Spider::find($id);
        foreach ($this->metaData as $meta) {
            $spider->{$meta['name']} = $request->{$meta['name']};
        }

        if ($spider->save()) {
            return redirect()->back()->withInput()->withErrors('更新成功！');
        } else {
            return redirect()->back()->withInput()->withErrors('更新失败！');
        }
    }

    public function show($id)
    {

        $record = Spider::find($id);

        return view('module.spider.show', ['record' => $record]);
    }

    public function destroy($id)
    {
        Spider::find($id)->delete();
        return redirect()->back()->withInput()->withErrors('删除成功！');
    }

    public function edit($id)
    {
        $record = Spider::find($id);
        return view('module.spider.edit', ['record' => $record]);
    }

}
