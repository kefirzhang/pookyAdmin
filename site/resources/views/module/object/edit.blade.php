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
            <span>编辑项目</span>
        </li>
    </ul>
</div>
<!-- END PAGE BAR -->
<!-- BEGIN PAGE TITLE-->
<h1 class="page-title"> 新增项目
    <small>Edit Item</small>
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
                    <span class="caption-subject font-blue-sharp bold uppercase"> 项目信息</span>
                </div>
            </div>
            <div class="portlet-body form">
        	<form action="{{ url('admin/item/'.$item->id) }}" method="POST" class="form-horizontal" enctype="multipart/form-data" >
        		{!! csrf_field() !!}
        		{!! method_field('PATCH') !!}
                    <div class="form-body">
                    	<div class="form-group">
                            <label class="col-md-3 control-label">所属分类</label>
                            <div class="col-md-9">
                                <select class="form-control" name="category_id">
                                  	<option value="0">请选择</option>
                                    @foreach ($categorys as $category)
                                    @if($category->id == $item->category_id)
                                    <option value="{{$category->id}}" selected="selected">{{$category->name}}</option>
                                    @else
                                  	<option value="{{$category->id}}">{{$category->name}}</option>
                                    @endif
                                  	@endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">名称</label>
                            <div class="col-md-9">
                            	<input class="form-control spinner" type="text"  name="name" value="{{$item->name}}"> 
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">英文名称</label>
                            <div class="col-md-9">
                            	<input class="form-control spinner" type="text"  name="en_name" value="{{$item->en_name}}"> 
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">别名</label>
                            <div class="col-md-9">
                            	<input class="form-control spinner" type="text"  name="alias_name" value="{{$item->alias_name}}"> 
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">英文别名</label>
                            <div class="col-md-9">
                            	<input class="form-control spinner" type="text"  name="alias_en_name" value="{{$item->alias_en_name}}"> 
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">简介</label>
                            <div class="col-md-9">
                            	<textarea class="form-control" rows="3" name="description">{{$item->description}}</textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">扩展信息</label>
                            <div class="col-md-9">
                            	<textarea class="form-control" rows="3" name="ext_info">{{$item->ext_info}}</textarea>
                            </div>
                        </div>                        
                        <div class="form-group">
                            <label for="exampleInputFile1"  class="col-md-3 control-label">封面图片</label>
                            <div class="col-md-9">
                                <input type="file" id="exampleInputFile1" name="cover">
                                <p class="help-block">
                                	<br/>
                                	<img src="{{ asset('storage/'.$item->cover) }}" style="width:50px;height:50px;" />
								</p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">类型</label>
                            <div class="col-md-9">
                            	<select class="form-control" name="type">
            			        	@foreach ($item_type['type'] as $type_key=>$type_value)
            			        	@if($item->type == $type_key)
            			        	<option value="{{$type_key}}" selected="selected">{{$type_value}}</option>
            			        	@else
                                  	<option value="{{$type_key}}">{{$type_value}}</option>
                                  	@endif
                                  	@endforeach
                                </select>
                           	</div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">周期</label>
                            <div class="col-md-9">
                            	<select class="form-control" name="period_type">
            			        	@foreach ($item_type['period_type'] as $period_key=>$period_value)
            			        	@if($item->period_type == $period_key)
            			        	<option value="{{$period_key}}" selected="selected">{{$period_value}}</option>
            			        	@else
                                  	<option value="{{$period_key}}">{{$period_value}}</option>
                                  	@endif
                                  	@endforeach
                                </select>
                           	</div>
                        </div>                                                
                        <div class="form-group">
                            <label class="col-md-3 control-label">排序</label>
                            <div class="col-md-9">
                            	<input class="form-control spinner" type="text" name="order"  value="{{$item->order}}"> 
                           	</div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">官方网站</label>
                            <div class="col-md-9">
                            	<input class="form-control spinner" type="text" name="official_site"  value="{{$item->official_site}}"> 
                           	</div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">官方更新时间</label>
                            <div class="col-md-9">
                            	<input class="form-control spinner" type="text" name="official_update_time"  value="{{$item->official_update_time}}"> 
                           	</div>
                        </div>                                                                             
                        <div class="form-group">
                            <label class="col-md-3 control-label">seo_title</label>
                            <div class="col-md-9">
                            	<input class="form-control spinner" type="text" name="seo_title" value="{{$item->seo_title}}"> 
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">seo_keywords</label>
                            <div class="col-md-9">
                            	<input class="form-control spinner" type="text" name="seo_keywords" value="{{$item->seo_keywords}}"> 
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">seo_description</label>
                            <div class="col-md-9">
                            	<textarea class="form-control" rows="3" name="seo_description">{{$item->seo_description}}</textarea>
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