<?php

namespace Tests\Unit;

use App\Testimonial;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TestimonialTest extends TestCase
{

    use RefreshDatabase;

    public function test_testimonials_with_approved_at_date_are_approved()
    {
        $approved_testimonial = factory(Testimonial::class)->states('approved')->create();
        $unapproved_testimonial = factory(Testimonial::class)->states('unapproved')->create();

        $approved_testimonials = Testimonial::approved()->get();

        $this->assertTrue($approved_testimonials->contains($approved_testimonial));
        $this->assertFalse($approved_testimonials->contains($unapproved_testimonial));
    }

    public function test_approve_testimonial()
    {
        $testimonial = factory(Testimonial::class)->states('unapproved')->create();

        $this->assertNull($testimonial->approved_at);

        $testimonial->approve();

        $this->assertNotNull($testimonial->approved_at);
    }

    public function test_unapprove_testimonial()
    {
        $testimonial = factory(Testimonial::class)->states('approved')->create();

        $this->assertNotNull($testimonial->approved_at);

        $testimonial->unapprove();

        $this->assertNull($testimonial->approved_at);
    }

}
