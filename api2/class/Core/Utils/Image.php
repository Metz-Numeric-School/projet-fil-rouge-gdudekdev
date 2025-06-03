<?php

namespace Core\Utils;

class Image
{

      public static function registerImg($account_id)
      {
            $uploadDir = ROOT . '/upload/' . $account_id . '/';
            if (!file_exists($uploadDir)) {
                  mkdir($uploadDir);
            }

            $maxSize = 2_000_000; 

            if ($_FILES['accounts_profile']['size'] > $maxSize) {
                  die("Fichier trop volumineux.");
            }

            $finfo = finfo_open(FILEINFO_MIME_TYPE);
            $mimeType = finfo_file($finfo, $_FILES['accounts_profile']['tmp_name']);
            finfo_close($finfo);

            switch ($mimeType) {
                  case 'image/jpeg':
                        $srcImage = imagecreatefromjpeg($_FILES['accounts_profile']['tmp_name']);
                        break;
                  case 'image/png':
                        $srcImage = imagecreatefrompng($_FILES['accounts_profile']['tmp_name']);
                        break;
                  case 'image/webp':
                        $srcImage = imagecreatefromwebp($_FILES['accounts_profile']['tmp_name']);
                        break;
                  default:
                        die("Format non pris en charge.");
            }

            $maxWidth = 512;
            $maxHeight = 512;
            $width = imagesx($srcImage);
            $height = imagesy($srcImage);

            if ($width > $maxWidth || $height > $maxHeight) {
                  $ratio = min($maxWidth / $width, $maxHeight / $height);
                  $newWidth = (int) ($width * $ratio);
                  $newHeight = (int) ($height * $ratio);

                  $resizedImage = imagecreatetruecolor($newWidth, $newHeight);
                  imagecopyresampled($resizedImage, $srcImage, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
                  imagedestroy($srcImage);
                  $srcImage = $resizedImage;
            }

            if (!is_dir($uploadDir)) {
                  mkdir($uploadDir, 0775, true);
            }

            $targetPath = $uploadDir . "profile.webp";

            imagewebp($srcImage, $targetPath, 80);
            imagedestroy($srcImage);
      }
}