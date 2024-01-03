<?php

namespace App\Http\Controllers;

use App\Models\Korpa;
use Illuminate\Http\Request;
use Stripe\Checkout\Session;
use Stripe\Stripe;

class PlacanjeController extends Controller
{
    public function otkaz()
    {
        return response()->json([
            'status' => 'cancelled',
        ], 200);
    }

    public function placanje($korisnik_id)
    {
        Stripe::setApiKey(config('stripe.sk'));

        $korpa = Korpa::where('korisnik_id', $korisnik_id)->first();
        $lineItems = [];

        foreach ($korpa->stavke as $stavka) {
            $lineItems[] = [
                'price_data' => [
                    'currency' => 'eur',
                    'product_data' => [
                        'name' => $stavka->knjiga->naziv,
                    ],
                    'unit_amount' => $stavka->knjiga->cena * 100,
                ],
                'quantity' => $stavka->kolicina,
            ];
        }

        $session = Session::create([
            'payment_method_types' => ['card'],
            'line_items' => $lineItems,
            'mode' => 'payment',
            'success_url' => 'https://neki_fake_domen/success',
            'cancel_url' => 'https://neki_fake_domen/cancel',
        ]);

        return redirect()->away($session->url);
    }


    public function uspeh()
    {
        return response()->json([
            'status' => 'success',
        ], 200);
    }
}
