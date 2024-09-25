<?php



namespace App\Exports;

use App\Models\Student;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class StudentExport implements FromCollection, WithHeadings
{
    protected $studentId;

    public function __construct($studentId)
    {
        $this->studentId = $studentId;
    }

    public function collection()
    {
        return Student::with('guardian')
            ->where('id', $this->studentId) // Fetch only the specific student
            ->get()
            ->map(function ($student) {
                return [
                    'lrn' => $student->lrn,
                    'name' => $student->name,
                    'sex' => $student->sex,
                    'birth_date' => $student->birth_date,
                    'mother_tongue' => $student->mother_tongue,
                    'ip_ethnic_group' => $student->ip_ethnic_group,
                    'religion' => $student->religion,
                    'barangay' => $student->barangay,
                    'municipality' => $student->municipality,
                    'father_name' => optional($student->guardian)->father_name,
                    'mother_name' => optional($student->guardian)->mother_name,
                    'contact_number' => $student->contact_number,
                    'learning_modality' => $student->learning_modality,
                    'remarks' => $student->remarks,
                ];
            });
    }

    public function headings(): array
    {
        return [
            'LRN',
            'Name',
            'Sex',
            'Birth Date',
            'Mother Tongue',
            'IP Ethnic Group',
            'Religion',
            'Barangay',
            'Municipality',
            'Father\'s Name',
            'Mother\'s Name',
            'Contact Number',
            'Learning Modality',
            'Remarks',
        ];
    }
}







