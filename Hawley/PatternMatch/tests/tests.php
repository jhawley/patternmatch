<?php
require_once(dirname(__FILE__) . '/simpletest/autorun.php');
require_once(dirname(dirname(dirname(dirname(__FILE__)))) . '/autoload.php');

use Hawley\PatternMatch\Matchers\SimpleSizedLambdaPatternMatch;
use Hawley\PatternMatch\Matchers\SimpleSizedValuePatternMatch;
use Hawley\PatternMatch\Patterns\SimpleSizedPattern;

class TestOfSimpleSizedPattern extends UnitTestCase {
    function testOfWildcard() {
        $pm1 = new SimpleSizedLambdaPatternMatch(1);
        $pm1->addRule(new SimpleSizedPattern("*"), function(){return 1;});
        $this->assertEqual($pm1->match("anything"), 1);
    }
}

class testOfSimpleSizedLambdaPatternMatch extends UnitTestCase {    
    function testOfSmallMatch() {
        $pm1 = new SimpleSizedLambdaPatternMatch(1);
        $p1 = new SimpleSizedPattern('test');
        $p2 = new SimpleSizedPattern('teste');
        $pm1->addRule($p1, function(){ return 1; });
        $pm1->addRule($p2, function($value){ return $value; });
        $this->assertEqual($pm1->match("test"), 1);
        $this->assertEqual($pm1->match("teste"), "teste");
        $this->expectException();
        $pm1->match("testes");
    }
    
    function testOfLargeMatch() {
        $pm2 = new SimpleSizedLambdaPatternMatch(2);
        $pm2->addRule(new SimpleSizedPattern('test', 'test'), 
          function(){ return 1; });
        $pm2->addRule(new SimpleSizedPattern('*', 'a'), 
          function($value1, $value2){ return 2; });
        $pm2->addRule(new SimpleSizedPattern('*', '*'), 
          function($value1, $value2){ return $value1.$value2; });
        $this->assertEqual($pm2->match("test", "test2"), "testtest2");
        $this->assertEqual($pm2->match("test", "test"), 1);
        $this->assertEqual($pm2->match("anything", "a"), 2);
    }
    
    function testOfDefault() {
        $pm2 = new SimpleSizedLambdaPatternMatch(1);
        $pm2->addRule(new SimpleSizedPattern('test'), 
          function(){ return 1; });
        $pm2->setDefault(function(){ return 2; });
        $this->assertEqual($pm2->match("teste"), 2);
    }
    
    function testNoDefault() {
        $pm2 = new SimpleSizedLambdaPatternMatch(1);
        $pm2->addRule(new SimpleSizedPattern('test'), 
          function(){ return 1; });
        $this->expectException();
        $pm2->match("teste");
    }
    
    function testOfBadSize1() {
        $pm2 = new SimpleSizedLambdaPatternMatch(2);
        $this->expectException();
        $pm2->addRule(new SimpleSizedPattern('test'), 
          function(){ return 1; });
    }
    
    function testOfBadSize2() {
        $pm2 = new SimpleSizedLambdaPatternMatch(2);
        $pm2->addRule(new SimpleSizedPattern('test', 'test'), 
          function(){ return 1; });
        $this->expectException();
        $pm2->match('teste');
    }
    
    function testOfInvalidArgument() {
        $pm = new SimpleSizedLambdaPatternMatch(1);
        $this->expectException();
        $pm->addRule(new SimpleSizedPattern('*'), 'not a function');
    }
}

class testOfSimpleSizedValuePatternMatch extends UnitTestCase {    
    function testOfSmallMatch() {
        $pm1 = new SimpleSizedValuePatternMatch(1);
        $p1 = new SimpleSizedPattern('test');
        $p2 = new SimpleSizedPattern('teste');
        $pm1->addRule($p1, 1);
        $pm1->addRule($p2, "teste");
        $this->assertEqual($pm1->match("test"), 1);
        $this->assertEqual($pm1->match("teste"), "teste");
        $this->expectException();
        $pm1->match("testes");
    }
    
    function testOfLargeMatch() {
        $pm2 = new SimpleSizedValuePatternMatch(2);
        $pm2->addRule(new SimpleSizedPattern('test', 'test'), 1);
        $pm2->addRule(new SimpleSizedPattern('*', 'a'), 2);
        $pm2->addRule(new SimpleSizedPattern('*', '*'), "testtest2");
        $this->assertEqual($pm2->match("test", "test2"), "testtest2");
        $this->assertEqual($pm2->match("test", "test"), 1);
        $this->assertEqual($pm2->match("anything", "a"), 2);
    }
    
    function testOfDefault() {
        $pm2 = new SimpleSizedValuePatternMatch(1);
        $pm2->addRule(new SimpleSizedPattern('test'), 1);
        $pm2->setDefault(2);
        $this->assertEqual($pm2->match("teste"), 2);
    }
    
    function testNoDefault() {
        $pm2 = new SimpleSizedValuePatternMatch(1);
        $pm2->addRule(new SimpleSizedPattern('test'), 1);
        $this->expectException();
        $pm2->match("teste");
    }
    
    function testOfBadSize1() {
        $pm2 = new SimpleSizedValuePatternMatch(2);
        $this->expectException();
        $pm2->addRule(new SimpleSizedPattern('test'), 1);
    }
    
    function testOfBadSize2() {
        $pm2 = new SimpleSizedValuePatternMatch(2);
        $pm2->addRule(new SimpleSizedPattern('test', 'test'), 1);
        $this->expectException();
        $pm2->match('teste');
    }
}