<?php

namespace App\Http\Livewire;

use App\Models\Product;
use App\Models\Section;
use Livewire\Component;



class Cashier extends Component
{
    public $sections = [];
    public $products = [];
    public $mounts = [];
    public $discounts = [];
    public $prices = [];
    public $totals = [];
    public function render()
    {
        return view('livewire.cashier');
    }
}
