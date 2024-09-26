<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Faculty;
class FacultySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create 5 dummy faculty records
        Faculty::create([
            'name' => 'John Doe',
            'birth' => '1980-01-15',
            'gender' => 'Male',
            'address' => '123 Main St, Cityville',
            'phone' => '555-1234',
            'email' => 'johndoe@example.com',
            'faculty_id' => 'FAC001',
            'degree' => 'PhD in Computer Science',
            'specialization' => 'Artificial Intelligence',
            'university' => 'University of Cityville',
            'graduation_year' => '2005',
            'certification' => 'Data Science Certificate',
            'language' => 'English',
            'employment_date' => '2010-05-12',
            'current_position' => 'Professor',
            'department' => 'Computer Science',
            'employment_type' => 'Full-time',
            'experience' => '5 years at Tech University',
            'development_activities' => 'Published research papers on AI',
            'workshops' => 'AI Conference 2021',
            'conferences' => 'International AI Conference 2022',
            'research' => 'AI-based healthcare',
            'awards' => 'Best Researcher Award 2021'
        ]);

        Faculty::create([
            'name' => 'Jane Smith',
            'birth' => '1985-07-21',
            'gender' => 'Female',
            'address' => '456 Park Ave, Cityville',
            'phone' => '555-5678',
            'email' => 'janesmith@example.com',
            'faculty_id' => 'FAC002',
            'degree' => 'Master of Education',
            'specialization' => 'Curriculum Design',
            'university' => 'State University',
            'graduation_year' => '2010',
            'certification' => 'Teaching Excellence Certificate',
            'language' => 'English, Spanish',
            'employment_date' => '2012-09-10',
            'current_position' => 'Senior Lecturer',
            'department' => 'Education',
            'employment_type' => 'Part-time',
            'experience' => '3 years at Regional College',
            'development_activities' => 'Workshop on Curriculum Development',
            'workshops' => 'Education Expo 2022',
            'conferences' => 'Teaching Excellence Conference 2021',
            'research' => 'Curriculum Reform',
            'awards' => 'Excellence in Teaching Award 2020'
        ]);

        // Add 3 more faculty members in a similar manner
        Faculty::create([
            'name' => 'David Johnson',
            'birth' => '1975-03-10',
            'gender' => 'Male',
            'address' => '789 Elm St, Suburbia',
            'phone' => '555-7890',
            'email' => 'davidjohnson@example.com',
            'faculty_id' => 'FAC003',
            'degree' => 'PhD in Physics',
            'specialization' => 'Quantum Mechanics',
            'university' => 'Global University',
            'graduation_year' => '2000',
            'certification' => 'Advanced Quantum Physics',
            'language' => 'English',
            'employment_date' => '2005-06-01',
            'current_position' => 'Professor',
            'department' => 'Physics',
            'employment_type' => 'Full-time',
            'experience' => '10 years at National University',
            'development_activities' => 'Research on Quantum Computing',
            'workshops' => 'Quantum Physics Seminar 2020',
            'conferences' => 'Quantum World Conference 2021',
            'research' => 'Quantum Teleportation',
            'awards' => 'Physics Nobel Prize 2019'
        ]);

        Faculty::create([
            'name' => 'Emily Brown',
            'birth' => '1990-11-05',
            'gender' => 'Female',
            'address' => '321 Oak St, Metrocity',
            'phone' => '555-2468',
            'email' => 'emilybrown@example.com',
            'faculty_id' => 'FAC004',
            'degree' => 'Master of Business Administration',
            'specialization' => 'Finance',
            'university' => 'Capital University',
            'graduation_year' => '2015',
            'certification' => 'Certified Financial Analyst',
            'language' => 'English, French',
            'employment_date' => '2016-03-14',
            'current_position' => 'Lecturer',
            'department' => 'Business',
            'employment_type' => 'Full-time',
            'experience' => '2 years at Business School',
            'development_activities' => 'Financial Markets Research',
            'workshops' => 'Finance Workshop 2021',
            'conferences' => 'Global Finance Conference 2022',
            'research' => 'Financial Modeling',
            'awards' => 'Finance Research Award 2021'
        ]);

        Faculty::create([
            'name' => 'Michael Green',
            'birth' => '1982-08-18',
            'gender' => 'Male',
            'address' => '789 Maple St, Rivercity',
            'phone' => '555-1357',
            'email' => 'michaelgreen@example.com',
            'faculty_id' => 'FAC005',
            'degree' => 'PhD in Chemistry',
            'specialization' => 'Organic Chemistry',
            'university' => 'Oceanic University',
            'graduation_year' => '2008',
            'certification' => 'Certified Chemical Analyst',
            'language' => 'English, German',
            'employment_date' => '2009-07-20',
            'current_position' => 'Associate Professor',
            'department' => 'Chemistry',
            'employment_type' => 'Full-time',
            'experience' => '5 years at Tech Institute',
            'development_activities' => 'Research on Organic Compounds',
            'workshops' => 'Chemical Research Workshop 2021',
            'conferences' => 'Organic Chemistry Summit 2022',
            'research' => 'Synthetic Chemistry',
            'awards' => 'Chemical Research Award 2020'
        ]);
        
    }
}
