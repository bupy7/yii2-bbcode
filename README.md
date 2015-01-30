# yii2-bbcode

## Examples

| **BB-code** | **HTML**  |
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

<table>
  <tr>
    <td>
      ```
      [list]
        [*]first
        [*]second
      [/list]
      ```
    </td>
    <td>
      ```
      <ul>
        <li>first</li>
        <li>second</li>
      </ul>
      ```
    </td>
  </tr>
  <tr>
    <td>
      ```
      [list=1]
        [*]first
        [*]second
      [/list]
      ```
    </td>
    <td>
      ```
      <ol>
        <li>first</li>
        <li>second</li>
      </ol>
      ```
    </td>
  <tr>
</table>
