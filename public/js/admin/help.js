function toggleFaq(btn) {
    const item = btn.closest('.faq-item');
    const wasOpen = item.classList.contains('open');
    document.querySelectorAll('.faq-item').forEach(i => i.classList.remove('open'));
    if (!wasOpen) item.classList.add('open');
}

function filterFaq(query) {
    const q = query.toLowerCase();
    document.querySelectorAll('.faq-item').forEach(item => {
        const text = item.querySelector('.faq-question').textContent.toLowerCase();
        item.style.display = text.includes(q) ? '' : 'none';
    });
}