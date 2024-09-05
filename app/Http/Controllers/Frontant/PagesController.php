<?php

namespace App\Http\Controllers\Frontant;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Mail\Order;
use App\Models\Blog;
use App\Models\Career;
use App\Models\Company;
use App\Models\OurClient;
use App\Models\Service;
use App\Models\Project;
use App\Models\Projectimage;
use App\Models\Slider;
use App\Models\VisaProcesing;
use App\Models\VisaSlider;
use App\Models\VisaVisited;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class PagesController extends Controller
{

    public function service_categories(Request $request,  $category)
    {
        return view('frontant_with_extra_path.pages.service_categories', ['data' => $category]);
    }

    public function pages(Request $request)
    {
        $ignore_image = [
            // 'social media marketing',
            'search engine optimization',
            'sms marketing'
        ];
        $data = Service::where('slug', $request->slug)->first();

        return view('frontant_with_extra_path.pages.services', [

            'data' => $data,
            'meta' => $data->meta ?? '',
            'ignore_image' => $ignore_image,
        ]);
    }


    public function orderNow(Request $request)
    {
        $details = [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'requirement' => $request->requirement,
            'packageName' => $request->packageName,
            'titleHere' => $request->titleHere,
        ];

        Mail::to('info@itwaybd.com')->send(new Order($details));
        return redirect()->back()->with('success', 'Your message has been sent successfully. we be will be contacted very soon.');
    }

    public function concernshow(Request $request, $slug)
    {
        // dd($slug);
        $client = OurClient::where('slug', $slug)->first();
        $title = $client->name ?? 'Blog Title';
        $meta = Company::orderBy('id', 'DESC')->pluck('blog_meta')->first();
        return view('frontant_with_extra_path.pages.concern-show', get_defined_vars());
    }

    public function project($id)
    {
        $images = Projectimage::where('status', 'Active')->where('project_id', $id)->get();
        $title = 'project view';
        return view('frontant_with_extra_path.pages.project_view', get_defined_vars());
    }

    public function softwares(Request $request)
    {
        // dd(Product::with(['modules', 'gallaries', 'packages'])->where('slug', $request->slug)->first());
        $data = Product::with(['modules', 'gallaries', 'packages.details'])->where('slug', $request->slug)->first();

        return view('frontant_with_extra_path.pages.softwares', [
            'data' => $data,
            'meta' => $data->meta ?? '',
        ]);
    }

    public function careers(Request $request)
    {
        $title = 'Careers';
        $careers = Career::latest('id')->paginate();
        $meta = Company::orderBy('id', 'DESC')->pluck('career_meta')->first();
        return view('frontant_with_extra_path.pages.career-list', get_defined_vars());
    }


    public function show(Request $request, $slug)
    {
        $career = Career::where('slug', $slug)->first();
        $title = $career->title ?? 'Career Title';
        $meta = $career->meta ?? '';
        return view('frontant_with_extra_path.pages.career-show', get_defined_vars());
    }

    public function blogs(Request $request)
    {
        $title = 'Blogs';
        $blogs = Blog::latest('id')->paginate();
        $meta = Company::orderBy('id', 'DESC')->pluck('blog_meta')->first();
        return view('frontant_with_extra_path.pages.blogs', get_defined_vars());
    }


    public function visaprocesshow(Request $request, $slug)
    {
        $visa = VisaProcesing::where('slug', $slug)->first();
        $relateds = collect();
        if ($visa) {
            $relateds = VisaProcesing::where('continent', $visa->continent)
                ->where('id', '!=', $visa->id)
                ->limit(3)
                ->get();
        }
        $topsliders = VisaSlider::where('visa_id', $visa->id)
            ->limit(5)
            ->get();

        $visteds = VisaVisited::where('visa_id', $visa->id)
            ->limit(5)
            ->get();
        $title = $visa->name ?? 'Visa Processing Title';
        $meta = $visa->meta ?? '';
        return view('frontant_with_extra_path.pages.visa-processing', get_defined_vars());
    }



    public function blogsshow(Request $request, $slug)
    {
        $blog = Blog::where('slug', $slug)->first();
        $title = $blog->title ?? 'Blog Title';
        $meta = $blog->meta ?? '';
        return view('frontant_with_extra_path.pages.blog-post', get_defined_vars());
    }

    public function blogTop10Company(Request $request)
    {

        $data = Product::with(['modules', 'gallaries', 'packages.details'])->where('id', 24)->first();

        return view('frontant_with_extra_path.pages.softwares', [
            'data' => $data,
            'meta' => $data->meta ?? '',
        ]);
    }
}
