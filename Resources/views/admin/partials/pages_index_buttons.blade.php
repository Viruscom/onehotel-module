@if($page->categoryPage->with_tour_btn)
    <a href="{{ route('admin.tour.update', ['page_id' => $page->id]) }}" class="btn {{ $page->tour_active ? 'btn-primary' : 'btn-default' }} tooltips" role="button" data-toggle="tooltip" data-placement="auto" title="" data-original-title="{{ __('onehotel::admin.360_degree_panorama_tooltip') }}"><i class="fas fa-redo-alt"></i></a>
@endif
