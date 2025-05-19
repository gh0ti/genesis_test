<?php

namespace App\Mail;

use App\Models\Subscription;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ConfirmationMail extends Mailable {
    use Queueable;
    use SerializesModels;

    public function build(Subscription $subscription) {
        return $this->subject('Confirm your email')
                    ->view('emails.confirmation', ['url' => $this->generateConfirmationUrl($subscription)]);
    }

    private function generateConfirmationUrl(Subscription $subscription): string {
        return '123';
        $token = $subscription->confirmation_token;

        return route('confirm', ['token' => $token], true);
    }
}
