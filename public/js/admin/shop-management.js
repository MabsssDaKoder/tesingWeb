// Category Selection
function selectCategory(btn) {
    document.querySelectorAll('.cat-btn').forEach(b => b.classList.remove('active'));
    btn.classList.add('active');
    document.getElementById('selected_category').value = btn.dataset.category;
    enablePriceButtons();
}

// Price Type Selection
function selectPriceType(type) {
    if (type === 'pack') {
        document.getElementById('pack_btn').classList.add('active');
        document.getElementById('scoop_btn').classList.remove('active');
        document.getElementById('addon_price').disabled = false;
        document.getElementById('addon_scoops').disabled = true;
        document.getElementById('addon_scoops').value = '';
        document.getElementById('addon_price').focus();
    } else {
        document.getElementById('scoop_btn').classList.add('active');
        document.getElementById('pack_btn').classList.remove('active');
        document.getElementById('addon_scoops').disabled = false;
        document.getElementById('addon_price').disabled = true;
        document.getElementById('addon_price').value = '';
        document.getElementById('addon_scoops').focus();
    }
}

function enablePriceButtons() {
    document.getElementById('pack_btn').disabled = false;
    document.getElementById('scoop_btn').disabled = false;
}

// Clear Form Fields
function clearFormFields() {
    document.getElementById('addon_name').value = '';
    document.getElementById('addon_price').value = '';
    document.getElementById('addon_scoops').value = '';
    document.getElementById('selected_category').value = '';
    document.querySelectorAll('.cat-btn').forEach(b => b.classList.remove('active'));
    document.getElementById('pack_btn').classList.remove('active');
    document.getElementById('scoop_btn').classList.remove('active');
    document.getElementById('addon_price').disabled = true;
    document.getElementById('addon_scoops').disabled = true;
    document.getElementById('pack_btn').disabled = true;
    document.getElementById('scoop_btn').disabled = true;
}

// Reset Form to Add mode
function resetFormToAdd() {
    document.getElementById('addon_name').value = '';
    document.getElementById('addon_price').value = '';
    document.getElementById('addon_scoops').value = '';
    document.getElementById('selected_category').value = '';
    document.querySelectorAll('.cat-btn').forEach(b => b.classList.remove('active'));
    document.getElementById('pack_btn').classList.remove('active');
    document.getElementById('scoop_btn').classList.remove('active');
    document.getElementById('addon_price').disabled = true;
    document.getElementById('addon_scoops').disabled = true;
    document.getElementById('pack_btn').disabled = true;
    document.getElementById('scoop_btn').disabled = true;
    
    // Show Add button, hide Edit/Confirm/Delete/Cancel
    document.getElementById('addAddonBtn').style.display = 'inline-block';
    document.getElementById('editAddonBtn').style.display = 'none';
    document.getElementById('confirmAddonBtn').style.display = 'none';
    document.getElementById('deleteAddonBtn').style.display = 'none';
    document.getElementById('cancelAddonBtn').style.display = 'none';
}

// Add New Addon
function addNewAddon() {
    const name = document.getElementById('addon_name').value.trim();
    const category = document.getElementById('selected_category').value;
    const price = document.getElementById('addon_price').value;
    const scoops = document.getElementById('addon_scoops').value;

    if (!name || !category || (!price && !scoops)) {
        alert('Please fill in all required fields');
        return;
    }

    const categoryMap = {
        'powdered': 'powdered-list',
        'liquid': 'liquid-list',
        'conditioner': 'conditioner-list'
    };

    const item = document.createElement('div');
    item.className = 'addon-item';
    item.innerHTML = `
        <div class="addon-item-content">
            <span class="addon-item-name">${name}</span>
            <div class="addon-item-details">
                ${price ? `₱${parseFloat(price).toFixed(2)} per pack` : ''}
                ${price && scoops ? ' | ' : ''}
                ${scoops ? `₱${parseFloat(scoops).toFixed(2)} per scoop` : ''}
            </div>
        </div>
        <div class="addon-item-actions">
            <button class="addon-item-btn edit" onclick="editAddon(this)">✎</button>
            <button class="addon-item-btn delete" onclick="deleteAddon(this)">✕</button>
        </div>
    `;

    document.getElementById(categoryMap[category]).appendChild(item);
    newAddonForm();
}

