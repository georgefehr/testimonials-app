<?php

namespace Tests\Feature;

use App\Testimonial;
use Carbon\Carbon;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ViewTestimonialTest extends TestCase
{

    use RefreshDatabase;

    public function test_can_view_testimonial()
    {

        $testimonial = Testimonial::create([
            'name' => 'Test Name',
            'email' => 'test@email.com',
            'website' => 'http://website.com',
            'location' => 'Location',
            'title' => 'Title',
            'comment' => 'Comment',
            'approved_at' => Carbon::parse('1 week ago'),
        ]);

        $response = $this->json('GET', '/api/testimonials/' . $testimonial->id);

        $response->assertStatus(200)
                 ->assertJson([
                     'name' => 'Test Name',
                     'email' => 'test@email.com',
                     'website' => 'http://website.com',
                     'location' => 'Location',
                     'title' => 'Title',
                     'comment' => 'Comment',
                     'approved_at' => Carbon::parse('1 week ago'),
                 ]);

    }

    public function test_can_view_testimonials_list()
    {
        $testimonials = factory(Testimonial::class, 3)->create();
        $json_array = [];

        foreach ($testimonials as $testimonial) {
            $json_array[] = [
                'id' => $testimonial->id,
                'name' => $testimonial->name,
                'email' => $testimonial->email,
                'website' => $testimonial->website,
                'location' => $testimonial->location,
                'title' => $testimonial->title,
                'comment' => $testimonial->comment,
            ];
        }

        $response = $this->json('GET', '/api/testimonials/');

        $response->assertStatus(200);

        $response->assertJson($json_array);
    }

    public function test_returns_not_found_if_testimonial_does_not_exist()
    {
        $response = $this->json('GET', '/api/testimonials/1');

        $response->assertStatus(404);
    }

}
