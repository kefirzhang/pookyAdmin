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
        'b_id' => ['name' => 'b_id', 'show_name' => '图书ID', 'type' => 'text'],
        'site_url' => ['name' => 'site_url', 'show_name' => '站点地址', 'type' => 'text'],
        'info_url' => ['name' => 'info_url', 'show_name' => '详情地址', 'type' => 'text'],
        'list_url' => ['name' => 'list_url', 'show_name' => '列表地址', 'type' => 'text'],
        'detail_url' => ['name' => 'detail_url', 'show_name' => '详情地址', 'type' => 'text'],
        'info_rule' => ['name' => 'info_rule', 'show_name' => '详情规则', 'type' => 'text'],
        'list_rule' => ['name' => 'list_rule', 'show_name' => '列表规则', 'type' => 'text'],
        'detail_rule' => ['name' => 'detail_rule', 'show_name' => '详情规则', 'type' => 'text'],
        'order' => ['name' => 'order', 'show_name' => '排序', 'type' => 'text'],

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

    public function index()
    {
        $records = Spider::all();
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