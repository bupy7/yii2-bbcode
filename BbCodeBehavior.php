<?php
namespace bupy7\bbcode;

use Yii;
use yii\helpers\HtmlPurifier;
use yii\base\Behavior;
use yii\db\ActiveRecord;
use yii\base\InvalidConfigException;
use JBBCode\Parser;

/**
 * 
 * @author Belosludcev Vasilij http://mihaly4.ru
 */
class BbCodeBehavior extends Behavior
{
    
    /**
     * @var string Attribute name where content BBCodes.
     * If this property is NULL will be an exception is thrown.
     */
    public $attribute;
    
    /**
     * @var string Attribute name where will be save result the pasing BBCodes.
     * If this property is NULL will be an exception is thrown.
     */
    public $saveAttribute;
    
    /**
     * @var array|\Closure|null $config The config to use for HtmlPurifier.
     * If not specified or `null` the default config will be used.
     * You can use an array or an anonymous function to provide configuration options:
     *
     * - An array will be passed to the `HTMLPurifier_Config::create()` method.
     * - An anonymous function will be called after the config was created.
     *   The signature should be: `function($config)` where `$config` will be an
     *   instance of `HTMLPurifier_Config`.
     *
     *   Here is a usage example of such a function:
     *
     *   ~~~
     *   // Allow the HTML5 data attribute `data-type` on `img` elements.
     *   function($config) {
     *     $config->getHTMLDefinition(true)
     *            ->addAttribute('img', 'data-type', 'Text');
     *   })
     *   ~~~
     */
    public $configHtmlPurifier = [];
    
    /**
     * @var string Class name of provides a default set of common bbcode definitions. 
     * By default '\JBBCode\DefaultCodeDefinitionSet'.
     */
    public $defaultCodeDefinitionSet;
    
    /**
     * @inheritdoc
     */
    public function init()
    {
        if (!$this->attribute || !$this->saveAttribute) {
            throw new InvalidConfigException('Invalid configuration of property `attribute` or `saveAttributes`.');
        }
        if (!$this->defaultCodeDefinitionSet) {
            $this->defaultCodeDefinitionSet = '\JBBCode\DefaultCodeDefinitionSet';
        }
        parent::init();
    }
    
    /**
     * Call behavior before save model of \yii\db\ActiveRecord.
     * 
     * @return array
     */
    public function events()
    {
        return [
            ActiveRecord::EVENT_BEFORE_UPDATE => 'beforeSave',
            ActiveRecord::EVENT_BEFORE_INSERT => 'beforeSave',
        ];
    }
    
    public function beforeSave($event)
    {
        $this->owner->{$this->saveAttribute} = $this->parsing();
    }
    
    protected function parsing()
    {
        $parser = new Parser();
        $parser->addCodeDefinitionSet(new $this->defaultCodeDefinitionSet());

        $parser->parse($this->owner->{$this->attribute});

        return $parser->getAsHtml();
    }
    
}

