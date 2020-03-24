@extends('layouts.admin')

@section('content')
<!-- BEGIN PAGE HEADER-->
<!-- BEGIN PAGE BAR -->
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="{{url('admin')}}">后台管理</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <a href="{{url('admin/item')}}">项目列表</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span>项目配置</span>
        </li>
    </ul>
</div>
<!-- END PAGE BAR -->
<!-- BEGIN PAGE TITLE-->
<h1 class="page-title"> 【{{$item->name}}】 的配置信息
    <small>所属分类：{{$item->category_name}}-类型：{{$item->type}}</small>
</h1>
<!-- END PAGE TITLE-->
<!-- END PAGE HEADER-->
@if (count($errors) > 0)
    @foreach ($errors->all() as $error)
        <div class="note note-danger">
            <p> {{ $error }} </p>
        </div>
    @endforeach
@endif
<div class="row">
    <div class="col-md-12">
        <!-- BEGIN SAMPLE FORM PORTLET-->
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption font-red-sunglo">
                    <i class="icon-social-dribbble font-blue-sharp"></i>
                    <span class="caption-subject font-blue-sharp bold uppercase"> 项目配置信息</span>
                </div>
            </div>
            <div class="portlet-body form">
        	<form action="{{ url('admin/unit') }}" method="POST" class="form-horizontal" id="units_form">
        		{!! csrf_field() !!}
                    <div class="form-body">
                        <div id="units_area">
                        	@foreach ($units as $unit)
                            <div class="form-group">
                                <input type="hidden" name="id[]" value="{{$unit->id}}" />
                                <label  class="col-md-2 control-label">配置</label>
                                <div class="col-md-2">
                                  <select class="form-control" name="type[]">
                                    	<option value="0">请选择</option>
                                    	@if($unit->type == 1)
                                    	<option value="1" selected="selected">X轴</option>
                                    	<option value="2">Y轴</option>
                                    	@elseif($unit->type ==2)
                                    	<option value="1">X轴</option>
                                    	<option value="2" selected="selected">Y轴</option>
                                    	@else
                                    	<option value="1">X轴</option>
                                    	<option value="2">Y轴</option>
                                    	@endif
                                  </select>
                                </div>
                                <div class="col-md-2">
                                  <select class="form-control" name="content_type[]">
                                    	<option value="0">请选择</option>
                                    	@if($unit->content_type == 1)
                                    	<option value="1" selected="selected">文本</option>
                                    	<option value="2">图片</option>
                                    	@elseif($unit->content_type ==2)
                                    	<option value="1">文本</option>
                                    	<option value="2" selected="selected">图片</option>
                                    	@else
                                    	<option value="1">文本</option>
                                    	<option value="2">图片</option>
                                    	@endif
                                  </select>
                                </div>
                                <div class="col-md-2">
                                  <input type="text" name="name[]"  class="form-control spinner"  placeholder="名称" value="{{$unit->name}}">
                                </div>
                                <div class="col-md-2">
                                  <input type="text" name="ext_name[]"  class="form-control spinner"  placeholder="别名" value="{{$unit->ext_name}}">
                                </div>
                                <div class="col-md-1">
                                  <input type="text" name="order[]" class="form-control spinner"  placeholder="排序" value="{{$unit->order}}" >
                                </div>
                                <div class="col-md-1">
                                  <button type="button" class="btn btn-danger" onclick="removeThisUnit(this)">删除此项</button>
                                </div>
                            </div>
                        	@endforeach
                        	
                        </div>
						<div class="form-group">
                            <label class="col-md-2 control-label">开始名次</label>
                            <div class="col-md-2">
                            	<input class="form-control spinner" type="text"  value="1" id="start_num" > 
                            </div>
                            <label class="col-md-2 control-label">结束名次</label>
                            <div class="col-md-3">
                            	<input class="form-control spinner" type="text"  value="100" id="end_num" class="form-control"> 
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">显示类型</label>
                            <div class="col-md-2">
                        		<select id="batch_type" class="form-control" >
                        			<option value="0">--请选择--</option>
                                	<option value="1">纯数字{n}</option>
                                	<option value="2">第{n}名</option>
                            	</select> 
                            </div>                            
                            <div class="col-md-2">
                            	<button type="button" class="btn btn-primary" onclick="batchAddNewUnit();" id="submit_button">批量增加名次配置</button>
                            </div>
                        </div>                        
                    </div>
                    <input type="hidden" name="item_id" value="{{$item->id}}" />
                    <div class="form-actions center">
                    	<div class="row">
                    		<div class="col-md-offset-3 col-md-9">
                                <button type="button" class="btn btn-primary" onclick="addNewUnit();" >新增配置项</button>
                                <button type="button" class="btn btn-primary" onclick="reduceLastUnit();" >减少配置项</button>
                                <button type="submit" class="btn blue">提交</button>
                    		</div>
                    	</div>
                    </div>
                </form>
            </div>
        </div>
        <!-- END SAMPLE FORM PORTLET-->
     </div>
</div>
@endsection

@section('script')
<script>
function batchAddNewUnit(){
	var start_num = parseInt($("#start_num").val());
	var end_num = parseInt($("#end_num").val());
	var batch_type = parseInt($("#batch_type").val());
	var unit_dom = '';
	for(var i = start_num; i <= end_num; i++){
		if(batch_type == 2){
			var rank = "第"+i+"名";
		} else {
			var rank = i;
		}
		unit_dom += getUnitHtml(rank);
    }
	$("#units_area").append(unit_dom);
}
function removeThisUnit(e){
	$(e).parent().parent().remove();
}
function addNewUnit(){
	var unit_dom = getUnitHtml('');
	$("#units_area").append(unit_dom);
}
function getUnitHtml(rank){
	unit_dom  = '';
	unit_dom += '<div class="form-group">';
	unit_dom += '<label class="col-md-2 control-label">配置</label>';
	unit_dom += '<div class="col-md-2">';
	unit_dom += '<select class="form-control" name="type[]">';
	unit_dom += '<option value="0">请选择</option>';
	unit_dom += '<option value="1">X轴</option>';
	unit_dom += '<option value="2" selected="selected">Y轴</option>';
	unit_dom += '</select>';
	unit_dom += '</div>';
	unit_dom += '<div class="col-md-2">';
	unit_dom += '<select class="form-control" name="content_type[]">';
	unit_dom += '<option value="0">请选择</option>';
	unit_dom += '<option value="1" selected="selected">文本</option>';
	unit_dom += '<option value="2">图片</option>';
	unit_dom += '</select>';
	unit_dom += '</div>';
	unit_dom += '<div class="col-md-2">';
	unit_dom += '<input type="text" name="name[]" class="form-control spinner"  placeholder="名称" value="'+rank+'">';
	unit_dom += '</div>';
	unit_dom += '<div class="col-md-2">';
	unit_dom += '<input type="text" name="ext_name[]" class="form-control spinner"  placeholder="别名" value="'+rank+'">';
	unit_dom += '</div>';
	unit_dom += '<div class="col-md-1">';
	unit_dom += '<input type="text" name="order[]" class="form-control spinner"  placeholder="排序" value="'+rank+'">';
	unit_dom += '</div>';
	unit_dom += '<div class="col-md-1">';
	unit_dom += '<button type="button" class="btn btn-danger" onclick="removeThisUnit(this)">删除此项</button>';
	unit_dom += '</div>';
	unit_dom += '</div>';
	return unit_dom;
}
function reduceLastUnit(){
	$("#units_area>div").last().remove();
}
</script>
@endsection
