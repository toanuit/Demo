
<?php

/**
 * php-excel
 * 
 * The MIT License
 * Copyright (c) 2007 Oliver Schwarz
 * Permission is hereby granted, free of charge, to any person
 * obtaining a copy of this software and associated documentation
 * files (the "Software"), to deal in the Software without
 * restriction, including without limitation the rights to use,
 * copy, modify, merge, publish, distribute, sublicense, and/or
 * sell copies of the Software, and to permit persons to whom the
 * Software is furnished to do so, subject to the following
 * conditions:
 *
 * The above copyright notice and this permission notice shall be
 * included in all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND,
 * EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES
 * OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND
 * NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT
 * HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY,
 * WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING
 * FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR
 * OTHER DEALINGS IN THE SOFTWARE.
 */
require('dbcon.inc');
// include the php-excel class
require (dirname (__FILE__) . "/class-excel-xml.inc.php");
$doc = array (
    1 => array (),
         array (),
    );
    $i=0; $l=1;
    $k=1;
    while ($l<41){
        $j=0;
        $result = mysql_query("SELECT * FROM thuebao ORDER BY VITRI_ANALOG ASC LIMIT $i , 8");
        $doc[$k][$j]= $l;
        $doc[$k+1][$j]= "";
        $doc[$k+2][$j]= "";
        $doc[$k+3][$j]= "";
        $doc[$k+4][$j]= "";
        $doc[$k+5][$j]= "";
        while($row = mysql_fetch_array($result)){
            $result_db=mysql_query("SELECT * FROM danhba WHERE SODT = '$row[SODT]'");
            $row_db = mysql_fetch_array($result_db);
            $doc[$k][$j+1]= $j+1;
            $doc[$k+1][$j+1]= $row[SHELL];
            $doc[$k+2][$j+1]= $row_db[TENTB];
            $doc[$k+3][$j+1]= $row_db[TENDV];
            $doc[$k+4][$j+1]= $row_db[SODT];
            $doc[$k+5][$j+1]= "";
            $j+=1;
            }
        mysql_free_result($result_db);
        $k+=6;
        $l+=1;
        $i+=8;
    };
    mysql_free_result($result);
    //print_r($doc);
    $day=date("d/m/y");
// create a dummy array
/* $doc = array (
    1 => array ("Oliver", "Peter", "Paul","Oliver", "Peter", "Paul"),
         array ("Marlene", "Lucy", "Lina","Oliver", "Peter", "Paul","Oliver", "Peter", "Paul"),
         array ("Marlene", "Lucy", "Lina","Oliver", "Peter", "Paul","Oliver", "Peter", "Paul"),
         array ()
         array ("Marlene", "Lucy", "Lina","Oliver", "Peter", "Paul","Oliver", "Peter", "Paul")
    );
*/
// generate excel file
$xls = new Excel_XML('UTF-8', false, 'Workflow Management');
$xls->addArray ( $doc );
$xls->generateXML ("tongdai"."-".$day."-");

?>