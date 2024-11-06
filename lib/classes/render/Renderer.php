<?php
declare(strict_types=1);

namespace iutnc\deefy\render;

interface Renderer {
    const LONG = 1;
    const COMPACT = 2;
    public function render(int $selector): string;
}