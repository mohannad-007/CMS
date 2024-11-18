<?php

namespace Database\Factories;

use App\Models\Company;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Company>
 */
class CompanyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Company::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'name' => [
                'ar' => 'شركة ' . $this->faker->company(),
                'en' => $this->faker->company()
            ],
            'company_details_title' => [
                'ar' => [
                    'من نحن',
                    'خدماتنا',
                    'رؤيتنا'
                ],
                'en' => [
                    'Who We Are',
                    'Our Services',
                    'Our Vision'
                ]
            ],
            'company_details' => [
                'ar' => [
                    'نحن شركة رائدة في مجال ' . $this->faker->word(),
                    'نقدم خدمات متميزة في ' . $this->faker->word(),
                    'نسعى لتحقيق ' . $this->faker->sentence()
                ],
                'en' => [
                    $this->faker->paragraph(),
                    $this->faker->paragraph(),
                    $this->faker->paragraph()
                ]
            ],
            'company_Info' => [
                'ar' => [
                    'عنوان' => 'معلومات عن الشركة',
                    'وصف' => $this->faker->paragraph(),
                    'تفاصيل' => $this->faker->sentences(3, true)
                ],
                'en' => [
                    'title' => 'Company Information',
                    'description' => $this->faker->paragraph(),
                    'details' => $this->faker->sentences(3, true)
                ]
            ],
            'phone_number' => $this->faker->numberBetween(1000000, 9999999)
        ];
    }
}
