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
            <a href="{{url('admin/instance')}}">实例列表</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span>项目内容</span>
        </li>
    </ul>
</div>
<!-- END PAGE BAR -->
<!-- BEGIN PAGE TITLE-->
<h1 class="page-title"> 【{{$instance->name}}】 的内容
    <small>所属榜单：{{$instance->item_name}}-期：{{$instance->period}}</small>
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
	<form action="{{ url('admin/cell') }}" method="POST" class="form-horizontal" id="cell_form" enctype="multipart/form-data" >
    {!! csrf_field() !!}
	<div class="col-md-12">
		<div class="portlet box blue">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-cogs"></i>数据标题
                </div>
                <div class="actions">
                    <a href="javascript:;" class="btn btn-default btn-sm">
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
                                <th> # </th>
                                @foreach ($units_x as $x)
                                <th>{{$x->name}}</th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($units_y as $y)
                            <tr>
                            	<td>{{$y->name}}</td>
                            	@foreach($units_x as $x)
                            	@if($x->content_type ==1)
                            	<td><input type="text" name="cell[{{$x->id}}][{{$y->id}}]" class="form-control" placeholder="" value="{{$cells[$x->id][$y->id] or ''}}"></td>
                            	@elseif($x->content_type == 2)
                            	<td>
                            		<input type="file" name="cell[{{$x->id}}][{{$y->id}}]" >
                            		<input type="hidden" name="cover[{{$x->id}}][{{$y->id}}]" value="{{$cells[$x->id][$y->id] or ''}}">
                            		<img src="{{ asset('storage/')}}/{{$cells[$x->id][$y->id] or ''}}" style="width:50px;height:50px;" /> 
                            	</td>
                            	@else
                            	<td><input type="text" name="cell[{{$x->id}}][{{$y->id}}]" class="form-control" placeholder="" value="{{$cells[$x->id][$y->id] or ''}}"></td>
                            	@endif
                            	@endforeach
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <input type="hidden" name="instance_id" value="{{$instance->id}}" />
        <div class="form-actions center">
        	<div class="row">
        		<div class="col-md-offset-3 col-md-9">
                    <button type="submit" class="btn blue">提交</button>
        		</div>
        	</div>
        </div>
	</div>
	</form>
</div>
@endsection
