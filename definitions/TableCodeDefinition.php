<?php
namespace bupy7\bbcode\definitions;

use JBBCode\ElementNode;
use JBBCode\CodeDefinition;
use yii\helpers\Html;

/**
 * Implements a [table] code definition that provides the following syntax:
 *
 * [table]
 *   [tr]
 *   	[td]first item[/td]
 *   	[td]second item[/td]
 *   	[td]third item[/td]
 *   [/tr]
 * [/table]
 *
 * @author Vasilij Belosludcev http://mihaly4.ru 
 * @version 1.1
 */
class TableCodeDefinition extends CodeDefinition
{
 
    public function __construct()
    {
        $this->parseContent = true;
        $this->useOption = false;
        $this->setTagName('table');
        $this->nestLimit = -1;
    }
 
    public function asHtml(ElementNode $el)
    {
        $bodyHtml = '';
        foreach ($el->getChildren() as $child) {
            $bodyHtml .= $child->getAsHTML();
        }
        
        $trList = array();
        preg_match_all('#\[tr\](.*?)\[\/tr\]#is', $bodyHtml, $trList);
        
        $trList = array_map(function($tr) {
            $tdList = array();
            preg_match_all('#\[td\](.*?)\[\/td\]#is', $tr, $tdList);

            $tdList = array_map(function($td)
            {
                    return Html::tag('td', $td);
            }, $tdList[1]);

            return Html::tag('tr', implode('', $tdList));
        }, $trList[1]);
       
        return Html::tag('table', implode('', $trList), ['class' => 'bb-table']);
    }
 
}

