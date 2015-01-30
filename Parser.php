<?php

namespace bupy7\bbcode;

/**
 * @inheritdoc
 * 
 * Support BB-codes: 
 * [b]bold[/b]
 * [i]italic[/i]
 * [u]underlining[/u]
 * [list]
 *     [*] first
 *     [*] second
 * [/list],
 * [url=http://domain.zone]This is link[/url]
 * [color=red]color![/color]
 * [img=This is image]http://link.to/image.png[/img]
 * [p]paragraph[/p]
 * [blockquote]blockquote[/blockquote]
 * [h=1|2|3|4|5|6]header[/h=1|2|3|4|5|6]
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
    