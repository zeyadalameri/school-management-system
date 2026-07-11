<?php

namespace Database\Seeders;

use App\Models\AcademicYear;
use App\Models\FeeInvoice;
use App\Models\GradeLevel;
use App\Models\Guardian;
use App\Models\Section;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class SchoolSeeder extends Seeder
{
    public function run(): void
    {
        $roles = ['super_admin', 'admin', 'teacher', 'accountant'];

        foreach ($roles as $role) {
            Role::firstOrCreate(['name' => $role]);
        }

        $admin = User::updateOrCreate(
            ['email' => 'admin@school.test'],
            [
                'name' => 'مدير المدرسة',
                'password' => Hash::make('password'),
            ],
        );

        $admin->assignRole('super_admin');

        $year = AcademicYear::updateOrCreate(
            ['name' => '2026-2027'],
            [
                'starts_on' => '2026-09-01',
                'ends_on' => '2027-06-30',
                'is_current' => true,
                'status' => 'active',
            ],
        );

        $gradeOne = GradeLevel::updateOrCreate(
            ['code' => 'G1'],
            ['name' => 'الصف الأول', 'sort_order' => 1, 'status' => 'active'],
        );

        $sectionA = Section::updateOrCreate(
            ['grade_level_id' => $gradeOne->id, 'code' => 'G1-A'],
            ['name' => 'أ', 'capacity' => 30, 'status' => 'active'],
        );

        $teacher = Teacher::updateOrCreate(
            ['employee_number' => 'T-1001'],
            [
                'first_name' => 'أحمد',
                'last_name' => 'المعلم',
                'email' => 'teacher@school.test',
                'specialization' => 'الرياضيات',
                'status' => 'active',
                'hired_on' => '2026-08-01',
            ],
        );

        Subject::updateOrCreate(
            ['code' => 'MATH-G1'],
            [
                'grade_level_id' => $gradeOne->id,
                'teacher_id' => $teacher->id,
                'name' => 'الرياضيات',
                'weekly_hours' => 5,
                'status' => 'active',
            ],
        );

        $guardian = Guardian::updateOrCreate(
            ['phone' => '0500000000'],
            [
                'first_name' => 'محمد',
                'last_name' => 'ولي الأمر',
                'email' => 'guardian@school.test',
                'relationship' => 'ولي أمر',
            ],
        );

        $student = Student::updateOrCreate(
            ['admission_number' => 'S-1001'],
            [
                'guardian_id' => $guardian->id,
                'first_name' => 'سارة',
                'last_name' => 'الطالبة',
                'gender' => 'female',
                'status' => 'active',
                'admitted_on' => '2026-09-01',
            ],
        );

        $student->enrollments()->updateOrCreate(
            ['academic_year_id' => $year->id],
            [
                'grade_level_id' => $gradeOne->id,
                'section_id' => $sectionA->id,
                'roll_number' => '1',
                'status' => 'enrolled',
                'enrolled_on' => '2026-09-01',
            ],
        );

        FeeInvoice::updateOrCreate(
            ['invoice_number' => 'INV-2026-0001'],
            [
                'student_id' => $student->id,
                'academic_year_id' => $year->id,
                'title' => 'رسوم الفصل الدراسي الأول',
                'amount' => 1500,
                'due_date' => '2026-09-15',
                'status' => 'pending',
            ],
        );
    }
}
