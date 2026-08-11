<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PublicHomePageTest extends TestCase
{
    use RefreshDatabase;

    public function test_home_page_displays_population_statistics_breakdown(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('Statistik Penduduk');
        $response->assertSee('Pekerjaan');
        $response->assertSee('Agama');
    }
}
