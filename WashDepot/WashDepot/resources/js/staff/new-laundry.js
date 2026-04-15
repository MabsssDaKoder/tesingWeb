let serviceType = 'ordinary';

function setServiceType(type, btn) {
    serviceType = type;
    document.querySelectorAll('.btn-time').forEach(b => b.classList.remove('active'));
    btn.classList.add('active');
    computePrice();
}

function toggleBrand(btn) {
    btn.classList.toggle('active');
    computePrice();
}

function toggleType(btn) {
    btn.classList.toggle('active');
}

function computePrice() {
    const kg        = parseFloat(document.getElementById('kg').value) || 0;
    const basePrice = 50;
    const perKg     = 20;
    const rush      = serviceType === 'rush' ? 30 : 0;
    const total     = (kg * perKg) + basePrice + rush;

    document.getElementById('totalPrice').textContent = '₱' + total.toFixed(2);
    return total;
}

// Update price when kg changes
document.getElementById('kg').addEventListener('input', computePrice);

function generateReceipt() {
    const firstName     = document.getElementById('first_name').value;
    const lastName      = document.getElementById('last_name').value;
    const contactNumber = document.getElementById('contact_number').value;
    const kg            = document.getElementById('kg').value;
    const receivingTime = document.getElementById('receiving_time').value;

    if (!firstName || !lastName || !contactNumber || !kg) {
        alert('Please fill in all required fields!');
        return;
    }

    // Get selected addons
    const addons = [];
    document.querySelectorAll('.brand-btn.active').forEach(btn => {
        addons.push(btn.dataset.brand);
    });

    // Send to Laravel
    fetch('/staff/new-laundry', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: JSON.stringify({
            first_name:      firstName,
            last_name:       lastName,
            contact_number:  contactNumber,
            kg:              kg,
            service_type:    serviceType,
            receiving_time:  receivingTime,
            addons:          addons
        })
    })
    .then(res => res.json())
    .then(data => {
        if (data.success) {
            showReceipt(data);
        } else {
            alert('Error saving customer!');
        }
    })
    .catch(err => {
        console.error(err);
        alert('Something went wrong!');
    });
}

function showReceipt(data) {
    document.getElementById('receiptQueueNum').textContent = data.queue_number;
    document.getElementById('receiptName').textContent     = data.customer.customer_name;
    document.getElementById('receiptContact').textContent  = data.customer.contact_number.replace(/.(?=.{4})/g, '*');
    document.getElementById('receiptKg').textContent       = data.customer.kg + ' kg';
    document.getElementById('receiptPrice').textContent    = data.total_price;
    document.getElementById('receiptCode').textContent     = data.qr_code;

    // Generate QR code
    const qrData = `WashDepot|Queue:${data.queue_number}|${data.customer.customer_name}|${data.qr_code}`;
    document.getElementById('qrImage').src = `https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=${encodeURIComponent(qrData)}`;

    document.getElementById('receiptModal').classList.add('active');
}

function closeReceipt() {
    document.getElementById('receiptModal').classList.remove('active');
    resetForm();
}

function resetForm() {
    document.getElementById('first_name').value    = '';
    document.getElementById('last_name').value     = '';
    document.getElementById('contact_number').value = '';
    document.getElementById('kg').value            = '';
    document.getElementById('receiving_time').value = '';
    document.getElementById('totalPrice').textContent = '₱0.00';
    document.querySelectorAll('.brand-btn').forEach(b => b.classList.remove('active'));
    document.querySelectorAll('.type-btn').forEach(b => b.classList.remove('active'));
    serviceType = 'ordinary';
    document.getElementById('btn-ordinary').classList.add('active');
    document.getElementById('btn-rush').classList.remove('active');
}