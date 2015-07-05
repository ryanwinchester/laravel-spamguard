# SpamGuard

Guarding form requests against bots.


## Install

```bash
composer require fungku/spamguard
```

Add the service provider to `config/app.php` in the `providers` array:

```php
Fungku\SpamGuard\Providers\SpamGuardServiceProvider::class,
```

Add the alias to `config/app.php` in the `aliases` array:

```php
'SpamGuard' => Fungku\SpamGuard\Facades\SpamGuard::class,
```

## Config (optional)

If you'd like to change the default package config values, then publish the config and change the defaults...

```bash
php artisan vendor:publish --provider="Fungku\SpamGuard\Providers\SpamGuardConfigServiceProvider" --tag="config"
```

## Usage

To use the spamguard, there are two things you need to do.

### 1. Add the *SpamGuard* form elements in your form

Somewhere inside your form, just use the `spamguard_html()` helper function.

Using all spam guard elements:

```html
<form action="/some-route/action">

    {!! spamguard_html() !!}
    
    <!-- other form elements -->
    
</form>
```

Using only the spamguard honeypot:

```html
<form action="/some-route/action">

    {!! spamguard_html(['only' => ['spam_honeypot']]) !!}
    
    <!-- other form elements -->
    
</form>
```

### 2. Add the *SpamGuard* middleware to your route or controller

Using the helper function to assign all spam middleware to all actions:

```php
class MyController extends Controller
{
    public function __construct()
    {
        spamguard_middleware($this);
    }
}
```

Using the helper function to assign just the honeypot middleware to only the `update` and `store` actions:

```php
spamguard_middleware($this, ['only' => ['update', 'store']]);
```

Using the helper function to assign all SpamGuard middleware except the `spam_timer`,
to only the `update` and `store` actions:

```php
spamguard_middleware(
    $this,
    ['only' => ['update', 'store']],
    ['except' => ['spam_timer']]
);
```

Or you can just use middleware normally:

```php
class MyController extends Controller
{
    public function __construct()
    {
        $this->middleware('spam_honeypot');
        
        $this->middleware('spam_timer');
    }
}
```

Using the `spam_timer` middleware in a controller normally and overriding the `min_time` and `max_time` for a specific action:

```php
$this->middleware('spam_timer:10,300', ['only' => 'postComment']);
```

## Options

Currently there are two spam middleware: `spam_honeypot` and `spam_timer`.

## Notes

If you are selectively using elements and middleware, please note that the elements you use must match up with the
middleware you assign to the routes.

## Plans

I will look into adding some more baked-in goodness, like Akismet or something else in the future if anyone other than
myself ends up using this package (or maybe I will do it anyway).
