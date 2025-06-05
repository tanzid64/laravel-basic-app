<?php

namespace App\Http\Controllers;

use App\Models\Hero;
use Illuminate\Http\Request;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

class HeroController extends Controller
{
    public function get_hero()
    {
        $hero = Hero::find(1);
        return view('admin.hero.get-hero', compact('hero'));
    }

    public function update_hero(Request $request)
    {
        $hero = Hero::find(1);
        // ** Upload Image **
        if ($request->file('image')) {
            $img = $request->file('image');
            $manager = new ImageManager(new Driver());
            $name_gen = hexdec(uniqid()).'.'.$img->getClientOriginalExtension();
            $image = $manager->read($img);
            $image->resize(306, 618)->save(public_path('upload/hero/'.$name_gen));
            $save_url = 'upload/hero/'.$name_gen;
            $hero->update([
                'image' => $save_url,
            ]);
        }
        $hero->update([
            'title' => $request->title,
            'description' => $request->description,
            'button_text' => $request->button_text,
            'link' => $request->link,
        ]);
        $notification = array(
            'message' => 'Hero updated successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
}
