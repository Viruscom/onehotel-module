@extends('layouts.front.app')
@section('styles')
    <link href="{{ asset('admin/plugins/foundation-datepicker/datepicker.css') }}" rel="stylesheet"/>
@endsection

@section('scripts')
    <script src="//code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <script src="{{ asset('admin/plugins/foundation-datepicker/datepicker.js') }}"></script>
    <script>
        $(document).ready(function () {
            var nowTemp  = new Date();
            var now      = new Date(nowTemp.getFullYear(), nowTemp.getMonth(), nowTemp.getDate(), 0, 0, 0, 0);
            var checkin  = $('#dpd1').fdatepicker({
                onRender: function (date) {
                    return date.valueOf() < now.valueOf() ? 'disabled' : '';
                },
                format: 'yyyy-mm-dd'
            }).on('changeDate', function (ev) {
                if (ev.date.valueOf() > checkout.date.valueOf()) {
                    var newDate = new Date(ev.date)
                    newDate.setDate(newDate.getDate() + 1);
                    checkout.update(newDate);
                }
                checkin.hide();
                $('#dpd2')[0].focus();
            }).data('datepicker');
            var checkout = $('#dpd2').fdatepicker({
                onRender: function (date) {
                    return date.valueOf() <= checkin.date.valueOf() ? 'disabled' : '';
                },
                format: 'yyyy-mm-dd'
            }).on('changeDate', function (ev) {
                checkout.hide();
            }).data('datepicker');
        });
    </script>
@endsection
@section('content')
    <x-front.layout.partials.inner-header :model="$viewArray['currentModel']" />
    @include('front.partials.breadcrumbs')
    @php
        $page = $viewArray['currentModel']->parent;
    @endphp
    <section class="section-top section-top-wide">
        <div class="shell">
            <div class="section-content">
                <h3 data-aos="fade-up" data-aos-delay="100">{{ $page->title }}</h3>

                <p data-aos="fade-up" data-aos-delay="150">{!! $page->announce !!}</p>
            </div>
        </div>
    </section>

    @include('onehotel::front.reservations.inquiry')
    @include('onehotel::front.reservations.clientric')
    @include('onehotel::front.reservations.clock')
    @include('onehotel::front.reservations.travelline')

    @if($page->description !== '')
        <section class="section-bottom section-bottom-alt">
            <div class="shell">
                <div class="section-content" data-aos="fade-up" data-aos-delay="50">{!! $page->description !!}</div>
            </div>
        </section>
    @endif

@endsection
