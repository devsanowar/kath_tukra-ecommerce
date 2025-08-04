<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\WebsiteSocialIcon;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use App\Http\Requests\UpdateSocialIconRequest;

class SocialIconController extends Controller
{
    public function socialIcon()
    {
        $social_icon_setting = WebsiteSocialIcon::first();
        return view('admin.layouts.pages.website.website_social', compact('social_icon_setting'));
    }

    public function socialIconUpdate(UpdateSocialIconRequest $request)
    {
        $data = $request->only(['facebook_url', 'messanger_url', 'linkedin_url', 'instagram_url', 'twitter_url', 'youtube_url', 'pinterest_url', 'googleplus_url', 'tiktok_url']);

        $socialIcon = WebsiteSocialIcon::first();

        if ($socialIcon) {
            $socialIcon->update($data);
        } else {
            WebsiteSocialIcon::create($data);
        }

        Toastr::success('Website social icons updated successfully.');
        return redirect()->back();
    }
}
