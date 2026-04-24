// ==========================================
// TAB SWITCHING
// ==========================================
function showTab(tab, btn) {
    document.querySelectorAll('.tab-content').forEach(t => t.classList.add('hidden'));
    document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
    document.getElementById('tab-' + tab).classList.remove('hidden');
    btn.classList.add('active');
    drawChart(tab);
}

// ==========================================
// SERVICE TYPE DATA
// Labels: Wash Only, Wash & Dry, Wash & Fold, Dry Clean
// Values: count per service type
// ==========================================

const serviceTypes = ['Wash Only', 'Wash & Dry', 'Wash & Fold', 'Dry Clean'];

// VARIABLE: daily_service_stats
const daily_service_stats   = [40, 30, 20, 11]; // counts per service type

// VARIABLE: weekly_service_stats
const weekly_service_stats  = [180, 150, 110, 60];

// VARIABLE: monthly_service_stats
const monthly_service_stats = [820, 600, 430, 250];

// VARIABLE: annually_service_stats
const annually_service_stats = [9800, 7500, 5200, 2500];

// Chart colors — one per service type
const serviceColors = ['#2563eb', '#0ea5e9', '#6366f1', '#8b5cf6'];

// Store chart instances to allow destroy on redraw
const chartInstances = {};

// ==========================================
// BUILD DYNAMIC LEGEND
// ==========================================
function buildLegend(legendEl, data) {
    const total = data.reduce((a, b) => a + b, 0);
    legendEl.innerHTML = '';

    serviceTypes.forEach((label, i) => {
        const pct  = total > 0 ? Math.round((data[i] / total) * 100) : 0;
        const item = document.createElement('div');
        item.className = 'legend-item';
        item.innerHTML = `
            <span class="dot" style="background:${serviceColors[i]};"></span>
            ${pct}% ${label}
        `;
        legendEl.appendChild(item);
    });
}

// ==========================================
// DRAW PIE CHART
// ==========================================
function drawChart(tab) {
    const dataMap = {
        daily:    daily_service_stats,
        weekly:   weekly_service_stats,
        monthly:  monthly_service_stats,
        annually: annually_service_stats,
    };

    const canvasId  = `${tab}-service-chart`;
    const legendId  = `${tab}-service-legend`;
    const canvas    = document.getElementById(canvasId);
    const legendEl  = document.getElementById(legendId);
    if (!canvas || !legendEl) return;

    const data = dataMap[tab];

    // Destroy previous instance
    if (chartInstances[tab]) {
        chartInstances[tab].destroy();
    }

    chartInstances[tab] = new Chart(canvas, {
        type: 'pie',
        data: {
            labels: serviceTypes,
            datasets: [{
                data: data,
                backgroundColor: serviceColors,
                borderWidth: 2,
                borderColor: '#ffffff'
            }]
        },
        options: {
            plugins: { legend: { display: false } },
            responsive: false
        }
    });

    buildLegend(legendEl, data);
}

// Draw initial chart on page load
drawChart('daily');