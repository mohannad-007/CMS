<?php

namespace Tests\Feature;

use App\Filament\Resources\CompanyDetailsResource\Pages\CreateCompanyDetails;
use App\Filament\Resources\CompanyDetailsResource\Pages\EditCompanyDetails;
use App\Models\Company;
use App\Models\CompanyDetails;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class CompanyDetailsTest extends TestCase
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
    public function can_view_company_details_list()
    {
        $this->withoutMiddleware()
            ->actingAs($this->user)
            ->get('/admin/company-details')
            ->assertSuccessful()
            ->assertSeeText('Company Details');
    }
    /** @test */
    public function can_create_company_details()
    {
        $header = 'ss';
        $information = 'ssda';
        $percentage = 2;

        Livewire::actingAs($this->user)
            ->test(CreateCompanyDetails::class)
            ->set('data.company_id', $this->company->id)
            ->set('data.header', $header)
            ->set('data.information', $information)
            ->set('data.percentage', $percentage)
            ->call('create')
            ->assertHasNoErrors();
    }

    /** @test */
    public function can_update_company_details()
    {
        $CompanyDetails = CompanyDetails::factory()->create([
            'company_id' => $this->company->id,
            'header' => 's',
            'information' => 'w',
            'percentage' => 3
        ]);

        $header = 'new';
        $information = 'new';
        $percentage = 4;

        Livewire::actingAs($this->user)
            ->test(EditCompanyDetails::class, ['record' => $CompanyDetails->id])
            ->set('data.id', $CompanyDetails->id)
            ->set('data.company_id', $this->company->id)
            ->set('data.header', $header)
            ->set('data.information', $information)
            ->set('data.percentage', $percentage)
            ->call('update')
            ->assertHasNoErrors();
    }

    /** @test */
    public function can_delete_company_details(){
        $CompanyDetails = CompanyDetails::factory()->create([
            'company_id' => $this->company->id,
            'header' => 's',
            'information' => 'w',
            'percentage' => 3
        ]);

        Livewire::actingAs($this->user)
            ->test(EditCompanyDetails::class,['record' => $CompanyDetails->id])
            ->call('delete')
            ->assertHasNoErrors();
        $this->assertDatabaseMissing('social_links', [
            'id' => $CompanyDetails->id,
        ]);
    }
}
