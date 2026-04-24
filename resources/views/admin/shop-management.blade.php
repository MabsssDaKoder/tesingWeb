@extends('admin.admin-layout')

@section('title', 'Shop Management')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/admin/shop-management.css') }}">
<link rel="stylesheet" href="{{ asset('css/admin/addon-form-styles.css') }}">
@endsection

@section('content')

<div class="page-title">Shop Management</div>

<div class="content-wrapper">

    {{-- ══════════════════════════════════════════════
         PRICE ADJUSTMENT SECTION
    ══════════════════════════════════════════════ --}}
    <div class="section">
        <div class="section-header">Price Adjustment</div>
        <div class="section-body">
            <div class="field-row">
                <label>Base Price :</label>
                <input type="number" min="0" id="base_price" placeholder="₱0.00">
            </div>
            <div class="field-row">
                <label>Base Kg :</label>
                <input type="number" min="0" id="base_kg" placeholder="kg">
            </div>
            <div class="field-row">
                <label>Additional Per Kg :</label>
                <input type="number" min="0" id="additional_per_kg" placeholder="₱0.00">
            </div>
        </div>
    </div>

    {{-- ══════════════════════════════════════════════
         SERVICE TYPES SECTION
    ══════════════════════════════════════════════ --}}
    <div class="section">
        <div class="section-header">Service Types</div>
        <div class="section-body">
            
            {{-- Create New Service Type --}}
            <div class="service-type-form">
                <div class="service-type-form-group">
                    <label for="service_name">Service Name</label>
                    <input type="text" id="service_name" placeholder="e.g., Express Wash">
                    <div class="suggestion-text">Create custom service types for your laundry</div>
                </div>

                <div class="service-type-form-group">
                    <label for="service_price">Price (₱)</label>
                    <input type="number" id="service_price" min="0" step="0.01" placeholder="0.00">
                    <div class="suggestion-text">Base price for this service</div>
                </div>

                <div class="service-type-actions">
                    <button class="action-btn add" onclick="addServiceType()">+ Add Service</button>
                </div>
            </div>

            {{-- Existing Service Types --}}
            <div class="service-type-chips">
                <div class="service-chip">
                    <div class="service-chip-content">
                        <span>Wash Only</span>
                        <div class="service-chip-menu">
                            <button class="service-chip-btn" onclick="editService(this)">✎</button>
                            <button class="service-chip-btn" onclick="deleteService(this)">✕</button>
                        </div>
                    </div>
                </div>

                <div class="service-chip">
                    <div class="service-chip-content">
                        <span>Dry Only</span>
                        <div class="service-chip-menu">
                            <button class="service-chip-btn" onclick="editService(this)">✎</button>
                            <button class="service-chip-btn" onclick="deleteService(this)">✕</button>
                        </div>
                    </div>
                </div>

                <div class="service-chip">
                    <div class="service-chip-content">
                        <span>Fold Only</span>
                        <div class="service-chip-menu">
                            <button class="service-chip-btn" onclick="editService(this)">✎</button>
                            <button class="service-chip-btn" onclick="deleteService(this)">✕</button>
                        </div>
                    </div>
                </div>

                <div class="service-chip">
                    <div class="service-chip-content">
                        <span>Self Service</span>
                        <div class="service-chip-menu">
                            <button class="service-chip-btn" onclick="editService(this)">✎</button>
                            <button class="service-chip-btn" onclick="deleteService(this)">✕</button>
                        </div>
                    </div>
                </div>

                <div class="service-chip">
                    <div class="service-chip-content">
                        <span>Full Package</span>
                        <div class="service-chip-menu">
                            <button class="service-chip-btn" onclick="editService(this)">✎</button>
                            <button class="service-chip-btn" onclick="deleteService(this)">✕</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    {{-- ══════════════════════════════════════════════
         CUSTOM ADD-ONS SECTION
    ══════════════════════════════════════════════ --}}
    <div class="section">
        <div class="section-header">New Add-ons</div>
        <div class="section-body">

            <div class="addons-container">
                
                {{-- Add-on Form --}}
                <div class="addons-form-card">

                    <div class="form-group">
                        <label>Item name</label>
                        <input type="text" id="addon_name" placeholder="Click New to start">
                    </div>

                    <div class="form-group">
                        <label>Category</label>
                        <div class="category-buttons">
                            <button class="cat-btn" data-category="powdered" onclick="selectCategory(this)">Powdered Detergent</button>
                            <button class="cat-btn" data-category="liquid" onclick="selectCategory(this)">Liquid Detergent</button>
                            <button class="cat-btn" data-category="conditioner" onclick="selectCategory(this)">Fabric Conditioner</button>
                        </div>
                        <input type="hidden" id="selected_category" value="">
                    </div>

                    <div class="form-group">
                        <label>Price</label>
                        <div class="price-input-group">
                            <button class="price-btn" id="pack_btn" onclick="selectPriceType('pack')" disabled>
                                Per Pack
                            </button>
                            <input type="number" id="addon_price" placeholder="₱0.00" disabled>
                            
                            <button class="price-btn" id="scoop_btn" onclick="selectPriceType('scoop')" disabled>
                                Per Scoop
                            </button>
                            <input type="number" id="addon_scoops" placeholder="₱0.00" disabled>
                        </div>
                    </div>

                    {{-- Buttons: Add | Cancel | Edit | Confirm | Delete --}}
                    <div class="form-actions">
                        <button class="action-btn add" onclick="addNewAddon()" id="addAddonBtn">Add</button>
                        <button class="action-btn cancel" onclick="clearFormFields()">Cancel</button>
                        <button class="action-btn edit" onclick="editAddonStart()" id="editAddonBtn" style="display:none;">Edit</button>
                        <button class="action-btn confirm" id="confirmAddonBtn" onclick="saveEditAddon()" style="display:none;">Confirm</button>
                        <button class="action-btn delete" id="deleteAddonBtn" onclick="deleteCurrentAddon()" style="display:none;">Delete</button>
                        <button class="action-btn cancel" id="cancelAddonBtn" onclick="cancelEditAddon()" style="display:none;">Cancel</button>
                    </div>

                </div>

                {{-- Add-ons Display Area --}}
                <div class="addons-display">

                    <div class="addon-category-section">
                        <h5 class="category-title">Powdered Detergent :</h5>
                        <div class="addon-items" id="powdered-list">
                            {{-- Items will be added here --}}
                        </div>
                    </div>

                    <div class="addon-category-section">
                        <h5 class="category-title">Liquid Detergent :</h5>
                        <div class="addon-items" id="liquid-list">
                            {{-- Items will be added here --}}
                        </div>
                    </div>

                    <div class="addon-category-section">
                        <h5 class="category-title">Fabric Conditioner :</h5>
                        <div class="addon-items" id="conditioner-list">
                            {{-- Items will be added here --}}
                        </div>
                    </div>

                </div>

            </div>

        </div>
    </div>

    {{-- Bottom Buttons --}}
    <div class="btn-row">
        <button class="btn-save">Save Changes</button>
        <button class="btn-cancel">Cancel</button>
    </div>

