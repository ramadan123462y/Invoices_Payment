<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Livewire\Component;

class Products extends Component
{
    public $section_id;
    public $products = [];

    public function render()
    {
        return view('livewire.products');
    }
    public function get_products()
    {

        $this->products = Product::where('section_id', $this->section_id)->pluck('Product_name');
    }
}
