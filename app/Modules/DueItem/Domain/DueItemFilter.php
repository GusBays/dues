<?php

namespace App\Modules\DueItem\Domain;

abstract class DueItemFilter {
    public function __construct(
        private ?int $id = null,
        private ?int $dueId = null
    )
    {}

    public function getId(): ?int {
        return $this->id;
    }

    public function getDueId(): ?int {
        return $this->dueId;
    }
}