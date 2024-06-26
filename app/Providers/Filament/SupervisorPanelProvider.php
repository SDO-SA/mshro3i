<?php

namespace App\Providers\Filament;

use App\Filament\Pages\SupervisorRegister;
use App\Filament\Resources\SupervisorAssignmentResource;
use App\Filament\Resources\SupervisorGroupResource;
use App\Filament\Resources\SupervisorProjectResource;
use App\Filament\Resources\SupervisorSubmissionResource;
use App\Filament\Supervisor\Widgets\ProjectState;
use App\Filament\Supervisor\Widgets\SubmissionState;
use App\Filament\Supervisor\Widgets\SupervisorStats;
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

class SupervisorPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->id('supervisor')
            ->path('supervisor')
            ->login()
            ->registration(SupervisorRegister::class)
            ->colors([
                'primary' => '#3f62ba',
            ])

            ->pages([
                Pages\Dashboard::class,
            ])
            ->resources([
                SupervisorGroupResource::class,
                SupervisorProjectResource::class,
                SupervisorAssignmentResource::class,
                SupervisorSubmissionResource::class,

            ])
            ->widgets([
                SupervisorStats::class,
                ProjectState::class,
                SubmissionState::class,
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
            ->authGuard('supervisor');
    }
}
