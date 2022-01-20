<?php

namespace App\Services;

trait Validations
{
	private static $errorArray;

	public static $CreateMember = [
		"name"				=> "required|string",
		"address"			=> "required|string",
		"phone_number"		=> "required|string|unique:members,phone_number",
		"email"				=> "required|email|unique:members,email",
		"company"			=> "string",
		"membership_cadre"	=> "string|in:fellow,member,associate,graduate,technologist,student",
		"dmn"				=> "required|string|unique:members,dmn",
		"date_joined"		=> "required|date|date_format:d-m-Y|before_or_equal:today"
	];

	public static $UpdateMember = [
		"qr_id"				=> "string",
		"name"				=> "string",
		"address"			=> "string",
		"phone_number"		=> "string",
		"email"				=> "email",
		"company"			=> "string",
		"membership_cadre"	=> "string|in:fellow,member,associate,graduate,technologist,student",
		"dmn"				=> "string|unique:members,dmn",
		"date_joined"		=> "date|date_format:d-m-Y|before_or_equal:today"
	];

	public static $CreateAdmin = [
		"name"		=> "required|string",
		"email"		=> "required|email|unique:admins,email",
		"password"	=> "required|string"
	];

	public static $LoginAdmin = [
		"email"		=> "required|email|exists:admins,email",
		"password"	=> "required"
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
