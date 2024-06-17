<?php

    namespace Modules\OneHotel\Models;

    use App\Models\CategoryPage\CategoryPage;
    use App\Models\LawPages\LawPageTranslation;
    use App\Models\Pages\Page;
    use App\Models\Settings\Application;
    use Illuminate\Database\Eloquent\Model;

    class OneHotel extends Model
    {
        const TOURS_PATH = 'hotel/tours';
        protected $table    = 'hotel_settings';
        protected $fillable = ['default_reservation_system', 'clientric_key', 'clock_key', 'travelline_key'];

        public static function getReservationPage($viewArray)
        {
            $reservationSystem = OneHotel::first();
            if (is_null($reservationSystem)) {
                $reservationSystem = OneHotel::create([
                                                          'default_reservation_system' => 'inquiry',
                                                          'clientric_key'              => null,
                                                          'clock_key'                  => null,
                                                          'travelline_key'             => null
                                                      ]);
            }

            $rooms = self::getActiveRooms();

            return view('onehotel::front.reservations', [
                'viewArray'         => $viewArray,
                'reservationSystem' => $reservationSystem,
                'rooms'             => $rooms,
                'recaptchaSiteKey'  => Application::getSettings()->google_recaptcha_ver2,
                'privacyPolicyPage' => LawPageTranslation::where('url', 'privacy-policy')->first()
            ]);
        }

        protected static function getActiveRooms()
        {
            return Page::whereHas('categoryPage', function ($query) {
                $query->where('visualization_type_id', CategoryPage::$VISUALIZATION_ONE_HOTEL_ROOMS)
                    ->where('with_reservation_btn', true);
            })
                ->where('active', true)
                ->with('translations')
                ->orderBy('position')
                ->get();
        }

        public static function getTourPath($pageId): string
        {
            return OneHotel::TOURS_PATH . '/' . $pageId;
        }

        public static function getTour($pageId): string
        {
            return url('storage/' . OneHotel::TOURS_PATH . '/' . $pageId . '/index.html');
        }

        public function isReservationTypeInquiry(): bool
        {
            return $this->default_reservation_system == 'inquiry';
        }

        public function isReservationTypeClientric(): bool
        {
            return $this->default_reservation_system == 'clientric';
        }

        public function isReservationTypeClock(): bool
        {
            return $this->default_reservation_system == 'clock';
        }

        public function isReservationTypeTravelline(): bool
        {
            return $this->default_reservation_system == 'travelline';
        }
    }
