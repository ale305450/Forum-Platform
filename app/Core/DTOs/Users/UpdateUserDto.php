<?php

namespace app\Core\DTOs\Users;

use Illuminate\Http\UploadedFile;

class UpdateUserDto
{
    public string $name;
    public string $password;
    public ?UploadedFile $profile_picture;

    public function __construct(string $name, string $password, ?UploadedFile $profile_picture)
    {
        $this->name = $name;
        $this->password = $password;
        $this->profile_picture = $profile_picture;
    }
}
