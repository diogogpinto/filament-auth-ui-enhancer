@php
    $formPosition = filament('filament-auth-ui-enhancer')->getFormPosition();
    $mobileFormPosition = filament('filament-auth-ui-enhancer')->getMobileFormPosition();
    $loginPanelBackgroundColor = filament('filament-auth-ui-enhancer')->getLoginPanelBackgroundColor();
    $emptyPanelBackgroundColor = filament('filament-auth-ui-enhancer')->getEmptyPanelBackgroundColor();
    $emptyPanelBackgroundImage = filament('filament-auth-ui-enhancer')->getEmptyPanelBackgroundImage();
    $emptyPanelBackgroundImageOpacity = filament('filament-auth-ui-enhancer')->getEmptyPanelBackgroundImageOpacity();
@endphp
<x-filament-panels::layout.base :livewire="$livewire">
    <div
        @class([
          'flex w-full min-h-screen',
          'lg:flex-row-reverse' => $formPosition === 'left',
          'lg:flex-row' => $formPosition === 'right',
          'flex-col' => $mobileFormPosition === 'bottom',
          'flex-col-reverse' => $mobileFormPosition === 'top',
        ])
    >
        <!-- Empty Container -->
        <div @class([
                    'flex flex-col relative justify-center px-4 flex-grow',
                    $emptyPanelBackgroundColor,
                    'hidden md:block' => $mobileFormPosition === 'full',
                 ])
        ">
        @if($emptyPanelBackgroundImage)
            <div class="absolute inset-0 h-full w-full bg-cover bg-center"
                 style="background-image: url('{{ $emptyPanelBackgroundImage }}'); opacity: {{ $emptyPanelBackgroundImageOpacity }}; background-position: center;">
            </div>
        @endif
    </div>

    <!-- Form Container -->
    <div
        class="flex flex-col justify-center px-4 py-12 sm:px-6 lg:px-20 xl:px-36 w-full lg:w-[var(--form-width)] {{ $loginPanelBackgroundColor }}">
        <div class="mx-auto w-full max-w-sm">
            {{ $slot }}
        </div>
    </div>

</x-filament-panels::layout.base>
