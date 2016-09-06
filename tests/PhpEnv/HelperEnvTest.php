<?php

namespace PhpEnvTest;

use PHPUnit\Framework\TestCase;

class HelperEnvTest extends TestCase
{
    public function testWeGetKnownEnvValue()
    {
        putenv('PHPENVTEST=test');
        $result = env('PHPENVTEST');

        $this->assertSame('test', $result);
    }

    public function testDefaultIsNull()
    {
        $result = env('PHPENVUNKNOWN');
        $this->assertNull($result);
    }

    public function testDefaultCanBeSet()
    {
        $result = env('PHPENVUNKNOWN', 'qwijibo');
        $this->assertSame('qwijibo', $result);
    }

    public function testDefaultCallableIsExecuted()
    {
        $result = env('PHPENVUNKNOWN', function(){ return 'qwijibo'; });
        $this->assertSame('qwijibo', $result);
    }

    public function testSpecialValuesAreConverted()
    {
        $specialValues = array(
            'true' => true,
            'false' => false,
            'null' => null,
        );

        foreach($specialValues as $value => $expected){
            putenv('PHPENVTEST=' . $value);
            $result = env('PHPENVTEST', 'qwijibo');
            $this->assertSame($expected, $result);
        }
    }
}