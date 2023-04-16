<?php

namespace App\Pipes;

use App\Commands\AlbertHeijn\Product\CreateProductCommand;
use App\Models\Product;
use Closure;

class ProductNotExistsPipe
{
    private Product $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    public function handle(CreateProductCommand $command, Closure $next)
    {
        if ($this->product->newQuery()->where('id', $command->id)->exists()) {
            return null;
        }

        return $next($command);
    }
}
