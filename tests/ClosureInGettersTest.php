<?php

use DiogoGPinto\AuthUIEnhancer\AuthUIEnhancerPlugin;

test('use closure for background color getters applies shade', function () {
    $palette = [300 => 'red300', 500 => 'red500'];

    $plugin = AuthUIEnhancerPlugin::make()
        ->formPanelBackgroundColor(fn () => $palette)
        ->emptyPanelBackgroundColor(fn () => $palette, 300);

    expect($plugin->getFormPanelBackgroundColor())->toBe('red500')
        ->and($plugin->getEmptyPanelBackgroundColor())->toBe('red300');
});

test('use closure for background color shade', function () {
    $palette = [300 => 'red300', 500 => 'red500'];

    $plugin = AuthUIEnhancerPlugin::make()
        ->formPanelBackgroundColor($palette, fn () => 300)
        ->emptyPanelBackgroundColor($palette, fn () => 300);

    expect($plugin->getFormPanelBackgroundColor())->toBe('red300')
        ->and($plugin->getEmptyPanelBackgroundColor())->toBe('red300');
});

test('use closure for background image url and opacity getters', function () {
    $plugin = AuthUIEnhancerPlugin::make()
        ->emptyPanelBackgroundImageUrl(fn () => 'https://example.com/image.jpg')
        ->emptyPanelBackgroundImageOpacity(fn () => '70');

    expect($plugin->getEmptyPanelBackgroundImageUrl())->toBe('https://example.com/image.jpg')
        ->and($plugin->getEmptyPanelBackgroundImageOpacity())->toBe('70');
});

test('closure returning null for form panel background color falls back to transparent', function () {
    $plugin = AuthUIEnhancerPlugin::make()->formPanelBackgroundColor(fn () => null);

    expect($plugin->getFormPanelBackgroundColor())->toBe('transparent');
});

test('closure returning null for empty panel background color falls back to default', function () {
    $plugin = AuthUIEnhancerPlugin::make()->emptyPanelBackgroundColor(fn () => null);

    expect($plugin->getEmptyPanelBackgroundColor())->toBe('var(--primary-500)');
});

test('use closure for custom empty panel view getter', function () {
    $plugin = AuthUIEnhancerPlugin::make()
        ->emptyPanelView(fn () => 'auth.custom-empty-panel');

    expect($plugin->getEmptyPanelView())->toBe('auth.custom-empty-panel');
});

test('use closure for form panel width getter', function () {
    $plugin = AuthUIEnhancerPlugin::make()
        ->formPanelWidth(fn () => '40%');

    expect($plugin->getFormPanelWidth())->toBe('40%');
});

test('closure returning invalid form width throws on getter', function () {
    $plugin = AuthUIEnhancerPlugin::make()
        ->formPanelWidth(fn () => 'invalid');

    expect(fn () => $plugin->getFormPanelWidth())
        ->toThrow(InvalidArgumentException::class);
});

test('use closure for form position getter', function () {
    $plugin = AuthUIEnhancerPlugin::make()
        ->formPanelPosition(fn () => 'left');

    expect($plugin->getFormPanelPosition())->toBe('left');
});

test('closure returning invalid form position throws on getter', function () {
    $plugin = AuthUIEnhancerPlugin::make()
        ->formPanelPosition(fn () => 'invalid');

    expect(fn () => $plugin->getFormPanelPosition())
        ->toThrow(InvalidArgumentException::class);
});

test('use closure for mobile form position getter', function () {
    $plugin = AuthUIEnhancerPlugin::make()
        ->mobileFormPanelPosition(fn () => 'bottom');

    expect($plugin->getMobileFormPanelPosition())->toBe('bottom');
});

test('closure returning invalid mobile form position throws on getter', function () {
    $plugin = AuthUIEnhancerPlugin::make()
        ->mobileFormPanelPosition(fn () => 'invalid');

    expect(fn () => $plugin->getMobileFormPanelPosition())
        ->toThrow(InvalidArgumentException::class);
});

test('use closure for show empty panel on mobile getter', function () {
    $plugin = AuthUIEnhancerPlugin::make()
        ->showEmptyPanelOnMobile(fn () => false);

    expect($plugin->getShowEmptyPanelOnMobile())->toBeFalse();
});
