<?php

    namespace Modules\Onehotel\Http\Requests;

    use Illuminate\Foundation\Http\FormRequest;

    class UpdateHotelSettingsRequest extends FormRequest
    {
        public function authorize()
        {
            return true;
        }

        public function rules()
        {
            return [
                'default_reservation_system' => 'required|in:inquiry,clientric,clock,travelline',
                'clientric_key'              => 'required_if:default_reservation_system,clientric|nullable|string',
                'clock_key'                  => 'required_if:default_reservation_system,clock|nullable|string',
                'travelline_key'             => 'required_if:default_reservation_system,travelline|nullable|string',
            ];
        }

        public function messages()
        {
            return [
                'default_reservation_system.required' => 'Типът на резервационната система е задължителен.',
                'clientric_key.required_if'           => 'Ключът за Clientric е задължителен, когато системата за резервации е Clientric.',
                'clock_key.required_if'               => 'Ключът за Clock е задължителен, когато системата за резервации е Clock.',
                'travelline_key.required_if'          => 'Ключът за Travelline е задължителен, когато системата за резервации е Travelline.',
            ];
        }
    }
