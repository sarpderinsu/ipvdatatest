<?php

namespace App\Commands\AlbertHeijn\Product;

use App\Models\Product;

class CreateProductCommandHandler
{
    private Product $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    public function handle(CreateProductCommand $command): void
    {
        if ($this->product->newQuery()->where('id', $command->id)->exists()) {
            return;
        }

        $this->product->fill([
            'id' => $command->id,
            'title' => $command->title,
            'link' => $command->link,
            'image' => $command->image,
            'brand' => $command->brand,
            'category' => $command->category,
            'price' => $command->price,
            'discount' => $command->discount
        ]);

        $this->product->save();
    }
}
