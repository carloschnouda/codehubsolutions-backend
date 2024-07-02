<?php

namespace App\Http\Controllers;

use App\ContactRequest;
use App\FixedSetting;
use App\FooterDetail;
use App\FooterSetting;
use App\FormSetting;
use App\MenuItem;
use App\OurService;
use App\SeoPage;
use App\SocialMediaLink;
use App\Statistic;
use App\Testimonial;
use App\TheHubSection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class GeneralController extends Controller
{
    function generalSettings()
    {
        $logo = FixedSetting::first()->full_path['logo'];
        $menu_items = MenuItem::orderBy('ht_pos')->get();
        $footer_settings = FooterSetting::first();
        $footer_details = FooterDetail::get();
        $social_media_links = SocialMediaLink::orderBy('ht_pos')->get();
        $seo_settings = SeoPage::where('slug', 'home')->firstOrFail();
        return compact('menu_items', 'footer_settings', 'footer_details', 'social_media_links', 'logo', 'seo_settings');
    }

    function index()
    {
        $settings = FixedSetting::first();
        $services = OurService::orderBy('ht_pos')->get();
        $the_hub_sections = TheHubSection::orderBy('ht_pos')->get();
        $testimonials = Testimonial::orderBy('ht_pos')->get();
        $statistics = Statistic::orderBy('ht_pos')->get();
        $form_settings = FormSetting::firstOrFail();


        return compact('settings', 'services', 'the_hub_sections', 'testimonials', 'statistics', 'form_settings');
    }

    function submit(Request $request)
    {
        $admin_email = FormSetting::first()->admin_email;

        $request->validate(
            [
                'name' => 'required',
                'email' => 'required|email',
                'phone_number' => 'required|numeric',
                'subject' => 'required',
                'service_id' => 'required',
                'file' => 'required|mimes:doc,docx,pdf,pptx,ppt',
                'message' => 'required'
            ],
            [
                'service_id.required' => 'The Service is required',
            ]
        );

        $new_request = new ContactRequest();
        $new_request->name = $request->name;
        $new_request->email = $request->email;
        $new_request->phone_number = $request->phone_number;
        $new_request->subject = $request->subject;
        $new_request->service_id = $request->service_id;
        $new_request->message = $request->message;
        if ($request->file) {
            $new_request->file = $request->file->store('files');
        } else {
            $new_request->file = null;
        }
        $new_request->save();

        Mail::send('emails.contact', compact('new_request'), function ($message) use ($new_request, $admin_email) {
            $message->to($admin_email)->attach(Storage::path($new_request->file))->subject('Contact Request');
        });
    }
}
