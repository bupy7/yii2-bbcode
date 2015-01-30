# yii2-bbcode

### Examples

| **BB-code** | **HTML**  | **Result** |
|-------------|-----------|------------|
| [b]bold[/b] | ```<strong>bold</strong>```
| [i]italic[/i] | ```<em>italic</em>```
| [u]underline[/u] | ```<u>underline</u>```
| ```
[list]<br>[\*]first
[\*]second<br>[/list]
``` |
| ```[list=1]<br>[\*]first<br>[\*]second<br>[/list]``` |
| [url=http://github.com]GitHub[/url] |
| [color=red]color[/color] |
| [img=My photo]http://link.to/image.png[/img] |
| [p]paragraph[/p] |
| [quote]blockquote[/quote] |
| [h=1]header 1[/h]<br>[h=2]header 2[/h]<br>[h=3]header 3[/h]<br>[h=4]header 4[/h]<br>[h=5]header 5[/h]<br>[h=6]header 6[/h] |
| [center]align by center[/center] |
| [left]align by left[/left] |
| [right]align by right[/right] |
| [hr][/hr] |

Bold:
```
[b]bold text[/b]
```
Result:
<strong>bold text</strong>

```
[i]italic text[/i]
[u]underline[/u]

[list]
[*]first
[*]second
[/list]

[list=1]
[*]first
[*]second
[/list]

[url=http://github.com]GitHub[/url]

[color=red]color[/color]

[img=My photo]http://link.to/image.png[/img]

[p]paragraph[/p]

[quote]blockquote[/quote]

[h=1]header 1[/h]
[h=2]header 2[/h]
[h=3]header 3[/h]
[h=4]header 4[/h]
[h=5]header 5[/h]
[h=6]header 6[/h]

[center]align text by center[/center]
[left]align text by left of edge[/left]
[right]align text by right of edge[/right]

[hr][/hr]
```
