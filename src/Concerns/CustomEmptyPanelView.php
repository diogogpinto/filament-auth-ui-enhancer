<?php

namespace DiogoGPinto\AuthUIEnhancer\Concerns;

use Closure;
use Filament\Support\Concerns\EvaluatesClosures;

trait CustomEmptyPanelView
{
    use EvaluatesClosures;

    public string|Closure|null $emptyPanelView = null;

    public function emptyPanelView(string|Closure|null $view): static
    {
        $this->emptyPanelView = $view;

        return $this;
    }

    public function getEmptyPanelView(): ?string
    {
        return $this->evaluate($this->emptyPanelView);
    }
}
