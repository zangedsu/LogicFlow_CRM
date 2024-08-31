<?php

namespace App\Livewire\Components;

use App\Actions\Attachment\StoreAttachmentAction;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

class FileUpload extends Component
{
    use WithFileUploads;

    #[Validate(['files.*' => 'max:10240'])]
    public $files = [];

    public function storeFiles(StoreAttachmentAction $action)
    {
        foreach ($this->files as $file){
            $action->store($file, 'uploads', 'avatar', $file->getClientOriginalName());
            $this->reset();
        }
    }
    public function render()
    {
        return view('livewire.components.file-upload');
    }
}
