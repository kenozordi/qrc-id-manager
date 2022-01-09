<?php

namespace App\Services;

trait Validations
{
	private static $errorArray;

	public static $CreateMember = [
		"name"				=> "required|string",
		"address"			=> "required|string",
		"phone_number"		=> "required|string",
		"email"				=> "required|email",
		"company"			=> "string",
		"membership_cadre"	=> "string|in:fellow,member,associate,graduate,technologist,student",
		"dmn"				=> "required|string|unique:members,dmn",
		"date_joined"		=> "required|date|date_format:d-m-Y|before_or_equal:today"
	];

	/**
	 * Error message method
	 * @param Mixed $errorArray
	 * @return Mixed or null
	 */
	public static function formatError($errorArray)
	{
		Validations::$errorArray = collect($errorArray);
		$newErrorFormat = Validations::$errorArray->map(function ($error) {
			return $error[0];
		});
		return $newErrorFormat;
	}
}
