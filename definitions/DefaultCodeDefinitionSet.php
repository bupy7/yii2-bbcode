<?php

namespace bupy7\bbcode\definitions;

use JBBCode\CodeDefinitionBuilder;
use bupy7\bbcode\validators\IntegerValidator;

/**
 * Provides a default set of common bbcode definitions.
 *
 * @author Belosludcev Vasilij http://github.com/bupy7
 */
class DefaultCodeDefinitionSet extends \JBBCode\DefaultCodeDefinitionSet
{

    /**
     * @var array The default code definitions in this set. 
     */
    protected $definitions = array();

    /**
     * @inheritdoc
     */
    public function __construct()
    {
        parent::__construct();
        
        /* [quote] blockquote tag */
        $builder = new CodeDefinitionBuilder('quote', '<blockquote>{param}</blockquote>');
        array_push($this->definitions, $builder->build());
        
        /* [p] paragraph tag */
        $builder = new CodeDefinitionBuilder('p', '<p>{param}</p>');
        array_push($this->definitions, $builder->build());
        
        /* [h=1|2|3|4|5|6] header tag */
        $builder = new CodeDefinitionBuilder('h', '<h{option}>{param}</h{option}>');
        $builder->setUseOption(true)->setParseContent(true)->setOptionValidator(new IntegerValidator);
        array_push($this->definitions, $builder->build());
    }

}
