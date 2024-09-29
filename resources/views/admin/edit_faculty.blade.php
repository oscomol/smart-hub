 @extends('layout.admin')

 @section('breadcrumbs')
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.faculty') }}">Faculty Record</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit {{ $faculty->name }} Record</li>
            </ol>
        </nav>
@endsection

@section('adminContent')
    <div class="container">
        <h3>Edit {{ $faculty->name }} Record</h3>
        <hr>
        <form action="{{ route('admin.faculty.update', $faculty->id) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Personal Information Section -->
            <div class="border p-3 mb-3 rounded">
                <h4 class="mb-3">Personal Information</h4>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="name">Name*</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter full Name" value="{{ old('name', $faculty->name) }}" required>
                        @error('name')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group col-md-3">
                        <label for="birth">Date of Birth*</label>
                        <input type="date" class="form-control" id="birth" name="birth" value="{{ old('birth', \Carbon\Carbon::parse($faculty->birth)->format('Y-m-d')) }}" required>
                        @error('birth')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group col-md-3">
                        <label for="gender">Gender*</label>
                        <select class="form-control" id="gender" name="gender" required>
                            <option value="Male" {{ old('gender', $faculty->gender) == 'Male' ? 'selected' : '' }}>Male</option>
                            <option value="Female" {{ old('gender', $faculty->gender) == 'Female' ? 'selected' : '' }}>Female</option>
                            <option value="Other" {{ old('gender', $faculty->gender) == 'Other' ? 'selected' : '' }}>Other</option>
                        </select>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="address">Address*</label>
                        <input type="text" class="form-control" id="address" name="address" placeholder="Enter Address" value="{{ old('address', $faculty->address) }}" required>
                        @error('address')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group col-md-3">
                        <label for="phone">Phone*</label>
                        <input type="text" class="form-control" id="phone" name="phone" placeholder="Enter Phone" value="{{ old('phone', $faculty->phone) }}" required>
                        @error('phone')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group col-md-3">
                        <label for="email">Email*</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email" value="{{ old('email', $faculty->email) }}" required>
                        @error('email')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label for="faculty_id">Faculty ID*</label>
                        <input type="text" class="form-control" id="faculty_id" name="faculty_id" placeholder="Enter Faculty ID" value="{{ old('faculty_id', $faculty->faculty_id) }}" required>
                        @error('faculty_id')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group col-md-3">
                        <label for="degree">Degree*</label>
                        <input type="text" class="form-control" id="degree" name="degree" placeholder="Enter Degree" value="{{ old('degree', $faculty->degree) }}" required>
                        @error('degree')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group col-md-3">
                        <label for="specialization">Specialization*</label>
                        <input type="text" class="form-control" id="specialization" name="specialization" placeholder="Enter Specialization" value="{{ old('specialization', $faculty->specialization) }}" required>
                        @error('specialization')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group col-md-3">
                        <label for="university">University Attended*</label>
                        <input type="text" class="form-control" id="university" name="university" placeholder="Enter University" value="{{ old('university', $faculty->university) }}" required>
                        @error('university')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label for="graduation_year">Year Graduated*</label>
                        <input type="number" class="form-control" id="graduation_year" name="graduation_year" placeholder="Enter Year Graduated" value="{{ old('graduation_year', $faculty->graduation_year) }}" required>
                        @error('graduation_year')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group col-md-4">
                        <label for="certification">Additional Certification</label>
                        <input type="text" class="form-control" id="certification" name="certification" placeholder="Additional Certification" value="{{ old('certification', $faculty->certification ?? '') }}">
                    </div>
                    <div class="form-group col-md-5">
                        <label for="language">Languages Spoken</label>
                        <input type="text" class="form-control" id="language" name="language" placeholder="Languages Spoken" value="{{ old('language', $faculty->language ?? '') }}">
                    </div>
                </div>
            </div>

            <!-- Employment Information Section -->
            <div class="border p-3 mb-3 rounded">
                <h4 class="mb-3">Employment Information</h4>
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="employment_date">Date of Employment</label>
                        <input type="date" class="form-control" id="employment_date" name="employment_date" value="{{ old('employment_date', \Carbon\Carbon::parse($faculty->employment_date)->format('Y-m-d')) }}" required>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="current_position">Current Position</label>
                        <input type="text" class="form-control" id="current_position" name="current_position" placeholder="Enter Current Position" value="{{ old('current_position', $faculty->current_position) }}" required>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="department">Department</label>
                        <input type="text" class="form-control" id="department" name="department" placeholder="Enter Department" value="{{ old('department', $faculty->department) }}" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="employment_type">Employment Type</label>
                        <input type="text" class="form-control" id="employment_type" name="employment_type" placeholder="Enter Employment Type" value="{{ old('employment_type', $faculty->employment_type) }}" required>
                    </div>
                    <div class="form-group col-md-8">
                        <label for="experience">Previous Teaching Experience</label>
                        <textarea class="form-control" id="experience" name="experience" rows="3" placeholder="Enter Experience">{{ old('experience', $faculty->experience ?? '') }}</textarea>
                    </div>
                </div>
            </div>
    
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="development_activities">Professional Development Activities</label>
                    <textarea class="form-control" id="development_activities" name="development_activities" rows="2" placeholder="Professional Development Activities" >{{ $faculty->development_activities ?? 'N/A' }}</textarea>
                </div>
                <div class="form-group col-md-6">
                    <label for="workshops">Workshops Attended</label>
                    <textarea class="form-control" id="workshops" name="workshops" rows="2" placeholder="Workshops Attended" >{{ $faculty->workshops ?? 'N/A' }}</textarea>
                </div>
            </div>
    
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="conferences">Conferences Participated</label>
                    <textarea class="form-control" id="conferences" name="conferences" rows="2" placeholder="Conferences Participated" >{{ $faculty->conferences ?? 'N/A' }}</textarea>
                </div>
                <div class="form-group col-md-6">
                    <label for="research">Research Projects Involved</label>
                    <textarea class="form-control" id="research" name="research" rows="2" placeholder="Research Projects Involved" >{{ $faculty->research ?? 'N/A' }}</textarea>
                </div>
            </div>
    
            <div class="form-row">
                <div class="form-group col-md-12">
                    <label for="awards">Awards and Recognitions</label>
                    <textarea class="form-control" id="awards" name="awards" rows="2" placeholder="Awards and Recognitions" >{{ $faculty->awards ?? 'N/A' }}</textarea>
                </div>
            </div>
            <div class="row justify-content-end">
                <div class="col-auto">
                    <!-- Back Link -->
                    <a href="{{ route('admin.faculty') }}" class="btn btn-secondary me-2">Back to Faculty</a>
                    
                    <!-- Update Button -->
                    <button type="submit" class="btn btn-success">Update Faculty Record</button>
                </div>
            </div>
            
            

        </form>
    </div>

@endsection
