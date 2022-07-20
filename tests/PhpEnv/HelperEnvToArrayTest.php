<?php

namespace PhpEnvTest;

use PHPUnit\Framework\TestCase;

class HelperEnvToArrayTest extends TestCase
{
    public function testWeGetSingleKnownEnvValue()
    {
        putenv('PHPENVTEST=test');
        $result = env_to_array('PHPENVTEST');

        $this->assertSame(array('test'), $result);
    }

    public function testWeGetDelimitedKnownEnvValue()
    {
        putenv('PHPENVTEST=test,qwerty');
        $result = env_to_array('PHPENVTEST');

        $this->assertSame(array('test','qwerty'), $result);
    }

    public function testWeTrimValues()
        {
            putenv('PHPENVTEST=test , qwerty ');
            $result = env_to_array('PHPENVTEST');

            $this->assertSame(array('test','qwerty'), $result);
        }

    public function testDefaultIsEmptyArray()
    {
        $result = env_to_array('PHPENVUNKNOWN');
        $this->assertSame(array(), $result);
    }

    public function testDefaultCanBeSet()
    {
        $result = env_to_array('PHPENVUNKNOWN', array('qwijibo'));
        $this->assertSame(array('qwijibo'), $result);
    }

    public function testDefaultIsForcedToArray()
        {
            $result = env_to_array('PHPENVUNKNOWN', 'qwijibo,krusty');
            $this->assertSame(array('qwijibo', 'krusty'), $result);
        }

    public function testDefaultCallableIsExecuted()
    {
        $result = env_to_array('PHPENVUNKNOWN', function(){ return 'qwijibo'; });
        $this->assertSame(array('qwijibo'), $result);
    }

}