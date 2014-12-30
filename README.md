hykw-wp-extFiles
================

WordPress Plugin for accesses the external files(mainly, tag files)

## Usage

```php
hykwExtFiles::getValue('parent', 'tags', 'googleAnalytics.txt');
  ---> it retuns the contents in extFiles/tags/googleanalytics.txt

hykwExtFiles::getValue('parent', 'tags', 'foo.txt', ['{{imgPath}}' => '/img']);
  ---> it retuns the contents from the files, also it replaces the string like below:
     <img src="{{imgPath}}/hoge.png">   --> <img src="/img/hoge.png">
```
