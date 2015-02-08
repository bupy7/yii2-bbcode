<?php

namespace bupy7\bbcode\definitions;

use JBBCode\ElementNode;
use JBBCode\CodeDefinition;
use bupy7\bbcode\validators\NumberValidator;

/**
 * Implements a [list] code definition with number that provides the following syntax:
 *
 * [list=1]
 *   [*] first item
 *   [*] second item
 *   [*] third item
 * [/list]
 *  
 * @uathor Vasilij Belosludcev http://github.com/bupy7
 * @version 1.1
 */
class ListNumberCodeDefinition extends CodeDefinition
{

    public function __construct()
    {
        $this->parseContent = true;
        $this->useOption = true;
        $this->setTagName('list');
        $this->nestLimit = -1;
        $this->optionValidator = new NumberValidator([
            'integerOnly' => true,
            'eq' => 1,
        ]);
    }

    public function asHtml(ElementNode $el)
    {
        $bodyHtml = '';
        foreach ($el->getChildren() as $child) {
            $bodyHtml .= $child->getAsHTML();
        }

        $listPieces = explode('[*]', $bodyHtml);
        unset($listPieces[0]);
        $listPieces = array_map(function($li) { return Html::tag('li', $li); }, $listPieces);
        
        return Html::tag('ol', implode('', $listPieces));    
    }

}
