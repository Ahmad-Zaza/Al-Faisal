<?php

namespace App\Http\Controllers;

use App\Http\Models\AboutInformations;
use App\Http\Models\Category;
use App\Http\Models\ContactInfo;
use App\Http\Models\MainInformations;
use App\Http\Models\Section;
use App\Http\Models\SectionArera;
use App\Http\Models\Slider;
use App\Http\Models\SocialMedia;
use App\Rules\ValidRecaptcha;
use crocodicstudio_voila\crudbooster\helpers\CRUDBooster;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;


// use Validator;

class HomeController extends Controller
{
    public function index()
    {
        //---------------------//
        $lang = App::getLocale();
        $section_sliders = array();
        $section_textBoxes = array();
        $sections_count = Section::count();
        $catering_categories = Category::orderBy('sorting')->get();
        $mainInformations = MainInformations::first();
        $social_media = SocialMedia::first();
        // sections data (slider + text_boxes)
        for ($i = 1; $i <= $sections_count; $i++) {
            if ($i == 5) { // owl-section_id
                $section_textBoxes[$i] = SectionArera::where('section_id', '=', $i)
                    ->orderBy('sorting')
                    ->get();
            } else {
                $section_textBoxes[$i] = SectionArera::where('section_id', '=', $i)
                    ->first();
            }

            $section_sliders[$i] = Slider::where('section_id', '=', $i)
                ->orderBy('sorting')
                ->get();
        }

        $first_service_sliders  = Slider::where('section_id', '=', 4)
            ->where('slider_number', '=', 1)
            ->orderBy('sorting')
            ->get();
        $second_service_sliders  = Slider::where('section_id', '=', 4)
            ->where('slider_number', '=', 2)
            ->orderBy('sorting')
            ->get();

        //---------------------//
        return view('home', compact(['lang', 'section_sliders', 'first_service_sliders', 'second_service_sliders', 'section_textBoxes', 'mainInformations', 'social_media', 'catering_categories']));
        //---------------------//
    }

    public function contactUs()
    {
        $lang = App::getLocale();
        $catering_categories = Category::orderBy('sorting')->get();
        $contactUs_section_info = SectionArera::where('section_id', '=', 6)->first();
        $mainInformations = MainInformations::first();
        $social_media = SocialMedia::first();
        $Highlight = SectionArera::where('section_id', '=', 11)->first();

        return view('contact-us', compact(['lang', 'mainInformations', 'contactUs_section_info', 'social_media', 'Highlight', 'catering_categories']));
    }

    public function sendContactUs(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|string|email',
            'phone_number' => 'required|string',
            'address' => 'required|string',
            'message' => 'required|string',
            'g-recaptcha-response' => ['required', new ValidRecaptcha]
        ]);

        if ($validator->fails()) {
            if ($validator->fails()) {
                return Redirect::back()->withErrors($validator);
            }
        }

        $contact = ContactInfo::create($request->all());
        $data = [];
        try {
            CRUDBooster::sendEmail(['to' => $request->email, 'data' => $data, 'template' => 'confirmation_tmp', 'attachments' => []]);
        } catch (\Exception $e) {
            Log::log("error", "Send mail $e");
            return redirect()->back()->with('error', 'Error !! Please Check Your Email Address');
        }
        try {
            $data = ["name" => $contact->name, "email" => $contact->email, "phone_number" => $contact->phone_number, "message" => $contact->message, "date" => $contact->created_at];
            CRUDBooster::sendEmail([
                'to' => 'ahmad@voila.digital',
                'data' => $data, 'template' => 'contact_template', 'attachments' => []
            ]);
        } catch (\Exception $e) {
            Log::log("error", "Send mail $e");
            return redirect()->back()->with('error', 'Error !! Please Check Your Email Address');
        }
        return redirect()->back()->with('message', 'Done');
    }

    public function aboutUs()
    {
        $lang = App::getLocale();
        $catering_categories = Category::orderBy('sorting')->get();
        $mainInformations = MainInformations::first();
        $aboutUsNumericInfo = AboutInformations::all();
        $Highlight = SectionArera::where('section_id', '=', 12)->first();
        $aboutUsInfo = SectionArera::where('section_id', '=', 9)->first();
        return view('about-us', compact(['lang', 'mainInformations', 'aboutUsInfo', 'Highlight', 'aboutUsNumericInfo', 'catering_categories']));
    }

    public function menu()
    {
        $headers = array(
            'Content-Type' => 'application/pdf',
        );
        $pathToFile = $_SERVER["DOCUMENT_ROOT"] . "/images/AlFaisal-catalog.pdf";
        return response()->file($pathToFile, $headers);
    }
}
