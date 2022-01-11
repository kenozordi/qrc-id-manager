<?php

namespace App\Services;

use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class AdminService
{
	/**
	 * store a new admin in the database
	 * 
	 * @param array $data data of the new admin to be created
	 * @return \App\Models\Admin
	 */
	public function store($data)
	{
		$data['password'] = Hash::make($data['password']);
		return Admin::create($data);
	}

	/**
	 * Update a admin in the database
	 * 
	 * @param  array  $data
	 * @param  string  $id
	 * @return \App\Models\Admin
	 */
	public function update($data, $id)
	{
		$admin = Admin::find($id);

		collect($data)->each(function ($value, $key) use ($admin) {
			$admin->$key = $value;
		});

		return tap($admin)->update();
	}

	/**
	 * Get a single admin from the database
	 * 
	 * @param  string  $fieldName
	 * @param  string  $fielValue
	 * @return \App\Models\Admin
	 */
	public function getRecord($fieldName, $fieldValue)
	{
		return Admin::where($fieldName, $fieldValue)->first();
	}


	/**
	 * Get all admins from the database
	 * 
	 * @return \Illuminate\Database\Eloquent\Collection
	 */
	public function getAll()
	{
		return Admin::all();
	}
}
