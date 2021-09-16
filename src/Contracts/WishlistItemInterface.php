<?php

namespace Tnt\Wishlist\Contracts;

interface WishlistItemInterface
{
	public static function getByWishlistId(int $id): ?WishlistItemInterface;

	public function getWishlistId(): int;

	public function serialize(): array;

    public function isWishlistable(): bool;
}