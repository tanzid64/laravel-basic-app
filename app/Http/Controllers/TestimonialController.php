<?php

namespace App\Http\Controllers;

use App\Models\Testimonial;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

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

    public function create_testimonial(Request $request)
    {
        // ** Upload Image **
        if ($request->file('image')) {
            $img = $request->file('image');
            $manager = new ImageManager(new Driver());
            $name_gen = hexdec(uniqid()).'.'.$img->getClientOriginalExtension();
            $image = $manager->read($img);
            $image->resize(60,60)->save(public_path('upload/testimonials/'.$name_gen));
            $save_url = 'upload/testimonials/'.$name_gen;
        }
        Testimonial::create([
            'name' => $request->name,
            'position' => $request->position,
            'message' => $request->message,
            'image' => $save_url,
        ]);
        $notification = array(
            'message' => 'Testimonial created successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('all.testimonials')->with($notification);
    }

    public function edit_testimonial($id)
    {
        $testimonial = Testimonial::find($id);
        return view('admin.testimonials.edit', compact('testimonial'));
    }

    public function update_testimonial(Request $request, $id)
    {
        $testimonial = Testimonial::find($id);
         // ** Upload Image **
        if ($request->file('image')) {
            $img = $request->file('image');
            $manager = new ImageManager(new Driver());
            $name_gen = hexdec(uniqid()).'.'.$img->getClientOriginalExtension();
            $image = $manager->read($img);
            $image->resize(60,60)->save(public_path('upload/testimonials/'.$name_gen));
            $save_url = 'upload/testimonials/'.$name_gen;
            $testimonial->update([
                'image' => $save_url,
            ]);
        }
        $testimonial->update([
            'name' => $request->name,
            'position' => $request->position,
            'message' => $request->message,
        ]);
        $notification = array(
            'message' => 'Testimonial updated successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('all.testimonials')->with($notification);
    }
}
