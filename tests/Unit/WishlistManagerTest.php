<?php

use dry\orm\Manager;
use Tnt\Wishlist\Admin\WishlistManager;
use Tnt\Wishlist\Model\Wishlist;

it('creates a read-only wishlist manager for the wishlist model', function (): void {
    $manager = new WishlistManager();

    expect($manager)
        ->toBeInstanceOf(Manager::class)
        ->and($manager->model)->toBe(Wishlist::class)
        ->and($manager->actions)->toBe([])
        ->and($manager->index->components)->toHaveCount(3);
});
