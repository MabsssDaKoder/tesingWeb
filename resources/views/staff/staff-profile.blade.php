@extends('staff.staff-layout')

@section('title', 'Profile Settings')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/staff/staff-profile.css') }}">

@endsection

@section('content')
<div class="main-content">

    <div class="page-header">
        <h1 class="page-title">Profile Settings</h1>
        <p class="page-subtitle">Manage your account details and preferences</p>
    </div>

    <div class="content-wrapper">

        {{-- ── PERSONAL INFORMATION ── --}}
        <div class="card">
            <div class="card-header">
                <h2 class="card-header-title">Personal Information</h2>
            </div>
            <div class="card-body">

                <div class="avatar-section">
                    <div class="avatar-wrapper">
                       
                    </div>
                    <div class="avatar-info">
                        <h3>{{ auth()->user()?->name ?? "Staff's Name" }}</h3>
                        <span class="role-badge">Staff · {{ auth()->user()?->branch ?? 'Branch A' }}</span>
                        <p>Last login: Today at {{ now()->format('g:i A') }}</p>
                    </div>
                    
                    <input type="file" id="avatar_input" accept="image/*" style="display:none">
                </div>

                <div class="section-divider"><span>Basic Details</span></div>
                <div class="form-grid">
                    <div class="form-group">
                        <label>First Name</label>
                        <input type="text" placeholder="First name" value="{{ explode(' ', auth()->user()?->name ?? 'Staff')[0] }}">
                    </div>
                    <div class="form-group">
                        <label>Last Name</label>
                        <input type="text" placeholder="Last name" value="{{ explode(' ', auth()->user()?->name ?? 'Staff Name')[1] ?? '' }}">
                    </div>
                    <div class="form-group">
                        <label>Email Address</label>
                        <input type="email" placeholder="email@example.com" value="{{ auth()->user()?->email ?? 'staff@washdepot.com' }}">
                    </div>
                    <div class="form-group">
                        <label>Phone Number</label>
                        <input type="tel" placeholder="+63 9XX XXX XXXX">
                    </div>
                    <div class="form-group span-2">
                        <label>Role</label>
                        <input type="text" value="Staff · {{ auth()->user()?->team ?? 'Team A' }}" disabled>
                        <span class="input-hint">Your role is assigned by the system and cannot be changed.</span>
                    </div>
                </div>

                <div class="action-row" style="margin-top:1.5rem;">
                    <button class="btn btn-outline">Discard</button>
                    <button class="btn btn-primary">Save Changes</button>
                </div>
            </div>
        </div>

        {{-- ── CHANGE PASSWORD ── --}}
        <div class="card">
            <div class="card-header">
                <h2 class="card-header-title">Change Password</h2>
            </div>
            <div class="card-body">
                <div class="form-grid">
                    <div class="form-group span-2">
                        <label>Current Password</label>
                        <input type="password" placeholder="Enter current password">
                    </div>
                    <div class="form-group">
                        <label>New Password</label>
                        <input type="password" placeholder="Enter new password" oninput="checkStrength(this.value)">
                        <div class="password-strength">
                            <div class="strength-bar" id="bar1"></div>
                            <div class="strength-bar" id="bar2"></div>
                            <div class="strength-bar" id="bar3"></div>
                            <div class="strength-bar" id="bar4"></div>
                        </div>
                        <span class="strength-label" id="strength_label">Enter a password</span>
                    </div>
                    <div class="form-group">
                        <label>Confirm New Password</label>
                        <input type="password" placeholder="Confirm new password">
                    </div>
                </div>
                <div class="action-row" style="margin-top:1.5rem;">
                    <button class="btn btn-outline">Cancel</button>
                    <button class="btn btn-primary">Update Password</button>
                </div>
            </div>
        </div>

        {{-- ── NOTIFICATIONS ── --}}
        <div class="card">
            <div class="card-header">
                <h2 class="card-header-title">Notification Preferences</h2>
            </div>
            <div class="card-body">
                <div class="toggle-list">
                    <div class="toggle-row">
                        <div class="toggle-label">
                            <h4>New Order Alerts</h4>
                            <p>Get notified when a new laundry order is assigned to you</p>
                        </div>
                        <label class="toggle">
                            <input type="checkbox" checked>
                            <span class="toggle-slider"></span>
                        </label>
                    </div>
                    <div class="toggle-row">
                        <div class="toggle-label">
                            <h4>Order Status Updates</h4>
                            <p>Notify when an order moves to Processing or Complete</p>
                        </div>
                        <label class="toggle">
                            <input type="checkbox" checked>
                            <span class="toggle-slider"></span>
                        </label>
                    </div>
                    <div class="toggle-row">
                        <div class="toggle-label">
                            <h4>Low Inventory Alerts</h4>
                            <p>Warn when add-on stock falls below threshold</p>
                        </div>
                        <label class="toggle">
                            <input type="checkbox">
                            <span class="toggle-slider"></span>
                        </label>
                    </div>
                </div>
                <div class="action-row" style="margin-top:1.5rem;">
                    <button class="btn btn-primary">Save Preferences</button>
                </div>
            </div>
        </div>

    </div>
</div>

<script src="{{ asset('js/staff/staff-profile.js') }}"></script>

@endsection