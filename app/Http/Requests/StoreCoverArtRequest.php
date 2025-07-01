<?php

namespace App\Http\Requests;


class StoreCoverArtRequest extends BaseFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'audio_file' => 'required|file|extensions:mp3,flac,aac,m4a|mimetypes:audio/mp3,audio/flac,audio/aac,audio/m4a,audio/mpeg|max:8192',
            'front_cover' => 'required|file|image|max:5120|dimensions:max_width=500,max_height=500|extensions:jpg,jpeg|mimetypes:image/jpeg',
            'back_cover' => 'sometimes|file|image|max:5120|dimensions:max_width=500,max_height=500|extensions:jpg,jpeg|mimetypes:image/jpeg',
        ];
    }
}
