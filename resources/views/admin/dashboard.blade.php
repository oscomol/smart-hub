@extends('layout.admin')


@section('title')
    Welcome to Dashboard
@endsection

@section('adminContent')
<div class="container-fluid pt-3">
    @include('partials.message')
    
    <!-- Card Section for Summary -->
    <div class="row">
        <!-- Total Users Card -->
        <div class="col-md-3">
            <div class="card text-white bg-primary mb-3">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="card-title">{{ $totalUsers }}</h5>
                            <p class="card-text">Total Users</p>
                        </div>
                        <i class="fas fa-users fa-3x"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Number of Students Card -->
        <div class="col-md-3">
            <div class="card text-white bg-success mb-3">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="card-title">{{ $studentsCount }}</h5>
                            <p class="card-text">Number of Students</p>
                        </div>
                        <i class="fas fa-graduation-cap fa-3x"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Faculty Members Card -->
        <div class="col-md-3">
            <div class="card text-white bg-warning mb-3">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="card-title">{{ $facultyCount }}</h5>
                            <p class="card-text">Faculty Members</p>
                        </div>
                        <i class="fas fa-chalkboard-teacher fa-3x"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Number of Facilities Card -->
        <div class="col-md-3">
            <div class="card text-white bg-danger mb-3">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="card-title">{{ $facilitiesCount }}</h5>
                            <p class="card-text">Number of Facilities</p>
                        </div>
                        <i class="fas fa-building fa-3x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- User Activity Logs Section -->
        <div class="col-md-6">
            <div class="card mb-3">
                <div class="card-header">
                    <h5>User Activity Logs</h5>
                </div>
                <div class="card-body">
                    <!-- Graph for User Activities -->
                    <canvas id="userActivityChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Schedule and Announcements Reports -->
        <div class="col-md-6">
            <div class="card mb-3">
                <div class="card-header">
                    <h5>Schedule and Announcements Reports</h5>
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        <li class="list-group-item">
                            <strong>Incoming Schedules (Events)</strong>
                            <ul>
                                @foreach($incomingSchedules as $schedule)
                                    <li>
                                        {{ $schedule->eventName }} 
                                        <small>({{ $schedule->startAt }} - {{ $schedule->endAt }})</small>
                                        <br>
                                        <small>{{ $schedule->eventDescription }}</small>
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                        <li class="list-group-item">
                            <strong>Outgoing Announcements</strong>
                            <ul>
                                @foreach($outgoingAnnouncements as $announcement)
                                    <li>
                                        {{ $announcement->title }}
                                        <br>
                                        <small>{{ $announcement->announcement }}</small>
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('userActivityChart').getContext('2d');
    const userActivityChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: {!! json_encode($labels) !!},
            datasets: {!! json_encode($datasets) !!} 
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                    labels: {
                        boxWidth: 10 
                    }
                },
                title: {
                    display: true,
                    text: 'User Activity Over Time'
                }
            }
        }
    });
</script>
@endsection