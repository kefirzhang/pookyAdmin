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
            <span>实例列表</span>
        </li>
    </ul>
</div>
<!-- END PAGE BAR -->
<!-- BEGIN PAGE TITLE-->
<h1 class="page-title"> 实例列表
    <small>Instance List</small>
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
		<div class="portlet box blue">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-cogs"></i>数据标题
                </div>
                <div class="actions">
                    <a href="{{url('admin/instance/create')}}" class="btn btn-default btn-sm">
                        <i class="fa fa-plus"></i> Add </a>
                    <a href="javascript:;" class="btn btn-default btn-sm">
                        <i class="fa fa-print"></i> Print </a>
                </div>
            </div>
            <div class="portlet-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>操作</th>
                                <th>ID</th>
                                <th>名称</th>
                                <th>项目</th>
                                <th>内容</th>
                                <th>操作</th>
                                <th>删除</th>
                            </tr>
                        </thead>
                        <tbody>
                        	@foreach ($instances as $instance)
                            <tr>
                                <td> <input type="checkbox" name="" value="{{$instance->id}}"/> </td>
                                <td> {{$instance->id}} </td>
                                <td> {{$instance->name}}</td>
                                <td> {{$instance->item_name}}</td>
                                <td> 
                                	<a href="{{ url('admin/cell/'.$instance->id) }}" class="btn btn-info">具体数据</a>
                                </td>
                                <td> 
                                	<a href="{{ url('admin/instance/'.$instance->id) }}" class="btn btn-info">查看</a>
                          	  		<a href="{{ url('admin/instance/'.$instance->id.'/edit') }}" class="btn btn-info">编辑</a> 
                          	  	</td>
                                <td> 
                                	<form action="{{ url('admin/instance/'.$instance->id) }}" method="POST">
                                    {!! csrf_field() !!}
                                    {!! method_field('DELETE') !!}
                                        <button type="submit" class="btn btn-danger">
                                            <i class="fa fa-trash"></i>删除
                                        </button>
                                 	</form>
                               </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="row text-center">
                	<div class="col-md-12">
                		<div class="dataTables_paginate paging_bootstrap_full_number" id="sample_1_2_paginate">
                			{!! $instances->links() !!}
                		</div>	
                	</div>
				</div>
            </div>
        </div>
	</div>
</div>
@endsection