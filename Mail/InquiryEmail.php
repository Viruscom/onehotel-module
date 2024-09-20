<?php

    namespace Modules\Onehotel\Mail;

    use Illuminate\Bus\Queueable;
    use Illuminate\Mail\Mailable;
    use Illuminate\Queue\SerializesModels;

    class InquiryEmail extends Mailable
    {
        use Queueable, SerializesModels;

        public $data;

        public function __construct($data)
        {
            $this->data = $data;
        }

        public function build()
        {
            $subject = trans('front.contacts.inquiry_from_the_site');

            return $this->subject($subject)->view('onehotel::emails.inquiry_email')->with('subject', $subject);
        }
    }
