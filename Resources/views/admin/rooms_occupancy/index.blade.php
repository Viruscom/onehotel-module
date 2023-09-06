@extends('layouts.admin.app')
@section('styles')
    <link href="{{ asset('admin/assets/css/select2.min.css') }}" rel="stylesheet"/>
@endsection
@section('scripts')
    <script src="{{ asset('admin/assets/js/select2.min.js') }}"></script>
    <script>
        $(document).ready(function () {
            $(".select2").select2({language: "bg"});
            $('.select2').on('change', function () {
                var select = $('.select2').find('option:selected');
            });
        });
    </script>
@endsection
@section('content')
    @include('onehotel::admin.rooms_occupancy.breadcrumbs')
    @include('admin.notify')
    <div class="row">
        <div class="col-xs-12">
            <div class="bg-grey top-search-bar">
                <div class="action-mass-buttons pull-right"></div>
            </div>
        </div>
    </div>
    <div class="alert alert-warning">{!! __('onehotel::admin.rooms_occupancy.warning') !!}</div>
    <div class="col-md-12">
        <div class="form form-horizontal form-bordered ">
            <div class="form-group">
                <label for="page_select" class="control-label col-md-3">{{ __('onehotel::admin.room') }}:</label>
                <div class="col-md-5">
                    <select id="page_select" name="room_id" class="form-control select2" style="width: 100%;">
                        <option value="">@lang('admin.common.please_select')</option>
                        @foreach($rooms as $roomCategory)
                            <optgroup label="{{ $roomCategory->title }}">
                                @foreach($roomCategory->pages as $room)
                                    <option value="{{$room->id }}">{{ $room->title }}</option>
                                @endforeach
                            </optgroup>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    </div>
@endsection
