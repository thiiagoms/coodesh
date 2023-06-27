<?php

declare(strict_types=1);

namespace App\Contracts;

use Illuminate\Database\Eloquent\Collection;

interface Contract
{
    /**
     * @param string $uuid
     * @return null|mixed
     */
    public function find(string $uuid);

    /**
     * @param array $params
     * @return string
     */
    public function store(array $params): string;

    /**
     * @param string $uuid
     * @param array $params
     * @return void
     */
    public function update(string $uuid, array $params): void;

    /**
     * @param string $uuid
     * @return void
     */
    public function delete(string $uuid): void;
}
