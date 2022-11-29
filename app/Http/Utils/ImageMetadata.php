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
    public function setMetaData($imageBankById, $copyright , $description){
        $slug = $imageBankById->slug;
        $path = Storage::get($slug);
        $data = new PelDataWindow($path);
        $tiff = null;
        $file = null;

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
        } // If it is a TIFF EXIF-headers will always be set
        elseif (PelTiff::isValid($data)) {
            $tiff = $file = new PelTiff();
            $tiff->load($data);
        } else {
            throw new \Exception('Invalid image format');
        }

        // Get the first Ifd, where most common EXIF-tags reside
        $ifd0 = $tiff->getIfd();

        // If no Ifd info found, create it
        if ($ifd0 == null) {
            $ifd0 = new PelIfd(PelIfd::IFD0);
            $tiff->setIfd($ifd0);
        }

        // See if the COPYRIGHT-tag already exists in Ifd
        $make = $ifd0->getEntry(PelTag::COPYRIGHT);

        // Create COPYRIGHT-tag if not found, otherwise just change the value
        if ($make == null) {
            $make = new PelEntryAscii(PelTag::COPYRIGHT, $copyright);
            $ifd0->addEntry($make);
        } else {
            $make->setValue($copyright);
        }

        // See if the DESCRIPTION-tag already exists in Ifd
        $imageDesc = $ifd0->getEntry(PelTag::IMAGE_DESCRIPTION);

        // Create DESCRIPTION-tag if not found, otherwise just change the value
        if ($imageDesc == null) {
            $imageDesc = new PelEntryAscii(PelTag::IMAGE_DESCRIPTION,$description);
            $ifd0->addEntry($imageDesc);
        } else {
            $imageDesc->setValue($description);
        }
//        return dd($file->getExif());
        $file->saveFile(Storage::disk('public')->path($slug));

    }

    public function getMetaData($slug)
    {
        $exif = Image::make(Storage::disk('public')->path($slug))->exif();
        return dd($exif);
    }
}
