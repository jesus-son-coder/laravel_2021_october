<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Models\Order;
use App\Models\Product;

class OrderTest extends TestCase
{
    protected $product;

    protected function setUp():void
    {

    }

    /** @test */
    function an_order_consist_of_products()
    {
        $order = $this->createOrderWithProducts();

        $this->assertCount(2, $order->products(), "Le total ne correspond pas à ce qui est attendu !");
    }


    /** @test */
    function an_order_can_determine_the_total_cost_of_all_its_products()
    {
        $order = $this->createOrderWithProducts();

        // 59 + 7 = 66
        $this->assertEquals(66, $order->total());
    }


    protected function createOrderWithProducts()
    {
        $order = new Order();

        $product1 = new Product('Fallout 4', 59);
        $product2 = new Product('Pillowcase', 7);

        $order->add($product1);
        $order->add($product2);

        return $order;
    }



}
