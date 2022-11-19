<?php

namespace App\DataTransferObjects\Contracts;

interface DTOMappingInterface
{
    public function map(): void;
    public function toJson(): string;
}
