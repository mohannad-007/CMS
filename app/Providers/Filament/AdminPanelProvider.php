<?php

namespace App\Providers\Filament;

use App\Filament\Resources\UserResource;
use Filament\Facades\Filament;
use Filament\FontProviders\LocalFontProvider;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Navigation\MenuItem;
use Filament\Navigation\NavigationBuilder;
use Filament\Navigation\NavigationItem;
use Filament\Pages;
use Filament\Pages\Auth\EditProfile;
use Filament\Pages\Dashboard;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\SpatieLaravelTranslatablePlugin;
use Filament\Support\Colors\Color;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use function Termwind\style;

//use App\Filament\Pages\Settings;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('/')
            ->login()
            ->colors([
                'danger' => Color::Rose,
               'gray' => 'rgb(107, 114, 128)',
                // 'gray' => '#224A91',
//                'gray' => '#EBF1FF',
//                'gray' => '#FF7E1D',
//                'gray' => 'rgb(107, 114, 128)',
                'info' => Color::Blue,
            //    'primary' => '#EBF1FF',
                'primary' => '#FF7E1D',
            //    'primary' => '#224A91',
                'success' => Color::Emerald,
                'warning' => Color::Orange,
            ])
            ->font(url("./fonts/URWGeometricRegular.otf"))

//            ->brandName('AL-Naweia')
            ->brandLogo(asset('storage/images/logo.png'))
//            ->brandLogoHeight('2rem')
            ->favicon(asset('storage/images/logo.png'))
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
//                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
                Widgets\AccountWidget::class,
                Widgets\FilamentInfoWidget::class,
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->plugin(
                SpatieLaravelTranslatablePlugin::make()
                    ->defaultLocales(['en','ar']),
            )
//            ->userMenuItems([
//                MenuItem::make()
//                    ->label('Settings')
////                    ->url(fn (): string => Settings::getUrl())
//                    ->icon('heroicon-o-cog-6-tooth'),
//                // ...
//            ])
//            ->topbar(false)
//            ->darkMode(false)
            ->topNavigation()
            ->authMiddleware([
                Authenticate::class,
            ]);
    }
}
