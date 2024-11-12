<?php

namespace App\Actions\Attachment;

use App\Models\Attachment;
use Illuminate\Support\Facades\Auth;

class StoreAttachmentAction
{
    public function store($file, $directory, $type, $file_name)
    {
        if (! $type) {
            $image_types = ['jpg', 'jpeg', 'gif', 'png', 'bmp'];
            $document_types = ['txt', 'pdf', 'doc', 'docx', 'csv', 'xls', 'xlsx', 'pages'];

            $extension = $file->guessExtension(); // Определяем расширение файла
            if (in_array($extension, $image_types)) {
                $type = 'image';
            } elseif (in_array($extension, $document_types)) {
                $type = 'document';
            } else {
                $type = 'other';
            }

        }

        $attachment = new Attachment;
        $attachment->path = $file->store($directory, 'public');
        $attachment->type = $type;
        $attachment->name = $file_name;
        $attachment->size = $file->getSize();
        $attachment->team_id = Auth::user()->currentTeam->id;
        $attachment->user_id = Auth::user()->id;
        if ($attachment->save()) {
            return $attachment->id;
        }

        return false;
    }
}
