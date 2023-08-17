<?php

    namespace Modules\OneHotel\Http\Controllers;

    use App\Helpers\WebsiteHelper;
    use App\Models\Pages\Page;
    use Illuminate\Http\Request;
    use Illuminate\Routing\Controller;

    class TourController extends Controller
    {
        public function updateActiveTourStatus(Request $request)
        {
            $page = Page::where('id', $request->page_id)->first();
            WebsiteHelper::redirectBackIfNull($page);

            $status = !$page->tour_active;
            $page->update(['tour_active' => $status]);

            if ($status) {
                return redirect()->back()->with('success-message', trans('onehotel::admin.tour_active_1') . $page->id);
            }

            return redirect()->back()->with('success-message', trans('onehotel::admin.tour_active_0'));
        }
    }
