<?php

namespace app\Core\DTOs\Users;

use Illuminate\Http\UploadedFile;

class RegisterDto
{
    public string $name;
    public string $email;
    public string $password;
    public ?UploadedFile $profile_picture;

    public function __construct(string $name, string $email, string $password, ?UploadedFile  $profile_picture)
    {
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->profile_picture = $profile_picture;
    }
}
