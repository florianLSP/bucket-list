<?php

namespace App\Tools;

class Censurator
{
    const BAN_WORDS = ['lutin', 'caramel', 'voila'];
    public function purify(String $textToPurify): string
    {
        foreach (self::BAN_WORDS as $word ){
            $newText = str_repeat('*', strlen($word));
            str_ireplace($word, $newText, $textToPurify);
            $textToPurify = str_ireplace(self::BAN_WORDS, '*****', $textToPurify);

        }

        return $textToPurify;
    }
}

