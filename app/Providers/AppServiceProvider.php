<?php

namespace App\Providers;

//use Filament\Facades\Filament;
use App\Models\Company;
use Filament\Facades\Filament;
use Filament\Navigation\NavigationGroup;
use Filament\Navigation\NavigationItem;
use Filament\Navigation\UserMenuItem;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
//        Filament::serving(function () {
//            $logoUrl = asset('storage/images/logo.png'); // المسار للشعار
//            $companyName = function (Company $query){
//                return $query->where('user_id', auth()->id());
//            };
//
//            // إضافة HTML مخصص في رأس الصفحة
//            Filament::pushMeta([
//                'before' => <<<HTML
//                <div style="display: flex; align-items: center;">
//                    <img src="{$logoUrl}" alt="Logo" style="height: 40px; margin-right: 10px;">
//                    <span style="font-size: 1.25rem; font-weight: bold; color: #333;">{$companyName}</span>
//                </div>
//            HTML,
//            ]);
//        });
    }


}
