<?php

namespace Tests\Feature;

use App\Filament\Resources\WorkPlanResource\Pages\CreateWorkPlan;
use App\Filament\Resources\WorkPlanResource\Pages\EditWorkPlan;
use App\Models\Company;
use App\Models\User;
use App\Models\WorkPlan;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class WorkPlansTest extends TestCase
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


    }

    /** @test */
    public function can_view_work_plan()
    {
        $this->withoutMiddleware()
            ->actingAs($this->user)
            ->get('/admin/work-plans')
            ->assertSuccessful()
            ->assertSeeText('WorkPlan');
    }
    /** @test */
    public function can_create_work_plan()
    {
        $work_image_file = 'ssw.png';
        $section_title = 'sasq';

        Livewire::actingAs($this->user)
            ->test(CreateWorkPlan::class)
            ->set('data.company_id', $this->company->id)
            ->set('data.work_image_file', [$work_image_file])
            ->set('data.section_title', [$section_title])
            ->call('create')
            ->assertHasNoErrors();
    }

    /** @test */
    public function can_update_work_plan()
    {
        $workplan = WorkPlan::factory()->create([
            'company_id' => $this->company->id,
            'work_image_file' => 'wsq',
            'section_title' => 'sadq',
        ]);

        $work_image_file = 'new';
        $section_title = 'new';

        Livewire::actingAs($this->user)
            ->test(EditWorkPlan::class, ['record' => $workplan->id])
            ->set('data.id', $workplan->id)
            ->set('data.company_id', $this->company->id)
            ->set('data.work_image_file', [$work_image_file])
            ->set('data.section_title', $section_title)
            ->call('update')
            ->assertHasNoErrors();
    }

    /** @test */
    public function can_delete_work_plan(){
        $workplan = WorkPlan::factory()->create([
            'company_id' => $this->company->id,
            'work_image_file' => 'wsq',
            'section_title' => 'sadq',
        ]);
        Livewire::actingAs($this->user)
            ->test(EditWorkPlan::class,['record' => $workplan->id])
            ->call('delete')
            ->assertHasNoErrors();
        $this->assertDatabaseMissing('sliders', [
            'id' => $workplan->id,
        ]);
    }
}
