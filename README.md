# Auth UI Enhancer for Filament Panels 🔥

[![Latest Version on Packagist](https://img.shields.io/packagist/v/diogogpinto/filament-auth-ui-enhancer.svg?style=flat-square)](https://packagist.org/packages/diogogpinto/filament-auth-ui-enhancer)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/diogogpinto/filament-auth-ui-enhancer/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/diogogpinto/filament-auth-ui-enhancer/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/diogogpinto/filament-auth-ui-enhancer/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/diogogpinto/filament-auth-ui-enhancer/actions?query=workflow%3A"Fix+PHP+code+styling"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/diogogpinto/filament-auth-ui-enhancer.svg?style=flat-square)](https://packagist.org/packages/diogogpinto/filament-auth-ui-enhancer)

![Filament Auth UI Enhancer](/art/auth-ui-enhancer.webp)

## Looking for an easy way to customize the UI of your Auth Pages in your Filament Panel?

This Filament plugin empowers you to transform your auth pages with ease, allowing you to make them truly stand out. It offers a flexible alternative to the default auth pages in the Filament Panels package.

Setting it up is a breeze, and it comes packed with a variety of customizable features—plus, there’s a lot more to come! 🔥

### Check out some examples you can create right out of the box:

![Auth UI Enhancer Examples](/art/auth-ui-enhancer-examples.webp)

## Navigation

-   [Version Compatibility](#version-compatibility)
-   [Installation](#installation)
-   [Usage](#usage)
    -   [AuthPage Discovery](#auth-page-discovery)
-   [Customizing the Auth UI](#customizing-the-auth-ui)
    -   [Customizing the Form Panel](#customizing-the-form-panel)
    -   [Customizing the Empty Panel](#customizing-the-empty-panel)
-   [Further Customization - CSS](#further-customization---css)
-   [Working Examples](#working-example)
-   [Todo](#todo)
-   [Changelog](#changelog)
-   [Contributing](#contributing)
-   [Security Vulnerabilities](#security-vulnerabilities)
-   [Credits](#credits)
-   [License](#license)

## Version Compatibility

| Plugin Version | Filament Version | PHP Version |
| -------------- | ---------------- | ----------- |
| `^2.0`         | `^4.0` \| `^5.0` | `^8.2`      |
| `^1.0`         | `^3.0`           | `^8.1`      |

## Installation

Start by installing the plugin via composer:

```bash
composer require diogogpinto/filament-auth-ui-enhancer
```

In an effort to align with Filament's theming methodology you will need to use a custom theme to use this plugin.

> [!IMPORTANT]
> If you have not set up a custom theme, follow the instructions in the [Filament Docs](https://filamentphp.com/docs/5.x/styling/overview) first.

1. Add the following to your `theme.css` file:

```css
@source '../../../../vendor/diogogpinto/filament-auth-ui-enhancer/resources/**/*.blade.php';
```

> [!IMPORTANT]
> The above content should be placed in your filament theme's `theme.css` file, under the /resources/css/filament/{panel-name} path

2. Run `npm run build` in your terminal

## Usage

To start using the plugin, you need to add the plugin to your plugins array in your filament panel.

```php
use DiogoGPinto\AuthUIEnhancer\AuthUIEnhancerPlugin;

 ->plugins([
    AuthUIEnhancerPlugin::make(),
])
```

### Auth Page Discovery

#### Default Auth Logic

If you don't have any custom classes on the auth methods of your Filament panel (login(), registration(), resetPassword() and emailVerification()), this plugin will work almost out of the box.

If your panel provider is setup like below, this plugin will automatically apply the changes to your UI.

```php
$panel
    ->login()
    ->registration()
```

#### Custom Auth Logic

If you have custom logic in the mentioned methods, there is a simple way to make that UI pop, using a simple trait from this plugin. If your panel looks like the below:

```php
$panel
    ->login(YourLoginClass::class)
```

Just add the following trait to `YourLoginClass`:

```php
use DiogoGPinto\AuthUIEnhancer\Pages\Auth\Concerns\HasCustomLayout;

class YourLoginClass extends BaseLogin
{
    use HasCustomLayout;
}
```

## Customizing the Auth UI

The view for this package divides your screen in two sections:

-   Form Panel - The panel that contains the form
-   Empty Panel - The panel that contains the image

### Customizing the Form Panel

You can customize:

-   The [form panel position](#form-position) in both desktop and mobile
-   The [form panel width](#form-panel-width) in desktop
-   The [form panel background color](#form-panel-background-color)

#### Form Position

!['Form Position Examples'](/art/auth-ui-enhancer-left-right-form.webp)

You can make the form appear on the left side of the page or in the right side of the page.

```php
->formPanelPosition('left')
```

#### Form Position on Mobile

!['Mobile Form Position Examples'](/art/auth-ui-enhancer-top-bottom-mobile.webp)

On mobile devices, you can chose if the form appears above the empty container or below.

```php
->mobileFormPanelPosition('bottom')
```

This method accepts `top` or `bottom` as arguments. You can also hide the empty panel on mobile (see below).

#### Form Panel Width

!['Form Width Examples'](/art/auth-ui-enhancer-form-width.webp)

The form panel width has a default value of `50%`. You can change it by adding the following method and passing the desired width.

```php
->formPanelWidth('40%')
```

Sizes must be expressed in rem, %, px, em, vw, vh or pt.

#### Form Panel Background Color

!['Form Background Color Examples'](/art/auth-ui-enhancer-form-background.webp)

You can change the form panel background color by using the following method:

```php
use Filament\Support\Colors\Color;

->formPanelBackgroundColor(Color::Zinc, '300')
```

In this case, 300 is the shade of the color you want to use.

You can also set the color using HEX or RGB, like in a typical filament panel:

```php
use Filament\Support\Colors\Color;

->formPanelBackgroundColor(Color::hex('#f0f0f0'))
```

### Customizing the Empty Panel

You can customize:

-   The [empty panel background color](#empty-panel-background-color)
-   The [empty panel background image and its opacity](#empty-panel-background-image-and-image-opacity)
-   The [empty panel view](#empty-panel-custom-view)
-   Either to [show or hide empty panel on mobile](#hide-empty-panel-on-mobile-devices)

#### Empty Panel Background Image and Image Opacity

!['Empty Panel Background Examples'](/art/auth-ui-enhancer-empty-panel-background-image.webp)

You can set an image to be displayed on the empty panel, and control its opacity.

```php
->emptyPanelBackgroundImageUrl('images/login.webp')
```

You can pass an asset URL with Laravel's `asset('images/login.webp')` function.

If you would like to change the image opacity, you can use the following method:

```php
->emptyPanelBackgroundImageOpacity('50%')
```

#### Empty Panel Background Color

!['Empty Panel Background Color Examples'](/art/auth-ui-enhancer-empty-panel-background-color.webp)

The default background color is your panel's primary color. You can change the empty panel background color by using the following method:

```php
use Filament\Support\Colors\Color;

->emptyPanelBackgroundColor(Color::Zinc, '300')
```

In this case, 300 is the shade of the color you want to use.

You can also set the color using HEX or RGB, like in a typical filament panel:

```php
use Filament\Support\Colors\Color;

->emptyPanelBackgroundColor(Color::hex('#f0f0f0'))
```

#### Empty Panel Custom View

!['Empty Panel View Examples'](/art/auth-ui-enhancer-empty-view.webp)

You can decide to use a custom view inside the empty panel instead of a background. Decide which view to use by using the following method:

```php
->emptyPanelView('view')
```

The method only accepts the view name as a parameter.
If both background image and custom view are provided, the plugin will prioritize the view.

#### Hide Empty Panel on Mobile Devices

You can just use the following method, so the empty panels disappears on mobile and the form container spans to full height:

```php
->showEmptyPanelOnMobile(false)
```

## Further Customization - CSS

You can create further customizations in your theme's CSS file. The following classes are available:

```css
/* Whole page wrapper */
.custom-auth-wrapper {
}

/* Empty panel wrapper */
.custom-auth-empty-panel {
}

/* Form panel wrapper */
.custom-auth-form-panel {
}

/* Form wrapper */
.custom-auth-form-wrapper {
}
```

## Working Example

If you're just looking to plug and play some code into your Filament Panel, here's a working code so you can just insert into your plugins array:

```php
use DiogoGPinto\AuthUIEnhancer\AuthUIEnhancerPlugin;
$panel
    ->plugins([
        AuthUIEnhancerPlugin::make()
            ->showEmptyPanelOnMobile(false)
            ->formPanelPosition('right')
            ->formPanelWidth('40%')
            ->emptyPanelBackgroundImageOpacity('70%')
            ->emptyPanelBackgroundImageUrl('https://images.pexels.com/photos/466685/pexels-photo-466685.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2')
    ]);

```

> [!WARNING]  
> This is a random image URL I got from Pexels. If you want to use it in production or commercially you should check its license.

## Todo

-   Develop different layouts

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

-   [Diogo Pinto](https://github.com/diogogpinto) - you can follow me on [Twitter](https://x.com/diogogpinto)
-   [Joao Patrício](https://github.com/ijpatricio) for his amazing support
-   [CodeWithDennis](https://github.com/CodeWithDennis) for his early contributions
-   [Alexandre](https://github.com/alexandrevega) for making the `views` feature possible
-   [Jicoy](https://github.com/Jicoy) for his contribution on v4 upgrade
-   [Davide Prevosto](https://github.com/davideprevosto) for his contribution on v5 upgrade
-   [Geridoc](https://www.geridoc.pt) for allowing me to release our packages with Open Source licenses
-   [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
