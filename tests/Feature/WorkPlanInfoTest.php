<?php

namespace Tests\Feature;

use App\Filament\Resources\WorkPlanInfoResource\Pages\CreateWorkPlanInfo;
use App\Filament\Resources\WorkPlanInfoResource\Pages\EditWorkPlanInfo;
use App\Models\Company;
use App\Models\User;
use App\Models\WorkPlan;
use App\Models\WorkPlanInfo;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class WorkPlanInfoTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create([
            'name' => 'Mohannad',
            'email' => 'mohannad@ultra.com',
            'password' => bcrypt(12345678),
        ]);

        $this->company = Company::factory()->create([
            'user_id' => $this->user->id,
            'name' => 'ss',
            'company_details_title' => 'ss',
            'company_details' => 'ss',
            'company_Info' => 'ss',
            'phone_number' => 123,
        ]);
        $this->workPlan = WorkPlan::factory()->create([
            'company_id' => $this->company->id,
            'work_image_file' => 'sw',
            'section_title' => [
                'ar' => 'سش',
                'en' => 'hs'
            ]
        ]);


    }

    /** @test */
    public function can_view_work_plan_info()
    {
        $this->withoutMiddleware()
            ->actingAs($this->user)
            ->get('/admin/work-plan-infos')
            ->assertSuccessful()
            ->assertSeeText('WorkPlanInfo');
    }
    /** @test */
    public function can_create_work_plan_info()
    {
        $title = ['ar' => 'تويتر', 'en' => 'Twitter'];
        $description = ['ar' => 'https://twitter.com/test', 'en' => 'https://twitter.com/test'];

        Livewire::actingAs($this->user)
            ->test(CreateWorkPlanInfo::class)
            ->set('data.workPlan_id', $this->workPlan->id)
            ->set('data.title', [$title])
            ->set('data.description', [$description])
            ->call('create')
            ->assertHasNoErrors();
    }

    /** @test */
    public function can_update_work_plan_info()
    {
        $workplaninfo = WorkPlanInfo::factory()->create([
            'workPlan_id' => $this->workPlan->id,
            'title' => ['ar' => 'تويتر', 'en' => 'Twitter'],
            'description' => ['ar' => 'https://twitter.com/test', 'en' => 'https://twitter.com/test'],
        ]);
        $title = ['ar' => 'جديد', 'en' => 'new'];
        $description = ['ar' => 'جديد', 'en' => 'new'];

        Livewire::actingAs($this->user)
            ->test(EditWorkPlanInfo::class, ['record' => $workplaninfo->id])
            ->set('data.id', $workplaninfo->id)
            ->set('data.workPlan_id', $this->workPlan->id)
            ->set('data.title', [$title])
            ->set('data.description', [$description])
            ->call('update')
            ->assertHasNoErrors();
    }


    /** @test */
    public function can_delete_work_plan_info(){
        $workplaninfo = WorkPlanInfo::factory()->create([
            'workPlan_id' => $this->workPlan->id,
            'title' => ['ar' => 'تويتر', 'en' => 'Twitter'],
            'description' => ['ar' => 'https://twitter.com/test', 'en' => 'https://twitter.com/test'],
        ]);
        Livewire::actingAs($this->user)
            ->test(EditWorkPlanInfo::class,['record' => $workplaninfo->id])
            ->call('delete')
            ->assertHasNoErrors();
        $this->assertDatabaseMissing('sliders', [
            'id' => $workplaninfo->id,
        ]);
    }
}
