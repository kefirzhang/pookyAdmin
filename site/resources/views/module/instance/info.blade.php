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
            <span>实例详情</span>
        </li>
    </ul>
</div>
<!-- END PAGE BAR -->
<!-- BEGIN PAGE TITLE-->
<h1 class="page-title"> 实例详情
    <small>Instance Detail</small>
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
                    <a class="btn btn-circle btn-icon-only btn-default" href="{{ url('admin/instance/'.$instance->id.'/edit') }}">
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
                    <div class="panel-body"> {{$instance->name}} </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">suid</h3>
                    </div>
                    <div class="panel-body"> {{$instance->suid}} </div>
                </div>                       
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">项目</h3>
                    </div>
                    <div class="panel-body"> {{$instance->item_name}} </div>
                </div>            
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">描述</h3>
                    </div>
                    <div class="panel-body"> {{$instance->description}} </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">封面图</h3>
                    </div>
                    <div class="panel-body"> 
                    	<img src="{{ asset('storage/'.$instance->cover) }}" style="width:50px;height:50px;" /> 
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">期/届（第52届）</h3>
                    </div>
                    <div class="panel-body"> {{$instance->period}} </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">展示时间（2017年）</h3>
                    </div>
                    <div class="panel-body"> {{$instance->show_date}} </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">排序</h3>
                    </div>
                    <div class="panel-body"> {{$instance->order}} </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">seo_title</h3>
                    </div>
                    <div class="panel-body"> {{$instance->seo_title}} </div>
                </div>            
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">seo_keywords</h3>
                    </div>
                    <div class="panel-body"> {{$instance->seo_keywords}} </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">seo_description</h3>
                    </div>
                    <div class="panel-body"> {{$instance->seo_description}} </div>
                </div>            
            </div>
        </div>
    </div>
</div>
@endsection