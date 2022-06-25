<?php

namespace App\Services;

use App\Models\Member;
use Illuminate\Support\Facades\Hash;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Support\Facades\Log;

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
		$data['password'] = Hash::make($data['password']);
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
	 * 
	 * @return \App\Models\Member
	 */
	public function uploadCode($request)
	{
		$user = $request->user();

		$temp_file_path = $request->file('qr_image')->getRealPath();

		try {
			$uploaded_file_url = Cloudinary::upload($temp_file_path)->getSecurePath();
			$user->qr_image_path = $uploaded_file_url;
			$user->save();
			return true;
		} catch (\Throwable $th) {
			Log::error($th->getMessage());
			return false;
		}
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
