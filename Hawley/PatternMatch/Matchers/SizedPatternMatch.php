<?php

namespace Hawley\PatternMatch\Matchers;
use Hawley\PatternMatch\Patterns\SizedPattern;

interface SizedPatternMatch {
    public function addRule(SizedPattern $pattern, $function);
    public function match();
    public function setDefault($result);
}