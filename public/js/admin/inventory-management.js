// ── Branch data ─────────────────────────────────────────
const branches = {
    1: { name: 'Branch 1', items: [] },
    2: { name: 'Branch 2',      items: [] },
    3: { name: 'Branch 3',       items: [] },
};

let currentBranch = 1;
let currentMode   = null; // 'add' | 'edit'
let editIndex     = null;

// ── Helpers ──────────────────────────────────────────────
function getItems() {
    return branches[currentBranch].items;
}

function getStatus(reorder, stocks) {
    if (stocks <= 0)           return '<span class="status outofstock">Out of Stocks</span>';
    if (stocks <= reorder / 2) return '<span class="status reorder">Re-Order</span>';
    return '<span class="status good">Good</span>';
}

// ── Render ───────────────────────────────────────────────
function renderTable(filter = '') {
    const tbody = document.getElementById('inventory-body');
    tbody.innerHTML = '';

    const items    = getItems();
    const filtered = filter
        ? items.filter(i => i.name.toLowerCase().includes(filter.toLowerCase()))
        : items;

    if (filtered.length === 0) {
        tbody.innerHTML = '<tr><td colspan="6" class="empty-msg">No items found.</td></tr>';
        return;
    }

    filtered.forEach((item, index) => {
        const realIndex = items.indexOf(item);
        const status    = getStatus(item.reorder, item.stocks);
        const alertIcon = item.stocks <= 0 ? '<span class="alert-icon">!</span>' : '';
        const row       = document.createElement('tr');

        row.innerHTML = `
            <td>${alertIcon} ${item.name}</td>
            <td>${item.category}</td>
            <td>${item.reorder}</td>
            <td>${item.stocks}</td>
            <td>${status}</td>
            <td>
                <button class="btn-notify" onclick="notifyItem(${realIndex})">Notify</button>
            </td>
        `;

        // Click row to select for editing
        row.style.cursor = 'pointer';
        row.addEventListener('click', () => selectRow(realIndex, row));
        tbody.appendChild(row);
    });
}

// ── Row selection (for Edit) ─────────────────────────────
let selectedIndex = null;

function selectRow(index, rowEl) {
    // Highlight selected row
    document.querySelectorAll('#inventory-body tr').forEach(r => r.classList.remove('selected-row'));
    rowEl.classList.add('selected-row');
    selectedIndex = index;
}

// ── Branch switching ─────────────────────────────────────
document.getElementById('branchTabs').addEventListener('click', function (e) {
    const tab = e.target.closest('.branch-tab');
    if (!tab) return;

    // Discard any open form
    disableForm();

    // Update active tab
    document.querySelectorAll('.branch-tab').forEach(t => t.classList.remove('active'));
    tab.classList.add('active');

    currentBranch  = parseInt(tab.dataset.branch);
    selectedIndex  = null;

    // Update form badge
    document.getElementById('formBranchBadge').textContent = branches[currentBranch].name;

    renderTable(document.getElementById('searchInput').value);
});

// ── Search ───────────────────────────────────────────────
document.getElementById('searchInput').addEventListener('input', function () {
    renderTable(this.value);
});

// ── Form enable / disable ────────────────────────────────
function enableForm(mode) {
    currentMode = mode;

    const fields = ['item_name', 'reorder_point', 'current_stocks', 'cat_det', 'cat_conditioner'];
    fields.forEach(id => document.getElementById(id).disabled = false);
    document.getElementById('saveBtn').disabled   = false;
    document.getElementById('cancelBtn').disabled = false;

    if (mode === 'add') {
        editIndex = null;
        document.getElementById('item_name').value      = '';
        document.getElementById('reorder_point').value  = '';
        document.getElementById('current_stocks').value = '';
        document.getElementById('cat_det').classList.add('active');
        document.getElementById('cat_conditioner').classList.remove('active');

    } else if (mode === 'edit') {
        if (selectedIndex === null) {
            alert('Please click a row in the table first to select an item to edit.');
            disableForm();
            return;
        }
        editIndex = selectedIndex;
        const item = getItems()[editIndex];
        document.getElementById('item_name').value      = item.name;
        document.getElementById('reorder_point').value  = item.reorder;
        document.getElementById('current_stocks').value = item.stocks;

        if (item.category === 'Powdered Detergent') {
            document.getElementById('cat_det').classList.add('active');
            document.getElementById('cat_conditioner').classList.remove('active');
        } else {
            document.getElementById('cat_conditioner').classList.add('active');
            document.getElementById('cat_det').classList.remove('active');
        }
    }
}

function disableForm() {
    currentMode = null;
    editIndex   = null;

    const fields = ['item_name', 'reorder_point', 'current_stocks', 'cat_det', 'cat_conditioner'];
    fields.forEach(id => document.getElementById(id).disabled = true);
    document.getElementById('saveBtn').disabled   = true;
    document.getElementById('cancelBtn').disabled = true;

    document.getElementById('item_name').value      = '';
    document.getElementById('reorder_point').value  = '';
    document.getElementById('current_stocks').value = '';
}

// ── Save ─────────────────────────────────────────────────
function saveItem() {
    const name     = document.getElementById('item_name').value.trim();
    const reorder  = parseInt(document.getElementById('reorder_point').value);
    const stocks   = parseInt(document.getElementById('current_stocks').value);
    const category = document.getElementById('cat_det').classList.contains('active')
        ? 'Powdered Detergent' : 'Fabric Conditioner';

    if (!name || isNaN(reorder) || isNaN(stocks)) {
        alert('Please fill in all fields!');
        return;
    }

    const items = getItems();

    if (currentMode === 'edit' && editIndex !== null) {
        // Update in place
        items[editIndex] = { name, category, reorder, stocks };

    } else {
        // Check duplicate on add
        const existingIndex = items.findIndex(
            item => item.name.toLowerCase() === name.toLowerCase()
        );

        if (existingIndex !== -1) {
            const confirmed = window.confirm(
                `"${name}" already exists in ${branches[currentBranch].name}. Update it instead?`
            );
            if (confirmed) {
                items[existingIndex] = { name, category, reorder, stocks };
            } else {
                return;
            }
        } else {
            items.push({ name, category, reorder, stocks });
        }
    }

    renderTable(document.getElementById('searchInput').value);
    disableForm();
    selectedIndex = null;
    document.querySelectorAll('#inventory-body tr').forEach(r => r.classList.remove('selected-row'));
}

// ── Notify ───────────────────────────────────────────────
function notifyItem(index) {
    const item = getItems()[index];
    alert(`Notification sent for: ${item.name} (${branches[currentBranch].name})`);
}

// ── Category toggle ──────────────────────────────────────
document.getElementById('cat_det').addEventListener('click', function () {
    this.classList.add('active');
    document.getElementById('cat_conditioner').classList.remove('active');
});

document.getElementById('cat_conditioner').addEventListener('click', function () {
    this.classList.add('active');
    document.getElementById('cat_det').classList.remove('active');
});

// ── Init ─────────────────────────────────────────────────
document.getElementById('formBranchBadge').textContent = branches[currentBranch].name;
renderTable();