@if($reservationSystem->isReservationTypeInquiry())
    <p class="feedback_head">{{ trans('messages.reservation_form') }}</p>
    @include('admin.notify')

    <form action="{{ url($languageSlug.'/send-inquiry') }}" method="POST">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="recaptcha_response" id="recaptcha_response" value="">
        <div class="width_reservation">
            <div class="form-group">
                <div class="col">
                    <div class="input-row">
                        <label class="my_form_label">{{ trans('messages.name') }}</label>
                        <input class="form-control light" type="text" name="name" required>
                    </div>
                </div>
                <div class="col p-0">
                    <div class="d-inline-flex w-100">
                        <div class="col col-md-6">
                            <label class="col-form-label my_form_label">{{ trans('messages.tel') }}</label>
                            <input class="form-control light" type="tel" name="telephone" required></div>
                        <div class="col col-md-6">
                            <label class="col-form-label my_form_label">{{ trans('messages.email') }}</label>
                            <input class="form-control light" type="email" name="email" required>
                        </div>
                    </div>
                </div>
                <div class="d-md-inline-flex w-100">
                    <div class="col col-12 col-md-6 p-0">
                        <div class="form-row p-0 m-0">
                            <div class="col col-6 p-3">
                                <label class="col-form-label my_form_label">{{ trans('messages.from_date') }}</label>
                                <input id="dpd1" class="form-control light" type="text" name="date_from" required autocomplete="off">
                            </div>
                            <div class="col col-6 p-3 p-l-0">
                                <label class="col-form-label my_form_label">{{ trans('messages.to_date') }}</label>
                                <input id="dpd2" class="form-control light" type="text" name="date_to" required autocomplete="off">
                            </div>
                        </div>
                    </div>
                    <div class="col col-12 col-md-6 p-3">
                        <label class="col-form-label my_form_label">{{trans('messages.room_type')}}</label>
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
                                <label class="col-form-label my_form_label">{{ trans('messages.room_numbers') }}</label>
                                <input class="form-control light" type="number" name="room_num">
                            </div>
                            <div class="col col-6 p-3">
                                <label class="col-form-label my_form_label">{{ trans('messages.adults') }}</label>
                                <input class="form-control light" type="number" name="adults">
                            </div>
                        </div>
                    </div>
                    <div class="col col-12 col-md-6 p-0">
                        <div class="form-row p-0 m-0">
                            <div class="col col-6 p-3">
                                <label class="col-form-label my_form_label">{{ trans('messages.children02') }}</label>
                                <input class="form-control light" type="number" name="children_1">
                            </div>
                            <div class="col col-6 p-3">
                                <label class="col-form-label my_form_label">{{ trans('messages.children212') }}</label>
                                <input class="form-control light" type="number" name="children_2">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <label class="col-form-label my_form_label">{{ trans('messages.text') }}</label>
                    <textarea class="form-control light sp-form-message" rows="6" name="text"></textarea>
                </div>
                <div class="form-row antispam light">
                    <div class="col p-3"><label class="col-form-label my_form_label">{{ trans('messages.antispam') }}</label>
                        <div class="g-recaptcha" data-sitekey="{{$recaptchaSiteKey}}"></div>
                    </div>
                    <div class="col p-3"><label class="check-container">
                            <input type="checkbox" name="copy_to_me">
                            <span class="checkmark reservation"></span>
                            <span class="check-text-reservation my_form_label">{{ trans('messages.send_copy') }}</span>
                        </label></div>
                </div>
                <div class="article-footer">
                    <div class="g-recaptcha float-left" data-sitekey="{{$recaptchaSiteKey}}"></div>
                    <button type="submit" class="btn float-right">{{ trans('messages.send_btn') }}</button>
                </div>
            </div>
        </div>
    </form>

    <script src="https://www.google.com/recaptcha/api.js?render={{$recaptchaSiteKey}}"></script>
    <script>
        grecaptcha.ready(function () {
            grecaptcha.execute('{{$recaptchaSiteKey}}', {action: 'submit'}).then(function (token) {
                $('input#recaptcha_response').val(token);
            });
        });

        function onSubmit() {
            $("#contact-form").submit();
        }
    </script>
@endif
