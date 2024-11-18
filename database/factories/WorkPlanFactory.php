<?php

namespace Database\Factories;

use App\Models\Company;
use App\Models\WorkPlan;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class WorkPlanFactory extends Factory
{
    protected $model = WorkPlan::class;

    public function definition(): array
    {
        return [
        'company_id' => Company::factory(),
        'work_image_file' => 'sw',
        'section_title' => [
            'ar' => 's',
            'en' => 'hs'
        ]
    ];
    }
}
