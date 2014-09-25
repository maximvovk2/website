<?php

class Text
{
    public static function formatText($text) {
        $text = trim($text);
        if ($text == '') {
            return '';
        }
        $explodeText = explode("\n", $text);
        $result = '';
        foreach ($explodeText as $p) {
            $result .= '<p>' . $p . '</p>';
        }
        return $result;
    }

    public static function divideByThree ($collection) {
        $result = array();
        $counter = 0;
        $iterator = 0;
        foreach($collection as $item) {
            $result[$counter][$iterator] = $item;
            $iterator++;
            if ($iterator >= 3) {
                $iterator = 0;
                $counter++;
            }
        }
        return $result;
    }

    public static function getCompanyProfile() {
        if (!is_dir('documents')) {
            return false;
        }
        $profiles = scandir('documents', 1);
        array_pop($profiles);
        array_pop($profiles);
        if (count($profiles) == 0) {
            return false;
        }
        return $profiles[0];
    }
}
