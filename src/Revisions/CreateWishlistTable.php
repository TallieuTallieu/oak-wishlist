<?php

namespace Tnt\Wishlist\Revisions;

use Oak\Contracts\Migration\RevisionInterface;
use Tnt\Dbi\TableBuilder;

class CreateWishlistTable extends DatabaseRevision implements RevisionInterface
{
    public function up(): void
    {
        $this->queryBuilder->table('wishlist')->create(function (TableBuilder $table): void {
            $table->id();
            $table->addColumn('created', 'int')->length(11);
            $table->addColumn('updated', 'int')->length(11);

            $table->addColumn('wishlist_class', 'varchar')->length(255);
            $table->addColumn('wishlist_id', 'int')->length(11);

            $table->addColumn('identifier', 'int')->length(11)->null();

            $table->addIndex('identifier');
            $table->addIndex(['identifier', 'wishlist_class', 'wishlist_id']);
        });

        $this->execute();
    }

    public function down(): void
    {
        $this->queryBuilder->table('wishlist')->drop();

        $this->execute();
    }

    public function describeUp(): string
    {
        return 'Table wishlist created';
    }

    public function describeDown(): string
    {
        return 'Table wishlist dropped';
    }
}
