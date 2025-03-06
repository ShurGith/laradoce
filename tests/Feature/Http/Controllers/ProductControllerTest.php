<?php

namespace Tests\Feature\Http\Controllers;

use App\Http\Controllers\ProductController;
use App\Http\Requests\ProductStoreRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\ProductController
 */
final class ProductControllerTest extends TestCase
{
    use AdditionalAssertions;
    use RefreshDatabase;
    use WithFaker;

    #[Test]
    public function index_displays_view(): void
    {
        $products = Product::factory()->count(3)->create();

        $response = $this->get(route('products.index'));

        $response->assertOk();
        $response->assertViewIs('product.index');
        $response->assertViewHas('products');
    }


    #[Test]
    public function create_displays_view(): void
    {
        $response = $this->get(route('products.create'));

        $response->assertOk();
        $response->assertViewIs('product.create');
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            ProductController::class,
            'store',
            ProductStoreRequest::class
        );
    }

    #[Test]
    public function store_saves_and_redirects(): void
    {
        $name = fake()->name();
        $active = fake()->boolean();
        $oferta = fake()->boolean();
        $user = User::factory()->create();

        $response = $this->post(route('products.store'), [
            'name' => $name,
            'active' => $active,
            'oferta' => $oferta,
            'user_id' => $user->id,
        ]);

        $products = Product::query()
            ->where('name', $name)
            ->where('active', $active)
            ->where('oferta', $oferta)
            ->where('user_id', $user->id)
            ->get();
        $this->assertCount(1, $products);
        $product = $products->first();

        $response->assertRedirect(route('products.index'));
        $response->assertSessionHas('product.id', $product->id);
    }


    #[Test]
    public function show_displays_view(): void
    {
        $product = Product::factory()->create();

        $response = $this->get(route('products.show', $product));

        $response->assertOk();
        $response->assertViewIs('product.show');
        $response->assertViewHas('product');
    }


    #[Test]
    public function edit_displays_view(): void
    {
        $product = Product::factory()->create();

        $response = $this->get(route('products.edit', $product));

        $response->assertOk();
        $response->assertViewIs('product.edit');
        $response->assertViewHas('product');
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            ProductController::class,
            'update',
            ProductUpdateRequest::class
        );
    }

    #[Test]
    public function update_redirects(): void
    {
        $product = Product::factory()->create();
        $name = fake()->name();
        $active = fake()->boolean();
        $oferta = fake()->boolean();
        $user = User::factory()->create();

        $response = $this->put(route('products.update', $product), [
            'name' => $name,
            'active' => $active,
            'oferta' => $oferta,
            'user_id' => $user->id,
        ]);

        $product->refresh();

        $response->assertRedirect(route('products.index'));
        $response->assertSessionHas('product.id', $product->id);

        $this->assertEquals($name, $product->name);
        $this->assertEquals($active, $product->active);
        $this->assertEquals($oferta, $product->oferta);
        $this->assertEquals($user->id, $product->user_id);
    }


    #[Test]
    public function destroy_deletes_and_redirects(): void
    {
        $product = Product::factory()->create();

        $response = $this->delete(route('products.destroy', $product));

        $response->assertRedirect(route('products.index'));

        $this->assertModelMissing($product);
    }
}
