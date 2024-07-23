<?php

namespace App\Helper;

class CensuratorService
{
    private $offensiveWords = array("caca", "pipi", "prouts");
    public function purify(string $text): string{
        $words = preg_split("/[\s\p{P}]/", $text);
        $string = "";
        foreach ($words as $word) {
            if (in_array($word, $this->offensiveWords)) {
                $tableau = str_split($word);
                for($i=0; $i<count($tableau); $i++) {
                    $tableau[$i] = '*';
                }
                $word = implode("", $tableau);
            }
            $string .= $word . " ";
        }
        return $string;
    }
}