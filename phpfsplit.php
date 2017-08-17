<?php
/**
 * A file splitter function for php
 * Can split a file to number of parts depending on the buffer size given
 * 
 * @author manujith pallewatte [manujith.nc@gmail.com]
 * @date   30/10/13
 *  * 
 * @param  $file String
 * Path of the file to split
 * @param $buffer number
 * The [maximum] size of the part of a file
 * @return array S
 * et of strings containing the paths to the parts
 */
function fsplit($file,$buffer=1024){
    //open file to read
    $file_handle = fopen($file,'r');
    //get file size
    $file_size = filesize($file);
    //no of parts to split
    $parts = $file_size / $buffer;
    
    //store all the file names
    $file_parts = array();
    
    //path to write the final files
    $store_path = "/var/www/html/phpfsplit/splits/";
    
    //name of input file
    $file_name = basename($file);
//    $total_array = array();
    for($i=0;$i<$parts;$i++){
        //read buffer sized amount from file
        $file_part = fread($file_handle, $buffer);
        //the filename of the part
        $file_part_path = $store_path.$file_name.".part$i";
        //open the new file [create it] to write
        $file_new = fopen($file_part_path,'w+');
        //write the part of file
        //$total_array[] = $file_part;
        print_r(explode(PHP_EOL, $file_part));
        fwrite($file_new, $file_part);
        //add the name of the file to part list [optional]
        array_push($file_parts, $file_part_path);
        //close the part file handle
        fclose($file_new);
    }    
    //close the main file handle
    
    fclose($file_handle);
  //  print_r($total_array);exit;
    exit;
    return $file_parts;
}


function fchunk($file, $noofLines)
{
    $file_handle = fopen($file,'r');
    $parts = $noofLines / 1000000;
    $file_content = file($file);
    $total_array = array_splice($file_content,20);
    $totalcount($total_array);
    print_r(count($total_array));die;    
}