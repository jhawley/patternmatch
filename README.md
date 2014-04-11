# Purpose
To allow developers to separate rules from implementation

# Example
    $pm = new SimpleSizedLambdaPatternMatch(2);
    $pm->addRule(new SimpleSizedPattern('test', 'test'), 
      function(){ return 1; });
    $pm->addRule(new SimpleSizedPattern('*', 'a'), 
      function($value1, $value2){ return 2; });
    $pm->addRule(new SimpleSizedPattern('*', '*'), 
      function($value1, $value2){ return $value1.$value2; });
    $this->assertEqual($pm2->match("test", "test2"), "testtest2");
    $this->assertEqual($pm2->match("test", "test"), 1);
    $this->assertEqual($pm2->match("anything", "a"), 2);

# Limitations
This implementation currently does not recursively apply matches.  In terms of the SICP definition of pattern-matching, one should think of this implementation as a single pass where all inputs are tuples of length n, all patterns are tuples of length n, and skeletons are determined by the second parameter passed into the matcher::addRule method.

# Installation
This requires a version of PHP that supports lambda expressions.  To add / run tests, install simpletest in Hawley/PatternMatch/tests/simpletest.

# License
Public domain without warranties