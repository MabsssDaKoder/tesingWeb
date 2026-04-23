function setFilter(el, filter) {
        document.querySelectorAll('.filter-chip').forEach(c => c.classList.remove('active'));
        el.classList.add('active');
        applyFilters(filter, document.querySelector('.search-wrap input').value);
    }

    function searchNotifs(query) {
        const activeFilter = document.querySelector('.filter-chip.active')?.dataset.filter || 'all';
        applyFilters(activeFilter, query);
    }

    function applyFilters(filter, query) {
        const rows = document.querySelectorAll('.notif-row');
        const q = query.toLowerCase();
        let visible = 0;

        rows.forEach(row => {
            const cat      = row.dataset.category || '';
            const isUnread = row.classList.contains('unread');
            const text     = row.textContent.toLowerCase();

            const matchFilter =
                filter === 'all'    ? true :
                filter === 'unread' ? isUnread :
                cat === filter;

            const matchSearch = !q || text.includes(q);

            if (matchFilter && matchSearch) { row.style.display = ''; visible++; }
            else row.style.display = 'none';
        });

        document.querySelectorAll('.notif-group-label').forEach(label => {
            let sibling = label.nextElementSibling;
            let hasVisible = false;
            while (sibling && !sibling.classList.contains('notif-group-label') && !sibling.id) {
                if (sibling.style.display !== 'none' && sibling.classList.contains('notif-row')) hasVisible = true;
                sibling = sibling.nextElementSibling;
            }
            label.style.display = hasVisible ? '' : 'none';
        });

        document.getElementById('empty-state').style.display = visible === 0 ? 'block' : 'none';
    }

    function markRead(btn, e) {
        e.stopPropagation();
        const row = btn.closest('.notif-row');
        row.classList.remove('unread');
        row.querySelector('.unread-dot').style.background = 'transparent';
        updateCounts();
    }

    function dismiss(btn, e) {
        e.stopPropagation();
        const row = btn.closest('.notif-row');
        row.style.transition = 'opacity 0.25s, max-height 0.3s';
        row.style.opacity = '0';
        row.style.maxHeight = row.offsetHeight + 'px';
        setTimeout(() => { row.style.maxHeight = '0'; row.style.padding = '0'; row.style.border = 'none'; }, 50);
        setTimeout(() => { row.remove(); updateCounts(); checkEmpty(); }, 350);
    }

    function markAllRead() {
        document.querySelectorAll('.notif-row.unread').forEach(row => {
            row.classList.remove('unread');
            row.querySelector('.unread-dot').style.background = 'transparent';
        });
        updateCounts();
    }

    function clearAll() {
        if (!confirm('Clear all notifications? This cannot be undone.')) return;
        document.querySelectorAll('.notif-row').forEach(r => r.remove());
        document.querySelectorAll('.notif-group-label').forEach(l => l.remove());
        updateCounts();
        document.getElementById('empty-state').style.display = 'block';
    }

    function updateCounts() {
        const rows   = document.querySelectorAll('.notif-row');
        const unread = document.querySelectorAll('.notif-row.unread');
        const alerts = document.querySelectorAll('.notif-row[data-category="alert"]');
        document.getElementById('count-total').textContent  = rows.length;
        document.getElementById('count-unread').textContent = unread.length;
        document.getElementById('count-alerts').textContent = alerts.length;
    }

    function checkEmpty() {
        document.getElementById('empty-state').style.display =
            document.querySelectorAll('.notif-row').length === 0 ? 'block' : 'none';
    }