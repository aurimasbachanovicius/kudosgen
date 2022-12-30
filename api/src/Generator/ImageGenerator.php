<?php

namespace Kudosgen\Generator;

use Exception;

class ImageGenerator
{
    /**
     * @throws Exception
     */
    public function generate(GenerateRequest $request): void
    {
        $im = imagecreatetruecolor(1168, 826);

        $font = 'static/arialmt.ttf';

        $white = imagecolorallocate($im, 255, 255, 255);
        $black = imagecolorallocate($im, 0, 0, 0);

        imagefilledrectangle($im, 0, 0, 600, 300, $white);

        $messages = str_split($request->getMessage(), 25);
        $counter = 0;
        foreach ($messages as $message) {
            $counter++;
            imagettftext($im, 30, 0, 30, 40 + ($counter * 60), $black, $font, $message);
        }

//        imageantialias();
//        imagettfbbox();

        header('Content-Type: image/png');
        $paint = imagepng($im);
        if ($paint === false) {
            die('test');
        }
        imagedestroy($im);
    }

    public function helloWorld(): string
    {
        return "hello world";
    }
}
