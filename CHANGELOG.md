# Changelog

All notable changes to this package are documented in this file. Versions
follow [Semantic Versioning](https://semver.org). New entries are generated from
commit messages by [dry-ci](https://github.com/TallieuTallieu/dry-ci); past
entries may be edited by hand.

## 3.0.0 - 2026-06-20

### Breaking changes

- Requires PHP 8.2+, `tallieutallieu/oak` ^3.0.2, `tallieutallieu/dry-internal-api` ^3.0.2, `tallieutallieu/dry` ^3.8.1-beta.5 or ^4.0 and `tallieutallieu/dry-dbi` ^3.8.0; upgrade these before updating (1.x required oak ^1.0 and dry-internal-api ^1.0.2)

### Features

- Support current dry and oak releases (dry 3.8+/4, oak 3)
- `wishlist.driver` falls back to `database` and `wishlist.model` to `Tnt\Wishlist\Model\Wishlist` when not configured
- **admin:** `WishlistManager` now shows a read-only index of the wishlist model (identifier, class, item id)

### Fixes

- The wishlist table revision uses the package's own `DatabaseRevision` instead of the application's `app\revisions\DatabaseRevision`
- The wishlist table revision adds lookup indexes on `identifier` and `identifier, wishlist_class, wishlist_id`
- The database driver skips stored rows whose class no longer exists

### Other changes

- Add Docker development workflow with PHPStan and Pest tests
- Expand the README usage guide (configuration, revision, facade, API endpoints, admin manager)

## Earlier history

- **1.0.0** (2019-09-16): First release as `reinvanoyen/oak-wishlist`: a session-backed wishlist (`SessionWishlist`) behind `WishlistInterface` and the `Wishlist` facade, with dry-internal-api routes `wishlist/items`, `toggle`, `add`, `remove` and `clear`.
- **1.0.1** (2019-09-19): Added a README with usage examples and pinned the requirements to oak ^1.0.0 and dry-internal-api ^1.0.0.
- **1.0.2** (2021-09-16): First release as `tallieutallieu/oak-wishlist` after the repo moved to T&T (install with the new package name). Added a `database` driver (`DatabaseWishlist`, `Wishlist` model, `wishlist` table revision, `WishlistableInterface` identifier) next to `session`, configured through `config/wishlist.php` (`driver`, `model`, `identifier`).
- **1.0.2** (2021-09-16): Breaking: the session wishlist is no longer bound by default; set `wishlist.driver` (`session` for the previous behaviour). `WishlistInterface::clear()` now declares a `void` return type, so custom implementations must add it.
- **1.0.3** (2021-09-16): Breaking: `WishlistItemInterface` requires `isWishlistable(): bool`; items returning `false` are not added. The wishlist migrator is only registered for the `database` driver.
- **1.0.4** (2022-10-12): Requires dry-internal-api ^1.0.2.
- There was no 2.x release; 3.0.0 follows 1.0.4.

See the git tags before 3.0.0 for the full history.
