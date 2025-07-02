<?php

namespace App\Services;

use App\Models\Audio;
use App\Models\Cover;
use App\Models\CoverType;
use Illuminate\Http\UploadedFile;
use Process;
use Storage;
use Symfony\Component\HttpKernel\Exception\HttpException;

class CoverArtService
{
    public function embedCoverArt(
        UploadedFile $audioFile,
        UploadedFile $frontCoverFile,
        ?UploadedFile $backCoverFile = null
    ) {
        $audioFilename =
            Storage::disk('audios')
                ->putFile($audioFile);

        $frontCoverFilename =
            Storage::disk('covers')
                ->putFile($frontCoverFile);

        $audio = Audio::create([
            'original_name' => $audioFile->getClientOriginalName(),
            'hashed_name' => $audioFilename,
            'extension' => $audioFile->getClientOriginalExtension(),
            'mime_type' => $audioFile->getClientMimeType(),
        ]);

        Cover::create([
            'hashed_name' => $frontCoverFilename,
            'audio_id' => $audio->id,
            'cover_type_id' => CoverType::FRONT,
        ]);

        if ($backCoverFile) {
            $backCoverFilename =
                Storage::disk('covers')
                    ->putFile($backCoverFile);

            Cover::create([
                'hashed_name' => $backCoverFilename,
                'audio_id' => $audio->id,
                'cover_type_id' => CoverType::BACK,
            ]);
        }

        $result = Process::run([
            'ffmpeg',
            '-i',
            Storage::disk('audios')->path($audioFilename),
            '-i',
            Storage::disk('covers')->path($frontCoverFilename),
            '-c',
            'copy',
            '-map',
            '0:a',  // Only map audio stream
            '-map',
            '1:v',  // Only map video/image stream
            '-disposition:v',
            'attached_pic',
            '-metadata:s:v',
            'title=Cover (front)',
            '-metadata:s:v',
            'comment=Cover Image',
            Storage::disk('output')->path($audioFilename),
        ]);

        if ($result->successful()) {
            return $audio;
        }

        throw new HttpException(
            500,
            'Failed to embed cover art'
        );
    }
}