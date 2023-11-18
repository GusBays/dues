<?php

namespace App\Modules\Due\Domain;

abstract class DueFilter {
    public function __construct(
        private ?int $id = null
    )
    {
        
    }

    public function getId(): ?int {
        return $this->id;
    }
}