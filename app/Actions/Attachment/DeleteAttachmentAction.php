<?php

namespace App\Actions\Attachment;

use App\Models\Attachment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DeleteAttachmentAction
{

    public function delete($id)
    {
        $attachment = Attachment::find($id);
        if ($attachment) {
            Storage::disk('public')->delete($attachment->path);
        }
        $attachment->delete();
    }

}
