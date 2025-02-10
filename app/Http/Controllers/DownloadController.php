<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use YoutubeDl\Options;
use YoutubeDl\YoutubeDl;

class DownloadController extends Controller
{
    public function download(Request $request): \Symfony\Component\HttpFoundation\BinaryFileResponse
    {
        $downloadsPath = storage_path('app/public/downloads');
        $file = $downloadsPath.'/'.$request->get('file');

        return response()->download($file);
    }

    public function show(Request $request): View
    {
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
                touch($video->getFilename());
            }
        }


        return view('result', compact('files'));
    }
}
