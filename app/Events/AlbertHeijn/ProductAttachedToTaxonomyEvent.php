<?php

namespace App\Events\AlbertHeijn;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class ProductAttachedToTaxonomyEvent implements ShouldBroadcast
{
    use InteractsWithSockets;
    public int $taxonomyId;
    public int $productId;

    public function __construct(int $taxonomyId, int $productId)
    {
        $this->taxonomyId = $taxonomyId;
        $this->productId = $productId;
    }

    public function broadcastOn(): string
    {
        return 'taxonomies.' . $this->taxonomyId;
    }
}
