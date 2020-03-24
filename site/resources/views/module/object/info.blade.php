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
            <a href="{{url('admin/item')}}">项目管理</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span>项目详情</span>
        </li>
    </ul>
</div>
<!-- END PAGE BAR -->
<!-- BEGIN PAGE TITLE-->
<h1 class="page-title"> 项目详情
    <small>Item Detail</small>
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
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption">
                    <i class="icon-share font-red-sunglo"></i>
                    <span class="caption-subject font-red-sunglo bold uppercase">详情</span>
                </div>
                <div class="actions">
                    <a class="btn btn-circle btn-icon-only btn-default" href="javascript:;">
                        <i class="icon-cloud-upload"></i>
                    </a>
                    <a class="btn btn-circle btn-icon-only btn-default" href="{{ url('admin/item/'.$item->id.'/edit') }}">
                        <i class="icon-wrench"></i>
                    </a>
                    <a class="btn btn-circle btn-icon-only btn-default" href="javascript:;">
                        <i class="icon-trash"></i>
                    </a>
                </div>
            </div>
            <div class="portlet-body">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">名称</h3>
                    </div>
                    <div class="panel-body"> {{$item->name}} </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">英文名称</h3>
                    </div>
                    <div class="panel-body"> {{$item->en_name}} </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">别名</h3>
                    </div>
                    <div class="panel-body"> {{$item->alias_name}} </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">英文别名</h3>
                    </div>
                    <div class="panel-body"> {{$item->alias_en_name}} </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">suid</h3>
                    </div>
                    <div class="panel-body"> {{$item->suid}} </div>
                </div>                       
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">父类</h3>
                    </div>
                    <div class="panel-body"> {{$item->category_name}} </div>
                </div>            
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">描述</h3>
                    </div>
                    <div class="panel-body"> {{$item->description}} </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">封面图</h3>
                    </div>
                    <div class="panel-body"> 
                    	<img src="{{ asset('storage/'.$item->cover) }}" style="width:50px;height:50px;" /> 
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">类型</h3>
                    </div>
                    <div class="panel-body"> {{$item->type}} </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">时间类型</h3>
                    </div>
                    <div class="panel-body"> {{$item->period_type}} </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">官网</h3>
                    </div>
                    <div class="panel-body"> {{$item->official_site}} </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">官方更新时间</h3>
                    </div>
                    <div class="panel-body"> {{$item->official_update_time}} </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">排序</h3>
                    </div>
                    <div class="panel-body"> {{$item->order}} </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">seo_title</h3>
                    </div>
                    <div class="panel-body"> {{$item->seo_title}} </div>
                </div>            
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">seo_keywords</h3>
                    </div>
                    <div class="panel-body"> {{$item->seo_keywords}} </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">seo_description</h3>
                    </div>
                    <div class="panel-body"> {{$item->seo_description}} </div>
                </div>            
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">扩展信息</h3>
                    </div>
                    <div class="panel-body"> {{$item->ext_info}} </div>
                </div>                                        
            </div>
        </div>
    </div>
</div>
@endsection