<?php

namespace App\Upload;

use App\Entity\Histoire;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class FileHistoireTypeUpload
{
    private $targetDirectory;

    public function __construct($targetDirectory)
    {
        $this->targetDirectory = $targetDirectory;
    }

    public function upload(Histoire $histoire)
    {

        if ($histoire->getPhotoFile() !== null) {
            $fileName = md5(uniqid()).'.'.$histoire->getPhotoFile()->guessExtension();
            try {
                $histoire->getPhotoFile()->move($this->getTargetDirectory().Histoire::DIR_UPLOAD, $fileName);
                $histoire->setPhoto($fileName);
            } catch (FileException $e) {
                // ... handle exception if something happens during file upload
                throw new \Exception('Error when upload picture');
            }
        }
    }

    public function removeFile(Histoire $histoire)
    {
        if ($histoire->getPhoto() !== null) {
            return \unlink($this->getTargetDirectory().Histoire::DIR_UPLOAD.'/'.$histoire->getPhoto());
        }

        return true;
    }

    public function getTargetDirectory()
    {
        return $this->targetDirectory;
    }
}