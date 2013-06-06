<?php
////////////////////////////////////////////////////////////////////////////////////////////////////
////	File:
////		array.php
////	Actions:
////		1) functions for dealing with arrays
////	Account:
////		Added on May 9th 2006 for ternstyle (tm) v1.0.0
////
////	Written by Matthew Praetzel. Copyright (c) 2006 Matthew Praetzel.
////////////////////////////////////////////////////////////////////////////////////////////////////

/****************************************Commence Script*******************************************/

if(!class_exists('arrayFixes')) {
//
class arrayFixes {

	function sortMulti($a,$c,$t,$o,$p=false) {
		$r = array();
		for($i=0;$i<count($a);$i++) {
			if(empty($r)) {
				$r[] = $a[$i];
			}
			else {
				for($b=0;$b<count($r);$b++) {
					if($t == "str") {
						if(strcmp(strtolower($a[$i][$c]),strtolower($r[$b][$c])) < 0) {
							$n = array($a[$i]);
							array_splice($r,$b,0,$n);
							break;
						}
						elseif(strcmp(strtolower($a[$i][$c]),strtolower($r[$b][$c])) > 0 and $b == (count($r)-1)) {
							array_push($r,$a[$i]);
							break;
						}
					}
					elseif($t == "num") {
						if($a[$i][$c] < $r[$b][$c] or $a[$i][$c] == $r[$b][$c]) {
							$n = array($a[$i]);
							array_splice($r,$b,0,$n);
							break;
						}
						elseif($a[$i][$c] > $r[$b][$c] and $b == (count($r)-1)) {
							array_push($r,$a[$i]);
							break;
						}
					}
				}
			}
		}
		if($o == "desc") {
			$r = is_array($r) ? array_reverse($r) : array();
		}
		return $r;
	}
	//type, array, field 1, field 2, separator, name
	function combineTwoFields($t,$a,$f,$g,$s,$n) {
		$a = is_array($a) ? $a : array();
		if($t == "multi/assoc") {
			foreach($a as $k => $v) {
				foreach($v as $l => $w) {
					if($l != $f or $l != $g) {
						$b[$k][$l] = $w;
					}
				}
				$b[$k][$n] = $a[$k][$f] . $s . $a[$k][$g];
			}
		}
		return $b;
	}
	function rearrangeIndices($array,$index_name,$item_serial,$altered_item,$altered_item_index) {
		foreach($array as $value) {
			if($value[$item_serial] == $altered_item) {
				$current_index = $value[$index_name];
				$greater = $value[$index_name] > $altered_item_index ? 0 : 1;
			}
		}
		foreach($array as $value) {
			if($value[$item_serial] == $altered_item) {
				$this_item = $value[$item_serial];
				$index_array[$this_item] = $altered_item_index;
			}
			else {
				if($greater == 0) {
					if($value[$index_name] > $altered_item_index or $value[$index_name] < $current_index) {
						$this_item = $value[$item_serial];
						$index_array[$this_item] = strval(intval($value[$index_name]+1));
					}
				}
				elseif($greater == 1) {
					if($value[$index_name] < $altered_item_index or $value[$index_name] > $current_index) {
						$this_item = $value[$item_serial];
						$index_array[$this_item] = strval(intval($value[$index_name]-1));
					}
				}
			}
		}
		return $index_array;
	}
	function replaceValueWithAnotherArrayValue($array,$change_key,$value_key) {
		$array_count = count($array);
		for($i=0;$i<$array_count;$i++) {
			$value = current($array);
			foreach($value as $key => $value2) {
				if($key == $change_key) {
					foreach($value as $key2 => $value3) {
						if($key2 == $value_key) {
							$array[$i][$key] = $value3;
						}
					}
					break;
				}
			}
			next($array);
		}
		return $array;
	}
	function removeMultiDimension($a,$k) {
		$b = array();
		for($i=0;$i<count($a);$i++) {
			$b[] = $a[$i][$k];
		}
		return $b;
	}
	function removeDuplicates($array) {
		$array_values = array();
		foreach($array as $value) {
			if(array_search($value,$array_values) >= 0 and array_search($value,$array_values) !== false) {
				
			}
			else {
				$array_values[] = $value;
			}
		}
		return $array_values;
	}
	function removeDuplicatesByField($array,$field) {
		$array_values = array();
		$break = 0;
		foreach($array as $value) {
			foreach($array_values as $value2) {
				if($value[$field] == $value2[$field]) {
					$break = 1;
					break;
				}
			}
			if($break == 0) {
				$array_values[] = $value;
			}
			$break = 0;
		}
		return $array_values;
	}
	function removeEmptyValues($a,$p=true) {
		$b = array();
		if(is_array($a)) {
			foreach($a as $k => $v) {
				if(!empty($v)) {
					if($p) {
						$b[$k] = $v;
					}
					else {
						$b[] = $v;
					}
				}
			}
		}
		return $b;
	}
	function sortByLength($a,$o='asc') {
		$b = array();
		foreach($a as $v) {
			if(empty($b)) {
				$b[] = $v;
			}
			else {
				for($i=0;$i<count($b);$i++) {
					if(strlen($v) < strlen($b[$i])) {
						array_splice($b,$i,0,$v);
						break;
					}
					elseif($i == (count($b)-1)){
						array_push($b,$v);
						break;
					}
				}
			}
		}
		if($o == 'desc') {
			return array_reverse($b);
		}
		return $b;
	}

}
$getFIX = new arrayFixes;
//
}

/****************************************Terminate Script******************************************/
?>