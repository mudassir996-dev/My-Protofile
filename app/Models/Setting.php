<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $guarded = [];

    /**
     * Get settings record, or create a default one if none exists.
     */
    public static function getSettings()
    {
        return self::firstOrCreate(
            ['id' => 1],
            [
                'name' => 'Mudassir Yaseen',
                'tagline' => 'Full Stack Web Developer | PHP | Laravel | Vue.js',
                'summary' => 'Motivated and detail-oriented Full Stack Web Developer with hands-on experience in front-end and back-end development using PHP, Laravel, Vue.js, and MySQL. Currently completing a B.Sc. (Hons) in Physics at The Islamia University of Bahawalpur. Experienced in building responsive web applications, collaborating in agile teams, and delivering production-ready code. Fluent in English and Urdu; seeking junior-to-mid-level developer roles locally or remote.',
                'phone' => '+92 326 042 8996',
                'email' => 'jammudassiryaseen2004@gmail.com',
                'github_url' => 'github.com/mudassir-yaseen',
                'linkedin_url' => '',
                'cv_path' => null,
                'profile_photo' => null,
            ]
        );
    }
}
