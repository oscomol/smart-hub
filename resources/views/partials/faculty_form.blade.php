<form action="{{ route('faculty.store') }}" method="POST">
    @csrf

    <!-- Personal Information Section -->
    <div class="border p-3 mb-3 rounded">
        <h4 class="mb-3">Personal Information</h4>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="name">Name*</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Enter your full Name" required>
            </div>
            <div class="form-group col-md-3">
                <label for="birth">Date of Birth*</label>
                <input type="date" class="form-control" id="birth" name="birth" required>
            </div>
            <div class="form-group col-md-3">
                <label for="gender">Gender*</label>
                <select class="form-control" id="gender" name="gender" required>
                    <option value="" disabled selected>Select Gender</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                    <option value="Other">Other</option>
                </select>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="address">Address*</label>
                <input type="text" class="form-control" id="address" name="address" placeholder="Enter Address" required>
            </div>
            <div class="form-group col-md-3">
                <label for="phone">Phone*</label>
                <input type="text" class="form-control" id="phone" name="phone" placeholder="Enter Phone" required>
            </div>
            <div class="form-group col-md-3">
                <label for="email">Email*</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email" required>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-3">
                <label for="faculty_id">Faculty ID*</label>
                <input type="text" class="form-control" id="faculty_id" name="faculty_id" placeholder="Enter Faculty ID" required>
            </div>
            <div class="form-group col-md-3">
                <label for="degree">Degree*</label>
                <input type="text" class="form-control" id="degree" name="degree" placeholder="Enter Degree" required>
            </div>
            <div class="form-group col-md-3">
                <label for="specialization">Specialization*</label>
                <input type="text" class="form-control" id="specialization" name="specialization" placeholder="Enter Specialization" required>
            </div>
            <div class="form-group col-md-3">
                <label for="university">University Attended*</label>
                <input type="text" class="form-control" id="university" name="university" placeholder="Enter University" required>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-3">
                <label for="graduation_year">Year Graduated*</label>
                <input type="number" class="form-control" id="graduation_year" name="graduation_year" placeholder="Enter Year Graduated" required>
            </div>
            <div class="form-group col-md-4">
                <label for="certification">Additional Certification*</label>
                <input type="text" class="form-control" id="certification" name="certification" placeholder="Additional Certification (if any)">
            </div>
            <div class="form-group col-md-5">
                <label for="language">Languages Spoken*</label>
                <input type="text" class="form-control" id="language" name="language" placeholder="Languages Spoken (if any)">
            </div>
        </div>
    </div>

    <!-- Employment Information Section -->
    <div class="border p-3 mb-3 rounded">
        <h4 class="mb-3">Employment Information</h4>
        <div class="form-row">
            <div class="form-group col-md-4">
                <label for="employment_date">Date of Employment</label>
                <input type="date" class="form-control" id="employment_date" name="employment_date" required>
            </div>
            <div class="form-group col-md-4">
                <label for="current_position">Current Position</label>
                <input type="text" class="form-control" id="current_position" name="current_position" placeholder="Enter Current Position" required>
            </div>
            <div class="form-group col-md-4">
                <label for="department">Department</label>
                <input type="text" class="form-control" id="department" name="department" placeholder="Enter Department" required>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-4">
                <label for="employment_type">Employment Type</label>
                <input type="text" class="form-control" id="employment_type" name="employment_type" placeholder="Enter Employment Type" required>
            </div>
            <div class="form-group col-md-8">
                <label for="experience">Previous Teaching Experience</label>
                <textarea class="form-control" id="experience" name="experience" rows="2" placeholder="Previous Teaching Experience (if any)"></textarea>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="development_activities">Professional Development Activities</label>
                <textarea class="form-control" id="development_activities" name="development_activities" rows="2" placeholder="Professional Development Activities"></textarea>
            </div>
            <div class="form-group col-md-6">
                <label for="workshops">Workshops Attended</label>
                <textarea class="form-control" id="workshops" name="workshops" rows="2" placeholder="Workshops Attended"></textarea>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="conferences">Conferences Participated</label>
                <textarea class="form-control" id="conferences" name="conferences" rows="2" placeholder="Conferences Participated"></textarea>
            </div>
            <div class="form-group col-md-6">
                <label for="research">Research Projects Involved</label>
                <textarea class="form-control" id="research" name="research" rows="2" placeholder="Research Projects Involved"></textarea>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-12">
                <label for="awards">Awards and Recognitions</label>
                <textarea class="form-control" id="awards" name="awards" rows="2" placeholder="Awards and Recognitions"></textarea>
            </div>
        </div>
    </div>

    <button type="submit" class="btn btn-primary">Save Faculty Record</button>
</form>
