<?php

namespace Tests\Feature;

use App\Filament\Resources\AboutCompanyInfoResource\Pages\CreateAboutCompanyInfo;
use App\Filament\Resources\AboutCompanyInfoResource\Pages\EditAboutCompanyInfo;
use App\Models\AboutCompany;
use App\Models\AboutCompanyInfo;
use App\Models\Company;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class AboutCompanyInfoTest extends TestCase
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
        $this->aboutCompany = AboutCompany::factory()->create([
            'company_id' => $this->company->id,
            'question' => [
                'ar' => 'س',
                'en' => 'hs'
            ]
        ]);


    }

    /** @test */
    public function can_view_about_company_info()
    {
        $this->withoutMiddleware()
            ->actingAs($this->user)
            ->get('/admin/about-company-infos')
            ->assertSuccessful()
            ->assertSeeText('AboutCompanyInfo');
    }

    /** @test */
    public function can_create_about_company_info()
    {
        $description = ['ar' => 'سص', 'en' => 'htt'];

        Livewire::actingAs($this->user)
            ->test(CreateAboutCompanyInfo::class)
            ->set('data.about_company_id', $this->aboutCompany->id)
            ->set('data.description', [$description])
            ->call('create')
            ->assertHasNoErrors();
    }

    /** @test */
    public function can_update_about_company_info()
    {
        $aboutCompanyInfo = AboutCompanyInfo::factory()->create([
            'about_company_id' => $this->aboutCompany->id,
            'description' => [
                'ar' => 'صش',
                'en' => 'asdahs'
            ],
        ]);
        $description = ['ar' => 'جديد', 'en' => 'new'];

        Livewire::actingAs($this->user)
            ->test(EditAboutCompanyInfo::class, ['record' => $aboutCompanyInfo->id])
            ->set('data.id', $aboutCompanyInfo->id)
            ->set('data.about_company_id', $this->aboutCompany->id)
            ->set('data.description', [$description])
            ->call('update')
            ->assertHasNoErrors();
    }


    /** @test */
    public function can_delete_about_company_info(){
        $aboutCompanyInfo = AboutCompanyInfo::factory()->create([
            'about_company_id' => $this->aboutCompany->id,
            'description' => [
                'ar' => 'صش',
                'en' => 'asdahs'
            ],
        ]);

        Livewire::actingAs($this->user)
            ->test(EditAboutCompanyInfo::class,['record' => $aboutCompanyInfo->id])
            ->call('delete')
            ->assertHasNoErrors();
        $this->assertDatabaseMissing('sliders', [
            'id' => $aboutCompanyInfo->id,
        ]);
    }
}
