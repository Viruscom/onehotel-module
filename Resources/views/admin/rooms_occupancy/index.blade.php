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

        .booking-table th:hover,
        .booking-table tr:hover,
        .booking-table td:hover {
            background: #a5b2cb !important;
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
    </div>
    <div class="hidden selected-room-id"></div>

    <div class="booking-info-room hidden">
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

        <h3>{{ __('onehotel::admin.rooms_occupancy.book_a_room') }}</h3>
        <div class="row">
            <form action="{{ route('admin.room_occupancy.store') }}" method="post" id="myForm">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="number" name="roomId" class="hidden">
                <div class="col-md-4">
                    <div class="form-group ">
                        <label for="start_date" class="control-label p-b-10 ">
                            {{ __('onehotel::admin.rooms_occupancy.start_date') }}:
                        </label>
                        <input id="start_date" class="form-control start_date" autocomplete="off" type="text" name="start_date" value="" placeholder="Start date" required>
                    </div>
                    <div class="form-group ">
                        <label for="end_date" class="control-label p-b-10 ">
                            {{ __('onehotel::admin.rooms_occupancy.end_date') }}:
                        </label>
                        <input id="end_date" class="form-control end_date" autocomplete="off" type="text" name="end_date" value="" placeholder="End date" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group ">
                        <label for="first_name" class="control-label p-b-10 ">
                            {{ __('onehotel::admin.rooms_occupancy.client_first_name') }}:
                        </label>
                        <input id="first_name" class="form-control " type="text" name="first_name" value="" placeholder="Client first name" required>
                    </div>
                    <div class="form-group ">
                        <label for="last_name" class="control-label p-b-10 ">
                            {{ __('onehotel::admin.rooms_occupancy.client_last_name') }}:
                        </label>
                        <input id="last_name" class="form-control " type="text" name="last_name" value="" placeholder="End date" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group ">
                        <label for="email" class="control-label p-b-10 ">
                            {{ __('onehotel::admin.rooms_occupancy.client_email') }}:
                        </label>
                        <input id="email" class="form-control " type="text" name="email" value="" placeholder="Client email" required>
                    </div>
                    <div class="form-group ">
                        <label for="phone" class="control-label p-b-10 ">
                            {{ __('onehotel::admin.rooms_occupancy.client_phone') }}:
                        </label>
                        <input id="phone" class="form-control " type="text" name="phone" value="" placeholder="Client phone" required>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="control-label p-b-10">{{ __('onehotel::admin.rooms_occupancy.note') }}</label>
                        <textarea name="note" class="col-xs-12 form-control m-b-10" rows="5">{{ old('note') }}</textarea>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="btn btn-success book-room-btn">{{ __('onehotel::admin.rooms_occupancy.book_room') }}</div>
                </div>
            </form>
        </div>

        <h3>{{ __('onehotel::admin.rooms_occupancy.list_bookings') }}</h3>
        <div class="row">
            <div class="col-md-12">
                <table class="table table-striped booking-table m-t-40">
                    <thead>
                    <tr>
                        <th>{{ __('onehotel::admin.rooms_occupancy.start_date') }}</th>
                        <th>{{ __('onehotel::admin.rooms_occupancy.end_date') }}</th>
                        <th>{{ __('onehotel::admin.rooms_occupancy.client_first_name') }}</th>
                        <th>{{ __('onehotel::admin.rooms_occupancy.client_last_name') }}</th>
                        <th>{{ __('onehotel::admin.rooms_occupancy.client_email') }}</th>
                        <th>{{ __('onehotel::admin.rooms_occupancy.client_phone') }}</th>
                        <th>{{ __('onehotel::admin.rooms_occupancy.note') }}</th>
                        <th class="text-right">@lang('admin.actions')</th>
                    </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
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
                        var styledDates = processOccupancyData(rawData);
                        renderCalendar(styledDates);
                        refreshTableData(rawData);
                    }
                });
            }

            function processOccupancyData(occupancyData) {
                var styledDates = {};
                occupancyData.forEach(function (entry) {
                    var startDate   = new Date(entry.start_date);
                    var endDate     = new Date(entry.end_date);
                    var currentDate = new Date(startDate);

                    while (currentDate <= endDate) {
                        var dateString = currentDate.toISOString().split('T')[0];

                        if (!styledDates[dateString]) {
                            styledDates[dateString] = [];
                        }

                        if (currentDate.getTime() === startDate.getTime()) {
                            styledDates[dateString].push('pm');
                        } else if (currentDate.getTime() === endDate.getTime()) {
                            styledDates[dateString].push('am');
                        } else {
                            styledDates[dateString].push('am', 'pm');
                        }

                        currentDate.setDate(currentDate.getDate() + 1);
                    }
                });

                return styledDates;
            }

            function renderCalendar(styledDates) {
                $('#calendar').datepicker('destroy');
                $('#calendar').datepicker({
                    numberOfMonths: 3,
                    beforeShowDay: function (date) {
                        var stringDate = $.datepicker.formatDate('yy-mm-dd', date);
                        if (styledDates[stringDate]) {
                            var slots      = styledDates[stringDate];
                            var extraClass = '';

                            if (slots.includes('am') && slots.includes('pm')) {
                                extraClass = 'unavailable-full-day';
                            } else if (slots.includes('am')) {
                                extraClass = 'unavailable-am';
                            } else if (slots.includes('pm')) {
                                extraClass = 'unavailable-pm';
                            }

                            return [true, extraClass];
                        }

                        return [true, ''];
                    }
                });
            }

            function refreshTableData(data) {
                var tableRows     = '';
                var editBaseUrl   = "{{ url('/admin/room_occupancy/edit/') }}"; // Adjust according to your route structure
                var deleteBaseUrl = "{{ url('/admin/room_occupancy/anulated/') }}"; // Adjust according to your route structure

                data.forEach(function (item) {
                    tableRows += '<tr room_id="' + item.page_id + '">' +
                        '<td>' + item.start_date + '</td>' +
                        '<td>' + item.end_date + '</td>' +
                        '<td>' + item.first_name + '</td>' +
                        '<td>' + item.last_name + '</td>' +
                        '<td>' + item.email + '</td>' +
                        '<td>' + item.phone + '</td>' +
                        '<td>' + (item.note || '') + '</td>' +
                        '<td class="text-right">' +
                        '<div class="btn green table-edit-btn m-r-5" role="button"><i class="fas fa-pencil-alt"></i></div>' +
                        '<div class="btn red table-delete-btn"><i class="fas fa-trash-alt"></i></div>' +
                        '</td>' +
                        '</tr>';
                });
                $('table.table tbody').html(tableRows);
            }

            $('.book-room-btn').on('click', function () {
                submitForm();
            });

            $('#page_select').change(function () {
                var roomId = $(this).val();
                if (roomId !== '') {
                    $('input[name="roomId"]').val(roomId);
                    fetchAndRenderCalendar(roomId);
                    $('.booking-info-room').removeClass('hidden');
                } else {
                    $('.booking-info-room').addClass('hidden');
                }
            });

            $(".start_date").datepicker({
                dateFormat: "dd.mm.yy",
                minDate: 0,
                onSelect: function (selectedDate) {
                    var dateParts     = selectedDate.split(".");
                    var formattedDate = new Date(dateParts[2], dateParts[1] - 1, dateParts[0]);
                    var nextDay       = new Date(formattedDate);
                    nextDay.setDate(nextDay.getDate() + 1);
                    var nextDayFormatted = $.datepicker.formatDate('dd.mm.yy', nextDay);
                    var endDate          = $("#end_date");

                    endDate.datepicker("option", "minDate", nextDayFormatted);
                    endDate.datepicker("enable");
                    setTimeout(function () {
                        endDate.datepicker("show");
                    }, 200);
                }
            });

            $(".end_date").datepicker({
                dateFormat: "dd.mm.yy",
                minDate: 0,
                disabled: true
            });

            $("#start_date_modal").datepicker({
                dateFormat: 'yy-mm-dd',
                minDate: 0,
                onSelect: function (selectedDate) {
                    var nextDay = new Date(selectedDate);
                    nextDay.setDate(nextDay.getDate() + 1);
                    var nextDayFormatted = $.datepicker.formatDate('yy-mm-dd', nextDay);
                    var endDate          = $("#end_date_modal");

                    endDate.datepicker("option", "minDate", nextDayFormatted);
                    endDate.datepicker("enable");
                    setTimeout(function () {
                        $("#end_date_modal").datepicker("show");
                    }, 200);
                }
            });

            $("#end_date_modal").datepicker({
                dateFormat: 'yy-mm-dd',
                minDate: 0,
                disabled: true
            });

            function submitForm() {
                $.ajax({
                    url: '{{ route('admin.room_occupancy.store') }}',
                    type: 'POST',
                    data: $('#myForm').serialize(),
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (response) {
                        alert('Successful create');
                        fetchAndRenderCalendar($('#myForm').find('input[name="roomId"]').val());
                        refreshTableData(response);
                    },
                    error: function (response) {
                        alert('An error occurred');
                    }
                });
            }

            function clearEditModalFields() {
                $('#editModal #start_date').val('');
                $('#editModal #end_date').val('');
                $('#editModal #first_name').val('');
                $('#editModal #last_name').val('');
                $('#editModal #email').val('');
                $('#editModal #phone').val('');
                $('#editModal textarea[name="note"]').val('');
                $('#editModal input[name="roomId"]').val('');
            }

            $(document).on('click', '.table-edit-btn', function () {
                var row       = $(this).closest('tr');
                var data      = {
                    start_date: row.find('td:nth-child(1)').text(),
                    end_date: row.find('td:nth-child(2)').text(),
                    first_name: row.find('td:nth-child(3)').text(),
                    last_name: row.find('td:nth-child(4)').text(),
                    email: row.find('td:nth-child(5)').text(),
                    phone: row.find('td:nth-child(6)').text(),
                    note: row.find('td:nth-child(7)').text(),
                    roomId: row.attr('room_id')
                };
                var startDate = row.find('td:nth-child(1)').text();
                var endDate   = row.find('td:nth-child(2)').text();

                $('#start_date_modal').datepicker('setDate', startDate);
                $('#end_date_modal').datepicker('setDate', endDate);

                clearEditModalFields();

                $('#editModal #start_date').val(data.start_date);
                $('#editModal #end_date').val(data.end_date);
                $('#editModal #first_name').val(data.first_name);
                $('#editModal #last_name').val(data.last_name);
                $('#editModal #email').val(data.email);
                $('#editModal #phone').val(data.phone);
                $('#editModal textarea[name="note"]').val(data.note);
                $('#editModal input[name="roomId"]').val(data.roomId);
                $('.update-room-btn').attr('action', '/admin/hotel/room_occupancy/' + data.roomId + '/update/');
                $('#editModal').modal('show');
            });

            $(document).on('click', '.update-room-btn', function (e) {
                e.preventDefault();
                e.preventDefault();
                var modal  = $('#editModal');
                var roomId = $('#myForm').find('input[name="roomId"]').val();

                var data = {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    roomId: roomId,
                    start_date: modal.find('#start_date_modal').val(),
                    end_date: modal.find('#end_date_modal').val(),
                    first_name: modal.find('#first_name').val(),
                    last_name: modal.find('#last_name').val(),
                    email: modal.find('#email').val(),
                    phone: modal.find('#phone').val(),
                    note: modal.find('textarea[name="note"]').val()
                };

                $.ajax({
                    url: $('.base-url').val() + '/admin/hotel/room_occupancy/' + roomId + '/update/',
                    type: 'GET',
                    data: data,
                    success: function (response) {
                        fetchAndRenderCalendar(roomId);
                        refreshTableData(response);
                        $('#editModal').modal('hide');
                    },
                    error: function (response) {
                        console.log(response);
                        alert('Error updating room');
                    }
                });
            });

            $(document).on('click', '.table-delete-btn', function () {
                var row    = $(this).closest('tr');
                var roomId = row.attr('room_id');

                var data = {
                    roomId: roomId,
                    start_date: row.find('td:nth-child(1)').text(),
                    end_date: row.find('td:nth-child(2)').text(),
                    first_name: row.find('td:nth-child(3)').text(),
                    last_name: row.find('td:nth-child(4)').text(),
                    email: row.find('td:nth-child(5)').text(),
                    phone: row.find('td:nth-child(6)').text(),
                    note: row.find('td:nth-child(7)').text()
                };

                if (confirm('Are you sure you want to delete this room reservation?')) {
                    $.ajax({
                        url: '/admin/hotel/room_occupancy/' + roomId + '/anulated',
                        type: 'POST',
                        data: data,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function (response) {
                            alert('Room reservation deleted successfully');
                            fetchAndRenderCalendar($('#myForm').find('input[name="roomId"]').val());
                            refreshTableData(response);
                        },
                        error: function (error) {
                            alert('Error occurred during deletion');
                        }
                    });
                }
            });
        });
    </script>

    <!-- Edit Room Occupancy Modal -->
    <div id="editModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">{{ __('onehotel::admin.rooms_occupancy.edit_room') }}</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="start_date" class="control-label">{{ __('onehotel::admin.rooms_occupancy.start_date') }}:</label>
                                <input id="start_date_modal" class="form-control" autocomplete="off" type="text" name="start_date" placeholder="Start date" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="end_date" class="control-label">{{ __('onehotel::admin.rooms_occupancy.end_date') }}:</label>
                                <input id="end_date_modal" class="form-control" autocomplete="off" type="text" name="end_date" placeholder="End date" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="first_name" class="control-label">{{ __('onehotel::admin.rooms_occupancy.client_first_name') }}:</label>
                                <input id="first_name" class="form-control" type="text" name="first_name" placeholder="Client first name" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="last_name" class="control-label">{{ __('onehotel::admin.rooms_occupancy.client_last_name') }}:</label>
                                <input id="last_name" class="form-control" type="text" name="last_name" placeholder="Client last name" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email" class="control-label">{{ __('onehotel::admin.rooms_occupancy.client_email') }}:</label>
                                <input id="email" class="form-control" type="text" name="email" placeholder="Client email" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="phone" class="control-label">{{ __('onehotel::admin.rooms_occupancy.client_phone') }}:</label>
                                <input id="phone" class="form-control" type="text" name="phone" placeholder="Client phone" required>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">{{ __('onehotel::admin.rooms_occupancy.note') }}:</label>
                                <textarea name="note" class="form-control" rows="5" placeholder="Enter a note"></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <div class="col-md-12 text-right">
                            <button type="button" class="btn btn-default" data-dismiss="modal">{{ __('onehotel::admin.rooms_occupancy.close') }}</button>
                            <div class="btn btn-success update-room-btn">{{ __('onehotel::admin.rooms_occupancy.update_room') }}</div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection
