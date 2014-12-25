hykw-wp-extFiles
================

WordPress Plugin for accesses the external files(mainly, tag files)

- Usage:
    $obj = new hykwExtFiles(); 
    $obj->getValue('parent', 'tags', 'googleAnalytics')
      ---> it retuns the contents in extFiles/tags/googleanalytics.txt
