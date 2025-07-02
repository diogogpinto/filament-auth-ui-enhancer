<?php

namespace DiogoGPinto\AuthUIEnhancer\Concerns;

trait BackgroundAppearance
{
    public ?string $formPanelBackgroundColor = null;

    public ?string $emptyPanelBackgroundColor = null;

    public ?string $emptyPanelBackgroundImageUrl = null;

    public ?string $emptyPanelBackgroundImageOpacity = '100%';

    public function formPanelBackgroundColor(string | array $color, int $shade = 500): self
    {
        $this->formPanelBackgroundColor = $color[$shade];

        return $this;
    }

    public function getFormPanelBackgroundColor(): ?string
    {
        return $this->formPanelBackgroundColor ?: 'transparent';
    }

    public function emptyPanelBackgroundColor(array $color, int $shade = 500): self
    {
        $this->emptyPanelBackgroundColor = $color[$shade];

        return $this;
    }

    public function getEmptyPanelBackgroundColor(): ?string
    {
        return $this->emptyPanelBackgroundColor ?: 'var(--primary-500)';
    }

    public function emptyPanelBackgroundImageUrl(?string $url): self
    {
        $this->emptyPanelBackgroundImageUrl = $url;

        return $this;
    }

    public function getEmptyPanelBackgroundImageUrl(): ?string
    {
        return $this->emptyPanelBackgroundImageUrl;
    }

    public function emptyPanelBackgroundImageOpacity(?string $opacity): self
    {
        $this->emptyPanelBackgroundImageOpacity = $opacity;

        return $this;
    }

    public function getEmptyPanelBackgroundImageOpacity(): ?string
    {
        return $this->emptyPanelBackgroundImageOpacity;
    }
}
