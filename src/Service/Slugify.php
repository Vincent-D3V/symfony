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
     return $input;
 }
}