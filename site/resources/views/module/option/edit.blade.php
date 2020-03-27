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
                    编辑配置项 </h3>
                <span class="kt-subheader__separator kt-hidden"></span>
                <div class="kt-subheader__breadcrumbs">
                    <a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
                    <span class="kt-subheader__breadcrumbs-separator"></span>
                    <a href="{{ route('option.index') }}" class="kt-subheader__breadcrumbs-link">列表页 </a>
                    <span class="kt-subheader__breadcrumbs-separator"></span>
                    <a href="" class="kt-subheader__breadcrumbs-link">编辑</a>

                    <!-- <span class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">Active link</span> -->
                </div>
            </div>
            <div class="kt-subheader__toolbar">
                <div class="kt-subheader__wrapper">
                    <a href="{{ route('option.create') }}" class="btn kt-subheader__btn-primary">
                        编辑配置项 &nbsp;
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
                        编辑配置项
                    </h3>
                </div>
            </div>

            <!--begin::Form-->
            <form method="POST" action="{{ route('option.update',$record->id) }}" class="kt-form kt-form--label-right">
                @csrf
                @method('PUT')
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
                        <label for="example-text-input" class="col-2 col-form-label">配置项</label>
                        <div class="col-10">
                            <input class="form-control" type="text" value="{{ $record->name }}" name="name">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="example-text-input" class="col-2 col-form-label">配置别名</label>
                        <div class="col-10">
                            <input class="form-control" type="text" value="{{ $record->alias_name }}" name="alias_name">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="example-text-input" class="col-2 col-form-label">配置内容</label>
                        <div class="col-10">
                            <input class="form-control" type="text" value="{{ $record->value }}" name="value">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="example-text-input" class="col-2 col-form-label">自动加载</label>
                        <div class="col-10">
                            <select class="form-control" name="autoload">
                                @if ($record->autoload == 1 )
                                <option value="0">NO</option>
                                <option value="1" selected>YES</option>
                                @else
                                <option value="0" selected>NO</option>
                                <option value="1">YES</option>
                                @endif
                            </select>
                        </div>
                    </div>

                </div>
                <div class="kt-portlet__foot">
                    <div class="kt-form__actions">
                        <div class="row">
                            <div class="col-3">
                            </div>
                            <div class="col-7">
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
