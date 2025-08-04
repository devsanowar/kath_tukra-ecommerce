<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function projectPage(){
        $projects = Project::with(['category:id,category_name'])->where('is_active', 1)->latest()->get(['id', 'category_id', 'project_title', 'project_slug', 'image' ]);
        return view('frontend.project', compact('projects'));
    }

    public function projectSinglePage($project_slug){
        $singleProject = Project::with(['category:id,category_name'])->where('project_slug', $project_slug)->firstOrFail();

        $latestProjects = Project::where('is_active', 1)->latest()->get(['id', 'project_title', 'project_slug', 'image']);

        return view('frontend.layouts.pages.project.project_single_page', compact('singleProject','latestProjects'));
    }
}
