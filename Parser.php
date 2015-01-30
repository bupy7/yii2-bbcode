<?php

namespace bupy7\bbcode;

/**
 * @inheritdoc
 * 
 * @author Belosludcev Vasilij http://github.com/bupy7
 */
class Parser extends \JBBCode\Parser
{

    /**
     * Insert <br /> tag to new line.
     * @inheritdoc
     */
    public function parse($str)
    {
        $str = preg_replace("/(\r\n|\n\r|\n|\r)/", "<br />", $str);
        
        return parent::parse($str);
    }
    
}
    