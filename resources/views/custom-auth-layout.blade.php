@php
    $formPanelPosition = filament('filament-auth-ui-enhancer')->getFormPanelPosition();
    $mobileFormPanelPosition = filament('filament-auth-ui-enhancer')->getMobileFormPanelPosition();
    $emptyPanelBackgroundImageUrl = filament('filament-auth-ui-enhancer')->getEmptyPanelBackgroundImageUrl();
    $emptyPanelBackgroundImageOpacity = filament('filament-auth-ui-enhancer')->getEmptyPanelBackgroundImageOpacity();
    $showEmptyPanelOnMobile = filament('filament-auth-ui-enhancer')->getShowEmptyPanelOnMobile();
    $emptyPanelView = filament('filament-auth-ui-enhancer')->getEmptyPanelView();
@endphp
<x-filament-panels::layout.base :livewire="$livewire">
    <div
        @class([
          'custom-auth-wrapper flex w-full min-h-screen',
          'lg:flex-row-reverse' => $formPanelPosition === 'left',
          'lg:flex-row' => $formPanelPosition === 'right',
          'flex-col' => $mobileFormPanelPosition === 'bottom' && $showEmptyPanelOnMobile,
          'flex-col-reverse' => $mobileFormPanelPosition === 'top' && $showEmptyPanelOnMobile,
        ])
    >
            @if (($hasTopbar ?? true) && filament()->auth()->check())
            <div class="fi-simple-layout-header">
                @if (filament()->hasDatabaseNotifications())
                    @livewire(Filament\Livewire\DatabaseNotifications::class, [
                        'lazy' => filament()->hasLazyLoadedDatabaseNotifications(),
                        'position' => \Filament\Enums\DatabaseNotificationsPosition::Topbar,
                    ])
                @endif

                @if (filament()->hasUserMenu())
                    @livewire(Filament\Livewire\SimpleUserMenu::class)
                @endif
            </div>
        @endif

        <!-- Empty Container -->
        <div @class([
            'custom-auth-empty-panel relative justify-center px-4',
            'bg-[var(--empty-panel-background-color)]',
            'hidden lg:flex lg:flex-col lg:flex-grow' => $showEmptyPanelOnMobile === false,
            'flex flex-col flex-grow' => $showEmptyPanelOnMobile === true
            ])
        >
            @if($emptyPanelView)
                @include($emptyPanelView)
            @else
                @if($emptyPanelBackgroundImageUrl)
                    <div class="absolute inset-0 h-full w-full bg-cover bg-center"
                         style="background-image: url('{{ $emptyPanelBackgroundImageUrl }}'); opacity: {{ $emptyPanelBackgroundImageOpacity }}; background-position: center;">
                </div>
                @endif
            @endif
        </div>

        <!-- Form Container -->
        <div class="custom-auth-form-panel flex flex-col justify-center px-4 py-12 sm:px-6 lg:px-20 xl:px-36 w-full lg:w-[var(--form-panel-width)] bg-[var(--form-panel-background-color)]">
            <div class="custom-auth-form-wrapper mx-auto w-full max-w-sm">
                {{ $slot }}
            </div>
        </div>

    </div>
</x-filament-panels::layout.base>
