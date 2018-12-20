<?php

namespace App\Upload;

use App\Entity\Chapitre;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class FileChapitreTypeUpload
{
    private $targetDirectory;

    public function __construct($targetDirectory)
    {
        $this->targetDirectory = $targetDirectory;
    }

    public function upload(Chapitre $chapitre)
    {

        if ($chapitre->getPhotoFile() !== null) {
            $fileName = md5(uniqid()).'.'.$chapitre->getPhotoFile()->guessExtension();
            try {
                $chapitre->getPhotoFile()->move($this->getTargetDirectory().Chapitre::DIR_UPLOAD, $fileName);
                $chapitre->setPhoto($fileName);
            } catch (FileException $e) {
                // ... handle exception if something happens during file upload
                throw new \Exception('Error when upload picture');
            }
        }
    }

    public function removeFile(Chapitre $chapitre)
    {
        if ($chapitre->getPhoto() !== null) {
            return \unlink($this->getTargetDirectory().Chapitre::DIR_UPLOAD.'/'.$chapitre->getPhoto());
        }

        return true;
    }

    public function getTargetDirectory()
    {
        return $this->targetDirectory;
    }
}