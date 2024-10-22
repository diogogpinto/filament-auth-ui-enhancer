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

- [Installation](#installation)
- [Usage](#usage)
  - [AuthPage Discovery](#auth-page-discovery)
- [Customizing the Auth UI](#customizing-the-auth-ui)
    - [Customizing the Form Panel](#customizing-the-form-panel)
    - [Customizing the Empty Panel](#customizing-the-empty-panel)
- [Changelog](#changelog)
- [Contributing](#contributing)
- [Security Vulnerabilities](#security-vulnerabilities)
- [Credits](#credits)
- [License](#license)

## Installation

First, starting by installing the plugin via composer:

```bash
composer require diogogpinto/filament-auth-ui-enhancer
```

After installation, run the following command to publish the assets:

```bash
php artisan filament:assets
```

### If you're using a custom theme

Add the vendor files to your tailwind config file:

```javascript
content: [
    './vendor/diogogpinto/filament-auth-ui-enhancer/resources/**/*.blade.php',
]
```

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

Just add the following trait to `YouLoginClass`:

```php
use DiogoGPinto\AuthUIEnhancer\Pages\Auth\Concerns\HasCustomLayout;

class YourLoginClass extends BaseLogin
{
    use HasCustomLayout;
}
```

## Customizing the Auth UI

The view for this package divides your screen in two sections:
- Form Panel - The panel that contains the form
- Empty Panel - The panel that contains the image

### Customizing the Form Panel

You can customize:
- The [form panel position](#form-position) in both desktop and mobile
- The [form panel width](#form-panel-width) in desktop
- The [form panel background color](#form-panel-background-color)

#### Form Position

!['Form Position Examples'](/art/auth-ui-enhancer-left-right-form.webp)

You can make the form appear on the left side of the page or in the right side of the page.

```php
->formPanelPosition('left')
````

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
- The [empty panel background color](#empty-panel-background-color)
- The [empty panel background image and its opacity](#empty-panel-background-image-and-image-opacity)
- Either to [show or hide empty panel on mobile](#hide-empty-panel-on-mobile-devices)

#### Empty Panel Background Image and Image Opacity

!['Empty Panel Background Examples'](/art/auth-ui-enhancer-empty-panel-background-image.webp)

You can set an image to be displayed on the empty panel, and control its opacity.

```php
->emptyPanelBackgroundImageUrl('images/login.webp')
```

You can pass an asset url, with Laravel's function `asset('images/login.webp')`.

If you would like to chance the image opacity of your image, you can use the following method:

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

#### Hide Empty Panel on Mobile Devices

You can just use the following method, so the empty panels disappears on mobile and the form container spans to full height:

```php
->showEmptyPanelOnMobile(false)
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


## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Diogo Pinto](https://github.com/diogogpinto) - you can follow me on [Twitter](https://x.com/diogogpinto)
- [Joao Patrício](https://github.com/ijpatricio) for his amazing support
- [CodeWithDennis](https://github.com/CodeWithDennis) for his early contributions
- [Geridoc](https://www.geridoc.pt) for allowing me to release our packages with Open Source licenses
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
