<form method="POST" action="{{ route('medical.store', $student->id) }}">
    @csrf
    <!-- Medical Information -->
    <div class="form-group">
        <label for="allergies">Allergies:</label>
        <textarea class="form-control" id="allergies" name="allergies" required></textarea>
    </div>
    <div class="form-group">
        <label for="medical_conditions">Medical Conditions:</label>
        <textarea class="form-control" id="medical_conditions" name="medical_conditions" required></textarea>
    </div>
    <div class="form-group">
        <label for="current_medication">Current Medication:</label>
        <textarea class="form-control" id="current_medication" name="current_medication" required></textarea>
    </div>
    <div class="form-group">
        <label for="physician_name">Physician Name:</label>
        <input type="text" class="form-control" id="physician_name" name="physician_name" required>
    </div>
    <div class="form-group">
        <label for="physician_contact_number">Physician Contact Number:</label>
        <input type="text" class="form-control" id="physician_contact_number" name="physician_contact_number" required>
    </div>
    
    <button type="submit" class="btn btn-primary">Add Medical Record</button>
</form>