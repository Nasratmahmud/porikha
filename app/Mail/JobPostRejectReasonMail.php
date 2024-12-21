<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class JobPostRejectReasonMail extends Mailable {
    use Queueable, SerializesModels;

    protected $reason, $user, $job_title;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct( $reason, $user, $jobtitle ) {
        $this->user = $user;
        $this->reason = $reason;
        $this->job_title = $jobtitle;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build() {
        $reason = $this->reason;
        $user = $this->user;
        $job_title = $this->job_title;
        return $this
            ->from( \Illuminate\Support\Facades\Config::get( 'mail.from.address' ) )
            ->to( $this->user->email )
            ->subject( 'Oops Your Job Post Is Rejected' )
            ->view( 'backend.mail.reject-mail', compact( ['reason', 'user', 'job_title'] ) );
    }
}
