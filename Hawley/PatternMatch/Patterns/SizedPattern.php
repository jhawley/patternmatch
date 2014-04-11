<?php

namespace Hawley\PatternMatch\Patterns;

interface SizedPattern extends Pattern {
    public function getSize();
}

