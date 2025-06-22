<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Midtrans\Notification;
use App\Models\User_donasi;
use App\Models\Donasi;

class MidtransController extends Controller
{
    public function callback(Request $request)
    {
        \Log::info('Midtrans Callback Hit:', $request->all());

        $serverKey = config('midtrans.server_key');
        $signatureKey = $request->get('signature_key');
        $input = $request->all();

        $expectedSignature = hash('sha512',
            $input['order_id'] .
            $input['status_code'] .
            $input['gross_amount'] .
            $serverKey
        );

        if ($signatureKey !== $expectedSignature) {
            \Log::warning('Midtrans Signature invalid');
            return response()->json(['message' => 'Invalid signature'], 403);
        }

        $userDonasi = User_donasi::where('order_id', $input['order_id'])->first();

        if ($userDonasi) {
            $userDonasi->status = $input['transaction_status'];
            $userDonasi->metode = $input['payment_type'];
            $userDonasi->save();
            \Log::info('User donasi updated', ['id' => $userDonasi->id]);

            if ($input['transaction_status'] === 'settlement') {
                Donasi::where('id_donasi', $userDonasi->id_donasi)
                      ->increment('total', $userDonasi->jumlah);
            }

            \Log::info('User donasi updated', ['id' => $userDonasi->id]);
        } else {
            \Log::warning('Donasi not found: ' . $input['order_id']);
        }

        return response()->json(['message' => 'Notification processed'], 200);
    }

}