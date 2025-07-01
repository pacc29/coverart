<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCoverArtRequest;
use App\Models\Audio;
use App\Models\Cover;
use App\Models\CoverType;
use App\Services\CoverArtService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Process;
use Storage;

class CoverArtController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->rspOk();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCoverArtRequest $request, CoverArtService $coverArtService)
    {
        $audioFile = $request->file('audio_file');
        $frontCoverFile = $request->file('front_cover');

        $audio = $coverArtService->embedCoverArt(
            $audioFile,
            $frontCoverFile
        );

        // TODO: Return the audio file


        return response()->rspOk();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
