<?php

namespace App\Services;

use App\Models\Member;

class MemberService
{
	/**
	 * store a new member in the database
	 * 
	 * @param array $data data of the new member to be created
	 * @return \App\Models\Member
	 */
	public function store($data)
	{
		$data['qr_id'] = uniqid() . rand(100, 1000);
		return Member::create($data);
	}

	/**
	 * Update a member in the database
	 * 
	 * @param  array  $data
	 * @param  string  $id
	 * @return \App\Models\Member
	 */
	public function update($data, $id)
	{
		$member = Member::find($id);

		collect($data)->each(function ($value, $key) use ($member) {
			$member->$key = $value;
		});

		return tap($member)->update();
	}

	/**
	 * Get a single member from the database
	 * 
	 * @param  string  $fieldName
	 * @param  string  $fielValue
	 * @return \App\Models\Member
	 */
	public function getRecord($fieldName, $fieldValue)
	{
		return Member::where($fieldName, $fieldValue)->first();
	}


	/**
	 * Get all members from the database
	 * 
	 * @return \Illuminate\Database\Eloquent\Collection
	 */
	public function getAll()
	{
		return Member::all();
	}
}
