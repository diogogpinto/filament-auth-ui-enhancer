<?php

namespace DiogoGPinto\AuthUIEnhancer\Pages\Auth\EmailVerification;

use DiogoGPinto\AuthUIEnhancer\Pages\Auth\Concerns\HasCustomLayout;
use Filament\Auth\Pages\EmailVerification\EmailVerificationPrompt;

class AuthUiEnhancerEmailVerificationPrompt extends EmailVerificationPrompt
{
    use HasCustomLayout;
}
