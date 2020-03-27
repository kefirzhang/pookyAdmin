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
                    配置项详情 </h3>
                <span class="kt-subheader__separator kt-hidden"></span>
                <div class="kt-subheader__breadcrumbs">
                    <a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
                    <span class="kt-subheader__breadcrumbs-separator"></span>
                    <a href="{{ route('option.index') }}" class="kt-subheader__breadcrumbs-link">详情页 </a>
                    <span class="kt-subheader__breadcrumbs-separator"></span>
                    <a href="" class="kt-subheader__breadcrumbs-link">详情</a>

                    <!-- <span class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">Active link</span> -->
                </div>
            </div>
            <div class="kt-subheader__toolbar">
                <div class="kt-subheader__wrapper">
                    <a href="{{ route('option.create') }}" class="btn kt-subheader__btn-primary">
                        配置项详情 &nbsp;
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
                        详情
                    </h3>
                </div>
            </div>

            <!--begin::Form-->
            <form method="POST" action="{{ route('option.update',$record->id) }}"
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
                        <label for="example-text-input" class="col-2 col-form-label">配置项</label>
                        <div class="col-10">
                            <input class="form-control" type="text" readonly value="{{ $record->name }}" name="name">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="example-text-input" class="col-2 col-form-label">配置别名</label>
                        <div class="col-10">
                            <input class="form-control" type="text" readonly value="{{ $record->alias_name }}" name="name">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="example-text-input" class="col-2 col-form-label">配置内容</label>
                        <div class="col-10">
                            <input class="form-control" type="text" readonly value="{{ $record->value }}" name="value">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="example-text-input" class="col-2 col-form-label">自动加载</label>
                        <div class="col-10">
                            @if ($record->autoload == 1 )
                                <input class="form-control" type="text" readonly value="YES" name="autoload">
                            @else
                                <input class="form-control" type="text" readonly value="NO" name="autoload">
                            @endif

                        </div>


                    </div>
                </div>

            </form>
        </div>
    </div>
@endsection
<!-- end:: Content -->
@section('page_js')
@endsection
