<?php

namespace DiogoGPinto\AuthUIEnhancer\Concerns;

use Closure;
use Filament\Support\Concerns\EvaluatesClosures;

trait FormPosition
{
    use EvaluatesClosures;

    public string|Closure $formPanelPosition = 'right';

    public function formPanelPosition(string|Closure $position = 'right'): static
    {
        if (is_string($position) && ! $this->isValidFormPosition($position)) {
            throw new \InvalidArgumentException("Form position must be 'left' or 'right'.");
        }

        $this->formPanelPosition = $position;

        return $this;
    }

    protected function isValidFormPosition(string $position): bool
    {
        return in_array($position, ['left', 'right']);
    }

    public function getFormPanelPosition(): string
    {
        $position = $this->evaluate($this->formPanelPosition);

        if (! $this->isValidFormPosition($position)) {
            throw new \InvalidArgumentException("Form position must be 'left' or 'right'.");
        }

        return $position;
    }
}
