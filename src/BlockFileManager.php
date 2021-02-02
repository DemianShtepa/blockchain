<?php

declare(strict_types=1);

namespace BlockChain;

use InvalidArgumentException;

final class BlockFileManager
{
    private string $blockPath = __DIR__ . '/../blocks/';

    public function getAll(): array
    {
        $blocks = array_diff(scandir($this->blockPath), ['..', '.']);
        $result = [];

        foreach ($blocks as $block) {
            $jsonBlock = file_get_contents($block);

            $result[] = Block::createFromJson($jsonBlock);
        }

        return $result;
    }

    public function getLast(): Block
    {
        $blocks = array_diff(scandir($this->blockPath), ['..', '.']);
        sort($blocks);
        $lastBlockJson = file_get_contents($this->blockPath . array_pop($blocks));

        return Block::createFromJson($lastBlockJson);
    }

    public function getByHeight(int $height): Block
    {
        $fileName = $this->blockPath . $height . '.json';
        $jsonBlock = file_get_contents($fileName);

        if (!$jsonBlock) {
            throw new InvalidArgumentException('Invalid height.');
        }

        return Block::createFromJson($jsonBlock);
    }

    public function save(Block $block): void
    {
        $fileName = $this->blockPath . $block->getHeight() . '.json';

        file_put_contents($fileName, json_encode($block));
    }
}