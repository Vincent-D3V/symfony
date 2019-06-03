<?php
/**
 * Created by PhpStorm.
 * User: wilder
 * Date: 03/06/19
 * Time: 10:34
 */
namespace App\Service;

class Slugify
{
 public function generate(string $input) : string
 {
     $input = html_entity_decode($input, ENT_QUOTES, 'UTF-8');
     // replace non letter or digits by -
     $input = str_replace("'","",$input);
     $input = preg_replace('~[^\\pL\d.]+~u', '-', $input);
     // trim
     $input = trim($input, '-');
     // setlocale(LC_CTYPE, 'en_GB.utf8');
     setlocale(LC_CTYPE, 'fr_FR.utf8');
     // transliterate
     if (function_exists('iconv')) {
         $input = iconv('utf-8', 'us-ascii//TRANSLIT', $input);
     }
     // lowercase
     $input = strtolower($input);
     // remove unwanted characters
     $input = preg_replace('~[^-\w.]+~', '', $input);
     if (empty($input)) {
         return 'empty_$';
     }
     // if ($strict) {
     //     $input = str_replace(".", "_", $input);
     // }
     return $input;
 }
}