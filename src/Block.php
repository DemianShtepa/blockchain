<?php

declare(strict_types=1);

namespace BlockChain;

use DateTimeImmutable;
use JsonSerializable;

final class Block implements JsonSerializable
{
    private string $hash;
    private DateTimeImmutable $timeStamp;
    private int $height;
    private array $transactions;

    public function __construct(string $hash, DateTimeImmutable $timeStamp, int $height, array $transactions = [])
    {
        $this->hash = $hash;
        $this->timeStamp = $timeStamp;
        $this->height = $height;
        $this->transactions = $transactions;
    }

    public static function createFromJson(string $json): self
    {
        $decoded = json_decode($json, true);
        $block = new self(
            $decoded['hash'],
            new DateTimeImmutable($decoded['timestamp']),
            $decoded['height'],
            $decoded['transactions']
        );

        return $block;
    }

    public function addTransaction(Transaction $transaction): void
    {
        $this->transactions[] = $transaction;
    }


    public function getHash(): string
    {
        return $this->hash;
    }

    public function getTimeStamp(): DateTimeImmutable
    {
        return $this->timeStamp;
    }

    public function getHeight(): int
    {
        return $this->height;
    }

    public function getTransactions(): array
    {
        return $this->transactions;
    }

    public function jsonSerialize(): array
    {
        return [
            'hash' => $this->hash,
            'timestamp' => $this->timeStamp->format('Y-m-d H:i'),
            'height' => $this->height,
            'transactions_count' => count($this->transactions),
            'transactions' => $this->transactions
        ];
    }
}