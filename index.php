<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NANDA BINGO - Elige tus Números</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@700&display=swap');

        :root {
            --dark-bg: #1a1a2e;
            --neon-pink: #ff0080;
            --neon-orange: #ffb300;
            --neon-blue: #00ffff;
            --neon-purple: #8a2be2;
            --sold-color: #555;
        }

        body {
            font-family: 'Montserrat', sans-serif;
            background-color: var(--dark-bg);
            color: white;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 20px;
            text-align: center;
        }

        header h1 {
            font-family: 'Montserrat', sans-serif;
            font-weight: 700;
            font-size: 4.5em;
            margin: 0;
            line-height: 0.9em;
            text-transform: uppercase;
            text-align: center;
        }

        .neon-letter-pink {
            color: var(--neon-pink);
            text-shadow: 0 0 5px var(--neon-pink),
                         0 0 10px var(--neon-pink),
                         0 0 20px var(--neon-pink),
                         0 0 40px var(--neon-pink);
        }

        .neon-letter-orange {
            color: var(--neon-orange);
            text-shadow: 0 0 5px var(--neon-orange),
                         0 0 10px var(--neon-orange),
                         0 0 20px var(--neon-orange),
                         0 0 40px var(--neon-orange);
        }

        .neon-letter-blue {
            color: var(--neon-blue);
            text-shadow: 0 0 5px var(--neon-blue),
                         0 0 10px var(--neon-blue),
                         0 0 20px var(--neon-blue),
                         0 0 40px var(--neon-blue);
        }

        main {
            display: flex;
            flex-direction: column;
            gap: 20px;
            width: 100%;
            max-width: 800px;
            margin-top: 30px;
            padding: 20px;
            background-color: rgba(0, 0, 0, 0.4);
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.5);
        }

        #selection-status {
            font-size: 1.5em;
            color: #fff;
            margin-bottom: 20px;
            text-shadow: 0 0 2px #fff;
            min-height: 1.5em;
            text-align: center;
        }

        #confirm-button {
            padding: 15px 30px;
            font-size: 1.5em;
            font-weight: bold;
            color: white;
            background: linear-gradient(45deg, var(--neon-orange), var(--neon-purple));
            border: none;
            border-radius: 10px;
            cursor: pointer;
            text-transform: uppercase;
            box-shadow: 0 0 10px var(--neon-orange), 0 0 20px var(--neon-purple);
            transition: transform 0.2s, box-shadow 0.2s;
        }

        #confirm-button:hover:not(:disabled) {
            transform: scale(1.05);
            box-shadow: 0 0 15px var(--neon-orange), 0 0 30px var(--neon-purple);
        }

        #confirm-button:disabled {
            background: #444;
            cursor: not-allowed;
        }

        #number-grid {
            display: grid;
            grid-template-columns: repeat(10, 1fr);
            gap: 8px;
            margin-top: 20px;
        }

        .number-cell {
            background-color: #333;
            padding: 10px;
            border-radius: 5px;
            font-size: 1.2em;
            border: 2px solid #555;
            cursor: pointer;
            transition: background-color 0.2s, border-color 0.2s;
        }

        .number-cell.selected {
            background-color: var(--neon-pink);
            border-color: var(--neon-pink);
            color: white;
            text-shadow: 0 0 3px white;
        }

        .number-cell.taken {
            background-color: var(--sold-color);
            border-color: var(--sold-color);
            color: #999;
            cursor: not-allowed;
        }

        aside {
            width: 100%;
            max-width: 800px;
            margin-top: 20px;
            display: flex;
            justify-content: space-between;
            gap: 20px;
        }

        .rules-container, .history-container {
            flex: 1;
            background-color: rgba(0, 0, 0, 0.4);
            padding: 20px;
            border-radius: 15px;
            text-align: left;
        }

        h2 {
            font-size: 2em;
            color: var(--neon-pink);
            text-shadow: 0 0 3px var(--neon-pink);
            border-bottom: 2px solid var(--neon-pink);
            padding-bottom: 10px;
        }

        #taken-numbers-list {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 15px;
        }

        #taken-numbers-list span {
            padding: 5px 10px;
            background-color: var(--neon-purple);
            border-radius: 5px;
            font-size: 1em;
            color: white;
            box-shadow: 0 0 5px var(--neon-purple);
        }

        ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        li {
            margin-bottom: 10px;
            line-height: 1.5;
        }

    </style>
