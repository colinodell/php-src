--TEST--
Test fwrite() function : null length
--FILE--
<?php
/*
 Prototype: int fwrite ( resource $handle,string string, [, int $length] );
 Description: fwrite() writes the contents of string to the file stream pointed to by handle.
              If the length arquement is given,writing will stop after length bytes have been
              written or the end of string reached, whichever comes first.
              fwrite() returns the number of bytes written or FALSE on error
*/


echo "*** Testing fwrite() with a null length ***\n";

// include the file.inc for Function: function delete_file($filename)
include ("file.inc");

$filename = __DIR__."/fwrite_variation5.tmp"; // this is name of the file

$file_handle = fopen($filename, 'w');
if (!$file_handle) {
    echo "Error: failed to fopen() file: $filename!";
    exit();
}

$data_to_be_written="";
fill_buffer($data_to_be_written, 'numeric', 1024);  //get the data of size 1024

// fwrite() without length parameter
var_dump( fwrite($file_handle, $data_to_be_written)); //int(1024)
var_dump( ftell($file_handle) );  // expected: 1024
var_dump( feof($file_handle) );  // expected: false

// close the file, get the size and content of the file.
var_dump( fclose($file_handle) ); //expected : true
clearstatcache();//clears file status cache
var_dump( filesize($filename) );  // expected:  1024
var_dump(md5(file_get_contents($filename))); // hash the output

// delete the file created : fwrite_variation5.tmp
delete_file($filename);

echo "Done\n";
?>
--EXPECT--

*** Testing fwrite() with a null length ***
int(1024)
int(1024)
bool(false)
bool(true)
int(1024)
string(32) "950b7457d1deb6332f2fc5d42f3129d6"
Done
