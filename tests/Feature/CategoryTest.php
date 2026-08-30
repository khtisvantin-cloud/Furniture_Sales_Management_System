<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    use RefreshDatabase;

    public function test_authenticated_user_can_view_categories(): void
    {
        $user = User::factory()->create();
        Category::factory()->count(2)->create();

        $this->actingAs($user)
            ->get(route('categories.index'))
            ->assertOk()
            ->assertSee('Category Management');
    }

    public function test_authenticated_user_can_create_a_category(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->post(route('categories.store'), ['name' => 'Office Furniture', 'description' => 'Furniture for offices.'])
            ->assertRedirect(route('categories.index'));

        $this->assertDatabaseHas('categories', ['name' => 'Office Furniture']);
    }

    public function test_category_name_must_be_unique(): void
    {
        $user = User::factory()->create();
        Category::factory()->create(['name' => 'Bedroom']);

        $this->actingAs($user)
            ->post(route('categories.store'), ['name' => 'Bedroom'])
            ->assertSessionHasErrors('name');
    }

    public function test_authenticated_user_can_update_a_category(): void
    {
        $user = User::factory()->create();
        $category = Category::factory()->create();

        $this->actingAs($user)
            ->put(route('categories.update', $category), ['name' => 'Updated Category', 'description' => 'Updated description.'])
            ->assertRedirect(route('categories.index'));

        $this->assertDatabaseHas('categories', ['id' => $category->id, 'name' => 'Updated Category']);
    }

    public function test_authenticated_user_can_delete_an_unused_category(): void
    {
        $user = User::factory()->create();
        $category = Category::factory()->create();

        $this->actingAs($user)
            ->delete(route('categories.destroy', $category))
            ->assertRedirect(route('categories.index'));

        $this->assertDatabaseMissing('categories', ['id' => $category->id]);
    }
}
