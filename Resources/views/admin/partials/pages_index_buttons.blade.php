@if($page->categoryPage->with_tour_btn)
    <a href="{{ route('admin.pages.make-ad-box', ['id' => $page->id]) }}" class="btn btn-primary tooltips" role="button" data-toggle="tooltip" data-placement="auto" title="" data-original-title="{{ __('onehotel::admin.360_degree_panorama_tooltip') }}"><i class="fas fa-redo-alt"></i></a>
@endif
