<?php

declare(strict_types=1);

namespace BlockChain;

final class Hasher
{
    private string $algorithm = 'sha256';

    public function hash(string $data): string
    {
        return hash($this->algorithm, $data);
    }
}