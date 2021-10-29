<?php

namespace Tests\Unit;

use App\Models\Produit;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;

class ProduitTest extends TestCase
{
    public function testExemple()
    {
        $request = new Request();

        $client = $this->getMockClass('GuzzleHttp\Client');



    }


    /**
     * @test
     *
     * @dataProvider pricesForFoodProduct
     */
    public function computeTVAFoodProduct($price, $expectedTva)
    {
        $produit = new Produit('Un produit', Produit::FOOD_PRODUCT, $price);

        $this->assertSame($expectedTva, $produit->computeTVA());
    }

    public function pricesForFoodProduct()
    {
        return [
            [0, 0.0],
            [20, 1.1],
            [100, 5.5]
        ];
    }


    /** @test */
    public function computeTVAProductNotFood()
    {
        $produit = new Produit('Un autre produit', 'computer', 500);

        $this->assertSame(98.0, $produit->computeTVA());
    }


    public function testNegativePriceComputeTVA()
    {
        $produit = new Produit('Un produit', Produit::FOOD_PRODUCT, -20);
        $this->expectException('LogicException');
        $produit->computeTVA();
    }


}



