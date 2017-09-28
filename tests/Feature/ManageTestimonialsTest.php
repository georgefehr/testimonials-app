<?php

namespace Tests\Feature;

use App\Testimonial;
use Carbon\Carbon;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ManageTestimonialsTest extends TestCase
{

    use RefreshDatabase;

    public function test_can_update_testimonial()
    {

        $testimonial = factory(Testimonial::class)->create();

        $response = $this->json('PUT', '/api/testimonials/' . $testimonial->id, [
            'name' => 'Updated Name',
            'comment' => 'Updated Content',
        ]);

        $response->assertStatus(200)
                 ->assertJson([
                     'name' => 'Updated Name',
                     'comment' => 'Updated Content',
                 ]);

        $this->assertDatabaseHas('testimonials', [
            'name' => 'Updated Name',
            'comment' => 'Updated Content',
        ]);

    }

    public function test_update_returns_not_found_if_testimonial_does_not_exist()
    {

        $response = $this->json('PUT', '/api/testimonials/1', [
            'name' => 'Updated Name',
            'comment' => 'Updated Content',
        ]);

        $response->assertStatus(404);
    }

    public function test_can_delete_testimonials()
    {
        $testimonials = factory(Testimonial::class, 2)->create();

        $response = $this->json('DELETE', '/api/testimonials/' . $testimonials[0]->id);

        $response->assertStatus(204);

        $this->assertDatabaseMissing('testimonials', [
            'id' => $testimonials[0]->id
        ]);
        $this->assertDatabaseHas('testimonials', [
            'id' => $testimonials[1]->id
        ]);
    }

    public function test_can_approve_testimonial()
    {
        $testimonial = factory(Testimonial::class)->states('unapproved')->create();

        $response = $this->json('POST', '/api/testimonials/' . $testimonial->id . '/approve');

        $response->assertStatus(204);

        $this->assertDatabaseHas('testimonials', [
            'id' => $testimonial->id,
            'approved_at' => Carbon::now(),
        ]);
    }

    public function test_can_unapprove_testimonial()
    {
        $testimonial = factory(Testimonial::class)->states('approved')->create();

        $response = $this->json('POST', '/api/testimonials/' . $testimonial->id . '/unapprove');

        $response->assertStatus(204);

        $this->assertDatabaseHas('testimonials', [
            'id' => $testimonial->id,
            'approved_at' => null,
        ]);
    }

}
