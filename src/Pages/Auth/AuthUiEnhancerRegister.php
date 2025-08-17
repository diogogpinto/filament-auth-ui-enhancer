<?php

namespace DiogoGPinto\AuthUIEnhancer\Pages\Auth;

use DiogoGPinto\AuthUIEnhancer\Pages\Auth\Concerns\HasCustomLayout;
use Filament\Auth\Pages\Register;

class AuthUiEnhancerRegister extends Register
{
    use HasCustomLayout;
}
