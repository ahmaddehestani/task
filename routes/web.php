<?php

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
//    $user=\App\Models\User::create([
//        'name'=>'ali',
//        'email'=>'IgHsP@example.com',
//        'password'=>'123456'
//    ]);
    $response = Http::withHeaders([
        'Content-Type' => 'application/json',
        'Accept' => 'application/json',
    ])->post('https://sandbox.zarinpal.com/pg/v4/payment/request.json', [
        'name' => 'علی رضایی',
        'merchant_id' => '27eb6831-7d90-43e7-a8d3-bf323ddbe2a8',
        'amount' => 54000,
        'currency' => 'IRR',
        'callback_url' => 'www.google.com',
        'metadata' => [
            'email' => 'IgHsP@example.com',],
        'description' => 'test'

    ]);
    $result = $response->json();

    if (isset($result['data']['authority'])) {
        $url = "https://sandbox.zarinpal.com/pg/StartPay/" . $result['data']['authority'];
        \App\Models\Transaction::create([
            'user_id' => 1,
            'authority' => $result['data']['authority'],
            'code' => $result['data']['code'],
            'amount' => 54000,
        ]);
        return redirect()->away($url);

    }

    return 0;
});
Route::get('/v', function () {
    $z = \App\Models\Transaction::find(9);
    $response = Http::withHeaders([
    ])->post('https://sandbox.zarinpal.com/pg/v4/payment/verify.json', [
        'merchant_id' => '27eb6831-7d90-43e7-a8d3-bf323ddbe2a8',
        'amount' => 54000,
        'authority' => $z->authority
    ]);
    $data = $response->json();
    if(isset($data['data']['code'])){
    if ($data['data']['code'] == 101||$data['data']['code'] == 100) {
        $z->update([
            'code' => $data['data']['code'],
            'fee' => $data['data']['fee'],
            'ref_id' => $data['data']['ref_id'],
            'message' => $data['data']['message'],
            'status' => 'success'
        ]);
        return $data['data']['message'];
    }
    }
    if(isset($data['errors']['code'])){
        $z->update([
            'code' => $data['errors']['code'],
            'message' => $data['errors']['message'],
            'status' => 'failed'
        ]);
    }
if(isset($data['code'])){
    return '';
}
    return 'call to admin';
});
