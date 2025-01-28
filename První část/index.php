<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kontaktní formulář</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Kontaktní formulář</h1>
    <p style="font-size: 14px; line-height: 1.6; margin-bottom: 20px;">
        <strong>Autoservis s tradicí a zkušenostmi</strong><br><br>
        Můj táta vlastní a provozuje autoservis specializovaný na opravy osobních automobilů značek Škoda, Volkswagen, Audi a BMW. Díky mnohaletým zkušenostem dokáže nabídnout komplexní služby, které zahrnují vše od základní údržby až po složité opravy.<br><br>
        <em>Mezi hlavní činnosti jeho servisu patří:</em><br>
    <p style="font-size: 11px; line-height: 1.2">
        <ul>
            <li>Autoservis s tradicí a zkušenostmi</li>
            <li>Můj táta vlastní a provozuje autoservis specializovaný na opravy osobních automobilů značek Škoda, Volkswagen, Audi a BMW. Díky mnohaletým zkušenostem dokáže nabídnout komplexní služby, které zahrnují vše od základní údržby až po složité opravy.</li>
            <li>Mezi hlavní činnosti jeho servisu patří:</li>
            <li>Diagnostika a opravy motorů, převodovek a elektroniky.</li>
            <li>Servis brzd, podvozků a výměna olejů či filtrů.</li>
            <li>Karosářské práce, lakování a opravy po nehodách.</li>
            <li>Montáž doplňků a příprava vozů na technické kontroly (STK).</li>
        </ul>
        Jeho filozofií je vždy odvádět kvalitní a poctivou práci, díky které se zákazníci rádi vracejí. Pokud hledáte profesionální přístup a spolehlivý autoservis, ten jeho je tím správným místem.

        Pro více informací nebo objednání termínu ho neváhejte kontaktovat.
    </p>
    <form action="process_form.php" method="post">
        <label for="firstName">Jméno:</label>
        <input type="text" id="firstName" name="firstName" required>

        <label for="lastName">Příjmení:</label>
        <input type="text" id="lastName" name="lastName" required>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email">

        <label for="phone">Telefon:</label>
        <input type="tel" id="phone" name="phone"><br><br>

        <label for="comment">Komentář:</label>
        <textarea id="comment" name="comment" rows="4" cols="50"></textarea><br><br>

        <input type="submit" value="Odeslat">
    </form>
</body>
</html>