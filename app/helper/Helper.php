<?php

class Helper {
    public static function strip_whitespace ($string) {
        // do some magic
        return self::do_magic();

    }

    private static function do_magic() {
        // return magic
    }

    public static function fileUploader($mainFile, $path)
    {
        $fileName = time().'.'.$mainFile->extension();
        $mainFile->move($path, $fileName);
        return $fileName;
    }
}

// $result = Helper::strip_whitespace("  I'm a string!  ");