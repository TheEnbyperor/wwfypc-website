<?php
// +---------------------------------------------------------------------------+
// | This file is part of the UR package.                              		   |
// | Copyright (c) 2005 Sabritech.			                                   |
// |                                                                           |
// | For the full copyright and license information, please view the COPYRIGHT |
// | file that was distributed with this source code. If the COPYRIGHT file is |
// | missing, please visit the Sabritech homepage: 							   |
// | http://www.sabritech.com    									           |
// +---------------------------------------------------------------------------+

/**
 * Images class will upload and resize images.
 * 
 * <note>
 *     This class to be included. It is not part of the main library.
 * </note>
 *
 * @author  Mazhar Iqbal <mazhar.iqbal@sabritech.com>
 * @since   1.0
 */

class Images
{
    function upload($Request_Name, $Img_Dir)
    {
        $Image = $_FILES[$Request_Name]['name'];
        $sub_Image = str_replace(" ", "_", $Image);
        $sub_Image = strtolower($sub_Image);
        $uploadfile = $Img_Dir . strtolower($sub_Image);

        if ($_FILES[$Request_Name]['type'] == "image/pjpeg" || $_FILES[$Request_Name]['type'] == "image/gif" || $_FILES[$Request_Name]['type'] == "image/jpeg" || $_FILES[$Request_Name]['type'] == "image/x-png" || $_FILES[$Request_Name]['type'] == "image/png")
        {

            $ext = explode('.', $sub_Image);
            $ext = $ext[count($ext) - 1];
            $ext = "." . $ext;
            $newName = substr($sub_Image, 0, -4);
            $newName = $newName . date("jnYHis") . $ext;

            $copy = copy($_FILES[$Request_Name]['tmp_name'], $Img_Dir . $newName);
            $return_filename = $newName;

            if (!$copy)
            {
                return false;
            } else
            {
                return strtolower($return_filename);
            }
        } else
        {
            return false;
        }

    }

    function getExtension($filename)
    {
        $dot = substr(strrchr($filename, "."), 1);
        return $dot;
    }

    function resize($Image, $Img_Dir, $width, $height, $mod_name = '', $target_dir = '')
    {
        $ext = $this->getExtension($Image);
        if ($ext != "jpg" && $ext != "jpeg" && $ext != "gif" && $ext != "png")
        {
            $_SESSION['Message'] = "Only .jpg, .jpeg, and .gif are supported";
            return false;
        }
        $sourcefile = $Img_Dir . $Image;
        $imagesize = getimagesize("$sourcefile");

        if ($imagesize[0] > $width || $imagesize[1] > $width)
        {
            if ($imagesize[0] > $imagesize[1])
            {
                $percentage = ($width / $imagesize[0]);
            } else
            {
                $percentage = ($height / $imagesize[1]);
            }
            $new_width = round($imagesize[0] * $percentage);
            $new_height = round($imagesize[1] * $percentage);
            $dest_x = $new_width;
            $dest_y = $new_height;
            if ($target_dir != '')
            {
                $targetfile = $target_dir . $mod_name . $Image;
            } else
            {
                $targetfile = $Img_Dir . $mod_name . $Image;
            }

            $jpegqual = 100;
            switch ($ext)
            {
                case 'jpg':
                case 'jpeg':
                    $source_id = imagecreatefromjpeg("$sourcefile");
                    break;
                case 'gif':
                    $source_id = imagecreatefromgif("$sourcefile");
                    break;
                case 'png':
                    $source_id = imagecreatefrompng("$sourcefile");
                    break;
            }
            $target_id = imagecreatetruecolor($dest_x, $dest_y);
            $target_pic = imagecopyresampled($target_id, $source_id, 0, 0, 0, 0, $dest_x, $dest_y, $imagesize[0], $imagesize[1]);
            imagejpeg($target_id, "$targetfile", $jpegqual);
        }
    }
	
    function fly_resize($source, $width, $height)
    {
        $sourcefile = $source;
        $imagesize = getimagesize("$sourcefile");
        if ($imagesize[0] > $width || $imagesize[1] > $width)
        {
            if ($imagesize[0] > $imagesize[1])
            {
                $percentage = ($width / $imagesize[0]);
            } else
            {
                $percentage = ($height / $imagesize[1]);
            }
            $size = array();
            $size[0] = round($imagesize[0] * $percentage);
            $size[1] = round($imagesize[1] * $percentage);
            return $size;
        }
    }


    function upload_three_dimension($Request_Name, $key, $Img_Dir)
    {

        $Image = $_FILES[$Request_Name]['name'][$key];
        $sub_Image = str_replace(" ", "_", $Image);
        $uploadfile = $Img_Dir . $Image;
        if ($_FILES[$Request_Name]['type'][$key] == "image/pjpeg" || $_FILES[$Request_Name]['type'][$key] == "image/gif" || $_FILES[$Request_Name]['type'][$key] == "image/jpeg" || $_FILES[$Request_Name]['type'][$key] == "image/x-png")
        {

            if (file_exists(strtolower($uploadfile)))
            {

                $ext = explode('.', $Image);
                $ext = $ext[count($ext) - 1];
                $ext = "." . $ext;

                $newName = substr($Image, 0, -4);
                $newName = $newName . rand() . $ext;

                $copy = copy($_FILES[$Request_Name]['tmp_name'][$key], "$Img_Dir" . $newName);
                $rename_ext = strtolower($newName);
                @rename("$Img_Dir" . $newName, "$Img_Dir" . $rename_ext);
                $return_filename = $newName;
            } else
            {
                $copy = copy($_FILES[$Request_Name]['tmp_name'][$key], "$Img_Dir" . $sub_Image);
                $rename_ext = strtolower($sub_Image);
                @rename("$Img_Dir" . $sub_Image, "$Img_Dir" . $rename_ext);
                $return_filename = $sub_Image;
            }

            if (!$copy)
            {
                return "an image must be select";
            }
            return strtolower($return_filename);
        } //file type if closeing here
        else
        {
            return "Only jpeg , pjpeg , gif allowed";
        }

    }

