<?php

namespace Database\Seeders;

use App\Models\Student;
use App\Models\TeacherStudent;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DefaultUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $superadmin = User::create([
            'first_name' => 'saFN',
            'middle_name' => 'saMN',
            'last_name' => 'saLN',
            'email' => 'superadmin@email.com',
            'password' => bcrypt('password')
        ]);

        $superadmin->roles()->attach([1]);

        $admin = User::create([
            'first_name' => 'adminFN',
            'middle_name' => 'adminMN',
            'last_name' => 'adminLN',
            'email' => 'admin@email.com',
            'password' => bcrypt('password')
        ]);

        $admin->roles()->attach([2,3,4]);

        $admin = User::create([
            'first_name' => '2admin',
            'middle_name' => '2adminmn',
            'last_name' => '2adminln',
            'email' => 'admin2@email.com',
            'password' => bcrypt('password')
        ]);

        $admin->roles()->attach([2,3,4]);

        // $student = User::create([
        //     'first_name' => 'studentFN',
        //     'middle_name' => 'studentMN',
        //     'last_name' => 'studentLN',
        //     'email' => 'student@email.com',
        //     'password' => bcrypt('password')
        // ]);

        // $student->roles()->attach([5]);

        // Student::create([
        //     'user_id' => $student->id,
        //     'year' => 1,
        //     'section' => 'W01',
        //     'group_code' => 'W01'
        // ]);

        // $student = User::create([
        //     'first_name' => '2studentFN',
        //     'middle_name' => '2studentMN',
        //     'last_name' => '2studentLN',
        //     'email' => 'student2@email.com',
        //     'password' => bcrypt('password')
        // ]);

        // $student->roles()->attach([5]);

        // $newStudent = Student::create([
        //     'user_id' => $student->id,
        //     'year' => 1,
        //     'section' => 'W02',
        //     'group_code' => 'W02'
        // ]);

        // TeacherStudent::create([
        //     'teacher_id' => 2,  
        //     'student_id' => $newStudent->id
        // ]);
    }
}
