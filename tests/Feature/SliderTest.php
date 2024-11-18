<?php

namespace Tests\Feature;

use App\Filament\Resources\SliderResource\Pages\CreateSlider;
use App\Filament\Resources\SliderResource\Pages\EditSlider;
use App\Models\Company;
use App\Models\Slider;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class SliderTest extends TestCase
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

//        // إنشاء رابط اجتماعي للاختبار
//        $this->socialLink = SocialLinks::factory()->create([
//            'company_id' => $this->company->id,
//            'platform' => [
//                'ar' => 'فيسبوك',
//                'en' => 'Facebook'
//            ],
//            'url' => [
//                'ar' => 'https://facebook.com/test',
//                'en' => 'https://facebook.com/test'
//            ]
//        ]);
    }

    /** @test */
    public function can_view_slider_list()
    {
        $this->withoutMiddleware()
            ->actingAs($this->user)
            ->get('/admin/sliders')
            ->assertSuccessful()
            ->assertSeeText('slider');
    }
    /** @test */
    public function can_create_slider()
    {
        $slider_file = 'slider.png';

        Livewire::actingAs($this->user)
            ->test(CreateSlider::class)
            ->set('data.company_id', $this->company->id)
            ->set('data.slider_file', [$slider_file])
            ->call('create')
            ->assertHasNoErrors();

    }

    /** @test */
    public function can_update_slider()
    {
        $slider = Slider::factory()->create([
            'company_id' => $this->company->id,
            'slider_file' => 'slider.png',
        ]);

        $slidermData = 'sliderpng';

        Livewire::actingAs($this->user)
            ->test(EditSlider::class, ['record' => $slider->id])
            ->set('data.id', $slider->id)
            ->set('data.company_id', $this->company->id)
            ->set('data.slider_file', [$slidermData])
            ->call('update')
            ->assertHasNoErrors();
    }

    /** @test */
    public function can_delete_slider(){
        $slider = Slider::factory()->create([
            'company_id' => $this->company->id,
            'slider_file' => 'slider.png',
        ]);
        Livewire::actingAs($this->user)
            ->test(EditSlider::class,['record' => $slider->id])
            ->call('delete')
            ->assertHasNoErrors();
        $this->assertDatabaseMissing('sliders', [
            'id' => $slider->id,
        ]);
    }
}
