<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculadora </title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="img/calculadora.png">
</head>
<body>
    <div class="container">
        <h1>INGRESE LA CANTIDAD DE PRODUCTOS CON SUS RESPECTIVOS COSTOS</h1>
        
        <div class="card">
            <form id="calculatorForm">
                <?php
                for ($i = 1; $i <= 3; $i++) {
                    echo "<div class='form-group'>";
                    echo "<div>";
                    echo "<label for='precio$i'>Precio del producto $i (S/):</label>";
                    echo "<input type='number' id='precio$i' name='precio$i' step='0.01' min='0' required>";
                    echo "</div>";
                    echo "<div>";
                    echo "<label for='cantidad$i'>Cantidad del producto $i:</label>";
                    echo "<input type='number' id='cantidad$i' name='cantidad$i' min='1' required>";
                    echo "</div>";
                    echo "</div>";
                }
                ?>
                <button type="submit">
                    <span class="material-icons">calculate</span>
                    Calcular
                </button>
            </form>
        </div>
    </div>

    <div class="loading-bar"></div>
    <div class="loading-text">Calculando los precios...</div>

    <div class="results-overlay">
        <button class="close-results">&times;</button>
        <div class="results-content">
            <h2>Resultados:</h2>
            <div id="product-results"></div>
            <div class="result-item">
                <span>Subtotal de la compra:</span>
                <span id="subtotal"></span>
            </div>
            <div class="result-item">
                <span>IGV (18%):</span>
                <span id="impuesto"></span>
            </div>
            <div class="result-item">
                <span>Descuento aplicado (10%):</span>
                <span id="descuento"></span>
            </div>
            <div class="result-item">
                <span>Total final de la compra:</span>
                <span id="total"></span>
            </div>
        </div>
    </div>

    <script>
        const form = document.getElementById('calculatorForm');
        const loadingBar = document.querySelector('.loading-bar');
        const loadingText = document.querySelector('.loading-text');
        const resultsOverlay = document.querySelector('.results-overlay');
        const closeResults = document.querySelector('.close-results');
        const toggleMode = document.querySelector('.toggle-mode');
        const inputs = document.querySelectorAll('input[type="number"]');

        form.addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Show loading bar and text
            loadingBar.classList.add('active');
            loadingText.classList.add('active');

            // Simulate calculation delay
            setTimeout(() => {
                let subtotal = 0;
                let productResults = '';

                for (let i = 1; i <= 3; i++) {
                    const precio = parseFloat(document.getElementById(`precio${i}`).value);
                    const cantidad = parseInt(document.getElementById(`cantidad${i}`).value);
                    const total = precio * cantidad;
                    subtotal += total;

                    productResults += `
                        <div class="result-item">
                            <span>Producto ${i}:</span>
                            <span>S/ ${total.toFixed(2)} (${cantidad} x S/ ${precio.toFixed(2)})</span>
                        </div>
                    `;
                }

                const impuesto = subtotal * 0.18; // IGV en Perú es 18%
                const descuento = subtotal * 0.10;
                const total = subtotal + impuesto - descuento;

                document.getElementById('product-results').innerHTML = productResults;
                document.getElementById('subtotal').textContent = `S/ ${subtotal.toFixed(2)}`;
                document.getElementById('impuesto').textContent = `S/ ${impuesto.toFixed(2)}`;
                document.getElementById('descuento').textContent = `S/ ${descuento.toFixed(2)}`;
                document.getElementById('total').textContent = `S/ ${total.toFixed(2)}`;

                // Hide loading bar and text, show results
                loadingBar.classList.remove('active');
                loadingText.classList.remove('active');
                resultsOverlay.classList.add('active');
            }, 2000); // 2 second delay for demonstration
        });

        closeResults.addEventListener('click', () => {
            resultsOverlay.classList.remove('active');
        });

        inputs.forEach(input => {
            input.addEventListener('input', function() {
                this.style.borderColor = 'var(--primary-color)';
                setTimeout(() => {
                    this.style.borderColor = '';
                }, 300);
            });
        });
    </script>
</body>
</html>