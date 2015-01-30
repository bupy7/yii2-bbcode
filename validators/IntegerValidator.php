<?php

namespace bupy7\bbcode\validators;

use JBBCode\InputValidator;

/**
 * An InputValidator for integer values. 
 *
 * @author Belosludcev Vasilij http://github.com/bupy7
 */
class IntegerValidator implements InputValidator
{

    /**
     * Returns true if $input uses only integer value
     * characters.
     *
     * @param $input the string to validate
     */
    public function validate($input)
    {
        return (bool)preg_match('/^1|2|3|4|5|6$/', $input);
    }

}
