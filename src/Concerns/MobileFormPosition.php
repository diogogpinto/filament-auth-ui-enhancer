<?php

namespace DiogoGPinto\AuthUIEnhancer\Concerns;

trait MobileFormPosition
{
    public string $mobileFormPosition = 'top';

    public function mobileFormPosition(string $position = 'top'): self
    {
        if (! in_array($position, ['top', 'bottom', 'full'])) {
            throw new \InvalidArgumentException("Form position must be 'top', 'bottom' or 'full'.");
        }

        $this->mobileFormPosition = $position;

        return $this;
    }

    public function getMobileFormPosition(): string
    {
        return $this->mobileFormPosition;
    }
}
