<?php

declare(strict_types=1);

namespace BlockChain;

use DateTimeImmutable;

final class BlockMiner
{
    private Hasher $hasher;
    private int $zerosCount = 3;

    public function __construct(Hasher $hasher)
    {
        $this->hasher = $hasher;
    }

    public function mine(Block $lastBlock): Block
    {
        $i = 0;
        while (!str_starts_with(($hash = $this->hasher->hash(json_encode($lastBlock) . $i)), str_repeat('0', $this->zerosCount))) {
            $i++;
        }

        return new Block(
            $hash,
            new DateTimeImmutable(),
            $lastBlock->getHeight() + 1
        );
    }
}