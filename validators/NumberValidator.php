<?php

namespace bupy7\bbcode\validators;

use JBBCode\InputValidator;

/**
 * An NumberValidator for number values. 
 *
 * @author Belosludcev Vasilij http://github.com/bupy7
 * @version 1.1
 */
class NumberValidator implements InputValidator
{

    /**
     * @var mixed Minimum value of input.
     */
    public $min;
    
    /**
     * @var mixed Maximum value of input.
     */
    public $max;
    
    /**
     * @var mixed Equal value of input.
     */
    public $eq;
    
    public $integerOnly = false;
    
    public function __construct($config = [])
    {    
        foreach ($config as $name => $value) {
            if (property_exists($this, $name)) {
                $this->{$name} = $value;
            }
        }
    }
    
    /**
     * Returns true if $input uses only number value
     * characters.
     *
     * @param $input the string to validate
     */
    public function validate($input)
    {
        if (!preg_match('/^[\d]+$/', $input)) {
            return false;
        }
        if ($this->integerOnly) {
            if (!is_int($input + 0)) {     
                return false;
            }
        }
        if (!isset($this->eq)) {
            if (isset($this->max) && !isset($this->min)) {
                if ($input > $this->max) {
                    return false;
                }
            }
            if (!isset($this->max) && isset($this->min)) {
                if ($input < $this->min) {
                    return false;
                }
            }
            if (isset($this->max) && isset($this->min)) {
                if ($input < $this->min || $input > $this->max) {
                    return false;
                }
            }
        } else {
            if ($input != $this->eq) {
                return false;
            }
        }
        return true;
    }

}
