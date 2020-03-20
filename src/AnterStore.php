<?php

namespace Anthoz69\Anter;

use Illuminate\Support\Facades\Storage;

class AnterStore
{
    private $path;
    private $file;
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
        $this->path = $path;
        $this->file = $file;
        return $this;
    }

    public function save()
    {
        $path = Storage::disk($this->disk)->putFile($this->path, $this->file);
        return $this->url($path);
    }

    public function url($path)
    {
        return Storage::disk($this->disk)->url($path);
    }
}
