<?php

    class ErrorMessage{

        public static function errorShow($text)
        {
            exit("<span class='errorBanner'>$text</span>");
        }
    }

?>
