<?php

namespace Hawley\PatternMatch\Matchers;
use Hawley\PatternMatch\Patterns\SizedPattern;

class SimpleSizedValuePatternMatch extends BaseSizedPatternMatch { 
    
    protected function onDefault() {
        if(!is_null($this->default)) {
            return $this->default;
        } else {
            throw new NoMatchException("No match for args");
        }
    }
    
    protected function onMatch() {
        $_args = func_get_args();
        return $_args[0];
    }
    
    public function addRule(SizedPattern $pattern, $result) {
        if($pattern->getSize() != $this->size) {
            throw new \InvalidArgumentException("Pattern is wrong size");
        }
        $this->_rules[] = array($pattern, $result);
    }
    
    public function setDefault($result) {
        $this->default = $result;
    }
}