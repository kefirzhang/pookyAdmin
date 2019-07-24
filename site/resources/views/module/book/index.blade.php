@extends('layouts.app')

@section('page_style')
@endsection

@section('subheader')
    <div class="kt-subheader   kt-grid__item" id="kt_subheader">
        <div class="kt-container  kt-container--fluid ">
            <div class="kt-subheader__main">
                <h3 class="kt-subheader__title">
                    Book-配置项管理 </h3>
                <span class="kt-subheader__separator kt-hidden"></span>
                <div class="kt-subheader__breadcrumbs">
                    <a href="{{ route('index') }}" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
                    <span class="kt-subheader__breadcrumbs-separator"></span>
                    <a href="{{ route('book.index') }}" class="kt-subheader__breadcrumbs-link">列表 </a>
                    <span class="kt-subheader__breadcrumbs-separator"></span>
                    <a href="javascript:;" class="kt-subheader__breadcrumbs-link">列表 </a>

                    <!-- <span class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">Active link</span> -->
                </div>
            </div>
            <div class="kt-subheader__toolbar">
                <div class="kt-subheader__wrapper">
                    <a href="{{ route('book.create') }}" class="btn kt-subheader__btn-primary">
                        新增
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
        @if (count($errors) > 0)
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
        @endif
        <div class="kt-portlet">
            <div class="kt-portlet__head">
                <div class="kt-portlet__head-label">
                    <h3 class="kt-portlet__head-title">
                        Bordered Table
                    </h3>
                </div>
            </div>
            <div class="kt-portlet__body">

                <!--begin::Section-->
                <div class="kt-section">
                    <div class="kt-section__content">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>名称</th>
                                <th>分类</th>
                                <th>作者</th>

{{--                                <th>简介</th>--}}
{{--                                <th>封面</th>--}}
{{--                                <th>标签</th>--}}
{{--                                --}}
                                <th>最新章节</th>
                                <th>采集规则id</th>
                                <th>是否完结</th>

                                <th>操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($records as $record)
                                <tr>
                                    <th scope="row">{{ $record->id }}</th>
                                    <td>{{ $record->name }}</td>
                                    <td>{{ $record->category }}</td>
                                    <td>{{ $record->author }}</td>
{{--                                    <td>{{ $record->intro }}</td>--}}
{{--                                    <td>{{ $record->cover }}</td>--}}
{{--                                    <td>{{ $record->tags }}</td>--}}
                                    <td>{{ $record->last_chapter }}</td>
                                    <td>{{ $record->bs_id }}</td>
                                    <td>{{ $record->finished }}</td>
                                    <td>
                                        <a title="章节列表" href="{{ route('chapter.index') }}?b_id={{ $record->id }}" class="btn btn-sm btn-clean btn-icon btn-icon-md">
                                            <i class="la la-list"></i>
                                        </a>
                                        <a title="采集规则" href="{{ route('spider.index') }}?b_id={{ $record->id }}" class="btn btn-sm btn-clean btn-icon btn-icon-md">
                                            <i class="la la-dropbox"></i>
                                        </a>

                                        <a title="Edit details" href="{{ route('book.edit',$record->id) }}" class="btn btn-sm btn-clean btn-icon btn-icon-md">
                                            <i class="la la-edit"></i>
                                        </a>
                                        <form action="{{ route('book.destroy',$record->id) }}" method="POST" style="display:inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-clean btn-icon btn-icon-md">
                                                <i class="la la-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <!--end::Section-->
            </div>

            <!--end::Form-->
        </div>
    </div>
@endsection
<!-- end:: Content -->
@section('page_js')
@endsection
