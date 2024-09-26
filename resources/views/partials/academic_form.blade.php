<form action="{{ route('academic.store', $student->id) }}" method="POST">
    @csrf
    <!-- Preschool Details -->
    <div class="form-group">
        <label for="preschool_name">Preschool Name:</label>
        <input type="text" class="form-control" id="preschool_name" name="preschool_name" required>
    </div>
    <div class="form-group">
        <label for="preschool_year_graduated">Year Graduated (Preschool):</label>
        <input type="text" class="form-control" id="preschool_year_graduated" name="preschool_year_graduated" required>
    </div>
    <div class="form-group">
        <label for="preschool_awards">Awards (Preschool):</label>
        <input type="text" class="form-control" id="preschool_awards" name="preschool_awards">
    </div>

    <!-- Elementary School Details -->
    <div class="form-group">
        <label for="elementary_school_name">Elementary School:</label>
        <input type="text" class="form-control" id="elementary_school_name" name="elementary_school_name" required>
    </div>
    <div class="form-group">
        <label for="elementary_year_graduated">Year Graduated (Elementary):</label>
        <input type="text" class="form-control" id="elementary_year_graduated" name="elementary_year_graduated" required>
    </div>
    <div class="form-group">
        <label for="elementary_awards">Awards (Elementary):</label>
        <input type="text" class="form-control" id="elementary_awards" name="elementary_awards">
    </div>
    
    <button type="submit" class="btn btn-primary">Add Academic Record</button>
</form>