<?php

namespace Database\Factories;

use App\Models\Company;
use App\Models\SocialLinks;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class SocialLinksFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = SocialLinks::class;

    public function definition(): array
    {
        return [
            'company_id' => Company::factory(),
            'platform' => [
                'ar' => 'فيسبوك',
                'en' => 'Facebook'
            ],
            'url' => [
                'ar' => 'https://facebook.com/example',
                'en' => 'https://facebook.com/example'
            ]
        ];
    }
}
