<?php
    /**
     *Utiliy functions
     * @return util
     */
class Util {
    //put your code here
    function __construct() {
         $this->ci =& get_instance();
    }
 
    public function plusArrayItem(&$array, $key, $value) {
        if(array_key_exists($key, $array)) {
            $array[$key] += $value;
        } else {
            $array[$key] = $value;
        }
    }

    public function searchArray($array, $key) {
        $result = 0;
        if(array_key_exists($key, $array)) 
            $result = $array[$key];
        return $result;
    }

    public function searchArrayObject($array, $search_key, $search_value, $return_key) {
        $result = 0;     
        foreach($array as $row) {
        	if(is_object($row)) $row = get_object_vars($row);
        	if(array_key_exists($search_key, $row) && array_key_exists($return_key, $row)){
        		if($row[$search_key] == $search_value) {
        			$result = $row[$return_key];
        			break;
        		}
        	}
        }
        return $result;
    }

    public function sumbArray(&$dest, $src, $keys) {
    	foreach($keys as $key)
        	$this->plusArrayItem($dest, $key, $src[$key]);
    }

    public function removeSignOfEmpty($entry) {
    	if(number_format($entry, 1) == '-0.0') $entry *= -1;
    	return $entry;
    }

    public function getYMD($date, &$year, &$month, &$day) {
        $year = 0; $month = 0; $day = 0;
        if($date != '') {
            $tmp = explode("-", $date);
            if(sizeof($tmp)>0) $year = intval($tmp[0]);
            if(sizeof($tmp)>1) $month = intval($tmp[1]);
            if(sizeof($tmp)>2) $day = intval($tmp[2]);
        }
    }

    public function getQuarter($month, &$qua1, &$qua2) {
        $qua1 = 0; $qua2 = 0;
        if($month) {
            $a = ceil($month / 3);
            $qua1 = ($a-1)*3 + 1;
            $qua2 = $qua1 + 2;
        }
    }

    public function rmR0($entry, $left=0) {
        $entry = trim($entry);
        $result = $entry;
        if($entry) {
            for($i=strlen($entry)-1;$i>=0;$i--) {
                if(($left>0 && strlen($result) == $left) || substr($entry, $i, 1) != '0') break;
                $result = substr($entry, 0, $i);
            }
        }
        return $result;
    }

    public function formatNumber(&$entry, $len=0) {
        if(is_array($entry)) {
            $this->formatNumberArray($entry, $len);
        } else if(is_object($entry)) {
            $entry = get_object_vars($entry);
            $this->formatNumber($entry, $len);
        } else if(is_numeric($entry)) {
            $entry = number_format($entry, $len);
        }
    }

    public function formatNumberArray(&$arr, $len=0) {
        if(is_array($arr)) {
            foreach ($arr as $key => &$value) {
                if(is_array($value))
                    $this->formatNumber($value, $len);
                else if(is_object($value)) {
                    $value = get_object_vars($value);
                    $this->formatNumber($value, $len);
                } else if(is_numeric($value)) {
                    $value = number_format($value, $len);
                }
            }
        } else if(is_object($arr)) {
            $arr = get_object_vars($arr);
            $this->formatNumber($arr, $len);
        } else if(is_numeric($arr)) {
            $arr = number_format($arr, $len);
        }
    }

    public function formatTableData(&$result) {
        foreach ($result as &$value) {
            if(is_array($value))
                $this->formatTableData($value);
            else{
                if(is_numeric($value) && floatval($value) == 0)
                    $value = '';
            }
        }
    }

    public function copyObject($src) {
        $dest = array();
        $a = get_object_vars($src);
        foreach ($a as $key => $value) {
            $dest[$key] = $value;
        }
        return $dest;
    }
}
?>