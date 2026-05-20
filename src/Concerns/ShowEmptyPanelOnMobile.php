<?php

namespace DiogoGPinto\AuthUIEnhancer\Concerns;

use Closure;
use Filament\Support\Concerns\EvaluatesClosures;

trait ShowEmptyPanelOnMobile
{
    use EvaluatesClosures;

    public bool|Closure $showEmptyPanelOnMobile = true;

    /**
     * @param bool|Closure $show
     * @return static
     */
    public function showEmptyPanelOnMobile(bool|Closure $show = true): static
    {
        $this->showEmptyPanelOnMobile = $show;

        return $this;
    }

    public function getShowEmptyPanelOnMobile(): bool
    {
        return $this->evaluate($this->showEmptyPanelOnMobile);
    }
}
