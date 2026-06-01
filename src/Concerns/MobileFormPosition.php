<?php

namespace DiogoGPinto\AuthUIEnhancer\Concerns;

use Closure;
use Filament\Support\Concerns\EvaluatesClosures;

trait MobileFormPosition
{
    use EvaluatesClosures;

    public string|Closure $mobileFormPanelPosition = 'top';

    public function mobileFormPanelPosition(string|Closure $position = 'top'): static
    {
        if (is_string($position) && ! $this->isValidMobileFormPanelPosition($position)) {
            throw new \InvalidArgumentException("Form position must be 'top' or 'bottom'.");
        }

        $this->mobileFormPanelPosition = $position;

        return $this;
    }

    protected function isValidMobileFormPanelPosition(string $position): bool
    {
        return in_array($position, ['top', 'bottom']);
    }

    public function getMobileFormPanelPosition(): string
    {
        $position = $this->evaluate($this->mobileFormPanelPosition);

        if (! $this->isValidMobileFormPanelPosition($position)) {
            throw new \InvalidArgumentException("Form position must be 'top' or 'bottom'.");
        }

        return $position;
    }
}
