<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use App\Models\ContactMessage;
use App\Models\Education;
use App\Models\Experience;
use App\Models\Project;
use App\Models\Setting;
use App\Models\Skill;
use App\Models\Testimonial;
use App\Mail\ContactSubmissionMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    /**
     * Display the portfolio home page with all sections.
     */
    public function index()
    {
        $settings = Setting::getSettings();
        
        $skills = Skill::all()->groupBy('category');
        
        $experiences = Experience::all()->sortBy(function ($exp) {
            // Sort so "Present" or latest experiences come first
            return $exp->end_date === 'Present' ? 0 : 1;
        });

        $education = Education::orderBy('start_year', 'desc')->get();
        
        $projects = Project::orderBy('order', 'asc')->get();
        
        $testimonials = Testimonial::all();
        
        $blogs = BlogPost::where('is_published', true)
            ->orderBy('published_at', 'desc')
            ->take(3)
            ->get();

        // Get unique tech stacks for filtering
        $allTechTags = [];
        foreach ($projects as $project) {
            if (is_array($project->tech_stack)) {
                foreach ($project->tech_stack as $tag) {
                    $allTechTags[] = trim($tag);
                }
            }
        }
        $techTags = array_unique($allTechTags);

        return view('home', compact(
            'settings',
            'skills',
            'experiences',
            'education',
            'projects',
            'testimonials',
            'blogs',
            'techTags'
        ));
    }

    /**
     * Handle the AJAX contact form submission.
     */
    public function contact(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|min:10',
        ]);

        $message = ContactMessage::create($validated);

        // Try to send email notification to owner
        try {
            $settings = Setting::getSettings();
            $ownerEmail = $settings->email ?? 'jammudassiryaseen2004@gmail.com';
            
            Mail::to($ownerEmail)->send(new ContactSubmissionMail($message));
        } catch (\Exception $e) {
            // Log error, but don't fail the request. The message is already stored in the DB.
            \Log::error("Failed sending email notification: " . $e->getMessage());
        }

        return response()->json([
            'success' => true,
            'message' => 'Thank you! Your message has been sent successfully.',
        ]);
    }

    /**
     * Display the blog posts list.
     */
    public function blogIndex()
    {
        $settings = Setting::getSettings();
        $posts = BlogPost::where('is_published', true)
            ->orderBy('published_at', 'desc')
            ->paginate(6);

        return view('blog.index', compact('settings', 'posts'));
    }

    /**
     * Display a single blog post.
     */
    public function blogShow($slug)
    {
        $settings = Setting::getSettings();
        $post = BlogPost::where('slug', $slug)
            ->where('is_published', true)
            ->firstOrFail();

        return view('blog.show', compact('settings', 'post'));
    }

    /**
     * Serve the downloaded CV PDF file.
     */
    public function downloadCv()
    {
        $settings = Setting::getSettings();

        if ($settings->cv_path && Storage::disk('public')->exists($settings->cv_path)) {
            return Storage::disk('public')->download($settings->cv_path, 'CV_' . str_replace(' ', '_', $settings->name) . '.pdf');
        }

        return abort(404, 'CV file not found.');
    }

    /**
     * Generate dynamic sitemap.xml.
     */
    public function sitemap()
    {
        $projects = Project::all();
        $posts = BlogPost::where('is_published', true)->get();

        $content = view('sitemap', compact('projects', 'posts'))->render();

        return response($content, 200)
            ->header('Content-Type', 'text/xml');
    }
}
