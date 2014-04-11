<?php

namespace Hawley\PatternMatch\Patterns;

class SimpleSizedPattern extends BaseSizedPattern {
    const ANY = '*';
    
    public function isMatch() {
        $_args = func_get_args();
        $failed = false;
        foreach($this->_rule as $index => $rule)
        {
            switch($rule) {
                case self::ANY:
                    break;
                default:
                    $failed = ($_args[$index] != $rule);               
                    break;
            }
            if($failed) {
                return false;
            }
        }
        return true;
    }
}