@extends('layouts.app')

@section('page_style')
@endsection

@section('subheader')
    <div class="kt-subheader   kt-grid__item" id="kt_subheader">
        <div class="kt-container  kt-container--fluid ">
            <div class="kt-subheader__main">
                <h3 class="kt-subheader__title">
                    实例管理 </h3>
                <span class="kt-subheader__separator kt-hidden"></span>
                <div class="kt-subheader__breadcrumbs">
                    <a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
                    <span class="kt-subheader__breadcrumbs-separator"></span>
                    <a href="" class="kt-subheader__breadcrumbs-link">列表 </a>
                    <span class="kt-subheader__breadcrumbs-separator"></span>
                    <a href="" class="kt-subheader__breadcrumbs-link">实例列表 </a>

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
                        实例列表
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
                                <th>模型</th>
                                <th>名称</th>
                                <th>图标</th>
                                <th>排序</th>
                                <th>操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($records as $record)
                                <tr>
                                    <th scope="row">{{ $record->id }}</th>
                                    <td>{{ $record->object_id }}</td>
                                    <td>{{ $record->name }}</td>
                                    <td><img src="{{ asset('storage/'.$record->cover) }}" style="width:50px;height:50px;" /></td>
                                    <td>{{ $record->order }}</td>
                                    <td>
                                        <a title="Show sons" href="{{ route('cell.show',$record->id) }}" class="btn btn-sm btn-clean btn-icon btn-icon-md">
                                            <i class="la la-bars"></i>
                                        </a>
                                        <a title="Show details" href="{{ route('instance.show',$record->id) }}" class="btn btn-sm btn-clean btn-icon btn-icon-md">
                                            <i class="la la-search"></i>
                                        </a>
                                        <a title="Edit details" href="{{ route('instance.edit',$record->id) }}" class="btn btn-sm btn-clean btn-icon btn-icon-md">
                                            <i class="la la-edit"></i>
                                        </a>
                                        <form action="{{ route('instance.destroy',$record->id) }}" method="POST" style="display:inline">
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
                    <div class="kt-pagination  kt-pagination--info">
                        {!! $records->appends(['parent_id' => $parent_id ])->links() !!}
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
