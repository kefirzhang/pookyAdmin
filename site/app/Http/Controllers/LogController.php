<?php
/**
 * @desc 示例流程 Controller Model view curd
 */

namespace App\Http\Controllers;

use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;
use App\Model\Log as CModel; // 别名 统一Model 调用

class LogController extends Controller
{

    private $viewDir = 'module.log.';
    private $metaData; //元数据描述
    private $validateRule; //验证条件
    private $moduleConf = [
        'moduleRoutePre' => 'log',
        'moduleTips'     => '配置项管理-Log'
    ];
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->metaData = CModel::getMetaData();
        $this->validateRule = CModel::getValidateRule();
        View::share('metaData', $this->metaData); //共享元数据
        View::share('moduleConf', $this->moduleConf); //共享元数据
    }

    public function store(Request $request)
    {
        $this->validate($request, $this->validateRule);
        $log = new CModel;
        foreach ($this->metaData as $meta) {
            $log->{$meta['name']} = $request->{$meta['name']};
        }
        if ($log->save()) {
            return redirect()->back()->withInput()->withErrors('保存成功！');
        } else {
            return redirect()->back()->withInput()->withErrors('保存失败！');
        }
    }

    public function index()
    {
        $records = CModel::orderBy('id', 'desc')->paginate(env('LIST_PAGE_SIZE'));;
        return view($this->viewDir . 'index', ['records' => $records]);
    }

    public function create(Request $request)
    {
        return view($this->viewDir . 'create');
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, $this->validateRule);
        $log = CModel::find($id);
        foreach ($this->metaData as $meta) {
            $log->{$meta['name']} = $request->{$meta['name']};
        }

        if ($log->save()) {
            return redirect()->back()->withInput()->withErrors('更新成功！');
        } else {
            return redirect()->back()->withInput()->withErrors('更新失败！');
        }
    }

    public function show($id)
    {

        $record = CModel::find($id);

        return view($this->viewDir . 'show', ['record' => $record]);
    }

    public function destroy($id)
    {
        CModel::find($id)->delete();
        return redirect()->back()->withInput()->withErrors('删除成功！');
    }

    public function edit($id)
    {
        $record = CModel::find($id);
        return view($this->viewDir . 'edit', ['record' => $record]);
    }

}
