<?php

use App\DoorPassword;
use PHPUnit\Framework\TestCase;

class DoorPasswordTest extends TestCase
{

    /**
     * @test
     */
    public function it_generates_door_code()
    {
        $doorPassword = new DoorPassword();

        $this->assertEquals($doorPassword->generate('abc'), '18f47a30');
    }

    /**
     * @test
     */
    public function it_also_generates_door_code_with_extended_encryption()
    {
        $doorPassword = new DoorPassword();

        $this->assertEquals('05ace8e3', $doorPassword->generateComplexCode('abc'));
    }
}