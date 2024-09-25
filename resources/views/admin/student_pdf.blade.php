

{{-- This regrad this for now. This will serve as PDF template --}}

<!DOCTYPE html>
<html>
<head>
    <title>Student Information</title>
    <style>
        body {
            font-family: 'Arial, sans-serif';
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
    </style>
</head>
<body>
    <h2>Student Information</h2>
    <table>
        <tr>
            <th>LRN</th>
            <td>{{ $student->lrn }}</td>
        </tr>
        <tr>
            <th>Name</th>
            <td>{{ $student->name }}</td>
        </tr>
        <tr>
            <th>Sex</th>
            <td>{{ $student->sex }}</td>
        </tr>
        <tr>
            <th>Birth Date</th>
            <td>{{ $student->birth_date }}</td>
        </tr>
        <tr>
            <th>Mother Tongue</th>
            <td>{{ $student->mother_tongue }}</td>
        </tr>
        <tr>
            <th>IP Ethnic Group</th>
            <td>{{ $student->ip_ethnic_group }}</td>
        </tr>
        <tr>
            <th>Religion</th>
            <td>{{ $student->religion }}</td>
        </tr>
        <tr>
            <th>Barangay</th>
            <td>{{ $student->barangay }}</td>
        </tr>
        <tr>
            <th>Municipality</th>
            <td>{{ $student->municipality }}</td>
        </tr>
        <tr>
            <th>Father's Name</th>
            <td>{{ $student->guardian->father_name }}</td>
        </tr>
        <tr>
            <th>Mother's Name</th>
            <td>{{ $student->guardian->mother_name }}</td>
        </tr>
        <tr>
            <th>Relationship</th>
            <td>{{ $student->guardian->relationship }}</td>
        </tr>
        <tr>
            <th>Contact Number</th>
            <td>{{ $student->contact_number }}</td>
        </tr>
        <tr>
            <th>Learning Modality</th>
            <td>{{ $student->learning_modality }}</td>
        </tr>
        <tr>
            <th>Remarks</th>
            <td>{{ $student->remarks }}</td>
        </tr>
    </table>
</body>
</html>
