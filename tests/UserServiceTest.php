<?php

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../src/UserService.php';

class UserServiceTest extends TestCase
{
    // Only authenticate() is tested — findById() has NO test (low coverage demo)
    public function testAuthenticateReturnsFalseOnBadQuery(): void
    {
        $pdo = $this->createMock(\PDO::class);
        $pdo->method('query')->willReturn(false);

        $service = new UserService($pdo);
        $result = $service->authenticate('admin', 'wrongpass');

        $this->assertFalse($result);
    }
}
