<?php

namespace App\Core\Contracts;

use Illuminate\Database\Eloquent\Collection;

interface RepositoryInterface
{
    public function all(): Collection;
    public function find($id);
    public function delete($id);
}
