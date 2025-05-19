<?php

namespace App\Services;

use App\Mail\ConfirmationMail;
use App\Models\Subscription;
use Illuminate\Support\Facades\Mail;

class MailSender {
    public function send(string $email, Subscription $subscription): void {
        Mail::to($email)->send(new ConfirmationMail()->build($subscription));
    }
}
