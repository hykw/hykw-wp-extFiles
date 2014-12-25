<?php
/*
  Plugin Name: HYKW external file access plugin
  Plugin URI: https://github.com/hykw/hykw-wp-extFiles
  Description: WordPress の 外部ファイルアクセスプラグイン
  Author: hitoshi-hayakawa
  Version: 1.0.0
*/

class hykwExtFiles
{
  private static $extDir = 'extFiles';
  private static $keyFile_suffix = 'txt';

  /**
   * $obj = new hykwExtFiles('extFiles')
   *   → テーマディレクトリ/extFiles/ファイル種別/キー.txt から値を取得する
   * 
   * @param String $extDir  外部ファイルを置くディレクトリ
   */

  function __construct($extDir = 'extFiles', $suffix = 'txt')
  {
    $this->extDir = $extDir;
    $this->keyFile_suffix = $suffix;
  }

  /**
   * 指定親子テーマ・ファイル種別・キーのファイルの中身を返す
   *
   * 親/子テーマファイルの下の
   *
   *
   *
   * @access public
   * @param String $parentChild 親か子（"parent" or "child")
   * @param String $fileType ファイル種別（e.g. "tags")
   * @param String $key キー
   *
   * @return String ファイルの中身
   */
  public static function getValue($parentChild, $fileType, $key)
  {
    switch ($parentChild) {
    case 'parent':
      $theme_dir = get_template_directory();
      break;
    case 'child':
      $theme_dir = get_stylesheet_directory();
      break;
    default: 
      throw new Exception('Unknown $parentChild');
    }

    $baseDir = sprintf('%s/%s/', $theme_dir, $this->extDir);
    $keyFile = sprintf('%s/%s/%s.%s', $baseDir, $fileType, $key, $this->keyFile_suffix);
    if (!file_exists($keyFile)) {
      throw new Exception(sprintf('File not found: %s', $keyFile));
    }
    $contents = file_get_contents($keyFile);
    return $contents;
  }
}

