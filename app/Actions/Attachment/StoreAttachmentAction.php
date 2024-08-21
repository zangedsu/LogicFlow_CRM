<?php

namespace App\Actions\Attachment;

use App\Models\Attachment;
use Illuminate\Support\Facades\Auth;

class StoreAttachmentAction
{

    public function store($file, $directory, $type, $file_name )
    {
        $attachment = new Attachment();
        $attachment->path = $file->store($directory, 'public');
        $attachment->type = $type;
        $attachment->name = $file_name;
        $attachment->size = $file->getSize();
        $attachment->team_id = Auth::user()->currentTeam->id;
        $attachment->user_id = Auth::user()->id;
        if ($attachment->save()){
            return $attachment->id;
        }
        return false;
    }

}
