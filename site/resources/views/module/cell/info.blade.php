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
                    <a href="{{ route('category.index') }}" class="kt-subheader__breadcrumbs-link">详情页 </a>
                    <span class="kt-subheader__breadcrumbs-separator"></span>
                    <a href="" class="kt-subheader__breadcrumbs-link">详情</a>

                    <!-- <span class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">Active link</span> -->
                </div>
            </div>
            <div class="kt-subheader__toolbar">
                <div class="kt-subheader__wrapper">
                    <a href="{{ route('category.create') }}" class="btn kt-subheader__btn-primary">
                        分类详情 &nbsp;
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
        <form method="POST" action="{{ route('cell.store') }}" class="kt-form kt-form--label-right" enctype="multipart/form-data">
        @csrf
        <div class="kt-portlet">
            <div class="kt-portlet__head">
                <div class="kt-portlet__head-label">
                    <h3 class="kt-portlet__head-title">
                        {{ $instance->name }}
                    </h3>
                </div>
            </div>
            <div class="kt-portlet__body">
                <!--begin::Section-->
                <div class="kt-section">
                    <div class="kt-section__content">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    @foreach ($metas_x as $x)
                                    <th>{{$x->name}}</th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($metas_y as $y)
                                <tr>
                                    <th scope="row">{{$y->name}}</th>
                                    @foreach($metas_x as $x)
                                        <td>
                                            <input type="text" name="cell[{{$x->id}}][{{$y->id}}]" class="form-control" placeholder="" value="{{ isset($cells[$x->id][$y->id])?$cells[$x->id][$y->id]:''}}">
                                        </td>
                                    @endforeach
                                </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="kt-section">
                    <div class="row">
                        <div class="col-lg-9 ml-lg-auto">
                            <input type="hidden" name="instance_id" value="{{$instance->id}}" />
                            <button type="submit" class="btn btn-success center">Submit</button>
                        </div>
                    </div>
                </div>
                <!--end::Section-->
            </div>

            <!--end::Form-->
        </div>

        </form>
    </div>
@endsection
<!-- end:: Content -->
@section('page_js')
@endsection