// Edit Addon
let currentEditingItem = null;

function editAddon(btn) {
    const item = btn.closest('.addon-item');
    const content = item.querySelector('.addon-item-content');
    const name = content.querySelector('.addon-item-name').textContent;
    const details = content.querySelector('.addon-item-details').textContent;

    document.getElementById('modal_addon_name').value = name;
    
    const packMatch = details.match(/₱([\d.]+)\s*per pack/);
    const scoopsMatch = details.match(/₱([\d.]+)\s*per scoop/);
    
    if (packMatch) document.getElementById('modal_addon_price').value = packMatch[1];
    if (scoopsMatch) document.getElementById('modal_addon_scoops').value = scoopsMatch[1];

    currentEditingItem = item;
    document.getElementById('editAddonModal').classList.add('active');
}

function saveEditAddon() {
    if (!currentEditingItem) return;

    const name = document.getElementById('modal_addon_name').value.trim();
    const price = document.getElementById('modal_addon_price').value;
    const scoops = document.getElementById('modal_addon_scoops').value;

    if (!name) {
        alert('Please fill in item name');
        return;
    }

    const content = currentEditingItem.querySelector('.addon-item-content');
    content.querySelector('.addon-item-name').textContent = name;
    content.querySelector('.addon-item-details').textContent = 
        `${price ? `₱${parseFloat(price).toFixed(2)} per pack` : ''}${price && scoops ? ' | ' : ''}${scoops ? `₱${parseFloat(scoops).toFixed(2)} per scoop` : ''}`;

    cancelEditAddon();
}

function cancelEditAddon() {
    document.getElementById('editAddonModal').classList.remove('active');
    currentEditingItem = null;
    document.getElementById('modal_addon_name').value = '';
    document.getElementById('modal_addon_price').value = '';
    document.getElementById('modal_addon_scoops').value = '';
}

function deleteAddon(btn) {
    if (confirm('Delete this add-on?')) {
        btn.closest('.addon-item').remove();
    }
}

function deleteCurrentAddon() {
    alert('Select an item to delete first');
}

function editAddonStart() {
    alert('Select an item to edit first');
}

// Service Type Functions
let currentEditingChip = null;

function addServiceType() {
    const name = document.getElementById('service_name').value.trim();
    const price = document.getElementById('service_price').value;

    if (!name || !price) {
        alert('Please fill in all fields');
        return;
    }

    const chip = document.createElement('div');
    chip.className = 'service-chip';
    chip.innerHTML = `
        <div class="service-chip-content">
            <span>${name} (₱${parseFloat(price).toFixed(2)})</span>
            <div class="service-chip-menu">
                <button class="service-chip-btn" onclick="editService(this)">✎</button>
                <button class="service-chip-btn" onclick="deleteService(this)">✕</button>
            </div>
        </div>
    `;

    document.querySelector('.service-type-chips').appendChild(chip);

    document.getElementById('service_name').value = '';
    document.getElementById('service_price').value = '';
}

function editService(btn) {
    const chip = btn.closest('.service-chip');
    const text = chip.querySelector('span').textContent;
    
    const match = text.match(/^(.*?)\s*\(₱([\d.]+)\)$/);
    if (match) {
        document.getElementById('modal_service_name').value = match[1];
        document.getElementById('modal_service_price').value = match[2];
    }

    currentEditingChip = chip;
    document.getElementById('editServiceModal').classList.add('active');
}

function closeEditModal() {
    document.getElementById('editServiceModal').classList.remove('active');
    currentEditingChip = null;
}

function updateService() {
    const name = document.getElementById('modal_service_name').value.trim();
    const price = document.getElementById('modal_service_price').value;

    if (!name || !price) {
        alert('Please fill in all fields');
        return;
    }

    if (currentEditingChip) {
        currentEditingChip.querySelector('span').textContent = `${name} (₱${parseFloat(price).toFixed(2)})`;
    }

    closeEditModal();
}

function deleteService(btn) {
    if (confirm('Delete this service?')) {
        btn.closest('.service-chip').remove();
    }
}

// Close modals when clicking outside
document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('editAddonModal').addEventListener('click', function(e) {
        if (e.target === this) cancelEditAddon();
    });
    
    document.getElementById('editServiceModal').addEventListener('click', function(e) {
        if (e.target === this) closeEditModal();
    });
});