<?php

namespace Database\Seeders;

use App\Models\Language;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $languages = [
            'English',
            'Hindi',
            'Spanish',
            'Finnish',  // Corrected from "Finish"
            'French',
            'Hebrew',   // Changed "Jewish" to "Hebrew"
            'Mandarin',
            'German',
            'Arabic',
            'Russian',
            'Portuguese',
            'Italian',
            'Japanese',
            'Korean',
            'Swahili',
            'Dutch',
            'Bengali',
            'Turkish',
            'Vietnamese',
            'Greek',
            'Urdu',
            'Tamil',
            'Telugu',
            'Punjabi',
            'Indonesian',
            'Thai',
            'Malay',
            'Czech',
            'Polish',
            'Ukrainian',
            'Hungarian',
            'Romanian',
            'Persian (Farsi)',
            'Pashto',
            'Somali',
            'Zulu',
            'Amharic',
            'Hausa',
            'Yoruba',
            'Igbo',
            'Nepali',
            'Sinhala',
            'Malayalam',
            'Marathi',
            'Kannada',
            'Gujarati',
            'Azerbaijani',
            'Kazakh',
            'Uzbek',
            'Georgian',
            'Armenian',
            'Tajik',
            'Kurdish',
            'Bosnian',
            'Serbian',
            'Croatian',
            'Slovenian',
            'Bulgarian',
            'Macedonian',
            'Albanian',
            'Latvian',
            'Lithuanian',
            'Estonian',
            'Icelandic',
            'Norwegian',
            'Swedish',
            'Danish',
            'Finnish',
            'Mongolian',
            'Tibetan',
            'Maori',
            'Samoan',
            'Tongan',
            'Hawaiian',
            'Luxembourgish',
            'Basque',
            'Catalan',
            'Galician',
            'Welsh',
            'Irish Gaelic',
            'Scottish Gaelic',
            'Breton',
            'Corsican',
            'Maltese',
            'Esperanto',
            'Haitian Creole',
            'Javanese',
            'Sundanese',
            'Tagalog',
            'Cebuano',
            'Ilocano',
            'Bislama',
            'Chamorro',
            'Lao',
            'Khmer',
            'Burmese',
            'Tatar',
            'Cherokee',
            'Navajo',
            'Inuktitut',
            'Greenlandic',
            'Fijian',
            'Wolof',
            'Shona',
            'Xhosa',
            'Tswana',
            'Sesotho',
            'Zulu',
            'Maasai',
            'Dinka',
            'Twi',
            'Ewe',
            'Ga',
            'Afrikaans',
            'Kinyarwanda',
            'Kirundi'
        ];


        foreach ($languages as $language) {
            # code...
            $lang = new Language();
            $lang->name = $language;
            $lang->save();
        }
    }
}
