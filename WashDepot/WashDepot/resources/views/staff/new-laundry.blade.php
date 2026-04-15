@extends('staff.layout')

@section('title', 'New Laundry Service')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/staff/new-laundry.css') }}">
@endsection

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
<h2 class="page-title">New Laundry Service</h2>

<div class="form-card" id="customerForm">

    <h3 class="section-title">Customer's Information</h3>
    <div class="field-row">
        <label>First Name:</label>
        <input type="text" id="first_name" placeholder="Enter first name">
    </div>
    <div class="field-row">
        <label>Last Name:</label>
        <input type="text" id="last_name" placeholder="Enter last name">
    </div>
    <div class="field-row">
        <label>Contact Number:</label>
        <input type="text" id="contact_number" placeholder="Enter contact number">
    </div>

    <h3 class="section-title">Laundries Information</h3>
    <div class="field-row">
        <label>Laundry Kg:</label>
        <input type="number" id="kg" min="0" placeholder="0">
        <button class="btn-organize">Organize Clothes</button>
    </div>

    <h3 class="section-title">Receiving Time:</h3>
    <div class="receiving-time">
        <button type="button" class="btn-time active" id="btn-ordinary" onclick="setServiceType('ordinary', this)">Ordinary</button>
        <button type="button" class="btn-time" id="btn-rush" onclick="setServiceType('rush', this)">Rush</button>
        <input type="time" id="receiving_time">
    </div>

    <h3 class="section-title">Custom / Add-Ons</h3>
    <div class="addons-grid">

        <div class="addon-card">
            <div class="addon-header">
                <span>Powdered Soap</span>
                <div class="qty-box">
                    Quantity: <input type="number" id="soap_qty" min="0">
                </div>
            </div>
            <div class="addon-brands">
                <button type="button" class="brand-btn" data-brand="Tide" onclick="toggleBrand(this)">Tide <small>15php per pack</small></button>
                <button type="button" class="brand-btn" data-brand="Surf" onclick="toggleBrand(this)">Surf <small>10php per pack</small></button>
                <button type="button" class="brand-btn" data-brand="Ariel" onclick="toggleBrand(this)">Ariel <small>13php per pack</small></button>
                <button type="button" class="brand-btn" data-brand="Wings" onclick="toggleBrand(this)">Wings <small>15php per pack</small></button>
            </div>
        </div>

        <div class="types-card">
            <div class="types-header">Types</div>
            <button type="button" class="type-btn" data-type="Red" onclick="toggleType(this)">Red</button>
            <button type="button" class="type-btn" data-type="White" onclick="toggleType(this)">White</button>
            <button type="button" class="type-btn" data-type="Blue" onclick="toggleType(this)">Blue</button>
        </div>

        <div class="addon-card">
            <div class="addon-header">
                <span>Fabric Conditioner</span>
                <div class="qty-box">
                    Quantity: <input type="number" id="conditioner_qty" min="0">
                </div>
            </div>
            <div class="addon-brands">
                <button type="button" class="brand-btn" data-brand="Downy" onclick="toggleBrand(this)">Downy <small>15php per pack</small></button>
                <button type="button" class="brand-btn" data-brand="Del" onclick="toggleBrand(this)">Del <small>13php per pack</small></button>
                <button type="button" class="brand-btn" data-brand="Lenor" onclick="toggleBrand(this)">Lenor <small>13php per pack</small></button>
                <button type="button" class="brand-btn" data-brand="Champion" onclick="toggleBrand(this)">Champion <small>13php per pack</small></button>
            </div>
        </div>

        <div class="types-card">
            <div class="types-header">Types</div>
            <button type="button" class="type-btn" data-type="Red" onclick="toggleType(this)">Red</button>
            <button type="button" class="type-btn" data-type="Blue" onclick="toggleType(this)">Blue</button>
            <button type="button" class="type-btn" data-type="White" onclick="toggleType(this)">White</button>
        </div>

    </div>

    <div class="form-footer">
        <div class="total-box">
            <span>Total Price: <strong id="totalPrice">₱0.00</strong></span>
        </div>
        <div class="btn-row">
            <button type="button" class="btn-confirm" onclick="generateReceipt()">Generate Receipt</button>
            <button type="button" class="btn-cancel" onclick="resetForm()">Cancel</button>
        </div>
    </div>

</div>

{{-- Receipt Modal --}}
<div class="modal-overlay" id="receiptModal">
    <div class="modal-card">
        <div class="receipt-top">
            <div class="receipt-num" id="receiptQueueNum">01</div>
            <div class="qr-box">
                <img id="qrImage" src="" alt="QR" width="80" height="80">
                <small id="receiptCode">-</small>
            </div>
        </div>
        <div class="receipt-body">
            <p>Name</p>
            <h3 id="receiptName">-</h3>
            <p>Contact Number</p>
            <h3 id="receiptContact">-</h3>
            <p>Laundry Kg</p>
            <h3 id="receiptKg">-</h3>
            <p>Price</p>
            <h3 id="receiptPrice">-</h3>
        </div>
        <button class="btn-confirm" onclick="closeReceipt()">Confirm</button>
    </div>
</div>

<script src="{{ asset('js/staff/new-laundry.js') }}"></script>
@endsection