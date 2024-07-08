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
    @include('onehotel::admin.settings.breadcrumbs')
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
                                    <span>Основни настройки</span>
                                </div>
                            </div>
                            <div class="portlet-body">
                                <div class="form-group">
                                    <label class="control-label col-md-3 p-t-0">Тип резервационна система:</label>
                                    <div class="col-md-9">
                                <span class="module">
                                    <div class="pretty p-default p-round">
                                        <input type="radio" name="default_reservation_system" value="inquiry" {{old('default_reservation_system') == 'inquiry' || $hotelSettings->default_reservation_system == 'inquiry' ? 'checked': ''}}>
                                        <div class="state p-primary-o">
                                            <label>Запитване</label>
                                        </div>
                                    </div>
                                </span>

                                        <span class="module">
                                    <div class="pretty p-default p-round">
                                        <input type="radio" name="default_reservation_system" value="clientric" {{old('default_reservation_system') == 'clientric' || $hotelSettings->default_reservation_system == 'clientric' ? 'checked': ''}}>
                                        <div class="state p-primary-o">
                                            <label>Clientric</label>
                                        </div>
                                    </div>
                                </span>

                                        <span class="module">
                                    <div class="pretty p-default p-round">
                                        <input type="radio" name="default_reservation_system" value="clock" {{old('default_reservation_system') == 'clock' || $hotelSettings->default_reservation_system == 'clock' ? 'checked': ''}}>
                                        <div class="state p-primary-o">
                                            <label>Clock</label>
                                        </div>
                                    </div>
                                </span>

                                        <span class="module">
                                    <div class="pretty p-default p-round">
                                        <input type="radio" name="default_reservation_system" value="travelline" {{old('default_reservation_system') == 'travelline' || $hotelSettings->default_reservation_system == 'travelline' ? 'checked': ''}}>
                                        <div class="state p-primary-o">
                                            <label>Travelline</label>
                                        </div>
                                    </div>
                                </span>

                                    </div>
                                </div>
                                <hr>

                                <div class="form-group">
                                    <label class="control-label col-md-3">Ключ за Clientric:</label>
                                    <div class="col-md-6">
                                        <input type="text" name="clientric_key" value="{{ old('clientric_key') ?: $hotelSettings->clientric_key }}" class="form-control">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3">Ключ за Clock:</label>
                                    <div class="col-md-6">
                                        <input type="text" name="clock_key" value="{{ old('clock_key') ?: $hotelSettings->clock_key }}" class="form-control">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3">Ключ за Travelline:</label>
                                    <div class="col-md-6">
                                        <input type="text" name="travelline_key" value="{{ old('travelline_key') ?: $hotelSettings->travelline_key }}" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </form>
@endsection
