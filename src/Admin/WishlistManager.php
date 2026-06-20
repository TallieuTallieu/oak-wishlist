<?php

namespace Tnt\Wishlist\Admin;

use dry\admin\component\IntegerView;
use dry\admin\Module;
use dry\admin\component\StringView;
use dry\orm\Index;
use dry\orm\Manager;
use Tnt\Wishlist\Model\Wishlist;

class WishlistManager extends Manager
{
    public function __construct(string $model = Wishlist::class)
    {
        parent::__construct($model, [
            'icon' => Module::ICON_GENRE,
            'singular' => 'Wishlist',
            'plural' => 'Wishlist',
        ]);

        $this->index = new Index([
            new IntegerView('identifier'),
            new StringView('wishlist_class'),
            new IntegerView('wishlist_id'),
        ]);
    }
}
