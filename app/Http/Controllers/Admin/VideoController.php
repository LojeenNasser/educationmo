<?php

namespace App\Http\Controllers\Admin;

use App\Models\Video;
use App\Models\Series;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class VideoController extends Controller
{
    public function create($slug)
    {
        // get series by slug
        $series = Series::where('slug', $slug)->first();

        // return view with series and an empty web_link
        return view('admin.video.create', compact('series'))->with('web_link', '');
    }

    public function store(Request $request, $slug)
    {
        // get series by slug
        $series = Series::where('slug', $slug)->first();

        // تأكد من وجود ملف فيديو يتم رفعه
        if ($request->hasFile('video_file')) {
            // رفع ملف الفيديو إلى التخزين
            $videoFile = $request->file('video_file');
            $videoPath = $videoFile->store('videos', 'public');

            // تأكد من وجود ملف PDF يتم رفعه
            if ($request->hasFile('pdf_file')) {
                // رفع ملف الـ PDF إلى التخزين
                $pdfFile = $request->file('pdf_file');
                $pdfPath = $pdfFile->store('pdfs', 'public');
            }

            // إنشاء فيديو جديد مع البيانات المستلمة ورابط الفيديو ورابط الـ PDF إذا كان موجودًا
            $video = $series->videos()->create([
                'name' => $request->name,
                'episode' => $request->episode,
                'duration' => $request->duration,
                'intro' => $request->intro ? 1 : 0,
                'video_code' => $request->video_code,
                'video_url' => $videoPath,
                'pdf_file' => $request->hasFile('pdf_file') ? $pdfPath : null,
                'web_link' => $request->web_link, // Added web_link field
            ]);
        }

        // return redirect with toastr
        return redirect(route('admin.series.show', $series->slug))->with('toast_success', 'Video created successfully ');
    }

    public function edit($slug, $video_code)
    {
        // get series by slug
        $series = Series::where('slug', $slug)->first();

        // get video by video_code
        $video = Video::where('video_code', $video_code)->first();

        // return view with series and video
        return view('admin.video.edit', compact('series', 'video'));
    }

    public function update(Request $request, $slug, $video_code)
    {
        // get series by slug
        $series = Series::where('slug', $slug)->first();

        // get video by video_code
        $video = Video::where('video_code', $video_code)->first();

        // تأكد من وجود ملف فيديو جديد يتم رفعه
        if ($request->hasFile('video_file')) {
            // حذف ملف الفيديو القديم إذا كان موجودًا
            if ($video->video_url) {
                Storage::disk('public')->delete($video->video_url);
            }

            // رفع ملف الفيديو الجديد إلى التخزين
            $videoFile = $request->file('video_file');
            $videoPath = $videoFile->store('videos', 'public');

            // تأكد من وجود ملف PDF جديد يتم رفعه
            if ($request->hasFile('pdf_file')) {
                // حذف ملف الـ PDF القديم إذا كان موجودًا
                if ($video->pdf_file) {
                    Storage::disk('public')->delete($video->pdf_file);
                }

                // رفع ملف الـ PDF الجديد إلى التخزين
                $pdfFile = $request->file('pdf_file');
                $pdfPath = $pdfFile->store('pdfs', 'public');
            }

            // تحديث بيانات الفيديو بما في ذلك رابط الفيديو الجديد ورابط الـ PDF إذا كان موجودًا
            $video->update([
                'name' => $request->name,
                'episode' => $request->episode,
                'duration' => $request->duration,
                'intro' => $request->intro ? 1 : 0,
                'video_code' => $request->video_code,
                'video_url' => $videoPath,
                'pdf_file' => $request->hasFile('pdf_file') ? $pdfPath : null,
                'web_link' => $request->web_link, // Added web_link field
            ]);
        } else {
            // تحديث بيانات الفيديو بدون تغيير في رابط الفيديو
            $video->update([
                'name' => $request->name,
                'episode' => $request->episode,
                'duration' => $request->duration,
                'intro' => $request->intro ? 1 : 0,
                'video_code' => $request->video_code,
                'web_link' => $request->web_link, // Added web_link field
            ]);
        }

        // return view with series and video
        return redirect(route('admin.series.show', $series->slug))->with('toast_success', 'Video updated successfully ');
    }

    public function destroy(video $video)
    {
        // حذف ملف الفيديو وملف الـ PDF إذا كانا موجودين
        if ($video->video_url) {
            Storage::disk('public')->delete($video->video_url);
        }

        if ($video->pdf_file) {
            Storage::disk('public')->delete($video->pdf_file);
        }

        // حذف الفيديو
        $video->delete();

        // redirect back with toastr
        return back()->with('toast_success', 'Video deleted successfully');
    }
}
