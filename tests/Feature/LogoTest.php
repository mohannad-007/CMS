<?php

namespace Tests\Feature;

use App\Filament\Resources\LogoResource\Pages\CreateLogo;
use App\Filament\Resources\LogoResource\Pages\EditLogo;
use App\Models\Company;
use App\Models\Logo;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class LogoTest extends TestCase
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
    public function can_view_logo_list()
    {
        $this->withoutMiddleware()
            ->actingAs($this->user)
            ->get('/admin/logos')
            ->assertSuccessful()
            ->assertSeeText('Logo');
    }

    /** @test */
    public function can_create_logo()
    {
        $name = 'name';
        $logo_file =['logoFile.png'];

        Livewire::actingAs($this->user)
            ->test(CreateLogo::class)
            ->set('data.company_id', $this->company->id)
            ->set('data.name', $name)
            ->set('data.logo_file', $logo_file)
            ->call('create')
            ->assertHasNoErrors();

    }

    /** @test */
    public function can_update_logo()
    {
        $logo = Logo::factory()->create([
            'company_id' => $this->company->id,
            'name' =>'ss',
            'logo_file' => 'asa.png'
        ]);

        $newNameData = 'new';
        $newLogoFileData = 'new.png';

        Livewire::actingAs($this->user)
            ->test(EditLogo::class, ['record' => $logo->id])
            ->set('data.id', $logo->id)
            ->set('data.company_id', $this->company->id)
            ->set('data.name', $newNameData)
            ->set('data.logo_file', [$newLogoFileData])
            ->call('update')
            ->assertHasNoErrors();
    }

    /** @test */
    public function can_delete_Logo(){
        $logo = Logo::factory()->create([
            'company_id' => $this->company->id,
            'name' =>'ss',
            'logo_file' => 'asa.png'
        ]);
        Livewire::actingAs($this->user)
            ->test(EditLogo::class,['record' => $logo->id])
            ->call('delete')
            ->assertHasNoErrors();
        $this->assertDatabaseMissing('logos', [
            'id' => $logo->id,
        ]);
    }
}
