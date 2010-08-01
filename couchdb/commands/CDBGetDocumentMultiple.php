<?php
/**
 *    CouchDB_PHP
 * 
 *    Copyright (C) 2009 Adam Venturella
 *
 *    LICENSE:
 *
 *    Licensed under the Apache License, Version 2.0 (the "License"); you may not
 *    use this file except in compliance with the License.  You may obtain a copy
 *    of the License at
 *
 *    http://www.apache.org/licenses/LICENSE-2.0
 *
 *    This library is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; 
 *    without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR 
 *    PURPOSE. See the License for the specific language governing permissions and
 *    limitations under the License.
 *
 *    Author: Adam Venturella - aventurella@gmail.com
 *
 *    @package CouchDB_PHP
 *    @author Adam Venturella <aventurella@gmail.com>
 *    @copyright Copyright (C) 2009 Adam Venturella
 *    @license http://www.apache.org/licenses/LICENSE-2.0 Apache 2.0
 *
 **/

/**
 * Includes
 */
require_once 'CouchDBCommand.php';

/**
 * Get Document Command
 *
 * @package Commands
 * @author Adam Venturella
 */
class CDBGetDocumentMultiple implements CouchDBCommand 
{
	private $database;
	private $keys;
	private $options;
	/**
	 * undocumented function
	 *
	 * @param string $database 
	 * @param string $id 
	 * @author Adam Venturella
	 */
	public function __construct($database, $keys, $options)
	{
		$this->database = $database;
		$this->keys     = $keys;
		$this->options  = $options;
	}
	
	public function request()
	{
		$options = null;
		if(!empty($this->options))
		{
			$options .= '?';
			$this->options = array_map("couchdb_json_encode", $this->options);
			$options .= http_build_query($this->options);
			
		}
		
		return <<<REQUEST
POST /$this->database/_all_docs$options HTTP/1.0
Host: {host}
Connection: Close
{authorization}


REQUEST;
	}
	
	public function __toString()
	{
		return 'GetDocumentMultiple';
	}
}
?>