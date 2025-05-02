<?php

namespace App\Services;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Customer;
use Stripe\PaymentIntent;
use Illuminate\Support\Facades\Log;
use Stripe\Webhook;
use Stripe\Exception\SignatureVerificationException;
use App\Models\Plans;

class SubscriptionServices {
    public static function subscribe(Request $request){
        $validated = $request->validate([
            'nombre_plan' => 'required|string',
            'paymentMethodId' => 'required|string'
        ]);
        $user = $request->user;
        Stripe::setApiKey(config('services.stripe.secret'));
        $plan = Plans::where(['nombre' => $validated['nombre_plan']])->firstOrFail();

        $customer = Customer::create([
            'email' => $user->email,
            'payment_method' => $validated['paymentMethodId']
        ]);

        $paymentIntent = PaymentIntent::create([
            'amount' => $plan->precio_mensual * 100, // en centavos
            'currency' => 'mxn',
            'customer' => $customer->id,
            'payment_method' => $validated['paymentMethodId'],
            'off_session' => true,
            'confirm' => true,
        ]);

        return response()->json([
            'message' => 'Pago exitoso',
            'paymentIntent' => $paymentIntent,
        ]);
    }
    
    public static function webhook(Request $request){
        $payload = $request->getContent();
        $sig_header = $request->header('Stripe-Signature');
        $endpoint_secret = config('services.stripe.webhook_secret');

        try {
            $event = Webhook::constructEvent($payload, $sig_header, $endpoint_secret);
        } catch (SignatureVerificationException $e) {
            Log::error("Webhook firma inválida: " . $e->getMessage());
            return response(['message' => 'firma invalida.'], 400);
        }

        switch ($event->type) {
            case 'payment_intent.succeeded':
                $paymentIntent = $event->data->object;
                Log::info("Pago exitoso: " . $paymentIntent->id);
                break;

            case 'payment_intent.payment_failed':
                $paymentIntent = $event->data->object;
                Log::warning("Pago fallido: " . $paymentIntent->id);
                break;

            default:
                Log::info("Evento recibido: " . $event->type);
        }

        return response()->json(['message' => 'status:recibido']);
    }
}