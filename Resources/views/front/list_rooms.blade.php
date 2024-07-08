@php use App\Helpers\WebsiteHelper; @endphp
<x-front.page-category.section-top1 :viewArray="$viewArray" :title="$viewArray['currentModel']->parent->title" :announce="optional($viewArray['currentModel']->parent)->announce"/>


<div class="boxes boxes-type-3">
    @php
        $activePages = !is_null(\Illuminate\Support\Facades\Request::segment(4)) ? $viewArray['currentModel']->parent->getActivePagesByYear(\Illuminate\Support\Facades\Request::segment(4)): $viewArray['currentModel']->parent->getActivePages;
    @endphp
    @foreach($activePages as $page)
        <div class="box" data-aos="fade-up">
            <div class="box-image-wrapper">
                <x-front.page-category.box-href :url="$page->getUrl($languageSlug)"/>
                <x-front.page-category.box-image :page="$page"/>
            </div>

            <div class="box-content">
                <x-front.page-category.box-title :language-slug="$languageSlug" :page="$page"/>
                <x-front.page-category.box-announce :page="$page"/>

                <x-front.page-category.box-actions>
                    <x-front.page-category.box-prices :page="$page"/>
                    <x-front.page-category.box-dates :page="$page" dateFormat="d.m.y"/>
                </x-front.page-category.box-actions>
            </div>
        </div>
    @endforeach
</div>

<x-front.page-category.section-bottom1 :pageTranslation="$viewArray['currentModel']"/>
<x-front.index-page.parallaxes.types.parallax-third/>
