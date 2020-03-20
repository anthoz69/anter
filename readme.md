# Anter

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Total Downloads][ico-downloads]][link-downloads]
[![StyleCI][ico-styleci]][link-styleci]

This package is collect my methods and function use frequently in laravel be careful if you are using this package it can be breaking chage anytime. Please fork it to your own repository, And send some PR for cool feature if you need to contribute it.

## Installation

1 - Install the package via Composer:

```bash
composer require anthoz69/anter
```

The package will automatically register its service provider.

> **Note**: If you are using Laravel 5.5, the steps 2 and 3, for providers and aliases, are unnecessaries. Dod Package supports Laravel new [Package Discovery](https://laravel.com/docs/5.5/packages#package-discovery).

2 - You need to update your application configuration in order to register the package so it can be loaded by Laravel, just update your `config/app.php` file adding the following code at the end of your `'providers'` section:

> `config/app.php`

```php
'providers' => [
    // other providers ommited
    anthoz69\anter\Providers\AntherServiceProvider::class,
],
```

## Usage

### AnterStore Facade

Save file from frontend upload in laravel and generate unique file name before store file.

```php
AnterStore::store($path, $file)->save();
AnterStore::url($path);
AnterStore::delete($path);
```
### AnterImg Facade

Save file from frontend upload in laravel and resize image.
```php
// Store image in /storage/app/public/user/cover
// save() method will return full path of image.
$image = AnterStore::make('user/cover', $request->file('image'));
$image->crop(300, 450)->save(); // Crop image from center size 300px x 450px.
$image->fit(300, 300, true)->save(); // Resize and crop image to 300px x 300px and prevent up size image if set true.
$image->resize(300, true)->save(); // Resize to width 300px and prevent up size image if set true.
$image->width(); // Get width of image.
$image->height(); // Get height of image.
```

### Currency function
2 => 2.00

4.75668 => 4.75

```php
setCurrency($number, $percision = 2); // truncate and round
truncate($number, $percision = 2); // truncate and not round number
```

### Router function

**isRoutePrefix** If your url start with /admin or something will place `active class` to html attribute class it good for hierarchy menu.

```php
isRouteMatch('/admin/*', $class = 'active');
```

e.g. your url `/admin/user/create`.

```php
<li class="{{ isRouteMatch('/admin/*', 'active-patent-menu') }}"></li>

// output if url start with /admin/user
<li class="active-patent-menu"></li>
```

**isRoute** When user access to url and [laravel route name](https://laravel.com/docs/5.8/routing#named-routes) matched it will output class.

```php
isRoute($routeName = '', $class = 'active');

isRoute('user.create', 'active-color-menu'); // result: active-color-menu
isRoute('user.create'); // result: active
```

### Video function

get id from url support Youtube, Vimeo if wrong format will return `null`.

```php
getYoutubeId('https://www.youtube.com/watch?v=aAzUC8vNtgo'); // output: aAzUC8vNtgo
getVimeoId('https://vimeo.com/68529790'); // output: 68529790
getVideoProvider('https://www.youtube.com/watch?v=aAzUC8vNtgo'); // output: youtube
```

### Time function in Thailand country format

Send timestamp (created_at, updated_at in laravel) to function will return string time.

```php
getTHMonth($index, $short = true);
getDateTH($strDate, $shortMonth = true, $time = false);
getTimeFromDate($strDate, $second = true);
```

e.g.

```php
getTHMonth(1); // มกราคม
getTHMonth(1, true); // ม.ค.

getDateTH('2019-07-17 16:07:42'); // 17 ก.ค. 2562
getDateTH('2019-07-17 16:07:42', false); // 17 กรกฏาคม 2562
getDateTH('2019-07-17 16:07:42', true, true); // 17 ก.ค. 2562 16:07

getTimeFromDate('2019-07-17 16:07:42'); // 16:07
getTimeFromDate('2019-07-17 16:07:42', true); // 16:07:42
```

## Security

If you discover any security related issues, please open the issue or send me some cool PR.

## Credits

- [Itthipat (Anthoz69)][link-author]
- [All Contributors][link-contributors]

## Contributing

Please see [contributing.md](contributing.md) for details and a todolist.

## License

license is under MIT. Please see the [license file](license.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/anthoz69/anter.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/anthoz69/anter.svg?style=flat-square
[ico-styleci]: https://styleci.io/repos/248770230/shield

[link-packagist]: https://packagist.org/packages/anthoz69/anter
[link-downloads]: https://packagist.org/packages/anthoz69/anter
[link-styleci]: https://styleci.io/repos/248770230
[link-author]: https://github.com/anthoz69
[link-contributors]: ../../contributors
