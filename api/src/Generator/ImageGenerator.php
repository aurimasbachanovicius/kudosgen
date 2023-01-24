<?php

namespace Kudosgen\Generator;

class ImageGenerator implements ImageGeneratorInterface
{
    public function generate(GenerateRequest $request): ImageBlob
    {
        $font = 'static/arialmt.ttf';

        $im = imagecreatetruecolor(1168, 826);

        $white = imagecolorallocate($im, 255, 255, 255);
        $black = imagecolorallocate($im, 0, 0, 0);

        imagefilledrectangle($im, 0, 0, 600, 300, $white);

        $messages = str_split($request->getMessage(), 25);
        $counter = 0;
        foreach ($messages as $message) {
            $counter++;
            imagefttext($im, 30, 0, 30, 40 + ($counter * 60), $black, $font, $message);
        }

        ob_start();
        imagepng($im);
        $imageData = ob_get_clean();
        imagedestroy($im);

        return new ImageBlob($imageData);

//        imageantialias();
//        imagettfbbox();

//        header('Content-Type: image/png');
//        $paint = imagepng($im);
//        if ($paint === false) {
//            die('test');
//        }
//        imagedestroy($im);
    }
}
