<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Course;
use App\Models\Category;
use App\Models\LmsRating;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $query = Course::with('user', 'category')->where('status', 'published');

        if ($request->has('category')) {
            $query->whereHas('category', function ($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }

        if ($request->has('search')) {
            $query->where(function($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('description', 'like', '%' . $request->search . '%');
            });
        }

        $courses = $query->get();
        $categories = Category::all();
        
        $lmsRatings = LmsRating::with('user')->latest()->take(5)->get();
        $avgLmsRating = LmsRating::avg('rating') ?: 0;
        $totalLmsRatings = LmsRating::count();

        return view('home', compact('courses', 'categories', 'lmsRatings', 'avgLmsRating', 'totalLmsRatings'));
    }
}
