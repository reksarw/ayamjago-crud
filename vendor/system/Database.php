<?php 
if(!defined("RUN")) exit; // Keep silent

/**
 * AyamJago Database Class
 *
 * @package	System
 * @file	Database.php
 * @author	Reksa Rangga Wardhana <reksarw@gmail.com>
 * @since	Version 1.0
 */


class AJ_Database {
	
	private
		$type,
		$command,
		$result,
		$pdo;
	
	public function __construct()
	{
		$this->catchErr =& take_class("Handler");
		
		if(!extension_loaded('PDO'))
			exit("Install PDO terlebih dahulu untuk menggunakan class database");
		
		if(!file_exists(APP."config/database.php"))
			exit("database.php tidak ditemukan pada file ".APP."config/");

		include APP."config/database.php";
		
		$hostname = $database['hostname'];
		$dbname = $database['dbname'];
		
		try 
		{
			$this->pdo = new PDO("mysql:host=$hostname;dbname=$dbname", $database['username'], $database['password']);
			$this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}
		catch(Exception $e)
		{
			$this->catchErr->show_error('Critical Error!',$e->getMessage(),$e->getMessage());
			exit;
		}
		
		return $this->pdo;
	}
	
	public function query($sql)
	{
		$x = explode(" ",$sql);
		
		if(strtolower($x[0]) == "select"){
			$this->type = 'select';
			$this->command = $sql;
			
			return $this;
		}
		
		try{
			$query = $this->pdo->prepare($sql);
			$query->execute();
			
			return $query->rowCount();
		}catch(Exception $e){
			$this->catchErr->show_error('Critical Error!',$e->getMessage(),$e->getMessage());
			exit;
		}
	}
	
	public function num_rows()
	{
		if($this->type == 'select')
		{
			try
			{
				$query = $this->pdo->prepare($this->command);
				$query->execute();
				
				return $query->rowCount();
			}catch(Exception $e)
			{
				$this->catchErr->show_error('Critical Error!',$e->getMessage(),$e->getMessage());
				exit;
			}
		}
	}
	
	public function select($table,$fields = '*')
	{
		$tb = (string) $table;
		
		if(!empty($tb))
		{
			$this->type = 'select';
			$this->command = "SELECT ".$fields." FROM ".$table;
		}
		
		return $this;
	}
	
	public function where($where)
	{
		if(!empty($where))
		{
			if($this->type == 'select')
				$this->type = 'select';
			elseif($this->type == 'delete')
				$this->type = 'delete';
			elseif($this->type == 'udpate')
				$this->type = 'update';
			
			$this->command .= " WHERE ".$where;
		}
		
		return $this;
	}
	
	public function limit($limit)
	{
		if(!empty($limit) or is_int($limit))
		{
			$this->type = 'select';
			$this->command .= " LIMIT ".(int) $limit;
		}
		
		return $this;
	}
	
	public function order($column,$sort = 'ASC')
	{
		if(!empty($column))
		{
			$this->type = 'select';
			$this->command .= " ORDER BY ".$column." ".$sort;
		}
		
		return $this;
	}
	
	public function insert($table)
	{
		if(!empty($table))
		{
			$this->type = 'insert';
			$this->command = "INSERT INTO ".$table;
		}
		
		return $this;
	}
	
	public function update($table)
	{
		if(!empty($table))
		{
			$this->type = 'update';
			$this->command = "UPDATE ".$table;
		}
		
		return $this;
	}
	
	public function delete($table)
	{
		if(!empty($table))
		{
			$this->type = 'delete';
			$this->command = "DELETE FROM ".$table;
		}
		
		return $this;
	}
	
	public function set($field = null)
	{
		if(!empty($field) && is_array($field))
		{
			$this->type = 'update';
			$this->command .= " SET ";
			
			$set = null;
			$value = null;
			
			foreach($field as $key => $values)
			{
				$set .= ', '.$key. ' = :'.$key;
				$value .= ', ":'.$key.'":"'.$values.'"';
			}
			
			$this->command .= substr(trim($set),1);
			$this->_val = '{'.substr($value,1).'}';
			$this->_update_param = json_decode($this->_val,true);
		}
		
		return $this;
	}
	
	final public function getFirstId()
	{
		$func = func_get_args();
		
		if(count($func) == 2 || count($func) == 3)
		{
			$allocation = array();
			
			while($x = each($func))
			{
				$allocation[] = $x['value'];
			}
			
			$this->tableLastId = $allocation[0];
			$this->columnLastId = $allocation[1];
			$this->returnType = empty($allocation[2]) ? 'array' : $allocation[2];
			
			$this->command = "SELECT * FROM ".$this->tableLastId." ORDER BY ".$this->columnLastId." ASC LIMIT 1";
			
			try{
			$query = $this->pdo->prepare($this->command);
			$query->execute();
			
			if($this->returnType == 'array')
			{
				while($row = $query->fetch(PDO::FETCH_ASSOC))
				{
					$this->result = $row;
					return $this->result;
				}
				
			}
			elseif($this->returnType == 'object')
			{
				while($row = $query->fetch(PDO::FETCH_OBJ))
				{
					$this->result = $row;
					return $this->result;
				}
			}
			}catch(Exception $e)
			{
				$this->catchErr->show_error('Critical Error!',$e->getMessage(),$e->getMessage());
				exit;
			}
		}
		
		return FALSE;
	}
	
