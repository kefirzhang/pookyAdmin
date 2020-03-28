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
                    新增实例 </h3>
                <span class="kt-subheader__separator kt-hidden"></span>
                <div class="kt-subheader__breadcrumbs">
                    <a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
                    <span class="kt-subheader__breadcrumbs-separator"></span>
                    <a href="{{ route('instance.index') }}" class="kt-subheader__breadcrumbs-link">列表页 </a>
                    <span class="kt-subheader__breadcrumbs-separator"></span>
                    <a href="" class="kt-subheader__breadcrumbs-link">新增</a>

                    <!-- <span class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">Active link</span> -->
                </div>
            </div>
            <div class="kt-subheader__toolbar">
                <div class="kt-subheader__wrapper">
                    <a href="{{ route('instance.create') }}" class="btn kt-subheader__btn-primary">
                        新增实例 &nbsp;
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
                        新建实例
                    </h3>
                </div>
            </div>

            <!--begin::Form-->
            <form method="POST" action="{{ route('instance.store') }}" class="kt-form kt-form--label-right">
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
                        <label for="example-text-input" class="col-2 col-form-label">模型</label>
                        <div class="col-10">
                            <select class="form-control" name="object_id">
                                <option value="0">--</option>
                                @foreach ($objectList as $object)
                                    <option value="{{$object->id}}">{{$object->name}}</option>
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
                        <label for="example-text-input" class="col-2 col-form-label">描述</label>
                        <div class="col-10">
                            <input class="form-control" type="text" value="" name="description">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="example-text-input" class="col-2 col-form-label">封面</label>
                        <div class="col-10">
                            <input class="form-control" type="file" value="" name="cover">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="example-text-input" class="col-2 col-form-label">排序</label>
                        <div class="col-10">
                            <input class="form-control" type="text" value="9999" name="order">
                        </div>
                    </div>
                    <div class="form-group row option-key-value">
                        <label for="example-text-input" class="col-2 col-form-label">配置项</label>
                        <div class="col-4">
                            <input class="form-control" type="text" value="" name="options[key][]">
                        </div>
                        <div class="col-4">
                            <input class="form-control" type="text" value="" name="options[value][]">
                        </div>
                        <div class="col-2">
                            <button type="button" class="btn btn-danger" onclick="removeThisOption(this)">删除此项</button>
                        </div>
                    </div>
                </div>
                <div class="kt-portlet__foot">
                    <div class="kt-form__actions">
                        <div class="row">
                            <div class="col-3">
                            </div>
                            <div class="col-7">
                                <button type="button" class="btn btn-primary" onclick="addNewOption();">新增配置项</button>
                                <button type="button" class="btn btn-primary" onclick="reduceOption();">减少配置项</button>
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
    <script>
        function addNewOption() {
            var optionHtml = getOptionHtml();
            $("#main_form").append(optionHtml);
        }

        function reduceOption() {
            $(".option-key-value:last").remove()
        }

        function removeThisOption(e) {
            $(e).parent().parent().remove();
        }

        function getOptionHtml() {
            option_dom = '<div class="form-group row option-key-value">\n' +
                '                        <label for="example-text-input" class="col-2 col-form-label">配置项</label>\n' +
                '                        <div class="col-4">\n' +
                '                            <input class="form-control" type="text" value="" name="options[key][]">\n' +
                '                        </div>\n' +
                '                        <div class="col-4">\n' +
                '                            <input class="form-control" type="text" value="" name="options[value][]">\n' +
                '                        </div>\n' +
                '                        <div class="col-2">\n' +
                '                            <button type="button" class="btn btn-danger" onclick="removeThisOption(this)">删除此项</button>\n' +
                '                        </div>\n' +
                '                    </div>';

            return option_dom;
        }


    </script>
    <!--begin::Page Vendors(used by this page) -->


    <!--end::Page Vendors -->

    <!--begin::Page Scripts(used by this page) -->


    <!--end::Page Scripts -->
@endsection
