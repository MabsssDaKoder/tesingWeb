// ═══════════════════════════════════════════════════
//  WashDepot — admin-new-laundry.js
//  Place in: public/js/admin/admin-new-laundry.js
// ═══════════════════════════════════════════════════

const RUSH_FEE  = 50;
const FULL_RATE = 60;

const SERVICE_CONFIG = {
    'dry-only':     { label: 'Dry Only',     rate: 35, neutral: false },
    'wash-only':    { label: 'Wash Only',    rate: 40, neutral: false },
    'fold-only':    { label: 'Fold Only',    rate: 25, neutral: false },
    'self-service': { label: 'Self Service', rate: 30, neutral: false },
    'pull-package': { label: 'Pull Package', rate: 60, neutral: true  },
};

let selectedService     = 'dry-only';
let selectedReceiveTime = 'ordinary';
let selectedAddons      = [];

// ── Contact: digits only, max 11 ────────────────────
document.getElementById('contact').addEventListener('input', function () {
    this.value = this.value.replace(/\D/g, '').slice(0, 11);
});

// ── Receive Time toggle (Ordinary / Rush) ────────────
function setReceiveTime(type) {
    selectedReceiveTime = type;
    document.getElementById('btn-ordinary').classList.toggle('active', type === 'ordinary');
    document.getElementById('btn-rush').classList.toggle('active', type === 'rush');
    document.getElementById('pickup-time-group').style.display = type === 'rush' ? 'block' : 'none';
    recalculate();
}

// ── Service Type toggle ──────────────────────────────
function setService(type) {
    selectedService = type;
    Object.keys(SERVICE_CONFIG).forEach(key => {
        const btn = document.getElementById('btn-' + key);
        if (btn) btn.classList.toggle('active', key === type);
    });
    recalculate();
}

// ── Addon toggle ─────────────────────────────────────
function toggleAddon(el) {
    el.classList.toggle('selected');
    const name  = el.dataset.name;
    const price = parseFloat(el.dataset.price);
    const type  = el.dataset.type;

    if (el.classList.contains('selected')) {
        selectedAddons.push({ name, price, type });
    } else {
        selectedAddons = selectedAddons.filter(a => a.name !== name);
    }
    recalculate();
}

// ── Recalculate ──────────────────────────────────────
function recalculate() {
    const kg       = parseFloat(document.getElementById('kg').value) || 0;
    const config   = SERVICE_CONFIG[selectedService];
    const rate     = config.rate;
    const rush     = selectedReceiveTime === 'rush' ? RUSH_FEE : 0;
    const addonSum = selectedAddons.reduce((s, a) => s + a.price, 0);

    const discountPerKg = config.neutral ? 0 : (FULL_RATE - rate);
    const discount      = kg * discountPerKg;
    const base          = kg * rate;
    const total         = base + rush + addonSum;

    document.getElementById('base-label').textContent         = `Base Price (${kg} kg × ₱${rate})`;
    document.getElementById('base-price-display').textContent = `₱${(kg * FULL_RATE).toFixed(2)}`;

    const rushRow = document.getElementById('rush-row');
    rushRow.style.display = rush ? 'flex' : 'none';
    document.getElementById('rush-fee-display').textContent = `₱${rush.toFixed(2)}`;

    const discountRow = document.getElementById('discount-row');
    if (!config.neutral && discount > 0) {
        discountRow.style.display = 'flex';
        document.getElementById('discount-label').textContent   = `${config.label} Discount (−₱${discountPerKg}/kg)`;
        document.getElementById('discount-display').textContent = `-₱${discount.toFixed(2)}`;
    } else {
        discountRow.style.display = 'none';
    }

    const addonRow = document.getElementById('addon-row');
    addonRow.style.display = addonSum > 0 ? 'flex' : 'none';
    document.getElementById('addon-price-display').textContent = `₱${addonSum.toFixed(2)}`;

    document.getElementById('total-display').textContent = `₱${total.toFixed(2)}`;
}

document.getElementById('kg').addEventListener('input', recalculate);

// ── Generate Receipt ─────────────────────────────────
async function generateReceipt() {
    const name    = document.getElementById('full_name').value.trim();
    const contact = document.getElementById('contact').value.trim();
    const kg      = parseFloat(document.getElementById('kg').value) || 0;
    const timeEl  = document.getElementById('receiving_time');
    const time    = timeEl ? timeEl.value : '';

    if (!name)                           { alert('Please enter the customer name.'); return; }
    if (!contact || contact.length < 11) { alert('Please enter a valid 11-digit contact number.'); return; }
    if (kg <= 0)                         { alert('Please enter the laundry weight.'); return; }
    if (selectedReceiveTime === 'rush' && !time) { alert('Please set a pickup time for Rush orders.'); return; }

    const config     = SERVICE_CONFIG[selectedService];
    const addonNames = selectedAddons.map(a => a.name);
    const totalNum   = parseFloat(document.getElementById('total-display').textContent.replace('₱', '')) || 0;

    let timeStr = 'Ordinary';
    if (selectedReceiveTime === 'rush' && time) {
        const [h, m] = time.split(':');
        const hour   = parseInt(h);
        const ampm   = hour >= 12 ? 'PM' : 'AM';
        timeStr      = `${hour % 12 || 12}:${m} ${ampm} (Rush)`;
    }

    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content || '';

    try {
        const res = await fetch('/admin/laundry', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': csrfToken },
            body: JSON.stringify({
                customer_name:  name,
                contact_number: contact,
                weight_kg:      kg,
                receive_time:   selectedReceiveTime,
                pickup_time:    time,
                service_type:   selectedService,
                addons:         addonNames,
                total_price:    totalNum,
            }),
        });

        if (!res.ok) throw new Error('Server error');
        const data = await res.json();

        document.getElementById('r-name').textContent      = name;
        document.getElementById('r-contact').textContent   = contact;
        document.getElementById('r-kg').textContent        = kg + ' kg';
        document.getElementById('r-service').textContent   = config.label;
        document.getElementById('r-time').textContent      = timeStr;
        document.getElementById('r-addons').textContent    = addonNames.length ? addonNames.join(', ') : 'None';
        document.getElementById('r-price').textContent     = `₱${totalNum.toFixed(2)}`;
        document.getElementById('r-qr-code').textContent   = data.qr_code;
        document.getElementById('r-queue-num').textContent = String(data.queue_number).padStart(2, '0');

        document.getElementById('receipt-qr-img').src =
            `https://api.qrserver.com/v1/create-qr-code/?size=90x90&data=${encodeURIComponent(data.qr_code)}`;

        document.getElementById('receiptModal').classList.remove('hidden');

    } catch (err) {
        console.error(err);
        alert('Failed to save order. Please try again.');
    }
}

function closeReceipt() {
    document.getElementById('receiptModal').classList.add('hidden');
    resetForm();
}

function resetForm() {
    document.getElementById('full_name').value = '';
    document.getElementById('contact').value   = '';
    document.getElementById('kg').value        = '';
    const timeEl = document.getElementById('receiving_time');
    if (timeEl) timeEl.value = '';

    selectedService     = 'dry-only';
    selectedReceiveTime = 'ordinary';
    selectedAddons      = [];

    setReceiveTime('ordinary');
    setService('dry-only');
    document.querySelectorAll('.addon-item.selected').forEach(el => el.classList.remove('selected'));
    recalculate();
}

recalculate();