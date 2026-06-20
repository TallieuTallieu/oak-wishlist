# Oak Wishlist

A wishlist package for DRY/Oak applications.

It supports two storage drivers:

- `session`: store wishlist item IDs in the Oak session.
- `database`: store wishlist item IDs in the `wishlist` table through dry ORM.

## Installation

```sh
composer require tallieutallieu/oak-wishlist
```

Register the service provider in your Oak application:

```php
<?php

$app->register([
    \Tnt\Wishlist\WishlistServiceProvider::class,
]);
```

## Configuration

Create or publish a `wishlist` config entry in your application config.

```php
<?php

return [
    'driver' => 'database',
    'model' => \Tnt\Wishlist\Model\Wishlist::class,
    'identifier' => \app\model\User::class,
];
```

| Option | Default | Description |
| --- | --- | --- |
| `driver` | `database` | `database` or `session`. |
| `model` | `Tnt\Wishlist\Model\Wishlist::class` | dry ORM model used by the database driver. |
| `identifier` | none | Class bound as `WishlistableInterface`; required for the database driver. |

The configured identifier class must implement `Tnt\Wishlist\Contracts\WishlistableInterface`.

```php
<?php

use Tnt\Wishlist\Contracts\WishlistableInterface;

class User implements WishlistableInterface
{
    public function getWishlistIdentifier(): int
    {
        return $this->id;
    }
}
```

## Database Revision

When `wishlist.driver` is `database`, `WishlistServiceProvider` registers a package migrator named `wishlist`.

Run the wishlist revision with Oak:

```sh
php oak migration migrate -m wishlist
```

To apply only the next pending wishlist revision:

```sh
php oak migration update -m wishlist
```

To inspect registered migrators and versions:

```sh
php oak migration list
```

The first wishlist revision creates the `wishlist` table with these columns:

- `id`
- `created`
- `updated`
- `wishlist_class`
- `wishlist_id`
- `identifier`

The revision also adds non-unique indexes for wishlist lookup performance. It does not add a unique constraint, so existing duplicate wishlist rows remain compatible.

## Wishlist Items

Wishlistable items must implement `WishlistItemInterface`.

```php
<?php

use Tnt\Wishlist\Contracts\WishlistItemInterface;

class Product implements WishlistItemInterface
{
    public static function getByWishlistId(int $id): ?WishlistItemInterface
    {
        return self::load($id);
    }

    public function getWishlistId(): int
    {
        return $this->id;
    }

    public function serialize(): array
    {
        return [
            'id' => $this->getWishlistId(),
            'title' => $this->title,
        ];
    }

    public function isWishlistable(): bool
    {
        return true;
    }
}
```

## Facade Usage

```php
<?php

use Tnt\Wishlist\Facade\Wishlist;

$product = Product::load(1);

Wishlist::add($product);
Wishlist::remove($product);

if (Wishlist::has($product)) {
    echo 'Product is on the wishlist';
}

$items = Wishlist::getItems();

Wishlist::clear();
```

## Internal API Endpoints

The service provider registers these dry-internal-api routes:

| Method | Path | Description |
| --- | --- | --- |
| `GET` | `wishlist/items/` | Return serialized wishlist items. |
| `GET` | `wishlist/toggle/` | Toggle an item by `class` and `id`. |
| `GET` | `wishlist/add/` | Add an item by `class` and `id`. |
| `GET` | `wishlist/remove/` | Remove an item by `class` and `id`. |
| `GET` | `wishlist/clear/` | Clear the wishlist. |

The item mutation endpoints expect:

- `class`: a class name implementing `WishlistItemInterface`.
- `id`: the item ID passed to `getByWishlistId()`.

## Admin Manager

`Tnt\Wishlist\Admin\WishlistManager` is available as a minimal read-only dry ORM manager for existing admin integrations.

It is not auto-registered by the service provider. If an application wants it in an admin portal, register it in that application.

## Development

This package follows the Docker workflow used by the DRY package ecosystem.

Start the Docker environment:

```sh
make docker
```

Run tests:

```sh
make test
```

Run PHPStan:

```sh
make phpstan
```

Format PHP files:

```sh
make yarn-install
make yarn-format
```

The Docker setup uses the PHP 8.4 DRY image, MySQL, Adminer, and Xdebug.
