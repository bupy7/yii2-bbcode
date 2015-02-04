<?php
namespace bupy7\bbcode;

use yii\helpers\HtmlPurifier;
use yii\base\Behavior;
use yii\db\ActiveRecord;
use yii\base\InvalidConfigException;
use JBBCode\CodeDefinitionBuilder;
use JBBCode\CodeDefinitionSet;
use JBBCode\CodeDefinition;

/**
 * Home page of extension: https://github.com/bupy7/yii2-bbcode/
 * Home page of jBBCode: http://jbbcode.com/
 * Home page of HtmlPurifier: http://htmlpurifier.org/
 * 
 * Behavior for parsing BB-codes at base jBBCode and HtmlPurifier.
 * 
 * @author Belosludcev Vasilij http://mihaly4.ru
 * @version 1.0
 */
class BBCodeBehavior extends Behavior
{
    
    /**
     * @var string Attribute name where content BBCodes.
     * If this property is NULL will be an exception is thrown.
     */
    public $attribute;
    
    /**
     * @var string Attribute name where will be save result the pasing BB-codes.
     * If this property is NULL will be an exception is thrown.
     */
    public $saveAttribute;
    
    /**
     * @var boolean Whether calling HtmlPurifier before process of parsing BB-codes.
     */
    public $enableHtmlPurifierBefore = false;
     
    /**
     * @var boolean Whether calling HtmlPurifier after process of parsing BB-codes.
     */
    public $enableHtmlPurifierAfter = false;
    
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
     *   This is configuration apply before process of parsing BB-codes.
     */
    public $configHtmlPurifierBefore = [];
    
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
     *   This is configuration apply after process of parsing BB-codes.
     */
    public $configHtmlPurifierAfter = [];
    
    /**
     * @var string Class name of provides a default set of common bbcode definitions. 
     * By default '\bupy7\bbcode\definitions\DefaultCodeDefinitionSet'.
     */
    public $defaultCodeDefinitionSet = '\bupy7\bbcode\definitions\DefaultCodeDefinitionSet';
    
    /**
     * @var array Adding new custom bbcodes to your parser is easy. 
     * For simple text-replacement bbcodes, just create a replacement string 
     * that contains {param} where the bbcode's content should go. 
     * Optionally, you may use the {option} variable for an option. 
     * Example: 
     * [
     *      // as elements of array
     *      ['quote', '<blockquote>{param}</blockquote>'],
     * 
     *      // as class name where class is instance of extended class \JBBCode\CodeDefinitionBuilder
     *      '/namespace/to/CodeDefinitionBuilder/ExtendedClassName',
     * 
     *      // as extended instance of extended class \JBBCode\CodeDefinitionBuilder
     *      $className,
     * 
     *      // as callable function where $builder is instance of class \JBBCode\CodeDefinitionBuilder
     *      function($builder) {
     *          $builder->setTagName('code');
     *          $builder->setReplacementText('<pre>{param}</pre>');
     *          return $builder;
     *      },
     * ]
     */
    public $codeDefinitionBuilder = [];
    
    /**
     * @var array BB-code definitions extended of class \JBBCode\CodeDefinitionSet
     * Example:
     * [
     *      // as class name where class is instance of extended class \JBBCode\CodeDefinitionSet
     *      '/namespace/to/CodeDefinitionSet/ExtendedClassName',
     * 
     *      // as extended instance of extended class \JBBCode\CodeDefinitionSet
     *      $className,
     * ]
     */
    public $codeDefinitionSet = [];
    
    /**
     * @var array BB-code definitions extended of class \JBBCode\CodeDefinition
     * Example:
     * [
     *      // as class name where class is instance of extended class \JBBCode\CodeDefinition
     *      '/namespace/to/CodeDefinition/ExtendedClassName',
     * 
     *      // as extended instance of extended class \JBBCode\CodeDefinition
     *      $className,
     * ]
     */
    public $codeDefinition = [];
    
    /**
     * @var boolean Whether to return content as html or bb-codes. If property 
     * is `true` then return as HTML, else as BB-codes.
     */
    public $asHtml = true;
    
    /**
     * @inheritdoc
     */
    public function init()
    {
        if (!$this->attribute || !$this->saveAttribute) {
            throw new InvalidConfigException('Invalid configuration of property `attribute` or `saveAttributes`.');
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
    
    /**
     * Parsing BB-codes before save of model.
     * 
     * @param \yii\base\Event $event
     */
    public function beforeSave($event)
    {
        $content = $this->owner->{$this->attribute};
       
        if ($this->enableHtmlPurifierBefore) {
            $content = HtmlPurifier::process($content, $this->configHtmlPurifierBefore);
        }
        
        $content = $this->process($content);
        
        if ($this->enableHtmlPurifierAfter) {
            $content = HtmlPurifier::process($content, $this->configHtmlPurifierAfter);
        }
        
        $this->owner->{$this->saveAttribute} = $content;
    }
    
    /**
     * Parsing of BB-codes.
     * 
     * @param string $content Content for parsing.
     * @return string
     */
    protected function process($content)
    {
        $parser = new Parser();
        
        $parser->addCodeDefinitionSet(new $this->defaultCodeDefinitionSet());

        // add definitions builder
        foreach ($this->codeDefinitionBuilder as $item) {
            if (is_string($item)) {
                $builder = new $item;
                if ($builder instanceof CodeDefinitionBuilder) {
                    $parser->addCodeDefinition($builder->build());
                }
            } elseif ($item instanceof CodeDefinitionBuilder) {
                $parser->addCodeDefinition($item->build());
            } elseif (is_callable($item)) {
                $parser->addCodeDefinition(call_user_func_array($item, [new CodeDefinitionBuilder]));  
            } elseif (isset($item[0]) && isset($item[1])) {
                $builder = new CodeDefinitionBuilder($item[0], $item[1]);
                $parser->addCodeDefinition($builder->build());
            }
        }       
        //added definitions set
        foreach ($this->codeDefinitionSet as $item) {
            if (is_string($item)) {
                $set = new $item;
                if ($set instanceof CodeDefinitionSet) {
                    $parser->addCodeDefinitionSet($set);
                }
            } elseif ($item instanceof CodeDefinitionSet) {
                $parser->addCodeDefinitionSet($item);
            }
        } 
        //added definitions
        foreach ($this->codeDefinition as $item) {
            if (is_string($item)) {
                $set = new $item;
                if ($set instanceof CodeDefinition) {
                    $parser->addCodeDefinition($set);
                }
            } elseif ($item instanceof CodeDefinition) {
                $parser->addCodeDefinition($item);
            }
        } 
        
        $parser->parse($content);
        
        if ($this->asHtml) {
            return $parser->getAsHtml();
        } 
        return $parser->getAsBBCode();
    }
    
}

