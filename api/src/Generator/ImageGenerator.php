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

        $im = imagecreatetruecolor(400, 100);
        if ($im === false) {
            throw new Exception('failed to create image');
        }

        $white = imagecolorallocate($im, 255, 255, 255);
        if ($white === false) {
            throw new Exception('failed to create white color');
        }

        $black = imagecolorallocate($im, 0, 0, 0);
        if ($black === false) {
            throw new Exception('failed to create black color');
        }

        imagefilledrectangle($im, 0, 0, 399, 80, $white);

        $text = $request->getFrom() . $request->getTo() . $request->getMessage() . ' ...';
        $font = 'static/MommyAndBabyPersonalUse.ttf';
        $i = imagettftext($im, 30, 0, 30, 40, $black, $font, $text);
        if ($i === false) {
            throw new Exception('failed to paint image');
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
