<?php

namespace app\Core\DTOs\Users;

class LoginDto
{
    public string $email;
    public string $password;

    public function __construct(string $email,string $password)
    {
        $this->email = $email;
        $this->password = $password;
    }
}