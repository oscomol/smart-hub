<form method="POST" action="{{ route('disciplinary.store', $student->id) }}">
    @csrf
    <div class="form-group">
        <label for="incident_date">Incident Date:</label>
        <input type="date" class="form-control" id="incident_date" name="incident_date" required>
    </div>
    <div class="form-group">
        <label for="incident_description">Incident Description:</label>
        <textarea class="form-control" id="incident_description" name="incident_description" required></textarea>
    </div>
    <div class="form-group">
        <label for="action_taken">Action Taken:</label>
        <textarea class="form-control" id="action_taken" name="action_taken" required></textarea>
    </div>
    
    <button type="submit" class="btn btn-primary">Add Disciplinary Record</button>
</form>