function checkStrength(val) {
    const bars = [document.getElementById('bar1'), document.getElementById('bar2'),
                  document.getElementById('bar3'), document.getElementById('bar4')];
    const label = document.getElementById('strength_label');
    bars.forEach(b => { b.className = 'strength-bar'; });

    let score = 0;
    if (val.length >= 8)  score++;
    if (/[A-Z]/.test(val)) score++;
    if (/[0-9]/.test(val)) score++;
    if (/[^A-Za-z0-9]/.test(val)) score++;

    const levels = ['', 'weak', 'fair', 'good', 'strong'];
    const labels = ['', 'Weak', 'Fair', 'Good', 'Strong'];
    for (let i = 0; i < score; i++) bars[i].classList.add(levels[score]);
    label.textContent = val.length ? labels[score] || 'Enter a password' : 'Enter a password';
}