<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SubmitTestimonialTest extends TestCase
{

    use RefreshDatabase;

    public function test_user_can_submit_testimonial()
    {

        $response = $this->json('POST', '/api/testimonials', [
            'name' => 'Test Name',
            'email' => 'test@email.com',
            'website' => 'http://website.com',
            'location' => 'Location',
            'title' => 'Title',
            'comment' => 'Comment',
        ]);

        $response->assertStatus(201);

        $this->assertDatabaseHas('testimonials', [
            'name' => 'Test Name',
            'email' => 'test@email.com',
            'website' => 'http://website.com',
            'location' => 'Location',
            'title' => 'Title',
            'comment' => 'Comment',
        ]);

    }

    public function test_submit_testimonial_validation()
    {

        // send blank post request
        $response = $this->json('POST', '/api/testimonials', []);

        $response->assertStatus(422)
                 ->assertJsonStructure([
                     'errors' => [
                         'name',
                         'comment',
                     ],
                 ]);

    }

    public function test_submit_testimonial_with_only_required_fields()
    {

        $response = $this->json('POST', '/api/testimonials', [
            'name' => 'Test Name',
            'comment' => 'Comment',
        ]);

        $response->assertStatus(201);

        $this->assertDatabaseHas('testimonials', [
            'name' => 'Test Name',
            'comment' => 'Comment',
        ]);

    }

}
