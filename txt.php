<?php
/*
php-local-txt
PHP Localization Class

Copyright: 	(C) 2012 
Author:		Robert Gerald Porter <rob@weeverapps.com>
License: 	MIT X11

Permission is hereby granted, free of charge, to any person obtaining a copy of
this software and associated documentation files (the "Software"), to deal in
the Software without restriction, including without limitation the rights to
use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies
of the Software, and to permit persons to whom the Software is furnished to do
so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.
*/

/*

//USAGE

// Load it with this:

_txt::import_ini( $path_to_ini_file );

// ... and to call it:

echo _txt::_("MY_TEXT"); // assuming you want it echoed, of course

// The .ini file should use standard .ini conventions, as follows:

MY_TEXT = "My text"

// Make sure all strings are encapsulated with double-quotes. To use quotes-within-quotes, use &quot;

*/

final class _txt
{
  	
  	private static	$_text			= array();
  	private static 	$_instance;

  	private function __construct($ini_file_path)
  	{
  	
	    	try 
	    	{
	    	
	    		self::$_text = parse_ini_file($ini_file_path);
	    		
	    		if(!self::$_text) throw new Exception('Localization file failed to load: '.$ini_file_path);
	    		
	    	} 
	    	catch (Exception $e) 
	    	{
	    	
	    		die( $e->getMessage() );
	    	
	    	}
    	
  	}
  	
  	public static function import_ini($ini_file_path)
  	{
    	
	    	if ( self::$_instance instanceof _txt )
	      		return self::$_instance;
	      	else 
	      		self::$_instance = new self($ini_file_path);
    	
  	}
  
  	public static function _($string, $addslashes = false)
  	{
  			
  		if ( isset(self::$_text[$string]) )	
  		{
  			if ($addslashes)
  				return addslashes(self::$_text[$string]);
  			else   		
  				return self::$_text[$string];
  		}
  		else 
    		return $string;
    	
  	}
  	
}