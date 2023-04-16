<?php

namespace App\Commands\AlbertHeijn\Product;

use Illuminate\Contracts\Queue\ShouldQueue;

class CreateProductCommand implements ShouldQueue
{
    public int $id;
    public string $title;
    public string $link;
    public string $image;
    public string $brand;
    public string $category;
    public array $price;
    public ?array $discount;

    public function __construct(int $id, string $title, string $link, string $image, string $brand, string $category, array $price, ?array $discount)
    {
        $this->id = $id;
        $this->title = $title;
        $this->link = $link;
        $this->image = $image;
        $this->brand = $brand;
        $this->category = $category;
        $this->price = $price;
        $this->discount = $discount;
    }
}
