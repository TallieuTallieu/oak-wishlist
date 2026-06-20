<?php

namespace Tnt\Wishlist\Model;

use dry\orm\Model;

/**
 * @property int|null $id
 * @property int $created
 * @property int $updated
 * @property string $wishlist_class
 * @property int $wishlist_id
 * @property int|null $identifier
 */
class Wishlist extends Model
{
    const TABLE = 'wishlist';
    const CREATED_FIELD = 'created';
    const UPDATED_FIELD = 'updated';
}
