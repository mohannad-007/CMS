<?php

namespace Database\Factories;

use App\Models\AboutDetails;
use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class AboutDetailsFactory extends Factory
{
    protected $model = AboutDetails::class;


    public function definition(): array
    {
        return [
            'company_id' => Company::factory(),
            'title' => [
                'ar' => 'صش',
                'en' => 'asdahs'
            ],
            'description' => [
                'ar' => 'يسش',
                'en' => 'hsa'
            ]
        ];
    }
}
