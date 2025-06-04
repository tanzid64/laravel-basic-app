<?php

namespace App\Http\Controllers;

use App\Models\Testimonial;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    public function all_testimonials()
    {
        // ** Get All Testimonials **
        $testimonials = Testimonial::all();
        return view('admin.testimonials.all', compact('testimonials'));
    }

    public function add_testimonial()
    {
        return view('admin.testimonials.create');
    }
    
    
}