</div>

<script src="{{ asset('js/admin/shop-management.js') }}"></script>

{{-- Edit Add-on Modal --}}
<div class="modal-overlay" id="editAddonModal">
    <div class="modal">
        <div class="modal-header">Edit Add-on Item</div>
        <div class="modal-content">
            <div class="modal-form-group">
                <label for="modal_addon_name">Item Name</label>
                <input type="text" id="modal_addon_name" placeholder="Enter item name">
            </div>
            <div class="modal-form-group">
                <label for="modal_addon_price">Price per Pack (₱)</label>
                <input type="number" id="modal_addon_price" min="0" step="0.01" placeholder="0.00">
            </div>
            <div class="modal-form-group">
                <label for="modal_addon_scoops">Price per Scoops (₱)</label>
                <input type="number" id="modal_addon_scoops" min="0" step="0.01" placeholder="0.00">
            </div>
        </div>
        <div class="modal-actions">
            <button class="modal-btn cancel" onclick="cancelEditAddon()">Cancel</button>
            <button class="modal-btn save" onclick="saveEditAddon()">Save Changes</button>
        </div>
    </div>
</div>

{{-- Edit Service Modal --}}
<div class="modal-overlay" id="editServiceModal">
    <div class="modal">
        <div class="modal-header">Edit Service Type</div>
        <div class="modal-content">
            <div class="modal-form-group">
                <label for="modal_service_name">Service Name</label>
                <input type="text" id="modal_service_name" placeholder="e.g., Express Wash">
            </div>
            <div class="modal-form-group">
                <label for="modal_service_price">Price (₱)</label>
                <input type="number" id="modal_service_price" min="0" step="0.01" placeholder="0.00">
            </div>
        </div>
        <div class="modal-actions">
            <button class="modal-btn cancel" onclick="closeEditModal()">Cancel</button>
            <button class="modal-btn save" onclick="updateService()">Save Changes</button>
        </div>
    </div>
</div>

@endsection