<?php

class Home {

	function __construct($inputString){
		$this->inputString = $inputString;
	}

	/**
	http://local.mvc.com/Home/Palindrome/madam
	Controller function to check Palindrome
	return : true if string is palindrome, false if it is not palindrome
	*/
	function Palindrome(){

		//Find length of the input string
		$strLen = strlen($this->inputString);
		$reverseString = '';

		//Reverse a string without using strrev() method
		for($i = $strLen-1; $i >= 0; $i--){

			$reverseString .= strtolower($this->inputString[$i]);
		}

		//Check if original and new strings are equal
		if($this->inputString == $reverseString){
			return true;
		}
		else {
			return false;
		}
	}

	/**
	http://local.mvc.com/Home/Reverse/Hello World
	Controller to Reverse a string
	return : new string after reverse
	*/
	function Reverse(){

		$reverseString = '';

		//Find length of the input string
		$strLen = strlen($this->inputString);

		//Reverse a string without using strrev() method
		for($i = $strLen-1; $i >= 0; $i--){

			$reverseString .= strtolower($this->inputString[$i]);
		}

		return $reverseString;
	}
}

?>