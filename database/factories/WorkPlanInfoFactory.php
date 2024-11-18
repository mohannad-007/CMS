<?php

namespace Database\Factories;

use App\Models\Company;
use App\Models\WorkPlan;
use App\Models\WorkPlanInfo;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\WorkPlanInfo>
 */
class WorkPlanInfoFactory extends Factory
{
    protected $model = WorkPlanInfo::class;


    public function definition(): array
    {
        return [
            'workPlan_id' => WorkPlan::factory(),
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
