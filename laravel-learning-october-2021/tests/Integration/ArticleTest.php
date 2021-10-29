<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Article;

use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ArticleTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function it_fetches_trending_articles()
    {
        // Given
        Article::factory()->count(20)->create();

        Article::factory()->count(4)->create(['reads' => 10]);

        $mostPopular = Article::factory()->create(['reads' => 20]);


        // When

        $articles = Article::trending();


        // Then

        $this->assertEquals($mostPopular->id, $articles->first()->id);


        $this->assertCount(10, $articles);
    }
}