</head>
<body>

    <header>
        <h1>
            <span class="neon-letter-pink">N</span><span class="neon-letter-pink">A</span><span class="neon-letter-orange">N</span><span class="neon-letter-orange">D</span><span class="neon-letter-pink">A</span>
            <span class="neon-letter-orange">B</span><span class="neon-letter-blue">I</span><span class="neon-letter-blue">N</span><span class="neon-letter-orange">G</span><span class="neon-letter-blue">O</span>
        </h1>
    </header>

    <main>
        <p id="selection-status">Selecciona los números que deseas...</p>
        <button id="confirm-button" disabled>Confirmar Selección</button>
        <div id="number-grid"></div>
    </main>

    <aside>
        <div class="rules-container">
            <h2>REGLAS</h2>
            <ul>
                <li>✅ NO INTERRUMPIR EN LAS PARTIDAS</li>
                <li>✅ Cada 25 números se hace la verificación</li>
                <li>✅ Si 2 personas cantan BINGO al mismo tiempo, el primero en cantar se gana el televisor y el segundo se gana el 2do premio</li>
                <li>✅ Partida cartón lleno</li>
            </ul>
        </div>
        <div class="history-container">
            <h2>Números Vendidos</h2>
            <div id="taken-numbers-list"></div>
        </div>
    </aside>

    <script>
        const totalNumbers = 75;
        let selectedNumbers = [];
        let allSoldNumbers = new Set();

        const selectionStatus = document.getElementById('selection-status');
        const confirmButton = document.getElementById('confirm-button');
        const numberGrid = document.getElementById('number-grid');
        const takenNumbersList = document.getElementById('taken-numbers-list');

        async function initializeBoard() {
            try {
                const response = await fetch('get_sold_numbers.php');
                if (!response.ok) {
                    throw new Error('Error al obtener los números vendidos.');
                }
                const data = await response.json();
                allSoldNumbers = new Set(data.soldNumbers);
                renderBoard();
                renderSoldNumbers();
            } catch (error) {
                console.error('Error:', error);
                selectionStatus.textContent = 'Error al cargar los números. Intenta de nuevo más tarde.';
                renderBoard();
            }
        }

        function renderBoard() {
            numberGrid.innerHTML = '';
            for (let i = 1; i <= totalNumbers; i++) {
                const cell = document.createElement('div');
                cell.classList.add('number-cell');
                cell.id = `number-${i}`;
                cell.textContent = i;

                if (allSoldNumbers.has(i)) {
                    cell.classList.add('taken');
                }

                numberGrid.appendChild(cell);

                cell.addEventListener('click', () => toggleSelection(i, cell));
            }
        }

        function renderSoldNumbers() {
            takenNumbersList.innerHTML = '';
            const sortedSoldNumbers = Array.from(allSoldNumbers).sort((a, b) => a - b);
            sortedSoldNumbers.forEach(number => {
                const takenItem = document.createElement('span');
                takenItem.textContent = number;
                takenNumbersList.appendChild(takenItem);
            });
        }

        function toggleSelection(number, cell) {
            if (allSoldNumbers.has(number)) {
                selectionStatus.textContent = `¡El número ${number} ya no está disponible!`;
                return;
            }

            const index = selectedNumbers.indexOf(number);
            if (index > -1) {
                selectedNumbers.splice(index, 1);
                cell.classList.remove('selected');
            } else {
                selectedNumbers.push(number);
                cell.classList.add('selected');
            }
            
            updateSelectionStatus();
        }

        function updateSelectionStatus() {
            if (selectedNumbers.length > 0) {
                selectionStatus.textContent = `Has seleccionado ${selectedNumbers.length} número(s).`;
                confirmButton.disabled = false;
            } else {
                selectionStatus.textContent = 'Selecciona los números que deseas...';
                confirmButton.disabled = true;
            }
        }

        async function confirmSelection() {
            confirmButton.disabled = true;
            selectionStatus.textContent = 'Reservando números y preparando página de pago...';
            
            try {
                const response = await fetch('save_and_redirect.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ numbers: selectedNumbers })
                });

                if (!response.ok) {
                    throw new Error('Error al guardar los números.');
                }
                
                const result = await response.json();
                
                if (result.success) {
                    // El servidor confirma que se guardaron los números, ahora redirigimos al usuario
                    window.location.href = 'checkout.php?numbers=' + result.numbers.join(',');
                } else {
                    throw new Error(result.error || 'Error desconocido.');
                }

            } catch (error) {
                console.error('Error:', error);
                selectionStatus.textContent = 'Error al confirmar la selección. Intenta de nuevo.';
                confirmButton.disabled = false;
            }
        }

        confirmButton.addEventListener('click', confirmSelection);
        window.onload = initializeBoard;
    </script>

</body>
</html>