<?php
/*
  Plugin Name: HYKW external file access plugin
  Plugin URI: https://github.com/hykw/hykw-wp-extFiles
  Description: WordPress の 外部ファイルアクセスプラグイン
  Author: hitoshi-hayakawa
  Version: 1.1.0
*/


/**
 * $obj = new hykwExtFiles('extFiles')
 *   → テーマディレクトリ/extFiles/ファイル種別/キー.txt から値を取得する
 *
 */
class hykwExtFiles
{
  const EXT_DIR = 'extFiles';

  /**
   * 指定親子テーマ・ファイル種別・キーのファイルの中身を返す
   *
   * 親/子テーマファイルの下の
   *
   *
   *
   * @access public
   * @param string $parentChild 親か子（"parent" or "child")
   * @param string $fileType ファイル種別（e.g. "tags")
   * @param string $key キー
   * @param array $replaced  置換対象の文字列（e.g.  ['{{imgPath}}' => '/img']なら、{{imgPath}}が/imgに置換される)
   * @param boolean $onErrorThrow TRUEならエラーの時に例外を投げる
   * @param mixed $errorReturn エラーの時に返す値（$onErrorThrow=FALSEの場合のみ有効）
   *
   * @return String ファイルの中身
   */
  public static function getValue($parentChild, $fileType, $key, $replaced = Array(), $onErrorThrow = TRUE, $errorReturn = FALSE)
  {
    switch ($parentChild) {
    case 'parent':
      $theme_dir = get_template_directory();
      break;
    case 'child':
      $theme_dir = get_stylesheet_directory();
      break;
    default: 
      if ($onErrorThrow)
        throw new Exception('Unknown $parentChild');
      else
        return $errorReturn;
    }

    $baseDir = sprintf('%s/%s', $theme_dir, self::EXT_DIR);
    $keyFile = sprintf('%s/%s/%s', $baseDir, $fileType, $key);
    if (!file_exists($keyFile)) {
      if ($onErrorThrow)
        throw new Exception(sprintf('File not found: %s', $keyFile));
      else
        return $errorReturn;
    }
    $contents = file_get_contents($keyFile);

    # 指定文字列を置換
    foreach ($replaced as $key => $value) {
      $contents = str_replace($key, $value, $contents);
    }

    return $contents;
  }
}

