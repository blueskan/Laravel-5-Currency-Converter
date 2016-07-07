# Laravel-5-Currency-Converter
Small Api for currency converting jobs in Laravel 5

Installation
-------------
- Going your project directory on shell and run this command: 

```php
composer require senemoglu/currency:dev-master
```

- Add this line in your service provider's array (config/app.php) => 
 
```php
Senemoglu\Currency\CurrencyServiceProvider::class,
```

- Add this line in your aliases => 
 
```php
'Currency' => Senemoglu\Currency\Facades\Converter::class,
```

# Usage

On Business Side:
-----------------
**Example**

```php
Currency::convert('USD', 'TRY', 20);
```

On Presentation Side:
--------------------
**Example** 

```php
@currency(USD => TRY, 20)
```

*I have been working about this since 3 hours. Any advice you give, im open.*
