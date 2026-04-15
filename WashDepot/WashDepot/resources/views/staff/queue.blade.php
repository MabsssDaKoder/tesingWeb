<!-- @extends('staff.layout')

@section('title', 'Queue Management')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/staff/queue.css') }}">
@endsection

@section('content')
<h2 class="page-title">Queue Management</h2>

<div class="queue-card">

    <div class="queue-tabs">
        <button class="tab-btn red active" onclick="showTab('pending', this)">Pending</button>
        <button class="tab-btn orange" onclick="showTab('processing', this)">Processing</button>
        <button class="tab-btn green" onclick="showTab('completed', this)">Completed</button>
    </div>

    {{-- Pending Tab --}}
    <div class="tab-content" id="tab-pending">
        <table class="queue-table">
            <thead>
                <tr>
                    <th>Queue #</th>
                    <th>Name</th>
                    <th>Receive Status</th>
                    <th>Action</th>
                </tr>
            </thead>
           
        </table>
    </div>

    {{-- Processing Tab --}}
    <div class="tab-content hidden" id="tab-processing">
        <table class="queue-table">
            <thead>
                <tr>
                    <th>Queue #</th>
                    <th>Name</th>
                    <th>Receive Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            
        </table>
    </div>

    {{-- Completed Tab --}}
    <div class="tab-content hidden" id="tab-completed">
        <table class="queue-table">
            <thead>
                <tr>
                    <th>Queue #</th>
                    <th>Name</th>
                    <th>Receive Status</th>
                    <th>Action</th>
                </tr>
            </thead>
          
        </table>
    </div>

</div>

<script>
function showTab(tab, btn) {
    // Hide all tabs
    document.querySelectorAll('.tab-content').forEach(t => t.classList.add('hidden'));
    // Remove active from all buttons
    document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
    // Show selected tab
    document.getElementById('tab-' + tab).classList.remove('hidden');
    // Set active button
    btn.classList.add('active');
}
</script>

@endsection -->
@extends('staff.layout')

@section('title', 'Queue Management')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/staff/queue.css') }}">
@endsection

@section('content')
<h2 class="page-title">Queue Management</h2>

<div class="queue-board">

    {{-- Queued Column --}}
    <div class="queue-column">
       
        <div class="col-body" id="queued-list">
            @forelse($queued as $customer)
                @include('staff.components.customer-card', ['customer' => $customer])
            @empty
                <p class="empty-msg">No customers in queue</p>
            @endforelse
        </div>
    </div>

    {{-- Processing Column --}}
    <div class="queue-column">
        
        <div class="col-body" id="processing-list">
            @forelse($processing as $customer)
                @include('staff.components.customer-card', ['customer' => $customer])
            @empty
                <p class="empty-msg">No customers processing</p>
            @endforelse
        </div>
    </div>

    {{-- Complete Column --}}
    <div class="queue-column">
       
        <div class="col-body" id="complete-list">
            @forelse($complete as $customer)
                @include('staff.components.customer-card', ['customer' => $customer])
            @empty
                <p class="empty-msg">No completed customers</p>
            @endforelse
        </div>
    </div>

</div>

<script>
function moveCard(id, status) {
    fetch(`/staff/queue/${id}/status`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({ status: status })
    })
    .then(res => res.json())
    .then(data => {
        if (data.success) location.reload();
    });
}

// Auto refresh every 10 seconds
setInterval(() => location.reload(), 10000);
</script>

@endsection