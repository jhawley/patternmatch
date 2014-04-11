<?php

namespace Hawley\PatternMatch\Matchers;

abstract class BaseSizedPatternMatch implements SizedPatternMatch {
    protected $size;
    protected $_rules = array();
    protected $default = null;
    
    public function __construct($size) {
        if(empty($size)) {
            throw new \InvalidArgumentException("Size must be >0");
        }
        $this->size = $size;
    }
    
    abstract protected function onDefault();
    
    public function match() {
        $_args = func_get_args();
        if(count($_args) != $this->size) {
            throw new \InvalidArgumentException("Wrong number of arguments");
        }        
        foreach($this->_rules as $index => $rule) {
            if(call_user_func_array(array($rule[0], 'isMatch'), 
              $_args)) {
                array_unshift($_args, $rule[1]);
                return call_user_func_array(array($this, 'onMatch'), $_args);
            }
        }        
        return call_user_func_array(array($this, 'onDefault'), $_args);
    }
    
    abstract protected function onMatch();
}