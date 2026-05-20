<?php

namespace DiogoGPinto\AuthUIEnhancer\Concerns;

use Closure;
use Filament\Support\Concerns\EvaluatesClosures;

trait BackgroundAppearance
{
    use EvaluatesClosures;

    /** @var array<string>|Closure|null */
    public array|Closure|null $formPanelBackgroundColor = null;

    public int|Closure $formPanelBackgroundColorShade = 500;

    /** @var array<string>|Closure|null */
    public array|Closure|null $emptyPanelBackgroundColor = null;

    public int|Closure $emptyPanelBackgroundColorShade = 500;

    public string|Closure|null $emptyPanelBackgroundImageUrl = null;

    public string|Closure|null $emptyPanelBackgroundImageOpacity = '100%';

    /**
     * @param array<string>|Closure $color
     * @param int|Closure $shade
     * @return static
     */
    public function formPanelBackgroundColor(array|Closure $color, int|Closure $shade = 500): static
    {
        $this->formPanelBackgroundColor = $color;
        $this->formPanelBackgroundColorShade = $shade;

        return $this;
    }

    public function getFormPanelBackgroundColor(): ?string
    {
        $color = $this->evaluate($this->formPanelBackgroundColor);
        $shade = $this->evaluate($this->formPanelBackgroundColorShade);

        return ($color[$shade] ?? null) ?: 'transparent';
    }

    /**
     * @param array<string>|Closure $color
     * @param int|Closure $shade
     * @return static
     */
    public function emptyPanelBackgroundColor(array|Closure $color, int|Closure $shade = 500): static
    {
        $this->emptyPanelBackgroundColor = $color;
        $this->emptyPanelBackgroundColorShade = $shade;

        return $this;
    }

    public function getEmptyPanelBackgroundColor(): ?string
    {
        $color = $this->evaluate($this->emptyPanelBackgroundColor);
        $shade = $this->evaluate($this->emptyPanelBackgroundColorShade);

        return ($color[$shade] ?? null) ?: 'var(--primary-500)';
    }

    /**
     * @param string|Closure|null $url
     * @return static
     */
    public function emptyPanelBackgroundImageUrl(string|Closure|null $url): static
    {
        $this->emptyPanelBackgroundImageUrl = $url;

        return $this;
    }

    public function getEmptyPanelBackgroundImageUrl(): ?string
    {
        return $this->evaluate($this->emptyPanelBackgroundImageUrl);
    }

    /**
     * @param string|Closure|null $opacity
     * @return static
     */
    public function emptyPanelBackgroundImageOpacity(string|Closure|null $opacity): static
    {
        $this->emptyPanelBackgroundImageOpacity = $opacity;

        return $this;
    }

    public function getEmptyPanelBackgroundImageOpacity(): ?string
    {
        return $this->evaluate($this->emptyPanelBackgroundImageOpacity);
    }
}
