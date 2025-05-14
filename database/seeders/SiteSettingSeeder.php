<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SiteSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $site_settings = array(
            array(
                "id" => 1,
                "key" => "site_name",
                "value" => "Ela",
                "created_at" => "2025-05-06 18:34:55",
                "updated_at" => "2025-05-06 22:30:23",
            ),
            array(
                "id" => 2,
                "key" => "site_email",
                "value" => "feloela101@gmail.com",
                "created_at" => "2025-05-06 18:34:55",
                "updated_at" => "2025-05-06 18:34:55",
            ),
            array(
                "id" => 3,
                "key" => "site_phone",
                "value" => "0769501328",
                "created_at" => "2025-05-06 18:34:55",
                "updated_at" => "2025-05-06 18:34:55",
            ),
            array(
                "id" => 4,
                "key" => "site_default_currency",
                "value" => "USD",
                "created_at" => "2025-05-06 18:34:55",
                "updated_at" => "2025-05-06 18:34:55",
            ),
            array(
                "id" => 5,
                "key" => "site_currency_icon",
                "value" => "$",
                "created_at" => "2025-05-06 18:34:55",
                "updated_at" => "2025-05-06 18:34:55",
            ),
            array(
                "id" => 6,
                "key" => "site_map",
                "value" => "<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d31908.441240848042!2d37.0343936!3d-1.441792!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x182f7671796e4977%3A0xdbcf4e925dfe9a95!2sDaystar%20University!5e0!3m2!1sen!2ske!4v1746570631078!5m2!1sen!2ske\" width=\"600\" height=\"450\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\" referrerpolicy=\"no-referrer-when-downgrade\"></iframe>",
                "created_at" => "2025-05-06 22:27:10",
                "updated_at" => "2025-05-06 22:30:38",
            ),
        );

        \DB::table('site_settings')->insert($site_settings);
    }
}
