# yii2-bbcode

Behavior for parsing BB-codes at base jBBCode and HtmlPurifier for Yii2.
This behavior very simple expand under your demands.
Behavior of use [jBBCode](http://jbbcode.com) and [HtmlPurifier](http://htmlpurifier.org/).

##Installation
The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run
```
$ php composer.phar require bupy7/yii2-bbcode "dev-master"
```

or add
```
"bupy7/yii2-bbcode": "dev-master"
```

to the **require** section of your **composer.json** file.

## Support BB-codes

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
| ```[quote]blockquote[/quote]``` | ```<blockquote></blockquote>``` |
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
