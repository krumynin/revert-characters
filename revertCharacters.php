<?php

function revertCharacters(string $string): string
{
    $words = explode(' ', $string);
    $words = array_map(fn ($word) => revertWord($word), $words);

    return implode(' ', $words);
}

function revertWord(string $word): string
{
    $parts = preg_split('#\w++\K\b|[^?,!;.\w]+#u', $word, -1, 1);
    $parts = array_map(fn ($part) => revertSubWord($part), $parts);

    return  implode('', $parts);
}

function revertSubWord(string $word): string
{
    $revWord = mb_strrev($word);
    $revWord = mb_strtolower($revWord);
    $characters = preg_split("//u", $word, -1, 1);

    foreach ($characters as $i => $character) {
        if ($character === mb_strtoupper($character)) {
            $newCharacter = mb_substr($revWord, $i, 1);
            $newCharacter = mb_strtoupper($newCharacter);
            $revWord = mb_substr_replace($revWord, $newCharacter, $i, 1);
        }
    }

    return $revWord;
}

function mb_substr_replace($original, $replacement, $position, $length): string
{
    $startString = mb_substr($original, 0, $position, "UTF-8");
    $endString = mb_substr($original, $position + $length, mb_strlen($original), "UTF-8");

    $out = $startString . $replacement . $endString;

    return $out;
}

function mb_strrev(string $string): string
{
    return join('', array_reverse(preg_split('//u', $string, -1, 1)));
}

echo revertCharacters('');