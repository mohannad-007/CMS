<?php

namespace Database\Factories;

use App\Models\AboutCompany;
use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\AboutCompany>
 */
class AboutCompanyFactory extends Factory
{
    protected $model = AboutCompany::class;

    public function definition(): array
    {
        return [
            'company_id' => Company::factory(),
            'question' => [
                'ar' => 'س',
                'en' => 'hs'
            ]
        ];
    }
}
