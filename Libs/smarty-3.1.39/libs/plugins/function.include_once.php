<?php
// added by fourat

/**
 * Smarty include_once function plugin
 *
 * Type:     function
 * Name:     include_once
 * Purpose:  include a file only one time
 * @file string
 * @return string
 */
function smarty_function_include_once($param, $smarty)
{
   static $includedFiles = array();

   $returnedData = '';
   if (!in_array($param['file'], $includedFiles)) {
      $returnedData = $smarty->fetch($param['file']);
      $includedFiles[] = $param['file'];
   }

   return $returnedData;
}

?>
