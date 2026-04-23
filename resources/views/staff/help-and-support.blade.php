@extends('staff.staff-layout')

@section('title', 'Help & Support')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/staff/help.css') }}">

@endsection

@section('content')
<div class="main-content">

    <div class="page-header">
        <h1 class="page-title">Help &amp; Support</h1>
        <p class="page-subtitle">Find answers, get in touch, or report an issue</p>
    </div>

    <div class="content-wrapper">

        {{-- ── QUICK CONTACT ── --}}
        <div class="card">
            <div class="card-header">
                <h2 class="card-header-title">Quick Contact</h2>
            </div>
            <div class="card-body">
                <div class="contact-grid">
                    <div class="contact-card">
                        <div class="contact-card-icon amber">📞</div>
                        <h4>Phone Support</h4>
                        <p>Call us Mon–Fri, 8 AM – 6 PM (Philippine Standard Time)</p>
                        <span class="contact-link">+63 2 8XXX XXXX</span>
                    </div>
                </div>
            </div>
        </div>

        {{-- ── FAQ ── --}}
        <div class="card">
            <div class="card-header">
                <h2 class="card-header-title">Frequently Asked Questions</h2>
            </div>
            <div class="card-body">
                <div class="faq-search">
                    <div class="faq-search-wrap">
                        <input type="text" placeholder="Search questions..." oninput="filterFaq(this.value)">
                    </div>
                </div>
                <div class="faq-list" id="faq-list">

                    <div class="faq-item">
                        <button class="faq-question" onclick="toggleFaq(this)">
                            How do I create a new laundry order?
                            <span class="faq-icon">+</span>
                        </button>
                        <div class="faq-answer">
                            <p>Go to <strong>New Laundry Service</strong> in the sidebar. Fill in the customer details, select the service type and any add-ons, then click <em>Submit Order</em> to add it to the queue.</p>
                        </div>
                    </div>

                    <div class="faq-item">
                        <button class="faq-question" onclick="toggleFaq(this)">
                            How do I move an order from Pending to Processing?
                            <span class="faq-icon">+</span>
                        </button>
                        <div class="faq-answer">
                            <p>Open <strong>Queue Management</strong> in the sidebar. Find the order under the <em>Pending</em> column and use the action button to move it to <em>Processing</em>.</p>
                        </div>
                    </div>

                    <div class="faq-item">
                        <button class="faq-question" onclick="toggleFaq(this)">
                            How do I check current inventory levels?
                            <span class="faq-icon">+</span>
                        </button>
                        <div class="faq-answer">
                            <p>Navigate to <strong>Inventory</strong> in the sidebar. You'll see current stock levels for all add-ons and supplies. Items highlighted in red are running low.</p>
                        </div>
                    </div>

                    <div class="faq-item">
                        <button class="faq-question" onclick="toggleFaq(this)">
                            What do I do if the system is running slow?
                            <span class="faq-icon">+</span>
                        </button>
                        <div class="faq-answer">
                            <p>First try refreshing your browser and clearing the cache. If the issue persists, check your internet connection. You can also submit a support ticket below with details so our team can investigate.</p>
                        </div>
                    </div>

                    <div class="faq-item">
                        <button class="faq-question" onclick="toggleFaq(this)">
                            How do I update my profile or change my password?
                            <span class="faq-icon">+</span>
                        </button>
                        <div class="faq-answer">
                            <p>Click <strong>Profile</strong> in the sidebar. From there you can update your personal details, change your password, and manage your notification preferences.</p>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        {{-- ── SEND SUPPORT EMAIL ── --}}
        <div class="card">
            <div class="card-header">
                <h2 class="card-header-title">Send Support Email</h2>
            </div>
            <div class="card-body">

                {{-- Send to --}}
                <div style="display:flex; align-items:center; gap:0.5rem;
                            padding:0.85rem 1rem; background:#f8fafc;
                            border:1px solid #e2e8f0; border-radius:8px;
                            margin-bottom:1.25rem;">
                    <span style="font-size:0.85rem; font-weight:600; color:#4a5568; white-space:nowrap;">Send to:</span>
                    <span style="font-size:0.92rem; font-weight:600; color:#1a2535;">devteam@washdepot.com</span>
                </div>

                <div class="form-grid-2">
                    <div class="form-group">
                        <label>Your Name</label>
                        <input type="text" value="{{ auth()->user()?->name ?? "Staff's Name" }}">
                    </div>
                    <div class="form-group">
                        <label>Email Address</label>
                        <input type="email" value="{{ auth()->user()?->email ?? 'staff@washdepot.com' }}">
                    </div>
                </div>

                <div class="form-grid-2">
                    <div class="form-group">
                        <label>Issue Category</label>
                        <select>
                            <option value="">Select a category</option>
                            <option>Order / Queue Issue</option>
                            <option>Account / Login</option>
                            <option>Feature Request</option>
                            <option>Bug Report</option>
                            <option>Other</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Priority</label>
                        <select>
                            <option>Low</option>
                            <option selected>Medium</option>
                            <option>High</option>
                            <option>Urgent</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label>Subject</label>
                    <input type="text" placeholder="Brief description of your issue">
                </div>

                <div class="form-group">
                    <label>Message</label>
                    <textarea placeholder="Please describe your issue in detail. Include steps to reproduce if reporting a bug."></textarea>
                </div>

                <div class="action-row">
                    <button class="btn btn-outline">Clear</button>
                    <button class="btn btn-primary">Submit Email</button>
                </div>

            </div>
        </div>

    </div>
</div>

<script src="{{ asset('js/staff/help.js') }}"></script>

@endsection