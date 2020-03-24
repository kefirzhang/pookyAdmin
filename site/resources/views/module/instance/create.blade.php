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
            <a href="{{url('admin/instance')}}">实例管理</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span>新增实例</span>
        </li>
    </ul>
</div>
<!-- END PAGE BAR -->
<!-- BEGIN PAGE TITLE-->
<h1 class="page-title"> 新增实例
    <small>New Instance</small>
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
    <div class="col-md-6">
        <!-- BEGIN SAMPLE FORM PORTLET-->
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption font-red-sunglo">
                    <i class="icon-social-dribbble font-blue-sharp"></i>
                    <span class="caption-subject font-blue-sharp bold uppercase"> 实例信息</span>
                </div>
            </div>
            <div class="portlet-body form">
                <form action="{{ url('admin/instance') }}" method="POST" class="form-horizontal" enctype="multipart/form-data" >
    				{!! csrf_field() !!}
                    <div class="form-body">
                    	<div class="form-group">
                            <label class="col-md-3 control-label">所属项目</label>
                            <div class="col-md-9">
            			        <select class="form-control" name="item_id">
                                    <option value="0">请选择</option>
                                    @foreach ($items as $item)
                                  	<option value="{{$item->id}}">{{$item->name}}</option>
                                  	@endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">名称</label>
                            <div class="col-md-9">
                            	<input class="form-control spinner" type="text"  name="name"> 
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">简介</label>
                            <div class="col-md-9">
                            	<textarea class="form-control" rows="3" name="description"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputFile1"  class="col-md-3 control-label">封面图片</label>
                            <div class="col-md-9">
                                <input type="file" id="exampleInputFile1" name="cover">
                                <p class="help-block"> 封面图片</p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">排序</label>
                            <div class="col-md-9">
                            	<input class="form-control spinner" type="text" name="order" value="999"> 
                           	</div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">届/期</label>
                            <div class="col-md-9">
                            	<input class="form-control spinner" type="text" name="period" value=""> 
                           	</div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">展示时间</label>
                            <div class="col-md-9">
                            	<input class="form-control spinner" type="text" name="show_date" value=""> 
                           	</div>
                        </div>                                                                             
                        <div class="form-group">
                            <label class="col-md-3 control-label">seo_title</label>
                            <div class="col-md-9">
                            	<input class="form-control spinner" type="text" name="seo_title"> 
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">seo_keywords</label>
                            <div class="col-md-9">
                            	<input class="form-control spinner" type="text" name="seo_keywords"> 
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">seo_description</label>
                            <div class="col-md-9">
                            	<textarea class="form-control" rows="3" name="seo_description"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="form-actions center">
                    	<div class="row">
                    		<div class="col-md-offset-3 col-md-9">
                                <button type="submit" class="btn blue">Submit</button>
                                <button type="button" class="btn default">Cancel</button>
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