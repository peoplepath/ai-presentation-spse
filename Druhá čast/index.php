<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kontaktní formulář</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php if (isset($_GET['success']) && $_GET['success'] == 1): ?>
        <div class="toast success" style="position: fixed; bottom: 20px; right: 20px; background-color: #4CAF50; color: white; padding: 15px; border-radius: 5px; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);">
            <p>Data byla úspěšně uložena</p>
        </div>
        <script>
            const toast = document.querySelector('.toast.success');
            toast.classList.add('show');
            setTimeout(() => {
                toast.classList.add('hide');
                setTimeout(() => {
                    toast.remove();
                }, 500);
            }, 3000); // Fade out after 3 seconds
        </script>
    <?php endif; ?>
    <p>
        <strong>Automechanik s bohatými zkušenostmi</strong><br><br>
        Můj strýc je zkušený automechanik, specializovaný na opravy automobilů značek Škoda, Volvo, Volkswagen, Audi a BMW. Díky svým rozsáhlým znalostem a zkušenostem dokáže řešit širokou škálu problémů.<br><br>
        <em>Mezi hlavní služby, které nabízí, patří:</em><br>
        <ul>
            <li>Diagnostika a opravy motorů, převodovek a elektroniky.</li>
            <li>Údržba brzd, podvozků a výměna olejů či filtrů.</li>
            <li>Karosářské práce a lakování.</li>
            <li>Příprava vozů na technické kontroly (STK).</li>
        </ul>
        Jeho cílem je poskytovat kvalitní a spolehlivé služby, které zajistí spokojenost zákazníků.
    </p>
    <form action="process_form.php" method="post">
        <label for="firstName">Jméno:</label>
        <input type="text" id="firstName" name="firstName"><br><br>

        <label for="lastName">Příjmení:</label>
        <input type="text" id="lastName" name="lastName"><br><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br><br>

        <label for="phone">Telefon:</label>
        <input type="tel" id="phone" name="phone" required><br><br>

        <label for="question">Dotaz:</label>
        <textarea id="question" name="question" rows="4" cols="50" required></textarea><br><br>

        <input type="submit" value="Odeslat">
    </form>
</body>
</html>