const form = document.getElementById('calculatorForm');
const results = document.getElementById('results');
const toggleMode = document.querySelector('.toggle-mode');
const inputs = document.querySelectorAll('input[type="number"]');

form.addEventListener('submit', function(e) {
    e.preventDefault();
    
    let subtotal = 0;
    for (let i = 1; i <= 3; i++) {
        const precio = parseFloat(document.getElementById(`precio${i}`).value);
        const cantidad = parseInt(document.getElementById(`cantidad${i}`).value);
        subtotal += precio * cantidad;
    }

    const impuesto = subtotal * 0.18; // IGV en Perú es 18%
    const descuento = subtotal * 0.10;
    const total = subtotal + impuesto - descuento;

    document.getElementById('subtotal').textContent = `S/ ${subtotal.toFixed(2)}`;
    document.getElementById('impuesto').textContent = `S/ ${impuesto.toFixed(2)}`;
    document.getElementById('descuento').textContent = `S/ ${descuento.toFixed(2)}`;
    document.getElementById('total').textContent = `S/ ${total.toFixed(2)}`;

    results.classList.add('show');
});

toggleMode.addEventListener('click', () => {
    document.body.classList.toggle('dark-mode');
    const icon = toggleMode.querySelector('.material-icons');
    icon.textContent = document.body.classList.contains('dark-mode') ? 'light_mode' : 'dark_mode';
});

inputs.forEach(input => {
    input.addEventListener('input', function() {
        this.style.borderColor = 'var(--primary-color)';
        setTimeout(() => {
            this.style.borderColor = '';
        }, 300);
    });
});