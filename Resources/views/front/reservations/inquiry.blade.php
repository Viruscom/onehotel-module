@if($reservationSystem->isReservationTypeInquiry())
    <p class="feedback_head">{{ trans('messages.reservation_form') }}</p>
    @include('admin.notify')

    <form id="inquiry-form" action="{{ url($languageSlug.'/send-inquiry') }}" method="POST">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="width_reservation">
            <div class="form-group">
                <div class="col">
                    <div class="input-row">
                        <label class="my_form_label">{{ __('onehotel::front.name') }}</label>
                        <input class="form-control light" type="text" name="name" required>
                    </div>
                </div>
                <div class="col p-0">
                    <div class="d-inline-flex w-100">
                        <div class="col col-md-6">
                            <label class="col-form-label my_form_label">{{ __('onehotel::front.phone') }}</label>
                            <input class="form-control light" type="tel" name="telephone" required></div>
                        <div class="col col-md-6">
                            <label class="col-form-label my_form_label">{{ __('onehotel::front.email') }}</label>
                            <input class="form-control light" type="email" name="email" required>
                        </div>
                    </div>
                </div>
                <div class="d-md-inline-flex w-100">
                    <div class="col col-12 col-md-6 p-0">
                        <div class="form-row p-0 m-0">
                            <div class="col col-6 p-3">
                                <label class="col-form-label my_form_label">{{ __('onehotel::front.arrival_day') }}</label>
                                <input id="dpd1" class="form-control light" type="text" name="date_from" required autocomplete="off">
                            </div>
                            <div class="col col-6 p-3 p-l-0">
                                <label class="col-form-label my_form_label">{{ __('onehotel::front.departure_day') }}</label>
                                <input id="dpd2" class="form-control light" type="text" name="date_to" required autocomplete="off">
                            </div>
                        </div>
                    </div>
                    <div class="col col-12 col-md-6 p-3">
                        <label class="col-form-label my_form_label">{{ __('onehotel::front.room_type') }}</label>
                        <select class="form-control light" name="room_type">
                            <option value=""></option>
                            @foreach($rooms as $resPage)
                                    <?php
                                    $resTrans = $resPage->translations()->where('locale', $languageSlug)->first();
                                    if (is_null($resTrans)) {
                                        continue;
                                    }
                                    ?>
                                <option value="{{ $resTrans->title }}" {{ (!is_null(Request::segment(5)) && ($resPage->id == Request::segment(5))) ? "selected" : ""}}>{{ $resTrans->title }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="d-md-inline-flex w-100">
                    <div class="col col-12 col-md-6 p-0">
                        <div class="form-row p-0 m-0">
                            <div class="col col-6 p-3">
                                <label class="col-form-label my_form_label">{{ __('onehotel::front.room_numbers') }}</label>
                                <input class="form-control light" type="number" name="room_num">
                            </div>
                            <div class="col col-6 p-3">
                                <label class="col-form-label my_form_label">{{ __('onehotel::front.adults') }}</label>
                                <input class="form-control light" type="number" name="adults">
                            </div>
                        </div>
                    </div>
                    <div class="col col-12 col-md-6 p-0">
                        <div class="form-row p-0 m-0">
                            <div class="col col-6 p-3">
                                <label class="col-form-label my_form_label">{{ __('onehotel::front.children_0_5') }}</label>
                                <input class="form-control light" type="number" name="children_1">
                            </div>
                            <div class="col col-6 p-3">
                                <label class="col-form-label my_form_label">{{ __('onehotel::front.children_6_12') }}</label>
                                <input class="form-control light" type="number" name="children_2">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <label class="col-form-label my_form_label">{{ __('onehotel::front.inquiry') }}</label>
                    <textarea class="form-control light sp-form-message" rows="6" name="text"></textarea>
                </div>
                <div class="form-row antispam light">
                    <div class="col p-3"><label class="col-form-label my_form_label">{{ __('onehotel::front.antispam') }}</label>
                        <div class="cf-turnstile" id="turnstile-container" data-sitekey="{{$recaptchaSiteKey}}"></div>
                        <input type="hidden" name="turnstile" id="cf-turnstile-response">
                    </div>
                    <div class="col p-3"><label class="check-container">
                            <input type="checkbox" name="copy_to_me">
                            <span class="checkmark reservation"></span>
                            <span class="check-text-reservation my_form_label">{{ __('onehotel::front.send_copy_to_me') }}</span>
                        </label></div>
                </div>
                <div class="article-footer">
                    <button type="submit" class="btn float-right">{{ __('onehotel::front.send_btn') }}</button>
                </div>
            </div>
        </div>
    </form>

    
<script src="https://challenges.cloudflare.com/turnstile/v0/api.js?render=explicit" async defer></script>
    
<script>
    window.onloadTurnstileCallback = function() {
        turnstile.render('#turnstile-container', {
            sitekey: '{{$recaptchaSiteKey}}',
            callback: function(token) {
                document.getElementById('cf-turnstile-response').value = token;
            },
        });
    };
    
    // Проверка дали turnstile е зареден
    document.addEventListener('DOMContentLoaded', function() {
        if (typeof turnstile !== 'undefined') {
            onloadTurnstileCallback();
        } else {
            // Ако още не е зареден, ще изчакаме
            var checkTurnstile = setInterval(function() {
                if (typeof turnstile !== 'undefined') {
                    clearInterval(checkTurnstile);
                    onloadTurnstileCallback();
                }
            }, 100);
        }
    });
    
    // Функция за проверка на формата преди изпращане
    document.getElementById('inquiry-form').addEventListener('submit', function(e) {
        var token = document.getElementById('cf-turnstile-response').value;
        if (!token) {
            e.preventDefault();
            alert('Моля, изчакайте валидацията от Cloudflare Turnstile да приключи.');
        }
    });
</script>
@endif
