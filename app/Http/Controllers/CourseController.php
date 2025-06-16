<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Module;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\CoursePostRequest;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::latest()->get();

        return view('pages.course.index', [
            'courses' => $courses
        ]);
    }

    public function create()
    {
        return view('pages.course.create');
    }

    public function store(CoursePostRequest $request)
    {
        try {
            DB::beginTransaction();

            $thumbnailPath = null;
            if ($request->hasFile('thumbnail')) {
                $thumbnailPath = $request->file('thumbnail')->store('thumbnails', 'public');
            }

            $course = Course::create([
                'title'        => $request->title,
                'description'  => $request->description,
                'category'     => $request->category,
                'video_url'    => $request->video_url,
                'level'        => $request->level,
                'slug'         => Str::slug($request->title) . '-' . uniqid(),
                'thumbnail'    => $thumbnailPath,
                'is_published' => false,
            ]);

            foreach ($request->modules as $moduleData) {
                $module = new Module([
                    'title' => $moduleData['title'],
                ]);
                $course->modules()->save($module);

                if (!empty($moduleData['contents'])) {
                    foreach ($moduleData['contents'] as $contentData) {
                        $module->contents()->create([
                            'type'  => $contentData['type'],
                            'value' => $contentData['value'],
                        ]);
                    }
                }
            }

            DB::commit();

            return response()->json(['message' => '✅ Course created successfully!'], 201);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Something went wrong.', 'error' => $e->getMessage()], 500);
        }
    }

    public function show(Course $course)
    {
        $course->load('modules.contents');

        return view('pages.course.show', compact('course'));
    }
}
