<?php

namespace App\Http\Controllers;

use App\Testimonial;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TestimonialsController extends Controller
{

    public function index()
    {
        $testimonials = Testimonial::all();

        return response()->json($testimonials);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'comment' => 'required',
        ]);

        $testimonial = Testimonial::create($request->all());

        return response()->json(['testimonial' => $testimonial], 201);
    }

    public function show($id)
    {
        $testimonial = Testimonial::findOrFail($id);

        return response()->json($testimonial);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'comment' => 'required',
        ]);

        $testimonial = Testimonial::findOrFail($id);

        $testimonial->update($request->all());

        return response()->json($testimonial);
    }

    public function destroy($id)
    {
        Testimonial::destroy($id);

        return response('', 204);
    }

    public function approve($id)
    {
        $testimonial = Testimonial::findOrFail($id);
        $testimonial->approve();

        return response('', 204);
    }


    public function unapprove($id)
    {
        $testimonial = Testimonial::findOrFail($id);
        $testimonial->unapprove();

        return response('', 204);
    }

}