    ############### function for upload song file

    function uploadSong($Request_Name, $Img_Dir)
    {

        $fileName = $_FILES[$Request_Name]['name'];
        $uploadfile = $Img_Dir . strtolower($fileName);
        if (file_exists($uploadfile))
        {
            $ext = explode('.', $fileName);
            $ext = $ext[count($ext) - 1];
            $ext = "." . $ext;

            $newName = substr($fileName, 0, -4);
            $newName = $newName . date("jnYHis") . $ext;

            $copy = copy($_FILES[$Request_Name]['tmp_name'], "$Img_Dir" . strtolower($newName));
            $return_filename = strtolower($newName);
        } else
        {
            $copy = copy($_FILES[$Request_Name]['tmp_name'], "$Img_Dir" . strtolower($fileName));
            $return_filename = strtolower($fileName);
        }

        if (!$copy)
        {
            return "a song must be select" . "<br>";
        }
        return $return_filename;

    }

    ## simple function to resize image and place it where it was
    ###Usage is like that

    #		$target_path = "administrator/logo/";
    #		$target_path = $target_path . basename( $_FILES['logo']['name']);
    #		if(move_uploaded_file($_FILES['logo']['tmp_name'], $target_path))
    #		{
    #			resizeImage($target_path,100,400);
    #			$ImageName = basename( $_FILES['logo']['name']);
    #		}

    function ResizeImageSimple($originalImage, $toWidth, $toHeight)
    {

        // Get the original geometry and calculate scales
        list($width, $height) = getimagesize($originalImage);
        $xscale = $width / $toWidth;
        $yscale = $height / $toHeight;
        // Recalculate new size with default ratio
        if ($yscale > $xscale)
        {
            $new_width = round($width * (1 / $yscale));
            $new_height = round($height * (1 / $yscale));

        } else
        {
            $new_width = round($width * (1 / $xscale));
            $new_height = round($height * (1 / $xscale));
        }
        // Resize the original image
        $imageResized = imagecreatetruecolor($new_width, $new_height);

        $nameoffile = explode(".", $originalImage);
        $ext = $nameoffile[count($nameoffile) - 1];
        switch (strtolower($ext))
        {
            case "jpg":
                $imageTmp = imagecreatefromjpeg($originalImage);
                imagecopyresampled($imageResized, $imageTmp, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
                imagejpeg($imageResized, $originalImage);
                break;

            case "jpeg":
                $imageTmp = imagecreatefromjpeg($originalImage);
                imagecopyresampled($imageResized, $imageTmp, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
                imagejpeg($imageResized, $originalImage);
                break;

            case "gif":
                $imageTmp = imagecreatefromgif($originalImage);
                imagecopyresampled($imageResized, $imageTmp, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
                imagegif($imageResized, $originalImage);
                break;

            case "png":
                $imageTmp = imagecreatefrompng($originalImage);
                imagecopyresampled($imageResized, $imageTmp, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
                imagepng($imageResized, $originalImage);
                break;
        }
        return $imageResized;
    }


    function ResizeImageSimple_New($originalImage, $toWidth, $toHeight)
    {
        // Get the original geometry and calculate scales
        list($width, $height) = getimagesize($originalImage);
        $xscale = $width / $toWidth;
        $yscale = $height / $toHeight;
        // Recalculate new size with default ratio
        if ($yscale > $xscale)
        {
            $new_width = $toWidth;
            $new_height = $toHeight;
        } else
        {
            $new_width = $toWidth; //round($width * (1/$xscale));
            $new_height = $toHeight; //round($height * (1/$xscale));
        }
        // Resize the original image
        $imageResized = imagecreatetruecolor($new_width, $new_height);

        $nameoffile = explode(".", $originalImage);
        $ext = $nameoffile[count($nameoffile) - 1];
        switch (strtolower($ext))
        {
            case "jpg":
                $imageTmp = imagecreatefromjpeg($originalImage);
                imagecopyresampled($imageResized, $imageTmp, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
                imagejpeg($imageResized, $originalImage);
                break;

            case "jpeg":
                $imageTmp = imagecreatefromjpeg($originalImage);
                imagecopyresampled($imageResized, $imageTmp, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
                imagejpeg($imageResized, $originalImage);
                break;

            case "gif":
                $imageTmp = imagecreatefromgif($originalImage);
                imagecopyresampled($imageResized, $imageTmp, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
                imagegif($imageResized, $originalImage);
                break;

            case "png":
                $imageTmp = imagecreatefrompng($originalImage);
                imagecopyresampled($imageResized, $imageTmp, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
                imagepng($imageResized, $originalImage);
                break;
        }
        return $imageResized;
    }
}
?>