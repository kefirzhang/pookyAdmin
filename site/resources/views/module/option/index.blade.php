@extends('layouts.app')

@section('page_style')
@endsection

@section('subheader')
    <div class="kt-subheader   kt-grid__item" id="kt_subheader">
        <div class="kt-container  kt-container--fluid ">
            <div class="kt-subheader__main">
                <h3 class="kt-subheader__title">
                    {{ $moduleConf['moduleTips'] }}</h3>
                <span class="kt-subheader__separator kt-hidden"></span>
                <div class="kt-subheader__breadcrumbs">
                    <a href="{{ route('index') }}" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
                    <span class="kt-subheader__breadcrumbs-separator"></span>
                    <a href="{{ route($moduleConf['moduleRoutePre'].'.index') }}" class="kt-subheader__breadcrumbs-link">列表 </a>
                    <span class="kt-subheader__breadcrumbs-separator"></span>
                    <a href="javascript:;" class="kt-subheader__breadcrumbs-link">列表 </a>

                    <!-- <span class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">Active link</span> -->
                </div>
            </div>
            <div class="kt-subheader__toolbar">
                <div class="kt-subheader__wrapper">
                    <a href="{{ route('option.create') }}" class="btn kt-subheader__btn-primary">
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
                                @foreach ($metaData as $meta)
                                    @if($meta['list_show'])
                                        <th>{{$meta['show_name']}}</th>
                                    @endif
                                @endforeach
                                <th>操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($records as $record)
                                <tr>
                                    <th scope="row">{{ $record->id }}</th>
                                    @foreach ($metaData as $meta)
                                        @if($meta['list_show'])
                                            <td>{{ $record->{$meta['name']} }}</td>
                                        @endif
                                    @endforeach
                                    <td>
                                        <a title="详情" href="{{ route($moduleConf['moduleRoutePre'].'.show',$record->id) }}" class="btn btn-sm btn-clean btn-icon btn-icon-md">
                                            <i class="la la-file-text"></i>
                                        </a>
                                        <a title="编辑" href="{{ route($moduleConf['moduleRoutePre'].'.edit',$record->id) }}" class="btn btn-sm btn-clean btn-icon btn-icon-md">
                                            <i class="la la-edit"></i>
                                        </a>
                                        <form action="{{ route($moduleConf['moduleRoutePre'].'.destroy',$record->id) }}" method="POST" style="display:inline">
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
                    <div class="row">

                        <div class="col-sm-12 col-md-7">

                        </div>
                        <div class="col-sm-12 col-md-5">
                            <div>
                                {{ $records->appends(['id' => $record->id ])->links() }}
                            </div>
                        </div>
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
