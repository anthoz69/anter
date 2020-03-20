<?php

namespace Anthoz69\Anter;

use Image;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Config\Repository as Config;


class AnterImg
{
    private $path;
    private $file;
    private $disk;
    private $configs;

    public function __construct(Config $configs)
    {
        $this->disk    = $configs->get('disk');
        $this->configs = $configs;
    }

    public function make($path, $file)
    {
        $this->path = $this->uniqueFilename($file, $path);
        $this->file = Image::make($file->getRealPath());
        return $this;
    }

    public function crop($width, $height)
    {
        $this->file = $this->file->crop($width, $height);
        return $this;
    }

    public function fit($width, $upsize = true)
    {
        $this->file = $this->file->fit($width, null, function ($constraint) use ($upsize) {
            if ($upsize) {
                $constraint->upsize();
            }
        }, $this->configs->get('fit.position'));
        return $this;
    }

    public function resize($width, $upsize = true)
    {
        $this->file = $this->file->widen($width, function ($constraint) use ($upsize) {
            if ($upsize) {
                $constraint->upsize();
            }
        });
        return $this;
    }

    public function width()
    {
        return $this->file->width();
    }

    public function height()
    {
        return $this->file->height();
    }

    public function save()
    {
        $path = Storage::disk($this->disk)->put($this->path, (string)$this->file->encode());
        return $this->url($this->path);
    }

    public function url($path)
    {
        return Storage::disk($this->disk)->url($path);
    }

    public function uniqueFilename($file, $storeFolder)
    {
        do {
            $uniqueFilename = uniqid(Str::random(8)) . '.' . $file->getClientOriginalExtension();
            $fullPathStore  = $storeFolder . DIRECTORY_SEPARATOR . $uniqueFilename;
            $exists         = Storage::disk($this->disk)->exists($fullPathStore);
        } while ($exists);

        return $fullPathStore;
    }
}
