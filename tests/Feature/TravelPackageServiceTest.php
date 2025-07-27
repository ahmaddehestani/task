<?php

namespace Tests\Feature;

use App\Models\Package;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class TravelPackageServiceTest extends TestCase
{
    use RefreshDatabase;

    public function test_index()
    {
        // آماده‌سازی داده‌ها
        Package::create([
            'name' => 'Package 1',
            'price' => 1000,
            'location'=> 'Location 1'
        ]); // ایجاد سه پکیج سفر برای تست

        // ارسال درخواست به متد index
        $response = $this->getJson(route('package.index'));

        // تایید وضعیت پاسخ
        $response->assertStatus(200);

        // تایید داده‌های دریافتی
//        $response->assertJsonCount(1, 'data');  // باید سه پکیج دریافت کنیم
    }

//  cls
}
