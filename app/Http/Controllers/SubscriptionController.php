<?php

namespace App\Http\Controllers;

use App\Http\Requests\SubscriptionRequest;
use App\Mail\ConfirmationMail;
use App\Models\City;
use App\Models\Subscription;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class SubscriptionController extends Controller {
    public function subscribe(SubscriptionRequest $request): string {
        $validated = $request->validated();

        $email = $validated['email'];

        $isEmailExists = Subscription::query()->where('email', $email)->exists();
        if ($isEmailExists) {
            return response()->json(['error' => 'Email already subscribed'], 409);
        }

        $city = City::where('name', $validated['city'])->first();

        if (!$city) {
            return response()->json(['error' => 'City not found'], 404);
        }

        $subscription = Subscription::create([
            'email' => $email,
            'city_id' => $city->id,
            'frequency' => $validated['frequency'],
            'active' => false,
            'confirmation_token' => Str::random(40),
        ]);

        $this->sendConfirmationEmail($subscription);

        return response()->json(['message' => 'Subscription successful. Confirmation email sent.'], 200);
    }

    public function confirm(string $confirmationToken): string {
        $subscription = Subscription::query()->where('confirmation_token', $confirmationToken)->first();
        if (!$subscription) {
            return response()->json(['error' => 'Token not found'], 404);
        }

        $subscription->update(['active' => true, 'unsubscribe_token' => Str::random(40)]);

        return response()->json(['message' => 'Subscription confirmed successfully.'], 200);
    }

    public function unsubscribe(string $unsubscribeToken): string {
        $subscription = Subscription::query()->where('unsubscribe_token', $unsubscribeToken)->first();
        if (!$subscription) {
            return response()->json(['error' => 'Token not found'], 404);
        }

        $subscription->delete();

        return response()->json(['message' => 'Unsubscribed successfully.'], 200);
    }

    private function sendConfirmationEmail($subscription): void {
        $confirmationMail = new ConfirmationMail();
        Mail::to($subscription->email)->send($confirmationMail->build($subscription));
    }
}
