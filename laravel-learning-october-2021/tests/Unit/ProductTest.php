<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Models\Product;

class ProductTest extends TestCase
{
    protected $product;

    protected function setUp():void
    {
        $this->product = new Product('Fallout 4', 59);
    }

    function testAProductHasName()
    {
        $this->assertEquals('Fallout 4', $this->product->name());
    }

    /** @test */
    function a_product_has_a_cost()
    {
        $product = new Product('Fallout 4', 59);

        $this->assertEquals(59, $this->product->cost());
    }

}
