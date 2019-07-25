@extends('layouts.app')
@section('page_style')
    <!--begin::Page Vendors Styles(used by this page) -->
    <!--end::Page Vendors Styles -->
    <style>
        #chapter_area {
            background-color: #E9FAFF;
            color: #555;
            font-family: 宋体;
            font-size: 12px;
            margin: 0 auto;
        }

        #chapter_content {
            font-family: 方正启体简体, "Microsoft YaHei", 微软雅黑, 宋体;
            font-size: 17pt;
            letter-spacing: 0.2em;
            line-height: 150%;
            padding-top: 15px;
            width: 85%;
            margin: auto;
            font-weight: bolder;
        }

        #bottem_area {
            clear: both !important;
            text-align: center;
            width: 900px;
            margin: auto 20px;
            padding: 15px;
        }

    </style>
@endsection

@section('subheader')
    <div class="kt-subheader   kt-grid__item" id="kt_subheader">
        <div class="kt-container  kt-container--fluid ">
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
                        {{$record->title}}
                    </h3>
                </div>
            </div>
        </div>
        <div class="kt-portlet" id="chapter_area">
            <div class="kt-portlet__body">
                <div class="kt-infobox">
                    <div class="kt-infobox__header">
                        <h2 class="kt-infobox__title">{{$record->title}}</h2>
                    </div>
                    <div class="kt-infobox__body" id="chapter_content">
                        {!!$record->content!!}
                    </div>
                </div>
            </div>

        </div>
        <div class="kt-container" id="bottem_area">
            <div class="kt-section__content kt-section__content--solid">
                @if($pre->id??0 != '0')
                    <a class="btn btn-primary" href="{{ route('chapter.show',$pre->id??0 ) }}" role="button">上一章</a>
                @endif
                <a class="btn btn-success" href="{{ route('chapter.index') }}?b_id={{ $record->b_id }}"
                   role="button">目录</a>
                @if($pre->id??0 != '0')
                    <a class="btn btn-primary" href="{{ route('chapter.show',$after->id??0 ) }}" role="button">下一章</a>
                @endif
            </div>
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
