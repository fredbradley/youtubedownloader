<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use YoutubeDl\Options;
use YoutubeDl\YoutubeDl;

class DownloadController extends Controller
{
    public function download(Request $request): BinaryFileResponse
    {
        $downloadsPath = storage_path('app/public/downloads');
        $file = $downloadsPath.'/'.$request->get('file');

        activity()
            ->causedBy(auth()->user())
            ->withProperties(['file' => $request->get('file')])
            ->log('Downloaded to device');

        return response()->download($file);
    }

    public function show(Request $request): View
    {
        activity()
            ->causedBy(auth()->user())
            ->withProperties(['url' => $request->get('url')])
            ->log('User requested download');
        $downloadsPath = storage_path('app/public/downloads');
        $ffmpegLocation = config('app.ffmpeg_location');
        // $command = config('app.ytdlp_bin_path').' '.$request->get('url').' --compat-options no-certifi --ffmpeg-location '.$ffmpegLocation.'  --cookies-from-browser chrome --merge-output-format mp4 --format="bestvideo+bestaudio[ext=m4a]/best" --output "'.$downloadsPath.'/%(title)s.%(ext)s"';
        //        $result = Process::run($command);
        //     $output = $result->output();

        // dd($output);
        $yt = new YoutubeDl;
        $yt->setBinPath(config('app.ytdlp_bin_path'));

        $options = Options::create()
            ->downloadPath($downloadsPath)
            ->ffmpegLocation(config('app.ffmpeg_location'))
            ->mergeOutputFormat('mp4')
            ->format('bestvideo+bestaudio[ext=m4a]/best')
            ->url($request->get('url'));

        $collection = $yt->download($options);

        $files = collect();

        foreach ($collection->getVideos() as $video) {
            if ($video->getError() !== null) {
                echo "Error downloading video: {$video->getError()}.";
            } else {
                $files->push($video->getFilename());
                activity()
                    ->causedBy(auth()->user())
                    ->withProperties(['video' => $video->getFilename(), 'url' => $request->get('url')])
                    ->log('Video saved');
                touch($video->getFilename());
            }
        }

        return view('result', compact('files'));
    }
}
