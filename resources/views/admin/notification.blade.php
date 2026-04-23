@extends('admin.admin-layout')

@section('title', 'Notifications')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/admin/notification.css') }}">

@endsection

@section('content')
<div class="main-content">

    <div class="page-header">
        <div class="page-header-left">
            <h1 class="page-title">Notifications</h1>
            <p class="page-subtitle">Stay updated on orders, alerts, and system activity</p>
        </div>
        <div class="header-actions">
            <button class="btn btn-outline" onclick="markAllRead()">✓ Mark All as Read</button>
            <button class="btn btn-danger-soft" onclick="clearAll()">🗑 Clear All</button>
        </div>
    </div>

    <div class="content-wrapper">

        {{-- ── SUMMARY STRIP ── --}}
        <div class="summary-strip">
            <div class="summary-card">
                <div class="summary-icon" style="background:#dbeafe;">🔔</div>
                <div>
                    <div class="s-label">Total</div>
                    <div class="s-value" id="count-total">12</div>
                </div>
            </div>
            <div class="summary-card">
                <div class="summary-icon" style="background:#fee2e2;">🔴</div>
                <div>
                    <div class="s-label">Unread</div>
                    <div class="s-value" id="count-unread">5</div>
                </div>
            </div>
            <div class="summary-card">
                <div class="summary-icon" style="background:#fef3c7;">⚠️</div>
                <div>
                    <div class="s-label">Alerts</div>
                    <div class="s-value" id="count-alerts">2</div>
                </div>
            </div>
            <div class="summary-card">
                <div class="summary-icon" style="background:#dcfce7;">📋</div>
                <div>
                    <div class="s-label">Orders</div>
                    <div class="s-value" id="count-orders">7</div>
                </div>
            </div>
        </div>

        {{-- ── FILTER BAR ── --}}
        <div class="filter-bar">
            <button class="filter-chip active" data-filter="all" onclick="setFilter(this,'all')">
                All <span class="chip-count">12</span>
            </button>
            <button class="filter-chip" data-filter="unread" onclick="setFilter(this,'unread')">
                Unread <span class="chip-count">5</span>
            </button>
            <button class="filter-chip" data-filter="order" onclick="setFilter(this,'order')">
                Orders <span class="chip-count">7</span>
            </button>
            <button class="filter-chip" data-filter="alert" onclick="setFilter(this,'alert')">
                Alerts <span class="chip-count">2</span>
            </button>
            <button class="filter-chip" data-filter="system" onclick="setFilter(this,'system')">
                System <span class="chip-count">2</span>
            </button>
            <button class="filter-chip" data-filter="account" onclick="setFilter(this,'account')">
                Account <span class="chip-count">1</span>
            </button>
            <div class="filter-spacer"></div>
            <div class="search-wrap">
                <input type="text" placeholder="Search notifications..." oninput="searchNotifs(this.value)">
            </div>
        </div>

        {{-- ── NOTIFICATION LIST ── --}}
        <div class="card" id="notif-container">

            {{-- TODAY --}}
            <div class="notif-group-label">Today</div>

            <div class="notif-row unread" data-category="order" data-id="1">
                <div class="unread-dot"></div>
                <div class="notif-icon-wrap blue">🧺</div>
                <div class="notif-body">
                    <h4>New Order Received — #1048</h4>
                    <p>A new laundry order was submitted at Branch 1. Customer: Maria Santos. Service: Wash & Fold (8 kg).</p>
                    <div class="notif-meta">
                        <span class="notif-time">2 minutes ago</span>
                        <span class="notif-tag order">Order</span>
                    </div>
                </div>
                <div class="notif-actions">
                    <button class="notif-action-btn" title="Mark as read" onclick="markRead(this, event)">✓</button>
                    <button class="notif-action-btn" title="Dismiss" onclick="dismiss(this, event)">✕</button>
                </div>
            </div>

            <div class="notif-row unread" data-category="alert" data-id="2">
                <div class="unread-dot"></div>
                <div class="notif-icon-wrap amber">⚠️</div>
                <div class="notif-body">
                    <h4>Low Inventory: Fabric Conditioner</h4>
                    <p>Fabric Conditioner stock at Branch 1 has dropped to 3 units — below the minimum threshold of 10.</p>
                    <div class="notif-meta">
                        <span class="notif-time">18 minutes ago</span>
                        <span class="notif-tag alert">Alert</span>
                    </div>
                </div>
                <div class="notif-actions">
                    <button class="notif-action-btn" title="Mark as read" onclick="markRead(this, event)">✓</button>
                    <button class="notif-action-btn" title="Dismiss" onclick="dismiss(this, event)">✕</button>
                </div>
            </div>

            <div class="notif-row unread" data-category="order" data-id="3">
                <div class="unread-dot"></div>
                <div class="notif-icon-wrap green">✅</div>
                <div class="notif-body">
                    <h4>Order #1045 Completed</h4>
                    <p>Order #1045 for Juan dela Cruz has been marked as Complete by Staff Team A.</p>
                    <div class="notif-meta">
                        <span class="notif-time">45 minutes ago</span>
                        <span class="notif-tag order">Order</span>
                    </div>
                </div>
                <div class="notif-actions">
                    <button class="notif-action-btn" title="Mark as read" onclick="markRead(this, event)">✓</button>
                    <button class="notif-action-btn" title="Dismiss" onclick="dismiss(this, event)">✕</button>
                </div>
            </div>

            <div class="notif-row unread" data-category="order" data-id="4">
                <div class="unread-dot"></div>
                <div class="notif-icon-wrap blue">🔄</div>
                <div class="notif-body">
                    <h4>Order #1044 Moved to Processing</h4>
                    <p>Staff Team B updated order #1044 status from Pending to Processing.</p>
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

            <div class="notif-row unread" data-category="alert" data-id="5">
                <div class="unread-dot"></div>
                <div class="notif-icon-wrap red">🚨</div>
                <div class="notif-body">
                    <h4>Low Inventory: Powdered Detergent</h4>
                    <p>Powdered Detergent at Branch 2 is critically low at 1 unit remaining.</p>
                    <div class="notif-meta">
                        <span class="notif-time">2 hours ago</span>
                        <span class="notif-tag alert">Alert</span>
                    </div>
                </div>
                <div class="notif-actions">
                    <button class="notif-action-btn" title="Mark as read" onclick="markRead(this, event)">✓</button>
                    <button class="notif-action-btn" title="Dismiss" onclick="dismiss(this, event)">✕</button>
                </div>
            </div>

            {{-- YESTERDAY --}}
            <div class="notif-group-label">Yesterday</div>

            <div class="notif-row" data-category="order" data-id="6">
                <div class="unread-dot"></div>
                <div class="notif-icon-wrap green">✅</div>
                <div class="notif-body">
                    <h4>Order #1042 Completed</h4>
                    <p>Order #1042 for Ana Reyes has been marked Complete. Payment collected: ₱180.</p>
                    <div class="notif-meta">
                        <span class="notif-time">Yesterday, 5:42 PM</span>
                        <span class="notif-tag order">Order</span>
                    </div>
                </div>
                <div class="notif-actions">
                    <button class="notif-action-btn" title="Dismiss" onclick="dismiss(this, event)">✕</button>
                </div>
            </div>

            <div class="notif-row" data-category="order" data-id="7">
                <div class="unread-dot"></div>
                <div class="notif-icon-wrap blue">🧺</div>
                <div class="notif-body">
                    <h4>New Order Received — #1043</h4>
                    <p>Order #1043 submitted at Branch 2. Customer: Pedro Bautista. Service: Dry Clean.</p>
                    <div class="notif-meta">
                        <span class="notif-time">Yesterday, 3:15 PM</span>
                        <span class="notif-tag order">Order</span>
                    </div>
                </div>
                <div class="notif-actions">
                    <button class="notif-action-btn" title="Dismiss" onclick="dismiss(this, event)">✕</button>
                </div>
            </div>

            <div class="notif-row" data-category="report" data-id="8">
                <div class="unread-dot"></div>
                <div class="notif-icon-wrap green">📊</div>
                <div class="notif-body">
                    <h4>Daily Sales Report Ready</h4>
                    <p>Yesterday's sales summary is available. Total revenue: ₱4,320 across 24 orders.</p>
                    <div class="notif-meta">
                        <span class="notif-time">Yesterday, 8:00 AM</span>
                        <span class="notif-tag report">Report</span>
                    </div>
                </div>
                <div class="notif-actions">
                    <button class="notif-action-btn" title="Dismiss" onclick="dismiss(this, event)">✕</button>
                </div>
            </div>

            <div class="notif-row" data-category="account" data-id="9">
                <div class="unread-dot"></div>
                <div class="notif-icon-wrap purple">👤</div>
                <div class="notif-body">
                    <h4>New Staff Account Created</h4>
                    <p>A new staff account for "Carlo Mendoza" (Team B) was created by an admin.</p>
                    <div class="notif-meta">
                        <span class="notif-time">Yesterday, 10:30 AM</span>
                        <span class="notif-tag account">Account</span>
                    </div>
                </div>
                <div class="notif-actions">
                    <button class="notif-action-btn" title="Dismiss" onclick="dismiss(this, event)">✕</button>
                </div>
            </div>

            {{-- OLDER --}}
            <div class="notif-group-label">Earlier This Week</div>

            <div class="notif-row" data-category="order" data-id="10">
                <div class="unread-dot"></div>
                <div class="notif-icon-wrap blue">🧺</div>
                <div class="notif-body">
                    <h4>New Order Received — #1040</h4>
                    <p>Order #1040 submitted at Branch 1. Customer: Rosa Villanueva. Service: Wash & Iron (6 kg).</p>
                    <div class="notif-meta">
                        <span class="notif-time">Mon, 2:10 PM</span>
                        <span class="notif-tag order">Order</span>
                    </div>
                </div>
                <div class="notif-actions">
                    <button class="notif-action-btn" title="Dismiss" onclick="dismiss(this, event)">✕</button>
                </div>
            </div>

            <div class="notif-row" data-category="system" data-id="11">
                <div class="unread-dot"></div>
                <div class="notif-icon-wrap gray">⚙️</div>
                <div class="notif-body">
                    <h4>System Maintenance Completed</h4>
                    <p>Scheduled maintenance finished successfully. All services are operating normally.</p>
                    <div class="notif-meta">
                        <span class="notif-time">Mon, 6:00 AM</span>
                        <span class="notif-tag system">System</span>
                    </div>
                </div>
                <div class="notif-actions">
                    <button class="notif-action-btn" title="Dismiss" onclick="dismiss(this, event)">✕</button>
                </div>
            </div>

            <div class="notif-row" data-category="system" data-id="12">
                <div class="unread-dot"></div>
                <div class="notif-icon-wrap gray">🔧</div>
                <div class="notif-body">
                    <h4>Shop Settings Updated</h4>
                    <p>Admin updated the pricing for "Wash & Fold" service. New rate: ₱60/kg.</p>
                    <div class="notif-meta">
                        <span class="notif-time">Sun, 4:22 PM</span>
                        <span class="notif-tag system">System</span>
                    </div>
                </div>
                <div class="notif-actions">
                    <button class="notif-action-btn" title="Dismiss" onclick="dismiss(this, event)">✕</button>
                </div>
            </div>

            {{-- Empty state (hidden by default) --}}
            <div class="empty-state" id="empty-state" style="display:none;">
                <span class="empty-icon">🔔</span>
                <h3>No notifications found</h3>
                <p>Try adjusting your filter or search query.</p>
            </div>

        </div>
    </div>
</div>

<script src="{{ asset('js/admin/notification.js') }}">

@endsection