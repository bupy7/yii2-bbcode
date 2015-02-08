<?php

namespace bupy7\bbcode\definitions;

use JBBCode\ElementNode;
use JBBCode\CodeDefinition;
use yii\helpers\Html;

/**
 * Implements a [list] code definition with marker that provides the following syntax:
 *
 * [list]
 *   [*] first item
 *   [*] second item
 *   [*] third item
 * [/list]
 *  
 * @author Jackson Owens https://github.com/jbowens
 * @version 1.1
 */
class ListMarkerCodeDefinition extends CodeDefinition
{

    public function __construct()
    {
        $this->parseContent = true;
        $this->useOption = false;
        $this->setTagName('list');
        $this->nestLimit = -1;
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
        
        return Html::tag('ul', implode('', $listPieces));    
    }

}
