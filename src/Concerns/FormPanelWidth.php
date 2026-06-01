<?php

namespace DiogoGPinto\AuthUIEnhancer\Concerns;

use Closure;
use Filament\Support\Concerns\EvaluatesClosures;

trait FormPanelWidth
{
    use EvaluatesClosures;

    public string|Closure $formPanelWidth = '50%';

    public function formPanelWidth(string|Closure $width = '50%'): static
    {
        if (is_string($width) && ! $this->isValidWidth($width)) {
            throw new \InvalidArgumentException('Sizes must be expressed in rem, %, px, em, vw, vh, pt');
        }

        $this->formPanelWidth = $width;

        return $this;
    }

    protected function isValidWidth(string $formPanelWidth): bool
    {
        $pattern = '/^\d+(\.\d+)?(rem|%|px|em|vw|vh|pt)$/';

        return preg_match($pattern, $formPanelWidth) === 1;

    }

    public function getFormPanelWidth(): string
    {
        $width = $this->evaluate($this->formPanelWidth);

        if (! $this->isValidWidth($width)) {
            throw new \InvalidArgumentException('Sizes must be expressed in rem, %, px, em, vw, vh, pt');
        }

        return $width;
    }
}
