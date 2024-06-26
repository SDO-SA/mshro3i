<?php

namespace App\Providers\Filament;

use App\Filament\Resources\AnnouncementResource;
use App\Filament\Resources\AssignmentResource;
use App\Filament\Resources\GroupResource;
use App\Filament\Resources\ProjectResource;
use App\Filament\Resources\ResourceResource;
use App\Filament\Resources\StudentsResource;
use App\Filament\Resources\SubmissionResource;
use App\Filament\Resources\SupervisorsResource;
use App\Filament\Widgets\StatsOverview;
use App\Filament\Widgets\StudentGroupStateChart;
use App\Filament\Widgets\UserStateChart;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class CommitteePanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('committee')
            ->path('committee')
            ->login()
            ->colors([
                'primary' => '#3f62ba',
            ])
            ->pages([
                Pages\Dashboard::class,
            ])
            ->resources([
                AssignmentResource::class,
                AnnouncementResource::class,
                ResourceResource::class,
                SubmissionResource::class,
                GroupResource::class,
                ProjectResource::class,
                SupervisorsResource::class,
                StudentsResource::class,
            ])
            ->widgets([
                StatsOverview::class,
                StudentGroupStateChart::class,
                UserStateChart::class,
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
            ->authMiddleware([
                Authenticate::class,
            ])
            ->authGuard('committee');
    }
}
