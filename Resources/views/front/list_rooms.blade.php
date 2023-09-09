@php use App\Helpers\WebsiteHelper; @endphp
<section class="section-top">
    <div class="shell">
        <div class="section-content">
            <h3 data-aos="fade-up" data-aos-delay="100">{{ $viewArray['currentModel']->parent->title }}</h3>

            <p data-aos="fade-up" data-aos-delay="150">{!! $viewArray['currentModel']->parent->announce !!}</p>
        </div>
    </div>
</section>

<div class="boxes boxes-type-2">
    @php
        $activePages = !is_null(\Illuminate\Support\Facades\Request::segment(4)) ? $viewArray['currentModel']->parent->getActivePagesByYear(\Illuminate\Support\Facades\Request::segment(4)): $viewArray['currentModel']->parent->getActivePages;
    @endphp
    @foreach($activePages as $page)
        <div class="box" data-aos="fade-up">
            <div class="box-image-wrapper">
                <a href="{{ $page->getUrl($languageSlug) }}"></a>

                <div class="box-image parent-image-wrapper">
                    <img src="{{ $page->getFileUrl() }}" alt="{{ $page->title }}" class="bg-image">
                </div>
            </div>

            <div class="box-content">
                @if($page->isOneDayEvent() || $page->getFromDate('d.m.Y') != '')
                    <div class="box-date">
                        @if($page->isOneDayEvent())
                            <span>{{ $page->getOneDayEventDate('d.m.Y') }}</span>
                        @else
                            <span>{{ $page->getFromDate('d.m.Y') }}</span>
                            <span>{{ $page->getToDate('d.m.Y') }}</span>
                        @endif
                    </div>
                @endif

                <h3>
                    <a href="{{ $page->getUrl($languageSlug) }}">{{ $page->title }}</a>
                </h3>

                <p>{!! $page->getAnnounce() !!}</p>

                @if($page->getPrice() != '')
                    <div class="box-prices">
                        <p>
                            @if($page->from_price)
                                <span>{{ __('front.from') }}</span>
                            @endif

                            <strong>{{ $page->getPrice() }}
                                <span>{{ __('front.currency') }}</span>
                            </strong>
                        </p>
                    </div>
                @endif
                {{--                <div class="box-prices">--}}
                {{--                    <p class="old-price">--}}
                {{--                        <span>from:</span>--}}

                {{--                        <strong>118.00--}}
                {{--                            <span>BGN</span>--}}
                {{--                        </strong>--}}
                {{--                    </p>--}}

                {{--                    <p>--}}
                {{--                        <span>from:</span>--}}

                {{--                        <strong>96.00--}}
                {{--                            <span>BGN</span>--}}
                {{--                        </strong>--}}
                {{--                    </p>--}}
                {{--                </div>--}}
            </div>
        </div>
    @endforeach
</div>

@if($viewArray['currentModel']->parent->description !== '')
    <section class="section-bottom">
        <div class="shell">
            <div class="section-content" data-aos="fade-up" data-aos-delay="50">
                <p>{!! $viewArray['currentModel']->parent->description !!}</p>
            </div>
        </div>
    </section>
@endif
