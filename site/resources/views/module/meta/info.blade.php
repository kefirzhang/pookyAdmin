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
                    对象元属性 </h3>
                <span class="kt-subheader__separator kt-hidden"></span>
                <div class="kt-subheader__breadcrumbs">
                    <a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
                    <span class="kt-subheader__breadcrumbs-separator"></span>
                    <a href="{{ route('category.index') }}" class="kt-subheader__breadcrumbs-link">列表页 </a>
                    <span class="kt-subheader__breadcrumbs-separator"></span>
                    <a href="" class="kt-subheader__breadcrumbs-link">新增</a>

                    <!-- <span class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">Active link</span> -->
                </div>
            </div>
            <div class="kt-subheader__toolbar">
                <div class="kt-subheader__wrapper">
                    <a href="{{ route('object.show',$object->id) }}" class="btn kt-subheader__btn-primary">
                        {{ $object->name }} &nbsp;
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
                        {{$object->name}}
                    </h3>
                </div>
            </div>

            <!--begin::Form-->
            <form method="POST" action="{{ route('category.store') }}" class="kt-form kt-form--label-right">
                @csrf
                <div class="kt-portlet__body" >
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




                    <div id="main_form">
                        <div class="form-group row">
                            <div class="col-1"></div>
                            <div class="col-2">X|Y轴</div>
                            <div class="col-2">内容类型</div>
                            <div class="col-2">显示名字</div>
                            <div class="col-2">别名</div>
                            <div class="col-1">排序</div>
                            <div class="col-1">操作</div>
                        </div>
                        @foreach ($metas as $meta)
                        <div class="form-group row">
                            <label class="col-1 col-form-label">配置</label>
                            <div class="col-2">
                                <select class="form-control" name="type[]">
                                    <option value="0">请选择</option>
                                    <option value="1">X轴</option>
                                    <option value="2" selected="selected">Y轴</option>
                                    @if($meta->type == 1)
                                    <option value="1" selected="selected">X轴</option>
                                    <option value="2">Y轴</option>
                                    @elseif($meta->type ==2)
                                    <option value="1">X轴</option>
                                    <option value="2" selected="selected">Y轴</option>
                                    @else
                                    <option value="1">X轴</option>
                                    <option value="2">Y轴</option>
                                    @endif
                                </select>
                            </div>
                            <div class="col-2">
                                <select class="form-control" name="content_type[]">
                                    <option value="0">请选择</option>
                                    @if($meta->content_type == 1)
                                    <option value="1" selected="selected">文本</option>
                                    <option value="2">图片</option>
                                    @elseif($meta->content_type ==2)
                                    <option value="1">文本</option>
                                    <option value="2" selected="selected">图片</option>
                                    @else
                                    <option value="1">文本</option>
                                    <option value="2">图片</option>
                                    @endif

                                </select>
                            </div>
                            <div class="col-2">
                                <input type="text" name="name[]" class="form-control spinner" placeholder="名称" value="{{ $meta->name }}">
                            </div>
                            <div class="col-2">
                                <input type="text" name="alias_name[]" class="form-control spinner" placeholder="别名" value="{{ $meta->ext_name }}">
                            </div>
                            <div class="col-2">
                                <input type="text" name="order[]" class="form-control spinner" placeholder="排序" value="{{ $meta->order }}">
                            </div>
                            <div class="col-1">
                                <button type="button" class="btn btn-danger" onclick="removeThisOption(this)">删除此项</button>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div class="form-group row">
                        <label for="example-text-input" class="col-2 col-form-label">开始名次</label>
                        <div class="col-3">
                            <input class="form-control" type="text" value="1" id="start_num" name="start_num">
                        </div>
                        <label for="example-text-input" class="col-2 col-form-label">结束名次</label>
                        <div class="col-3">
                            <input class="form-control" type="text" value="10" id="end_num" name="end_num">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="example-text-input" class="col-2 col-form-label">显示类型</label>
                        <div class="col-3">
                            <select id="batch_type" class="form-control" >
                                <option value="0">--请选择--</option>
                                <option value="1">纯数字{n}</option>
                                <option value="2">第{n}名</option>
                            </select>
                        </div>
                        <div class="col-3">
                            <button type="button" class="btn btn-primary" onclick="batchAddNewOption();" id="submit_button">批量增加名次配置</button>
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
        function batchAddNewOption(){
            var start_num = parseInt($("#start_num").val());
            var end_num = parseInt($("#end_num").val());
            var batch_type = parseInt($("#batch_type").val());
            var option_dom = '';
            for(var i = start_num; i <= end_num; i++){
                if(batch_type == 2){
                    var name = "第"+i+"名";
                } else {
                    var name = i;
                }
                option_dom += getOptionHtml(name,i);
            }
            $("#main_form").append(option_dom);
        }
        function addNewOption() {
            var optionHtml = getOptionHtml("","");
            $("#main_form").append(optionHtml);
        }

        function reduceOption() {
            $(".option-key-value:last").remove()
        }

        function removeThisOption(e) {
            $(e).parent().parent().remove();
        }

        function getOptionHtml(name,order) {
            option_dom  = '<div class="form-group row">\n' +
                '    <label class="col-1 col-form-label">配置</label>\n' +
                '    <div class="col-2">\n' +
                '        <select class="form-control" name="type[]">\n' +
                '            <option value="0">请选择</option>\n' +
                '            <option value="1">X轴</option>\n' +
                '            <option value="2" selected="selected">Y轴</option>\n' +
                '        </select>\n' +
                '    </div>\n' +
                '    <div class="col-2">\n' +
                '        <select class="form-control" name="content_type[]">\n' +
                '            <option value="0">请选择</option>\n' +
                '            <option value="1" selected="selected">文本</option>\n' +
                '            <option value="2">图片</option>\n' +
                '        </select>\n' +
                '    </div>\n' +
                '    <div class="col-2">\n' +
                '        <input type="text" name="name[]" class="form-control spinner" placeholder="名称" value="'+name+'">\n' +
                '    </div>\n' +
                '    <div class="col-2">\n' +
                '        <input type="text" name="alias_name[]" class="form-control spinner" placeholder="别名" value="'+name+'">\n' +
                '    </div>\n' +
                '    <div class="col-2">\n' +
                '        <input type="text" name="order[]" class="form-control spinner" placeholder="排序" value="'+order+'">\n' +
                '    </div>\n' +
                '    <div class="col-1">\n' +
                '        <button type="button" class="btn btn-danger" onclick="removeThisOption(this)">删除此项</button>\n' +
                '    </div>\n' +
                '</div>';
            return option_dom;
        }


    </script>
    <!--begin::Page Vendors(used by this page) -->


    <!--end::Page Vendors -->

    <!--begin::Page Scripts(used by this page) -->


    <!--end::Page Scripts -->
@endsection
