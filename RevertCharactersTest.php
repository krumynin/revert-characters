<?php

require_once __DIR__ . '/revertCharacters.php';

use PHPUnit\Framework\TestCase;

class RevertCharactersTest extends TestCase
{
    public function testEmptyString(): void
    {
        $this->assertEquals('', revertCharacters(''));
    }

    public function testStringWithManyWords(): void
    {
        $this->assertEquals('Тевирп! Онвад ен ьсиледив.', revertCharacters('Привет! Давно не виделись.'));
    }

    public function testStringOneWord(): void
    {
        $this->assertEquals('Тевирп', revertCharacters('Привет'));

    }
}
