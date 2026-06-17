<?php

namespace App\Http\Controllers;

use App\Mail\ContactUs;
use App\Models\Category;
use App\Models\Course;
use App\Models\Message;
use App\Models\Service;
use App\Models\Slider;
use App\Models\Subscription;
use App\Models\Team;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MainController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sliders = Slider::with('image')->latest()->take(5)->get();
        $categories = Category::with('image')->latest()->take(3)->get();
        $courses = Course::with(['image', 'category', 'teacher', 'reviews'])
            ->withAvg('reviews', 'rate')
            ->withCount('reviews')
            ->where('status', 'active')
            ->latest()
            ->take(3)
            ->get();
        $services = Service::latest()->take(4)->get();
        $testimonials = Testimonial::with('image')->latest()->take(12)->get();
        $teams = Team::with('image')->latest()->take(3)->get();

        $data = [
            'sliders' => $sliders,
            'courses' => $courses,
            'services' => $services,
            'categories' => $categories,
            'testimonials' => $testimonials,
            'teams' => $teams
        ];
        return view('front.index', $data);
    }
    public function slider_show(Slider $slider)
    {
        return view('front.showSlider', compact('slider'));
    }
    public function Course_show(Course $course)

    {
        $course->loadCount('reviews')
            ->loadAvg('reviews', 'rate');

        return view('front.showCourse', compact('course'));
    }
    public function about()
    {
        return view('front.about');
    }

    public function course()
    {
        $courses = Course::with('image', 'category', 'teacher')->latest()->take(3)->get();

        return view('front.course', compact('courses'));
    }

    public function team()
    {
        $teams = Team::with('image')->latest()->take(6)->get();

        return view('front.team', compact('teams'));
    }

    public function testimonial()
    {
        $testimonials = Testimonial::with('image')->latest()->take(3)->get();

        return view('front.testimonial', compact('testimonials'));
    }

    public function contact()
    {
        return view('front.contact');
    }


    public function contact_data(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',

        ]);

        $data = $request->all();
        Message::create($data);
        Mail::to('mohmmedbssam97@gmail.com')->send(new ContactUs($data));
        flash()->success('Mail sended successful');
        return redirect()->back();
    }

    public function subscription(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);
        Subscription::create([
            'email' => $request->email,
        ]);

        return redirect()->back();
    }


}