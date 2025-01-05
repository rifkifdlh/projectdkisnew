<?php

namespace App\Http\Controllers;

use App\Models\UserGroup;
use App\Models\User;
use Illuminate\Http\Request;

class UserGroupController extends Controller
{
    public function index()
    {
        // Ambil semua data user_groups dengan relasi
        $userGroups = UserGroup::with(['user', 'group', 'createdBy', 'updatedBy'])->get();
    
        // Ambil data users yang tidak ada di user_groups
        $usersWithoutGroups = User::doesntHave('userGroups')->with('group')->get();
    
        // Gabungkan kedua data
        $allUsers = collect();
    
        // Masukkan data dari user_groups
        foreach ($userGroups as $userGroup) {
            $allUsers->push([
                'group_id' => $userGroup->group_id,
                'group_name' => $userGroup->group->name ?? 'No Group',
                'user_name' => $userGroup->user->name,
                'created_by' => $userGroup->createdBy->name ?? 'Unknown',
                'updated_by' => $userGroup->updatedBy->name ?? 'Unknown',
            ]);
        }
    
        // Masukkan data users tanpa relasi
        foreach ($usersWithoutGroups as $user) {
            $allUsers->push([
                'group_id' => $user->group_id ?? 'N/A',
                'group_name' => $user->group->name ?? 'No Group',
                'user_name' => $user->name,
                'created_by' => 'N/A',
                'updated_by' => 'N/A',
            ]);
        }
    
        // Kelompokkan data berdasarkan group_id
        $groupedUsers = $allUsers->groupBy('group_id');
    
        // Kirim data ke view
        return view('usergroups.index', compact('groupedUsers'));
    }
    
}
