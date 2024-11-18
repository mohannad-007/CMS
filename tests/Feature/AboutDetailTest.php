<?php

namespace Tests\Feature;

use App\Filament\Resources\AboutDetailsResource\Pages\CreateAboutDetails;
use App\Filament\Resources\AboutDetailsResource\Pages\EditAboutDetails;
use App\Models\AboutDetails;
use App\Models\Company;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class AboutDetailTest extends TestCase
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
    public function can_view_about_details()
    {
        $this->withoutMiddleware()
            ->actingAs($this->user)
            ->get('/admin/about-details')
            ->assertSuccessful()
            ->assertSeeText('AboutDetails');
    }

    /** @test */
    public function can_create_about_details()
    {
        $title = ['ar' => 'تويتر', 'en' => 'Twitter'];
        $description = ['ar' => 'https://twitter.com/test', 'en' => 'https://twitter.com/test'];

        Livewire::actingAs($this->user)
            ->test(CreateAboutDetails::class)
            ->set('data.company_id', $this->company->id)
            ->set('data.title', [$title])
            ->set('data.description', [$description])
            ->call('create')
            ->assertHasNoErrors();
    }

    /** @test */
    public function can_update_about_details()
    {
        $aboutDetails = AboutDetails::factory()->create([
            'company_id' => $this->company->id,
            'title' => ['ar' => 'تويتر', 'en' => 'Twitter'],
            'description' => ['ar' => 'https://twitter.com/test', 'en' => 'https://twitter.com/test'],
        ]);
        $title = ['ar' => 'جديد', 'en' => 'new'];
        $description = ['ar' => 'جديد', 'en' => 'new'];

        Livewire::actingAs($this->user)
            ->test(EditAboutDetails::class, ['record' => $aboutDetails->id])
            ->set('data.id', $aboutDetails->id)
            ->set('data.company_id', $this->company->id)
            ->set('data.title', [$title])
            ->set('data.description', [$description])
            ->call('update')
            ->assertHasNoErrors();
    }


    /** @test */
    public function can_delete_about_details(){
        $aboutDetails = AboutDetails::factory()->create([
            'company_id' => $this->company->id,
            'title' => ['ar' => 'تويتر', 'en' => 'Twitter'],
            'description' => ['ar' => 'https://twitter.com/test', 'en' => 'https://twitter.com/test'],
        ]);
        Livewire::actingAs($this->user)
            ->test(EditAboutDetails::class,['record' => $aboutDetails->id])
            ->call('delete')
            ->assertHasNoErrors();
        $this->assertDatabaseMissing('sliders', [
            'id' => $aboutDetails->id,
        ]);
    }

}
