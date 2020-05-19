<?php

namespace Anthoz69\Anter;

use Illuminate\Support\Facades\Storage;

class AnterStore
{
    private $disk = '';

    public function __construct(array $configs = [])
    {
        $this->disk = $configs['disk'];
    }

    public function delete($path)
    {
        return Storage::disk($this->disk)->delete($path);
    }

    public function store($path, $file)
    {
        return Storage::disk($this->disk)->putFile($path, $file);
    }

    public function url($path)
    {
        return Storage::disk($this->disk)->url($path);
    }
}
