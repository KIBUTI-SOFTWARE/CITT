<?php

    function src($fileName, $type="full")
    {
        $path = './uploads/files/';

        if ($type != 'full') {
            $path .= $type . '/';

            return $path . $fileName;
        }
    }
?>