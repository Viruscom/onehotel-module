@extends('layouts.admin.app')
@section('styles')
    <link href="{{ asset('admin/assets/css/select2.min.css') }}" rel="stylesheet"/>
    <link href="{{ asset('front/common/calendar.css') }}" rel="stylesheet"/>
    <style>
        .booking-wrapper {
            display:         flex;
            justify-content: space-evenly;
        }

        .legend-item {
            position: relative;
        }

        .legend-item span {
            display:        inline-block;
            vertical-align: middle;
        }

        .legend-box {
            position:       relative;
            display:        inline-block;
            vertical-align: middle;
            width:          25px;
            height:         25px;
            border:         1px solid #d4ddbe;
            background:     #fff;
        }

        .legend-item-closed .legend-box {
            background: #FF908F;
        }

        .legend-item-pm .legend-box:after {
            content:       '';
            position:      absolute;
            left:          -1px;
            top:           -1px;
            border-left:   24px solid transparent;
            border-right:  0 solid transparent;
            border-bottom: 24px solid #FF908F;
        }

        .legend-item-am .legend-box:after {
            content:      '';
            position:     absolute;
            left:         0px;
            top:          0px;
            border-left:  0 solid transparent;
            border-right: 24px solid transparent;
            border-top:   24px solid #FF908F;
        }
    </style>
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
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
    <div class="row">
        <div class="col-md-12">
            <div class="form form-horizontal form-bordered ">
                <div class="form-group">
                    <label for="page_select" class="control-label col-md-3">{{ __('onehotel::admin.room') }}:</label>
                    <div class="col-md-5">
                        <select id="page_select" name="room_id" class="form-control select2" style="width: 100%;">
                            @foreach($rooms as $roomCategory)
                                <option value="">@lang('admin.common.please_select')</option>
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
    </div>

    <div class="row m-t-40">
        <div class="col-md-12">
            <div id="calendar" class="col-md-12"></div>
        </div>
        <div class="col-md-12">
            <div class="booking-legend booking-wrapper m-t-40">
                <div class="legend-item aos-init aos-animate" data-aos="fade-up" data-aos-delay="50">
                    <div class="legend-box"></div>
                    <span>{{ __('onehotel::front.book_status_available') }}</span>
                </div>

                <div class="legend-item legend-item-closed aos-init aos-animate" data-aos="fade-up" data-aos-delay="100">
                    <div class="legend-box"></div>
                    <span>{{ __('onehotel::front.book_status_booked_or_closed') }}</span>
                </div>

                <div class="legend-item legend-item-am aos-init aos-animate" data-aos="fade-up" data-aos-delay="150">
                    <div class="legend-box"></div>
                    <span>{{ __('onehotel::front.book_status_booked_am') }}</span>
                </div>

                <div class="legend-item legend-item-pm aos-init aos-animate" data-aos="fade-up" data-aos-delay="200">
                    <div class="legend-box"></div>
                    <span>{{ __('onehotel::front.book_status_booked_pm') }}</span>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            function fetchAndRenderCalendar(roomId) {
                $.ajax({
                    url: $('.base-url').val() + '/admin/hotel/room_occupancy/get-room-occupancy/' + roomId,
                    type: 'GET',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (rawData) {
                        var formattedData = {};
                        rawData.forEach(function (entry) {
                            if (!formattedData[entry.start_date]) {
                                formattedData[entry.start_date] = [];
                            }
                            formattedData[entry.start_date].push(entry.slot);

                            // ако е необходимо, добавете същото и за end_date
                        });
                        renderCalendar(formattedData);
                    }
                });
            }

            function renderCalendar(data) {
                $('#calendar').datepicker('destroy');
                $('#calendar').datepicker({
                    numberOfMonths: 3,
                    beforeShowDay: function (date) {
                        var stringDate = $.datepicker.formatDate('yy-mm-dd', date);
                        var slots      = data[stringDate];

                        if (slots) {
                            var extraClass = '';
                            if (slots.includes("am") && slots.includes("pm")) {
                                extraClass = 'unavailable-full-day';
                            } else if (slots.includes("am")) {
                                extraClass = 'unavailable-am';
                            } else if (slots.includes("pm")) {
                                extraClass = 'unavailable-pm';
                            }
                            return [true, extraClass];
                        }

                        return [true, ''];
                    }
                });
            }

            $('#page_select').change(function () {
                var roomId = $(this).val();
                if (roomId !== '') {
                    fetchAndRenderCalendar(roomId);
                    $('#calendar').show();
                } else {
                    $('#calendar').hide();
                }
            });
        });
    </script>
    <div class="hidden selected-room-id"></div>

    <div class="booking-info">
        <h3>Запазване на стая</h3>
        <input type="text" id="start_date" placeholder="Начална дата" required>
        <input type="text" id="end_date" placeholder="Крайна дата" required>
        <input type="text" name="first_name" placeholder="Client first name" required>
        <input type="text" name="last_name" placeholder="Client last name" required>
        <input type="text" name="email" placeholder="Client email" required>
        <input type="text" name="phone" placeholder="Client phone" required>

        <button id="book-room">Запази стая</button>

    </div>

    <script>
        $(document).ready(function () {
            $("#start_date").datepicker({
                dateFormat: "dd.mm.yy",
                minDate: 0,
                onSelect: function (selected) {
                    $("#end_date").datepicker("option", "minDate", selected);
                }
            });

            $("#end_date").datepicker({
                dateFormat: "dd.mm.yy",
                minDate: 0,
                onSelect: function (selected) {
                    $("#start_date").datepicker("option", "maxDate", selected);
                }
            });

            $("#book-room").click(function () {
                var startDate = $("#start_date").val();
                var endDate   = $("#end_date").val();

                $.ajax({
                    url: '/book-room',
                    method: 'POST',
                    data: {
                        '_token': '{{ csrf_token() }}',
                        'page_id': 1,
                        'start_date': startDate,
                        'end_date': endDate
                    },
                    success: function (response) {
                        alert("Успешно направена резервация!");
                    },
                    error: function (response) {
                        alert("Възникна грешка при резервацията!");
                    }
                });
            });
        });
    </script>
@endsection
