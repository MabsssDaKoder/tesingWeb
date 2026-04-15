// Cancel button
document.getElementById('cancelBtn').addEventListener('click', function() {
    history.back();
});

// Prevent negative numbers on all number inputs
document.querySelectorAll('input[type="number"]').forEach(function(input) {
    input.addEventListener('input', function() {
        if (this.value < 0) this.value = 0;
    });
});

// Confirm button - validate before submit
document.querySelector('form').addEventListener('submit', function(e) {
    const inputs = document.querySelectorAll('input[type="number"]');
    let valid = true;

    inputs.forEach(function(input) {
        if (input.value === '' || input.value < 0) {
            valid = false;
            input.style.borderColor = 'red';
        } else {
            input.style.borderColor = '#ccc';
        }
    });

    if (!valid) {
        e.preventDefault();
        alert('Please fill in all fields with valid numbers!');
    }
});
```

---

### 📁 Folder structure:
```
public/
  css/
    admin/
      shop.css
  js/
    admin/
      shop.js
resources/
  views/
    admin/
      shop.blade.php