@extends('staff.staff-layout')

@section('title', 'Notifications')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/staff/notification.css') }}">

@endsection

@section('content')
<div class="main-content">

    <div class="page-header">
        <div class="page-header-left">
            <h1 class="page-title">Notifications</h1>
            <p class="page-subtitle">Your assigned orders, alerts, and updates</p>
        </div>
        <div class="header-actions">
            <button class="btn btn-outline" onclick="markAllRead()">✓ Mark All as Read</button>
            <button class="btn btn-danger-soft" onclick="clearAll()">🗑 Clear All</button>
        </div>
    </div>

    <div class="content-wrapper">

        {{-- ── SUMMARY ── --}}
        <div class="summary-strip">
            <div class="summary-card">
                <div class="summary-icon" style="background:#dbeafe;">🔔</div>
                <div>
                    <div class="s-label">Total</div>
                    <div class="s-value" id="count-total">8</div>
                </div>
            </div>
            <div class="summary-card">
                <div class="summary-icon" style="background:#fee2e2;">🔴</div>
                <div>
                    <div class="s-label">Unread</div>
                    <div class="s-value" id="count-unread">3</div>
                </div>
            </div>
            <div class="summary-card">
                <div class="summary-icon" style="background:#fef3c7;">⚠️</div>
                <div>
                    <div class="s-label">Alerts</div>
                    <div class="s-value" id="count-alerts">1</div>
                </div>
            </div>
        </div>

        {{-- ── FILTER BAR ── --}}
        <div class="filter-bar">
            <button class="filter-chip active" data-filter="all" onclick="setFilter(this,'all')">
                All <span class="chip-count">8</span>
            </button>
            <button class="filter-chip" data-filter="unread" onclick="setFilter(this,'unread')">
                Unread <span class="chip-count">3</span>
            </button>
            <button class="filter-chip" data-filter="order" onclick="setFilter(this,'order')">
                Orders <span class="chip-count">6</span>
            </button>
            <button class="filter-chip" data-filter="alert" onclick="setFilter(this,'alert')">
                Alerts <span class="chip-count">1</span>
            </button>
            <button class="filter-chip" data-filter="system" onclick="setFilter(this,'system')">
                System <span class="chip-count">1</span>
            </button>
            <div class="filter-spacer"></div>
            <div class="search-wrap">
                <input type="text" placeholder="Search notifications..." oninput="searchNotifs(this.value)">
            </div>
        </div>

        {{-- ── NOTIFICATION LIST ── --}}
        <div class="card" id="notif-container">

            <div class="notif-group-label">Today</div>

            <div class="notif-row unread" data-category="order">
                <div class="unread-dot"></div>
                <div class="notif-icon-wrap blue">🧺</div>
                <div class="notif-body">
                    <h4>New Order Assigned — #1048</h4>
                    <p>Order #1048 has been assigned to your team. Customer: Maria Santos. Service: Wash & Fold (8 kg).</p>
                    <div class="notif-meta">
                        <span class="notif-time">5 minutes ago</span>
                        <span class="notif-tag order">Order</span>
                    </div>
                </div>
                <div class="notif-actions">
                    <button class="notif-action-btn" title="Mark as read" onclick="markRead(this, event)">✓</button>
                    <button class="notif-action-btn" title="Dismiss" onclick="dismiss(this, event)">✕</button>
                </div>
            </div>

            <div class="notif-row unread" data-category="alert">
                <div class="unread-dot"></div>
                <div class="notif-icon-wrap amber">⚠️</div>
                <div class="notif-body">
                    <h4>Low Stock: Fabric Conditioner</h4>
                    <p>Fabric Conditioner is running low (3 units left). Please notify your admin to restock.</p>
                    <div class="notif-meta">
                        <span class="notif-time">30 minutes ago</span>
                        <span class="notif-tag alert">Alert</span>
                    </div>
                </div>
                <div class="notif-actions">
                    <button class="notif-action-btn" title="Mark as read" onclick="markRead(this, event)">✓</button>
                    <button class="notif-action-btn" title="Dismiss" onclick="dismiss(this, event)">✕</button>
                </div>
            </div>

            <div class="notif-row unread" data-category="order">
                <div class="unread-dot"></div>
                <div class="notif-icon-wrap green">✅</div>
                <div class="notif-body">
                    <h4>Order #1045 Marked Complete</h4>
                    <p>You successfully completed order #1045 for Juan dela Cruz.</p>
                    <div class="notif-meta">
                        <span class="notif-time">1 hour ago</span>
                        <span class="notif-tag order">Order</span>
                    </div>
                </div>
                <div class="notif-actions">
                    <button class="notif-action-btn" title="Mark as read" onclick="markRead(this, event)">✓</button>
                    <button class="notif-action-btn" title="Dismiss" onclick="dismiss(this, event)">✕</button>
                </div>
            </div>

            <div class="notif-group-label">Yesterday</div>

            <div class="notif-row" data-category="order">
                <div class="unread-dot"></div>
                <div class="notif-icon-wrap green">✅</div>
                <div class="notif-body">
                    <h4>Order #1042 Completed</h4>
                    <p>Order #1042 for Ana Reyes was marked complete. Payment collected: ₱180.</p>
                    <div class="notif-meta">
                        <span class="notif-time">Yesterday, 5:42 PM</span>
                        <span class="notif-tag order">Order</span>
                    </div>
                </div>
                <div class="notif-actions">
                    <button class="notif-action-btn" title="Dismiss" onclick="dismiss(this, event)">✕</button>
                </div>
            </div>

            <div class="notif-row" data-category="order">
                <div class="unread-dot"></div>
                <div class="notif-icon-wrap blue">🔄</div>
                <div class="notif-body">
                    <h4>Order #1041 Moved to Processing</h4>
                    <p>You updated order #1041 from Pending to Processing.</p>
                    <div class="notif-meta">
                        <span class="notif-time">Yesterday, 2:00 PM</span>
                        <span class="notif-tag order">Order</span>
                    </div>
                </div>
                <div class="notif-actions">
                    <button class="notif-action-btn" title="Dismiss" onclick="dismiss(this, event)">✕</button>
                </div>
            </div>

            <div class="notif-row" data-category="system">
                <div class="unread-dot"></div>
                <div class="notif-icon-wrap gray">⚙️</div>
                <div class="notif-body">
                    <h4>Pricing Updated by Admin</h4>
                    <p>Admin updated the rate for "Wash & Fold" to ₱60/kg. This applies to all new orders.</p>
                    <div class="notif-meta">
                        <span class="notif-time">Yesterday, 9:15 AM</span>
                        <span class="notif-tag system">System</span>
                    </div>
                </div>
                <div class="notif-actions">
                    <button class="notif-action-btn" title="Dismiss" onclick="dismiss(this, event)">✕</button>
                </div>
            </div>

            <div class="notif-group-label">Earlier This Week</div>

            <div class="notif-row" data-category="order">
                <div class="unread-dot"></div>
                <div class="notif-icon-wrap blue">🧺</div>
                <div class="notif-body">
                    <h4>New Order Assigned — #1038</h4>
                    <p>Order #1038 assigned to your team. Customer: Rosa Villanueva. Service: Wash & Iron (6 kg).</p>
                    <div class="notif-meta">
                        <span class="notif-time">Mon, 11:30 AM</span>
                        <span class="notif-tag order">Order</span>
                    </div>
                </div>
                <div class="notif-actions">
                    <button class="notif-action-btn" title="Dismiss" onclick="dismiss(this, event)">✕</button>
                </div>
            </div>

            <div class="notif-row" data-category="order">
                <div class="unread-dot"></div>
                <div class="notif-icon-wrap green">✅</div>
                <div class="notif-body">
                    <h4>Order #1036 Completed</h4>
                    <p>Order #1036 for Pedro Bautista marked complete. Service: Dry Clean.</p>
                    <div class="notif-meta">
                        <span class="notif-time">Sun, 3:45 PM</span>
                        <span class="notif-tag order">Order</span>
                    </div>
                </div>
                <div class="notif-actions">
                    <button class="notif-action-btn" title="Dismiss" onclick="dismiss(this, event)">✕</button>
                </div>
            </div>

            <div class="empty-state" id="empty-state" style="display:none;">
                <span class="empty-icon">🔔</span>
                <h3>No notifications found</h3>
                <p>Try adjusting your filter or search query.</p>
            </div>

        </div>
    </div>
</div>

<script src="{{ asset('js/staff/notification.js') }}"></script>

@endsection