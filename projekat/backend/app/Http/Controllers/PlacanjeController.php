<?php

namespace App\Http\Controllers;

use App\Models\Korpa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Stripe\Checkout\Session;
use Stripe\Stripe;

class PlacanjeController extends Controller
{

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
                    'unit_amount' => $stavka->knjiga->cena,
                ],
                'quantity' => $stavka->kolicina,
            ];
        }

        $session = Session::create([
            'payment_method_types' => ['card'],
            'line_items' => $lineItems,
            'mode' => 'payment',
            'success_url' => 'http://localhost:4200/success',
            'cancel_url' => 'http://localhost:4200/cancel',
        ]);

        return response()->json([
            'url' => $session->url
        ], 200);
    }

    public function success($korisnik_id)
    {
        $korpa = Korpa::where('korisnik_id', $korisnik_id)->first();

        foreach ($korpa->stavke as $stavka) {
            DB::table('korisnik_knjiga')->insert([
                'korisnik_id' => $korisnik_id,
                'knjiga_id' => $stavka->knjiga->knjiga_id,
            ]);
        }

        $korpa->stavke()->delete();

        return response()->json([
            'status' => 'success',
        ], 200);
    }

    public function cancel()
    {

        return response()->json([
            'status' => 'cancelled',
        ], 200);
    }
}
