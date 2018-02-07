# yii2-bbcode

Behavior for parsing BB-codes at base jBBCode and HtmlPurifier for Yii2.
This behavior very simple expand under your demands.
Behavior of use [jBBCode](http://jbbcode.com) and [HtmlPurifier](http://htmlpurifier.org/).

## Installation
The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run
```
$ php composer.phar require bupy7/yii2-bbcode "1.*"
```

or add
```
"bupy7/yii2-bbcode": "1.*"
```

to the **require** section of your **composer.json** file.

## How it use

Add you view following code:

```php
echo $form->field($model, 'content')->textArea();
```

Add you model following code:

```php
use bupy7\bbcode\BBCodeBehavior;

public function behaviors()
{
    return [
        ...
        
        [
            'class' => BBCodeBehavior::className(),
            'attribute' => 'content',
            'saveAttribute' => 'purified_content',
        ],
        
        ...
    ];
}
```

## Support BB-code

| **BB-code** | **HTML Result**  |
|-------------|-----------|
| ```[b]bold[/b]``` | ```<strong>bold</strong>``` |
| ```[i]italic[/i]``` | ```<em>italic</em>``` |
| ```[u]underline[/u]``` | ```<u>underline</u>``` |
| ```[url=http://github.com]GitHub[/url]``` | ```<a href="http://github.com">GitHub</a>``` |
| ```[color=red]color[/color]``` | ```<span style="color:red">color</span>``` |
| ```[img=My photo]http://link.to/image.png[/img]``` | ```<img src="http://link.to/image.png" alt="My photo" />``` |
| ```[img]http://link.to/image.png[/img]``` | ```<img src="http://link.to/image.png" />``` |
| ```[p]paragraph[/p]``` | ```<p>paragraph</p>``` |
| ```[quote]blockquote[/quote]``` | ```<blockquote><p>blockquote</p></blockquote>``` |
| ```[h=1]header 1[/h]``` | ```<h1>header 1</h1>``` |
| ```[h=2]header 2[/h]``` | ```<h2>header 2</h2>``` |
| ```[h=3]header 3[/h]``` | ```<h3>header 3</h3>``` |
| ```[h=4]header 4[/h]``` | ```<h4>header 4</h4>``` |
| ```[h=5]header 5[/h]``` | ```<h5>header 5</h5>``` |
| ```[h=6]header 6[/h]``` | ```<h6>header 6</h6>``` |
| ```[center]align by center[/center]``` | ```<div style="text-align: center">align by center</div>``` |
| ```[left]align by left[/left]``` | ```<div style="text-align: left">align by left</div>``` |
| ```[right]align by right[/right]``` | ```<div style="text-align: right">align by right</div>``` |
| ```[hr][/hr]``` | ```<hr />``` |
| ```[list][*]first[*]second[/list]``` | ```<ul><li>first</li><li>second</li></ul>``` |
| ```[list=1][*]first[*]second[/list]``` | ```<ol><li>first</li><li>second</li></ol>``` |
| ```[table][tr][td]first[/td][td]second[/td][/tr][/table]``` | ```<table class="bb-table"><tr><td>first</td><td>second</td></tr></table>``` |

## How added new BB-code

Adding new custom bbcodes to your parser is easy. For simple text-replacement bbcodes, just create a replacement string that contains {param} where the bbcode's content should go. Optionally, you may use the {option} variable for an option. 

Example:
```php
public function behaviors()
{
    return [
        ...
        
        [
            'class' => BBCodeBehavior::className(),
            'attribute' => 'content',
            'saveAttribute' => 'purified_content',
            'codeDefinitionBuilder' => [
                // as elements of array
                ['quote', '<blockquote>{param}</blockquote>'],
            
                // as class name where class is instance of extended class \JBBCode\CodeDefinitionBuilder
                '/namespace/to/CodeDefinitionBuilder/ExtendedClassName',
            
                // as extended instance of extended class \JBBCode\CodeDefinitionBuilder
                $className,
            
                // as callable function where $builder is instance of class \JBBCode\CodeDefinitionBuilder
                function($builder) {
                    $builder->setTagName('code');
                    $builder->setReplacementText('<pre>{param}</pre>');
                    return $builder->build();
                },
            ],
        ]
        ...
    ];
}        
```

Add BB-code definitions extended of class \JBBCode\CodeDefinitionSet

Example:
```php
public function behaviors()
{
    return [
        ...
        
        [
            'class' => BBCodeBehavior::className(),
            'attribute' => 'content',
            'saveAttribute' => 'purified_content',
            'codeDefinitionSet' => [
                // as class name where class is instance of extended class \JBBCode\CodeDefinitionSet
                '/namespace/to/CodeDefinitionSet/ExtendedClassName',
          
                // as extended instance of extended class \JBBCode\CodeDefinitionSet
                $className,
            ],
        ],
        
        ...
    ];
}
```

Add BB-code definitions extended of class \JBBCode\CodeDefinition

Example:
```php
public function behaviors()
{
    return [
        ...
        
        [
            'class' => BBCodeBehavior::className(),
            'attribute' => 'content',
            'saveAttribute' => 'purified_content',
            'codeDefinition' => [
                // as class name where class is instance of extended class \JBBCode\CodeDefinition
                '/namespace/to/CodeDefinition/ExtendedClassName',
    
                // as extended instance of extended class \JBBCode\CodeDefinition
                $className,
            ],
        ],
        
        ...
    ];
}
```

## HtmlPurifier

After and before parsing BB-code can aplly HtmlPurifier with different configuration. See ```bupy7\bbcode\BBCodeBehavior``` for addition information.

## License

yii2-bbcode is released under the BSD 3-Clause License.
