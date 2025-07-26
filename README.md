# Generate policies for all existing models in one go.

[![Latest Version on Packagist](https://img.shields.io/packagist/v/petersowah/laravel-bulk-policies.svg?style=flat-square)](https://packagist.org/packages/petersowah/laravel-bulk-policies)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/petersowah/laravel-bulk-policies/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/petersowah/laravel-bulk-policies/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/petersowah/laravel-bulk-policies/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/petersowah/laravel-bulk-policies/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/petersowah/laravel-bulk-policies.svg?style=flat-square)](https://packagist.org/packages/petersowah/laravel-bulk-policies)

This is where your description should go. Limit it to a paragraph or two. Consider adding a small example.

## Support us

[<img src="https://github-ads.s3.eu-central-1.amazonaws.com/laravel-bulk-policies.jpg?t=1" width="419px" />](https://spatie.be/github-ad-click/laravel-bulk-policies)

We invest a lot of resources into creating [best in class open source packages](https://spatie.be/open-source). You can support us by [buying one of our paid products](https://spatie.be/open-source/support-us).

We highly appreciate you sending us a postcard from your hometown, mentioning which of our package(s) you are using. You'll find our address on [our contact page](https://spatie.be/about-us). We publish all received postcards on [our virtual postcard wall](https://spatie.be/open-source/postcards).

## Installation

You can install the package via composer:

```bash
composer require petersowah/laravel-bulk-policies
```

## Usage

### Generate Policies for All Models

To generate policies for all Eloquent models in your application, run:

```bash
php artisan make:bulk-policies
```

This command will:
- Scan both `app/Models` and `app` for all Eloquent models (following Laravel conventions).
- Generate a policy in `app/Policies` for each model that does not already have one.
- Each generated policy will have the correct `App\Policies` namespace.
- Skip any models that already have a corresponding policy.

**Example output:**
```
Discovered models:
- App\Models\User
- App\Models\Post
---
Created policies:
- UserPolicy
- PostPolicy
Skipped (already exist):
- CommentPolicy
```

> **Note:**
> This package is convention-driven and does not require or support custom configuration for model or policy paths. It always follows Laravel's default structure for models and policies.

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Peter Sowah](https://github.com/petersowah)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.