<?php

namespace Tests\Feature;

use App\Filament\Resources\AboutCompanyResource\Pages\CreateAboutCompany;
use App\Filament\Resources\AboutCompanyResource\Pages\EditAboutCompany;
use App\Models\AboutCompany;
use App\Models\Company;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class AboutCompanyTest extends TestCase
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
    public function can_view_about_company()
    {
        $this->withoutMiddleware()
            ->actingAs($this->user)
            ->get('/admin/about-companies')
            ->assertSuccessful()
            ->assertSeeText('AboutCompany');
    }
    /** @test */
    public function can_create_about_company()
    {
        $question = ['ar' => 'سص', 'en' => 'sw'];

        Livewire::actingAs($this->user)
            ->test(CreateAboutCompany::class)
            ->set('data.company_id', $this->company->id)
            ->set('data.question', [$question])
            ->call('create')
            ->assertHasNoErrors();
    }

    /** @test */
    public function can_update_about_company()
    {
        $about_company = AboutCompany::factory()->create([
            'company_id' => $this->company->id,
            'question' => ['ar' => 'سسص','en' => 'ws'],
        ]);

        $question = ['ar' => 'جديد','en' => 'new'];

        Livewire::actingAs($this->user)
            ->test(EditAboutCompany::class, ['record' => $about_company->id])
            ->set('data.id', $about_company->id)
            ->set('data.company_id', $this->company->id)
            ->set('data.question', $question)
            ->call('update')
            ->assertHasNoErrors();
    }

    /** @test */
    public function can_delete_about_company(){
        $about_company = AboutCompany::factory()->create([
            'company_id' => $this->company->id,
            'question' => ['ar' => 'سسص','en' => 'ws'],
        ]);
        Livewire::actingAs($this->user)
            ->test(EditAboutCompany::class,['record' => $about_company->id])
            ->call('delete')
            ->assertHasNoErrors();
        $this->assertDatabaseMissing('sliders', [
            'id' => $about_company->id,
        ]);
    }

}
