<?php

namespace DiogoGPinto\AuthUIEnhancer\Pages\Auth;

use DiogoGPinto\AuthUIEnhancer\Pages\Auth\Concerns\HasCustomLayout;
use Filament\Auth\Pages\Login;

class AuthUiEnhancerLogin extends Login
{
    use HasCustomLayout;
}
