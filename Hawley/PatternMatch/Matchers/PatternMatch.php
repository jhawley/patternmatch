<?php

namespace Hawley\PatternMatch\Matchers;
use Hawley\PatternMatch\Patterns\Pattern;

interface PatternMatch {
    public function addRule(Pattern $pattern, $function);
    public function match();
    public function setDefault($result);
}