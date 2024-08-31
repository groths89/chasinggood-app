<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class ValidVideoFile implements Rule
{
    public function passes($attribute, $value)
    {
        // Implement your custom logic to validate video files
        // For example, you could check the file extension, mime type, or use a library like ffmpeg
        return true; // Replace with your validation logic
    }

    public function message()
    {
        return 'The :attribute must be a valid video file.';
    }
}
