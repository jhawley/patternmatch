<?php

namespace Hawley\PatternMatch\Patterns;

abstract class BaseSizedPattern implements SizedPattern {
    protected $size;
    protected $_rule;
    
    public function getSize() {
        return $this->size;
    }
    
    public function __construct() {
        $this->_rule = func_get_args();
        $this->size = count($this->_rule);
    }
    
    public function setRule() {
        $this->_rule = func_get_args();
    }
}
