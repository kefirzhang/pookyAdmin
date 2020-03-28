@extends('layouts.app')
@section('page_style')
    <!--begin::Page Vendors Styles(used by this page) -->
    <!--end::Page Vendors Styles -->
@endsection

@section('subheader')
    <div class="kt-subheader   kt-grid__item" id="kt_subheader">
        <div class="kt-container  kt-container--fluid ">
            <div class="kt-subheader__main">
                <h3 class="kt-subheader__title">
                    分类详情 </h3>
                <span class="kt-subheader__separator kt-hidden"></span>
                <div class="kt-subheader__breadcrumbs">
                    <a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
                    <span class="kt-subheader__breadcrumbs-separator"></span>
                    <a href="{{ route('category.index') }}" class="kt-subheader__breadcrumbs-link">列表</a>
                    <span class="kt-subheader__breadcrumbs-separator"></span>
                    <a href="javascript:void(0);" class="kt-subheader__breadcrumbs-link">详情</a>

                    <!-- <span class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">Active link</span> -->
                </div>
            </div>
            <div class="kt-subheader__toolbar">
                <div class="kt-subheader__wrapper">
                    <a href="{{ route('category.create') }}" class="btn kt-subheader__btn-primary">
                        新增分类 &nbsp;
                        <!--<i class="flaticon2-calendar-1"></i>-->
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection

<!-- begin:: Content -->
@section('content')
    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
        <div class="kt-portlet">
            <div class="kt-portlet__head">
                <div class="kt-portlet__head-label">
                    <h3 class="kt-portlet__head-title">
                        【{{ $record->name }}】详情
                    </h3>
                </div>
            </div>

            <!--begin::Form-->
            <form method="POST" action="{{ route('category.update',$record->id) }}"
                  class="kt-form kt-form--label-right">
                @csrf
                <div class="kt-portlet__body" id="main_form">
                    @if (count($errors) > 0)
                        <div class="form-group form-group-last">
                            <div class="alert alert-secondary" role="alert">
                                <div class="alert-icon"><i class="flaticon-warning kt-font-brand"></i></div>
                                <div class="alert-text">
                                    @foreach ($errors->all() as $error)
                                        <div class="note note-danger">
                                            <p> {{ $error }} </p>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endif

                    <div class="form-group row">
                        <label for="example-text-input" class="col-2 col-form-label">父类</label>
                        <div class="col-10">
                            <input class="form-control" readonly type="text" value="{{ $record->parent_name }}"
                                   name="name">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="example-text-input" class="col-2 col-form-label">名称</label>
                        <div class="col-10">
                            <input class="form-control" readonly type="text" value="{{ $record->name }}" name="name">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="example-text-input" class="col-2 col-form-label">别名</label>
                        <div class="col-10">
                            <input class="form-control" readonly type="text" value="{{ $record->alias_name }}"
                                   name="alias_name">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="example-text-input" class="col-2 col-form-label">描述</label>
                        <div class="col-10">
                            <input class="form-control" readonly type="text" value="{{ $record->description }}"
                                   name="description">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="example-text-input" class="col-2 col-form-label">封面</label>
                        <div class="col-10">
                            <img src="{{ asset('storage/'.$record->cover) }}" style="width:50px;height:50px;" />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="example-text-input" class="col-2 col-form-label">排序</label>
                        <div class="col-10">
                            <input class="form-control" readonly type="text" value="{{ $record->order }}" name="order">
                        </div>
                    </div>
                    @foreach ($record->options['key'] as $key=>$optionKey)
                        <div class="form-group row option-key-value">
                            <label for="example-text-input" class="col-2 col-form-label">配置项</label>
                            <div class="col-4">
                                <input class="form-control" readonly type="text" value="{{$optionKey}}" name="options[key][]">
                            </div>
                            <div class="col-4">
                                <input class="form-control" readonly type="text" value="{{$record->options['value'][$key]}}" name="options[value][]">
                            </div>
                        </div>
                    @endforeach
                </div>

            </form>
        </div>
    </div>
@endsection
<!-- end:: Content -->
@section('page_js')
@endsection
