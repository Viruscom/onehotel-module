<?php

    namespace Modules\OneHotel\Database\Seeders;

    use App\Actions\CommonControllerAction;
    use App\Helpers\LanguageHelper;
    use App\Helpers\UrlHelper;
    use App\Models\SpecialPage\SpecialPage;
    use App\Models\SpecialPage\SpecialPageTranslation;
    use Illuminate\Database\Seeder;
    use Illuminate\Http\Request;

    class SpecialPageReservationsTableSeeder extends Seeder
    {
        /**
         * Run the database seeds.
         *
         * @return void
         */
        public function run(CommonControllerAction $action)
        {

            $activeLanguages = LanguageHelper::getActiveLanguages();

            $reservationsPage = SpecialPage::create(['type' => SpecialPage::TYPE_HOTEL_RESERVATIONS_PAGE, 'active' => true]);

            $reservationsPageRequest             = new Request();
            $reservationsPageRequest['module']   = 'SpecialPage';
            $reservationsPageRequest['model']    = get_class($reservationsPage);
            $reservationsPageRequest['model_id'] = $reservationsPage->id;

            foreach ($activeLanguages as $language) {
                SpecialPageTranslation::create([
                                                   'special_page_id' => $reservationsPage->id,
                                                   'locale'          => $language->code,
                                                   'title'           => 'Резервации',
                                                   'url'             => UrlHelper::generate('Резервации', SpecialPageTranslation::class, $reservationsPage->id, false),
                                                   'announce'        => '',
                                                   'description'     => '',
                                                   'visible'         => true,
                                               ]);
                $reservationsPageRequest['seo_title_' . $language->code] = 'Резервации';
            }

            $action->storeSeo($reservationsPageRequest, $reservationsPage, 'SpecialPage');
            SpecialPage::cacheUpdate();
        }
    }
