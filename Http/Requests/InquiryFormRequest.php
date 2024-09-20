<?php

    namespace Modules\Onehotel\Http\Requests;

    use Illuminate\Foundation\Http\FormRequest;

    class InquiryFormRequest extends FormRequest
    {
        public function authorize()
        {
            return true;
        }

        public function rules(): array
        {
            $this->trimInput();

            $array = [
                'name'  => 'required|min:2|max:255',
                // 'phone' => 'required|min:5|max:12|integer',
                'email' => 'required|email',
                'text'  => 'required',
            ];

            return $array;
        }

        public function trimInput()
        {
            $trim_if_string = function ($var) {
                return is_string($var) ? trim($var) : $var;
            };
            $this->merge(array_map($trim_if_string, $this->all()));
        }

        public function messages(): array
        {
            return [
                'name.required'  => trans('front.contacts.form_name_required'),
                'name.min'       => trans('front.contacts.form_name_min'),
                'name.max'       => trans('front.contacts.form_name_max'),
                'phone.required' => trans('front.contacts.form_phone_required'),
                'phone.min'      => trans('front.contacts.form_phone_min'),
                'phone.max'      => trans('front.contacts.form_phone_max'),
                'phone.integer'  => trans('front.contacts.form_phone_integer'),
                'email.required' => trans('front.contacts.form_email_required'),
                'email.email'    => trans('front.contacts.form_email_email'),
                'text.required'  => trans('front.contacts.form_description_required'),

            ];
        }
    }
