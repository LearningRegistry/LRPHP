<?php
// @package LR-PHP
// @copyright 2011 Jeffrey Hill
// @license Apache 2.0 License http://www.apache.org/licenses/LICENSE-2.0.html
defined('LREXEC') or die('Access denied');

require_once(LRDIR.DS.'request.php');
require_once(LRDIR.DS.'utility.php');

class LRService
{
    var $data;
    var $action;
    var $args;
    var $verb;
    var $verbs;
    
    public function __construct()
    {
        $this->verbs = array('default'=>new LRRequest);
    }
    
	public function getArgs()
	{
		return $this->args;
	}
	
    public function setArgs($args)
    {
        foreach($args as $k=>$v)
        {
            $arg = $this->verbs[$this->verb]->$k;
            if(!empty($arg))
            {
                // format indicator in service declaration
                if(LR::$debug) print_r($arg);
                $format = "_".$arg[1];
                $this->args->$k = LRUtility::$format($v);
                if(LR::$debug) echo $k.'>'.$this->args->$k.'<br />';
            }
        }
    }
    
    public function unsetArgs($k)
    {
        $k = (array) $k;
        foreach($k as $kk)
        {
            if(in_array($kk, array_keys($this->verbs[$this->verb])))
            {
                unset($this->args->$kk);
            }
        }
    }
    
    public function getVerb()
    {
        return $this->verb;
    } 
    
    public function setVerb($verb)
    {
        if(!in_array($verb,array_keys($this->verbs))) return false;
        $this->verb = $verb;
    }
}
