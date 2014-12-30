hykw-wp-extFiles
================

WordPress Plugin for accesses the external files(mainly, tag files)

## Usage

```php
hykwExtFiles::getValue('parent', 'tags', 'googleAnalytics');
  ---> it retuns the contents in extFiles/tags/googleanalytics.txt

hykwExtFiles::getValue('parent', 'tags', 'foo', ['{{imgPath}}' => '/img']);
  ---> it retuns the contents, and replace the string like below
     <img src="{{imgPath}}/hoge.png">   --> <img src="/img/hoge.png">
```
