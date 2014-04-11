<?php

namespace Hawley\PatternMatch\Patterns;

interface Pattern {
    public function isMatch();
    public function setRule();
}