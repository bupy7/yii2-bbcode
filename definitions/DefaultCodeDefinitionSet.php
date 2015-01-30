<?php

namespace bupy7\bbcode\definitions;

use JBBCode\CodeDefinitionBuilder;
use bupy7\bbcode\validators\NumberValidator;

/**
 * Provides a default set of common bbcode definitions.
 * Support BB-codes: 
 * [b]bold[/b]
 * [i]italic[/i]
 * [u]underlining[/u]
 * [list] with marker
 *     [*] first
 *     [*] second
 * [/list]
 * [list=1] with number 
 *     [*] first
 *     [*] second
 * [/list]
 * [url=http://domain.zone]This is link[/url]
 * [color=red]color![/color]
 * [img=This is image]http://link.to/image.png[/img]
 * [p]paragraph[/p]
 * [blockquote]blockquote[/blockquote]
 * [h=1|2|3|4|5|6]header[/h=1|2|3|4|5|6]
 * [center]text by center[/center]
 * [right]text align by right[/right]
 * [left]text align by left[/left]
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
        $builder->setUseOption(true)
            ->setParseContent(true)
            ->setOptionValidator(new NumberValidator([
                'integerOnly' => true,
                'min' => 1,
                'max' => 6,
            ]));
        array_push($this->definitions, $builder->build());
        
        /* [center] align text by center */
        $builder = new CodeDefinitionBuilder('center', '<span style="text-align:center">{param}</span>');
        $builder->setParseContent(true);
        array_push($this->definitions, $builder->build());
        
        /* [left] align text by left of edge */
        $builder = new CodeDefinitionBuilder('left', '<span style="text-align:left">{param}</span>');
        $builder->setParseContent(true);
        array_push($this->definitions, $builder->build());
        
        /* [right] align text by right of edge */
        $builder = new CodeDefinitionBuilder('right', '<span style="text-align:right">{param}</span>');
        $builder->setParseContent(true);
        array_push($this->definitions, $builder->build());
        
        
        /* [list] with marker */
        array_push($this->definitions, new ListMarkerCodeDefinition);
        
        /* [list=1] with number */
        array_push($this->definitions, new ListNumberCodeDefinition);
    }

}
