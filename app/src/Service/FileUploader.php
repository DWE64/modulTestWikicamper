<?php


namespace App\Service;


use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\String\Slugger\SluggerInterface;

class FileUploader
{
    private $uploadDirectory;
    private $slugger;

    public function __construct($uploadDirectory, SluggerInterface $slugger)
    {
        $this->uploadDirectory = $uploadDirectory;
        $this->slugger = $slugger;
    }

    public function upload(UploadedFile $file)
    {
        $originalFilename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $safeFilename = $this->slugger->slug($originalFilename);
        $fileName = $safeFilename.'-'.uniqid().'.'.$file->guessExtension();

        try {
            $file->move($this->getUploadDirectory(), $fileName);
        } catch (FileException $e) {
            return $e;
        }

        return $fileName;
    }


    public function getUploadDirectory()
    {
        return $this->uploadDirectory;
    }
}