<div class="customer-card">
    <div class="card-top">
        <div class="card-left">
            <span class="queue-num">{{ str_pad($customer->queue_number, 2, '0', STR_PAD_LEFT) }}</span>
            <div class="card-info">
                <span class="customer-name">{{ $customer->customer_name }}</span>
                <span class="customer-kg">{{ $customer->kg }} kg</span>
            </div>
        </div>
        <span class="badge {{ $customer->service_type }}">
            {{ $customer->service_type === 'rush' ? '⭐ Rush' : 'Ordinary' }}
        </span>
    </div>

    <div class="addons-list">
        @foreach($customer->addons ?? [] as $addon)
            <span class="addon-tag">{{ $addon }}</span>
        @endforeach
    </div>

    <div class="received-time">
        Received: {{ $customer->receiving_time }}
    </div>

    <div class="card-actions">
        @if($customer->status === 'queued')
            <button class="btn-start" onclick="moveCard({{ $customer->id }}, 'processing')">
                → Start Processing
            </button>
        @elseif($customer->status === 'processing')
            <button class="btn-complete" onclick="moveCard({{ $customer->id }}, 'complete')">
                → Complete
            </button>
        @endif
        <button class="btn-sms">💬 Send SMS</button>
    </div>
</div>