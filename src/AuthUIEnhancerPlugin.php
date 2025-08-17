<?php

namespace DiogoGPinto\AuthUIEnhancer;

use DiogoGPinto\AuthUIEnhancer\Concerns\BackgroundAppearance;
use DiogoGPinto\AuthUIEnhancer\Concerns\CustomEmptyPanelView;
use DiogoGPinto\AuthUIEnhancer\Concerns\FormPanelWidth;
use DiogoGPinto\AuthUIEnhancer\Concerns\FormPosition;
use DiogoGPinto\AuthUIEnhancer\Concerns\MobileFormPosition;
use DiogoGPinto\AuthUIEnhancer\Concerns\ShowEmptyPanelOnMobile;
use DiogoGPinto\AuthUIEnhancer\Pages\Auth\AuthUiEnhancerLogin;
use DiogoGPinto\AuthUIEnhancer\Pages\Auth\AuthUiEnhancerRegister;
use DiogoGPinto\AuthUIEnhancer\Pages\Auth\EmailVerification\AuthUiEnhancerEmailVerificationPrompt;
use DiogoGPinto\AuthUIEnhancer\Pages\Auth\PasswordReset\AuthUiEnhancerRequestPasswordReset;
use DiogoGPinto\AuthUIEnhancer\Pages\Auth\PasswordReset\AuthUiEnhancerResetPassword;
use Filament\Auth\Pages\EmailVerification\EmailVerificationPrompt;
use Filament\Auth\Pages\Login;
use Filament\Auth\Pages\PasswordReset\RequestPasswordReset;
use Filament\Auth\Pages\PasswordReset\ResetPassword;
use Filament\Auth\Pages\Register;
use Filament\Contracts\Plugin;
use Filament\Panel;
use Filament\Support\Facades\FilamentView;
use Filament\View\PanelsRenderHook;

class AuthUIEnhancerPlugin implements Plugin
{
    use BackgroundAppearance;
    use CustomEmptyPanelView;
    use FormPanelWidth;
    use FormPosition;
    use MobileFormPosition;
    use ShowEmptyPanelOnMobile;

    public function getId(): string
    {
        return 'filament-auth-ui-enhancer';
    }

    public function register(Panel $panel): void
    {
        if ($panel->getLoginRouteAction() === Login::class) {
            $panel
                ->login(AuthUiEnhancerLogin::class);
        }

        if ($panel->getRegistrationRouteAction() === Register::class) {
            $panel
                ->registration(AuthUiEnhancerRegister::class);
        }

        if ($panel->getRequestPasswordResetRouteAction() === RequestPasswordReset::class && $panel->getResetPasswordRouteAction() === ResetPassword::class) {
            $panel
                ->passwordReset(AuthUiEnhancerRequestPasswordReset::class, AuthUiEnhancerResetPassword::class);

        }

        if ($panel->getEmailVerificationPromptRouteAction() === EmailVerificationPrompt::class) {
            $panel
                ->emailVerification(AuthUiEnhancerEmailVerificationPrompt::class);
        }
    }

    public function boot(Panel $panel): void
    {
        FilamentView::registerRenderHook(
            PanelsRenderHook::HEAD_END,
            function () {
                return '
                    <style>
                    :root {
                    --form-panel-width: ' . $this->getFormPanelWidth() . ';
                    --form-panel-background-color: ' . $this->getFormPanelBackgroundColor() . ';
                    --empty-panel-background-color: ' . $this->getEmptyPanelBackgroundColor() . ';
                    }
                    </style>
                ';
            }
        );
    }

    public static function make(): static
    {
        return app(static::class);
    }
}
