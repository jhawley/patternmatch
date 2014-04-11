<?php

namespace Hawley\PatternMatch\Matchers;
use Hawley\PatternMatch\Patterns\SizedPattern;

class SimpleSizedLambdaPatternMatch extends BaseSizedPatternMatch { 
    
    protected function onDefault() {
        $_args = func_get_args();
        if(!is_null($this->default)) {
            return call_user_func_array($this->default, $_args);
        } else {
            throw new NoMatchException("No match for args");
        }
    }
    
    protected function onMatch() {
        $_args = func_get_args();
        return call_user_func_array($_args[0], array_slice($_args, 1));
    }
    
    public function addRule(SizedPattern $pattern, $function) {
        if(!is_callable($function)) {
            throw new \InvalidArgumentException("Invalid function argument");
        }
        if($pattern->getSize() != $this->size) {
            throw new \InvalidArgumentException("Pattern is wrong size");
        }
        $this->_rules[] = array($pattern, $function);
    }
    
    public function setDefault($result) {
        if(!is_callable($result)) {
            throw new \InvalidArgumentException("Invalid function argument");
        }
        $this->default = $result;
    }
}