	final public function getLastId()
	{
		$func = func_get_args();
		
		if(count($func) == 2 || count($func) == 3)
		{
			$allocation = array();
			
			while($x = each($func))
			{
				$allocation[] = $x['value'];
			}
			
			$this->tableLastId = $allocation[0];
			$this->columnLastId = $allocation[1];
			$this->returnType = empty($allocation[2]) ? 'array' : $allocation[2];
			
			$this->command = "SELECT * FROM ".$this->tableLastId." ORDER BY ".$this->columnLastId." DESC LIMIT 1";
			
			try{
				
			$query = $this->pdo->prepare($this->command);
			$query->execute();
			
			if($this->returnType == 'array')
			{
				while($row = $query->fetch(PDO::FETCH_ASSOC))
				{
					$this->result = $row;
					return $this->result;
				}
				
			}
			elseif($this->returnType == 'object')
			{
				while($row = $query->fetch(PDO::FETCH_OBJ))
				{
					$this->result = $row;
					return $this->result;
				}
			}
			}catch(Exception $e)
			{
				$this->catchErr->show_error('Critical Error!',$e->getMessage(),$e->getMessage());
				exit;
			}
		}
		
		return FALSE;
	}
	
	final public function values($values = array())
	{
		if(!is_array($values))
			return $values;
		
		if($this->type == 'insert')
		{
			$this->insert = $values;
			
			$row = null ; $value = null;
			
			foreach($this->insert as $key => $val)
			{
				$row .= ",".$key;
				$value .= ", :".$key;
			}
			
			$this->command .="(".substr($row,1).")";
			$this->command .="VALUES(".substr($value,1).")";
		}
		
		return $this;
	}
	
	final public function run()
	{
		if($this->type == 'insert')
		{
			try
			{
				$query = $this->pdo->prepare($this->command);
				$query->execute($this->insert);
				
				$this->result = $query->rowCount();
				
				return $this->result;
			}catch(Exception $e)
			{
				$this->catchErr->show_error('Critical Error!',$e->getMessage(),$e->getMessage());
				exit;
			}
		}
		
		if($this->type == 'delete')
		{
			try
			{
				$query = $this->pdo->prepare($this->command);
				$query->execute();
				
				return $query->rowCount();
			}catch(Exception $e)
			{
				$this->catchErr->show_error('Critical Error!',$e->getMessage(),$e->getMessage());
				exit;
			}
		}
		
		if($this->type == 'update')
		{
			try
			{
				$query = $this->pdo->prepare($this->command);
				$query->execute($this->_update_param);
				
				return $query->rowCount();
			}catch(Exception $e)
			{
				$this->catchErr->show_error('Critical Error!',$e->getMessage(),$e->getMessage());
				exit;
			}
		}
	}
	
	final public function resultOne($type = 'array')
	{
		if ( $this->type == 'select')
		{
			try{
				$query = $this->pdo->prepare($this->command);
				$query->execute();
			}catch(Exception $e)
			{
				$this->catchErr->show_error('Critical Error!',$e->getMessage(),$e->getMessage());
				exit;
			}
			
			if($type == 'array')
			{
				$this->result = $query->fetch(PDO::FETCH_ASSOC);
				
				if ( $query->rowCount() > 0 )
				{
					return $this->result;
				}
				else
				{
					return 0;
				}
			}
			else
			{
				$this->result = $query->fetch(PDO::FETCH_OBJ);
				
				if ( $query->rowCount() > 0 )
				{
					return $this->result;
				}
				else
				{
					return 0;
				}
			}
		}
	}
	
	final public function result($type = 'array')
	{
		if($this->type == 'select')
		{
			try{
				$query = $this->pdo->prepare($this->command);
				$query->execute();
			}catch(Exception $e)
			{
				$this->catchErr->show_error('Critical Error!',$e->getMessage(),$e->getMessage());
				exit;
			}
			
			if($type == 'array')
			{
				while($row = $query->fetch(PDO::FETCH_ASSOC))
				{
					$this->result[] = $row; 
				}
				
				return $this->result;
			}
			else
			{
				while($row = $query->fetch(PDO::FETCH_OBJ))
				{
					$this->result[] = $row;
				}
				
				return $this->result;
			}
		}
	}
}

/*
 * Location :./vendor/system/Database.php
 */