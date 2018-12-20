<?php

namespace App\Upload;

use App\Entity\User;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class FileUserTypeUpload
{
    private $targetDirectory;

    public function __construct($targetDirectory)
    {
        $this->targetDirectory = $targetDirectory;
    }

    public function upload(User $user)
    {

        if ($user->getPhotoFile() !== null) {
            $fileName = md5(uniqid()).'.'.$user->getPhotoFile()->guessExtension();
            try {
                $user->getPhotoFile()->move($this->getTargetDirectory().User::DIR_UPLOAD, $fileName);
                $user->setPhoto($fileName);
            } catch (FileException $e) {
                // ... handle exception if something happens during file upload
                throw new \Exception('Error when upload picture');
            }
        }
    }

    public function removeFile(User $user)
    {
        if ($user->getPhoto() !== null) {
            return \unlink($this->getTargetDirectory().User::DIR_UPLOAD.'/'.$user->getPhoto());
        }

        return true;
    }

    public function getTargetDirectory()
    {
        return $this->targetDirectory;
    }
}