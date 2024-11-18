<?php

namespace Tests\Feature;

use App\Filament\Resources\SocialLinksResource\Pages\CreateSocialLinks;
use App\Filament\Resources\SocialLinksResource\Pages\EditSocialLinks;
use App\Models\Company;
use App\Models\SocialLinks;
use App\Models\User;

//use Filament\Forms\Components\Livewire;
use Livewire\Livewire;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

//use function Pest\Livewire\livewire;
//it('can create social link', function () {

class SocialLinkResourceTest extends TestCase
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
    public function can_view_social_links_list()
    {
        $this->withoutMiddleware()
            ->actingAs($this->user)
            ->get('/admin/social-links')
            ->assertSuccessful()
            ->assertSeeText('Social Links');
    }

    /** @test */
    public function can_create_social_link()
    {
        $platformData = ['ar' => 'تويتر', 'en' => 'Twitter'];
        $urlData = ['ar' => 'https://twitter.com/test', 'en' => 'https://twitter.com/test'];

        Livewire::actingAs($this->user)
            ->test(CreateSocialLinks::class)
            ->set('data.company_id', $this->company->id)
            ->set('data.platform', $platformData)
            ->set('data.url', $urlData)
            ->call('create')
            ->assertHasNoErrors();

        $socialLink = SocialLinks::where('company_id', $this->company->id)->latest()->first();

        $this->assertEquals($this->company->id, $socialLink->company_id);
        $this->assertEquals('تويتر', $socialLink->platform['ar']);
        $this->assertEquals('Twitter', $socialLink->platform['en']);
        $this->assertEquals('https://twitter.com/test', $socialLink->url['ar']);
        $this->assertEquals('https://twitter.com/test', $socialLink->url['en']);
    }

    /** @test */
    public function can_update_social_link()
    {
        $socialLink = SocialLinks::factory()->create([
            'company_id' => $this->company->id,
            'platform' => ['ar' => 'تويتر', 'en' => 'Twitter'],
            'url' => ['ar' => 'https://twitter.com/test', 'en' => 'https://twitter.com/test']
        ]);

        $newPlatformData = ['ar' => 'فيسبوك', 'en' => 'Facebook'];
        $newUrlData = ['ar' => 'https://facebook.com/test', 'en' => 'https://facebook.com/test'];

        Livewire::actingAs($this->user)
            ->test(EditSocialLinks::class, ['record' => $socialLink->id])
            ->set('data.id', $socialLink->id)
            ->set('data.company_id', $this->company->id)
            ->set('data.platform', $newPlatformData)
            ->set('data.url', $newUrlData)
            ->call('update')
            ->assertHasNoErrors();
    }

    /** @test */
    public function can_delete_social_link(){
         $socialLink = SocialLinks::factory()->create([
             'company_id' => $this->company->id,
             'platform' => ['ar' => 'تويتر', 'en' => 'Twitter'],
             'url' => ['ar' => 'https://twitter.com/test', 'en' => 'https://twitter.com/test']
         ]);
         Livewire::actingAs($this->user)
             ->test(EditSocialLinks::class,['record' => $socialLink->id])
             ->call('delete')
             ->assertHasNoErrors();
         $this->assertDatabaseMissing('social_links', [
         'id' => $socialLink->id,
         ]);
    }

}
