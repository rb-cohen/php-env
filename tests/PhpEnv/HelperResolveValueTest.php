<?php

namespace PhpEnvTest;

use PHPUnit\Framework\TestCase;

class HelperResolveValueTest extends TestCase
{
    public function testCallableIsExecuted()
    {
        $callable = function(){
            return 'test';
        };

        $result = resolve_value($callable);
        $this->assertSame('test', $result);
    }

    public function testNestedCallableIsExecuted()
    {
        $callable = function(){
            return function(){
                return 'test';
            };
        };

        $result = resolve_value($callable);
        $this->assertSame('test', $result);
    }

    public function testNonCallableValuesAreReturned()
    {
        $values = array(
            0, 1, '0', '1', 'test', true, false,
        );

        foreach($values as $value){
            $result = resolve_value($value);
            $this->assertSame($value, $result);
        }
    }
}