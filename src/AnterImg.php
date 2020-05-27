<?php

namespace Anthoz69\Anter;

use Illuminate\Config\Repository as Config;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Image;

class AnterImg
{
    private $path;
    private $file;
    private $disk;
    private $configs;

    public function __construct(Config $configs)
    {
        $this->disk = $configs->get('disk');
        $this->configs = $configs;
    }

    public function make($path, $file)
    {
        $this->path = $this->uniqueFilename($file, $path);
        $this->file = Image::make($file->getRealPath());

        return $this;
    }

    public function makeBase64($path, $base64)
    {
        $this->path = $this->uniqueFilename($base64, $path);
        $this->file = Image::make($base64);

        return $this;
    }

    public function crop($width, $height)
    {
        $this->file = $this->file->crop($width, $height);

        return $this;
    }

    public function fit($width, $height = null, $upsize = true)
    {
        $this->file = $this->file->fit($width, $height, function ($constraint) use ($upsize) {
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

    public function mimeType()
    {
        switch ($file->mime()) {
            case 'image/png':
                return 'png';
                break;
            case 'image/jpeg':
                return 'jpg';
                break;
            case 'image/gif':
                return 'gif';
                break;
            case 'image/bmp':
                return 'bmp';
                break;
            case 'image/svg+xml':
                return 'svg';
                break;
            default:
                return 'jpg';
                break;
        }
    }

    public function save()
    {
        $path = Storage::disk($this->disk)->put($this->path, (string) $this->file->encode());

        return $this->url($this->path);
    }

    private function url($path)
    {
        return Storage::disk($this->disk)->url($path);
    }

    private function uniqueFilename($file, $storeFolder)
    {
        do {
            $uniqueFilename = uniqid(Str::random(8)).'.'.$this->mimeType();
            $fullPathStore = $storeFolder.DIRECTORY_SEPARATOR.$uniqueFilename;
            $exists = Storage::disk($this->disk)->exists($fullPathStore);
        } while ($exists);

        return $fullPathStore;
    }
}
