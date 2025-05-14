<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaymentSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $payment_settings = array(
            array(
                "id" => 1,
                "key" => "paypal_status",
                "value" => "active",
                "created_at" => "2025-04-18 08:55:25",
                "updated_at" => "2025-04-18 08:55:25",
            ),
            array(
                "id" => 2,
                "key" => "paypal_account_mode",
                "value" => "sandbox",
                "created_at" => "2025-04-18 08:55:25",
                "updated_at" => "2025-04-18 08:55:25",
            ),
            array(
                "id" => 3,
                "key" => "paypal_country_name",
                "value" => "US",
                "created_at" => "2025-04-18 08:55:25",
                "updated_at" => "2025-04-18 08:55:25",
            ),
            array(
                "id" => 4,
                "key" => "paypal_currency_name",
                "value" => "USD",
                "created_at" => "2025-04-18 08:55:25",
                "updated_at" => "2025-04-18 08:55:25",
            ),
            array(
                "id" => 5,
                "key" => "paypal_currency_rate",
                "value" => "1",
                "created_at" => "2025-04-18 08:55:26",
                "updated_at" => "2025-04-18 08:55:26",
            ),
            array(
                "id" => 6,
                "key" => "paypal_client_id",
                "value" => "AY_U-M34Yhg5sGV5-qhzpPt3L7Uhmnf98b3xM4Jrq6gkBltn7oetvUKc4JClc7_Bex7FExV-rLp0Ao7o",
                "created_at" => "2025-04-18 08:55:26",
                "updated_at" => "2025-04-18 08:55:26",
            ),
            array(
                "id" => 7,
                "key" => "paypal_client_secret",
                "value" => "EDA7qkmrTu3xyrLfJkp7mEXJk5a1Mq2xsOF9eAHxI-ASy_e7muClgyHb9uzOYowQlgn76_othbxN-pMY",
                "created_at" => "2025-04-18 08:55:26",
                "updated_at" => "2025-04-18 08:55:26",
            ),
            array(
                "id" => 8,
                "key" => "paypal_app_id",
                "value" => "APP-80W284485P519543T",
                "created_at" => "2025-04-18 08:55:26",
                "updated_at" => "2025-04-18 08:55:26",
            ),
            array(
                "id" => 16,
                "key" => "mpesa_status",
                "value" => "active",
                "created_at" => "2025-05-05 18:32:40",
                "updated_at" => "2025-05-05 18:32:40",
            ),
            array(
                "id" => 17,
                "key" => "mpesa_env",
                "value" => "sandbox",
                "created_at" => "2025-05-05 18:32:40",
                "updated_at" => "2025-05-05 18:32:40",
            ),
        );

        \DB::table('payment_settings')->insert($payment_settings);
    }
}
