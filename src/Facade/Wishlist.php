<?php

namespace Tnt\Wishlist\Facade;

use Oak\Facade;
use Tnt\Wishlist\Contracts\WishlistInterface;

/**
 * @method static void add(\Tnt\Wishlist\Contracts\WishlistItemInterface $item)
 * @method static void remove(\Tnt\Wishlist\Contracts\WishlistItemInterface $item)
 * @method static bool has(\Tnt\Wishlist\Contracts\WishlistItemInterface $item)
 * @method static void clear()
 * @method static array<int, \Tnt\Wishlist\Contracts\WishlistItemInterface> getItems()
 *
 * @extends Facade<WishlistInterface>
 */
class Wishlist extends Facade
{
	protected static function getContract(): string
	{
		return WishlistInterface::class;
	}
}
