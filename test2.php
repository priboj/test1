<?php
/**
 * Created by PhpStorm.
 * User: Gabor
 * Date: 10.3.2016.
 * Time: 9:32
 */

class table {
    private $myfile;
    private $myarray;
    private $incolumns;
    private $columns;

    function __construct ($filename = './textfile.txt', $columns = 4){
        // set number of columns
        $this->columns = $columns;
        // open the file
        $this->myfile = file_get_contents($filename, FILE_USE_INCLUDE_PATH);
        // call function to setting the array
        $this->setarray();
        // count of elements in column
        $this->incolumns = ceil(count($this->myarray)/$this->columns);
        // do loop
        $this->myloop($this->columns);
    }

    private function setarray (){
        // file to array
        $this->myarray = array_count_values(str_word_count($this->myfile, 1));
        // sort array
        ksort($this->myarray);
    }

    private function myloop(){
        // counter of elements
        $i = 1;
        // counter of columns
        $c = 1;
        // show the header of column
        echo $this->divhead();
        // the loop
        while (list($var, $val) = each($this->myarray)) {
            // display the row of column
            echo $this->elementrow($var,$val);
            $i++;
            // check if it is end of column
            if ($i > $this->incolumns){
                // check number of column
                if ($c < $this->columns){
                    // show the end of column
                    echo $this->divend();
                    // show the head of new column
                    echo $this->divhead();
                }
                // reset the elements counter
                $i = 1;
                // next column
                $c++;
            }
        }
        // show the end of column
        echo $this->divend();
    }

    private function divhead(){
        // show the html head of column
        return "<div style='float:left;border:solid black;border-width: 1px;padding: 3px;width: 150px'>\n";
    }

    private function elementrow($var, $val){
        // show the row of column
        return "<div style='display: inline'>$var</div><div style='display: inline;float: right;'>$val</div><div style='clear: both'></div>";
    }

    private function divend (){
        // show the end of column
        return "</div>";
    }

}

new table();
?>