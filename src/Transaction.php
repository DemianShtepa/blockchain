<?php

declare(strict_types=1);

namespace BlockChain;

use DateTimeImmutable;
use JsonSerializable;

final class Transaction implements JsonSerializable
{
    private string $hash;
    private string $from;
    private string $to;
    private float $amount;
    private DateTimeImmutable $timeStamp;

    public function __construct(string $hash, string $from, string $to, float $amount, DateTimeImmutable $timeStamp)
    {
        $this->hash = $hash;
        $this->from = $from;
        $this->to = $to;
        $this->amount = $amount;
        $this->timeStamp = $timeStamp;
    }

    public function jsonSerialize(): array
    {
        return [
            'hash' => $this->hash,
            'from' => $this->from,
            'to' => $this->to,
            'amount' => $this->amount,
            'timestamp' => $this->timeStamp->format('Y-m-d H:i')
        ];
    }
}