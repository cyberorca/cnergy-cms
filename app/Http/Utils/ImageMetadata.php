<?php

namespace App\Http\Utils;

use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use lsolesen\pel\PelDataWindow;
use lsolesen\pel\PelEntryAscii;
use lsolesen\pel\PelExif;
use lsolesen\pel\PelIfd;
use lsolesen\pel\PelJpeg;
use lsolesen\pel\PelTag;
use lsolesen\pel\PelTiff;

trait ImageMetadata
{
    public function isFormat($slug)
    {
        $path = Storage::get($slug);
        $data = new PelDataWindow($path);
        if (PelJpeg::isValid($data) || PelTiff::isValid($data))
            return true;
        else
            return 'Cannot edit metadata because invalid image format only supported jpeg,tiff,jfif';

    }

    private function checkFormat($slug)
    {
        $path = Storage::get($slug);
        $data = new PelDataWindow($path);
        // If it is a JPEG-image, check if EXIF-headers exists
        if (PelJpeg::isValid($data)) {
            $jpeg = $file = new PelJpeg();
            $jpeg->load($data);
            $exif = $jpeg->getExif();

            // If no EXIF in image, create it
            if ($exif == null) {
                $exif = new PelExif();
                $jpeg->setExif($exif);
                $tiff = new PelTiff();
                $exif->setTiff($tiff);
            } else {
                $tiff = $exif->getTiff();
            }
            return ['tiff' => $tiff, 'file' => $file];
        } // If it is a TIFF EXIF-headers will always be set
        elseif (PelTiff::isValid($data)) {
            $tiff = $file = new PelTiff();
            $tiff->load($data);
            return ['tiff' => $tiff, 'file' => $file];
        } else {
            throw new \Exception('Invalid image format only supported jpeg or tiff');
        }
    }

    public function setMetaData($slug,
                                $copyright,
                                $description,
                                $photographer,
                                $title,
                                $keywords,
    )
    {
        $checkFormat = $this->checkFormat($slug);
        $tiff = $checkFormat['tiff'];
        $file = $checkFormat['file'];

        // Get the first Ifd, where most common EXIF-tags reside
        $ifd0 = $tiff->getIfd();

        // If no Ifd info found, create it
        if ($ifd0 == null) {
            $ifd0 = new PelIfd(PelIfd::IFD0);
            $tiff->setIfd($ifd0);
        }

        // See if the COPYRIGHT-tag already exists in Ifd
        $copyrightImg = $ifd0->getEntry(PelTag::COPYRIGHT);

        // Create COPYRIGHT-tag if not found, otherwise just change the value
        if ($copyrightImg == null) {
            $copyrightImg = new PelEntryAscii(PelTag::COPYRIGHT, $copyright);
            $ifd0->addEntry($copyrightImg);
        } else {
            $copyrightImg->setValue($copyright);
        }

        // See if the DESCRIPTION-tag already exists in Ifd
        $imageDesc = $ifd0->getEntry(PelTag::IMAGE_DESCRIPTION);

        // Create DESCRIPTION-tag if not found, otherwise just change the value
        if ($imageDesc == null) {
            $imageDesc = new PelEntryAscii(PelTag::IMAGE_DESCRIPTION, $description);
            $ifd0->addEntry($imageDesc);
        } else {
            $imageDesc->setValue($description);
        }

        // See if the AUTHOR-tag already exists in Ifd
        $authorImg = $ifd0->getEntry(PelTag::XP_AUTHOR);

        // Create AUTHOR-tag if not found, otherwise just change the value
        if ($authorImg == null) {
            $authorImg = new PelEntryAscii(PelTag::XP_AUTHOR, $photographer);
            $ifd0->addEntry($authorImg);
        } else {
            $authorImg->setValue($photographer);
        }

        // See if the TITLE-tag already exists in Ifd
        $titleImg = $ifd0->getEntry(PelTag::XP_TITLE);

        // Create TITLE-tag if not found, otherwise just change the value
        if ($titleImg == null) {
            $titleImg = new PelEntryAscii(PelTag::XP_TITLE, $title);
            $ifd0->addEntry($titleImg);
        } else {
            $titleImg->setValue($title);
        }

        // See if the KEYWORDS-tag already exists in Ifd
        $keywordsImg = $ifd0->getEntry(PelTag::XP_KEYWORDS);

        // Create KEYWORDS-tag if not found, otherwise just change the value
        if ($keywordsImg == null) {
            $keywordsImg = new PelEntryAscii(PelTag::XP_KEYWORDS, $keywords);
            $ifd0->addEntry($keywordsImg);
        } else {
            $keywordsImg->setValue($keywords);
        }

        $file->saveFile(Storage::disk('public')->path($slug));

    }

    public
    function getMetaData($slug)
    {
        $exif = Image::make(Storage::disk('public')->path($slug))->exif();
        return dd($exif);
    }
}
