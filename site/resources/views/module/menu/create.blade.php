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
                    菜单新增 </h3>
                <span class="kt-subheader__separator kt-hidden"></span>
                <div class="kt-subheader__breadcrumbs">
                    <a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
                    <span class="kt-subheader__breadcrumbs-separator"></span>
                    <a href="{{ route('menu.index') }}" class="kt-subheader__breadcrumbs-link">列表页 </a>
                    <span class="kt-subheader__breadcrumbs-separator"></span>
                    <a href="" class="kt-subheader__breadcrumbs-link">新增</a>

                    <!-- <span class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">Active link</span> -->
                </div>
            </div>
            <div class="kt-subheader__toolbar">
                <div class="kt-subheader__wrapper">
                    <a href="{{ route('menu.create') }}" class="btn kt-subheader__btn-primary">
                        新增新增 &nbsp;
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
                        菜单新增
                    </h3>
                </div>
            </div>

            <!--begin::Form-->
            <form method="POST" action="{{ route('menu.store') }}" class="kt-form kt-form--label-right" enctype="multipart/form-data">
                @csrf
                <div class="kt-portlet__body">
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
                            <select class="form-control" name="p_id">
                                <option value="0">顶级分类</option>
                                @foreach($tRecords as $tRecord)
                                    <option value="{{$tRecord->id}}">{{$tRecord->level_pre}}{{$tRecord->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="example-text-input" class="col-2 col-form-label">名称</label>
                        <div class="col-10">
                            <input class="form-control" type="text" value="" name="name">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="example-text-input" class="col-2 col-form-label">图标</label>
                        <div class="col-10">
                            <input class="form-control" type="text" value="" name="icon">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="example-text-input" class="col-2 col-form-label">地址</label>
                        <div class="col-10">
                            <input class="form-control" type="text" value="" name="action">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="example-text-input" class="col-2 col-form-label">目标</label>
                        <div class="col-10">
                            <select class="form-control" id="exampleSelectd" name="target">
                                <option value="_self">相同的框架中(_self)</option>
                                <option value="_blank">在新窗口中(_blank)</option>
                                <option value="_parent">在父框架集中(_parent)</option>
                                <option value="_top">在整个窗口中(_top)</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="example-text-input" class="col-2 col-form-label">排序</label>
                        <div class="col-10">
                            <input class="form-control" type="text" value="9999" name="order">
                        </div>
                    </div>
                </div>
                <div class="kt-portlet__foot">
                    <div class="kt-form__actions">
                        <div class="row">
                            <div class="col-2">
                            </div>
                            <div class="col-10">
                                <button type="submit" class="btn btn-success">Submit</button>
                                <button type="reset" class="btn btn-secondary">Cancel</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
<!-- end:: Content -->
@section('page_js')
    <!--begin::Page Vendors(used by this page) -->


    <!--end::Page Vendors -->

    <!--begin::Page Scripts(used by this page) -->


    <!--end::Page Scripts -->
@endsection
