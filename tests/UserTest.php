<?php

namespace App\Tests;

use App\Entity\User;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

final class UserTest extends TestCase
{
    public function testCanBeCreatedFromValidEmailAddress(): void
    {
        $this->assertInstanceOf(
            User::class,
            new User()
        );
    }

    public function testCannotBeCreatedFromInvalidEmailAddress(): void
    {
        $this->expectException(InvalidArgumentException::class);

//        User::fromString('invalid');
    }

    public function testCanBeUsedAsString(): void
    {
//        $this->assertEquals(
//            'user@example.com',
//            User::fromString('user@example.com')
//        );
    }
}
