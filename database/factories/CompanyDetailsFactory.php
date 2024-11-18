<?php

namespace Database\Factories;

use App\Models\Company;
use App\Models\CompanyDetails;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CompanyDetails>
 */
class CompanyDetailsFactory extends Factory
{
    protected $model = CompanyDetails::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'company_id' => Company::factory(),
            'header' => [
                'ar' => 'سس',
                'en' => 'as'
            ],
            'information' => [
                'ar' => 'https://facebook.com/example',
                'en' => 'https://facebook.com/example'
            ],
            'percentage'=>1
        ];
    }
}
