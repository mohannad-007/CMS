<?php

namespace Database\Factories;

use App\Models\Company;
use App\Models\Logo;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Logo>
 */
class LogoFactory extends Factory
{

    protected $model = Logo::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'company_id' => Company::factory(),
            'name' =>'aa',
            'logo_file' => 'xzczzxcxzczxc.png'
        ];
    }
}
