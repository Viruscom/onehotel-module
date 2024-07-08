@extends('layouts.admin.app')

@section('styles')
    <style>
        .sale-background {
            color:            #ffffff;
            background-color: #2d8f3c !important;
        }

        .sale-check-wrapper {
            display:         flex;
            align-items:     center;
            justify-content: flex-end;
        }

        .sale-check-wrapper > i {
            margin-right: 10px;
        }
    </style>
@endsection

@section('content')
    @include('shop::admin.settings.main.breadcrumbs')
    @include('admin.notify')

    <form action="{{ route('admin.hotel.settings.update') }}" method="POST">
        <div class="col-xs-12 p-0">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="bg-grey top-search-bar">
                <div class="action-mass-buttons pull-right">
                    <button type="submit" name="submit" value="submit" class="btn btn-lg save-btn margin-bottom-10"><i class="fas fa-save"></i></button>
                    <a href="{{ route('admin.hotel.settings.index') }}" role="button" class="btn btn-lg back-btn margin-bottom-10"><i class="fa fa-reply"></i></a>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="form form-horizontal">
                    <div class="form-body">
                        <div class="portlet light bordered">
                            <div class="portlet-title">
                                <div class="caption">
                                    <span>@lang('shop::admin.main_settings.index')</span>
                                </div>
                            </div>
                            <div class="portlet-body">
                                @foreach($hotelSettings as $hotelSetting)
                                    <div class="form-group">
                                        <label class="control-label col-md-3">{{ __('shop::admin.main_settings.'.$hotelSetting->key) }}:</label>
                                        <div class="col-md-6">
                                            <input type="text" name="shopSettings[{{$hotelSetting->key}}]" value="{{ old($hotelSetting->key) ?: $hotelSetting->value }}" class="form-control">
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </form>
@endsection
