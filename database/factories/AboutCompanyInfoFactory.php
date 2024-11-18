<?php

namespace Database\Factories;

use App\Models\AboutCompany;
use App\Models\AboutCompanyInfo;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\AboutCompanyInfo>
 */
class AboutCompanyInfoFactory extends Factory
{

    protected $model = AboutCompanyInfo::class;

    public function definition(): array
    {
        return [
            'about_company_id' => AboutCompany::factory(),
            'description' => [
                'ar' => 'صش',
                'en' => 'asdahs'
            ],
        ];
    }
}
