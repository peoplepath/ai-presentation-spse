<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulář</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .toast {
            opacity: 1;
            transition: opacity 0.5s ease-in-out;
        }
        .toast.show {
            animation: fadeIn 0.5   s ease-in-out forwards;
        }
        .toast.hide {
            animation: fadeOut 0.5s ease-in-out forwards;
        }
        @keyframes fadeIn {
            0% {
                opacity: 0;
            }
            100% {
                opacity: 1;
            }
        }
        @keyframes fadeOut {
            0% {
                opacity: 1;
            }
            100% {
                opacity: 0;
            }
        }
    </style>
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
    <form action="process_form.php" method="post">
        <label for="firstName">Jméno:</label>
        <input type="text" id="firstName" name="firstName" required>

        <label for="lastName">Příjmení:</label>
        <input type="text" id="lastName" name="lastName" required>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email">

        <label for="dob">Datum narození:</label>
        <input type="date" id="dob" name="dob">

        <label for="note">Poznámka:</label>
        <textarea id="note" name="note"></textarea>

        <button type="submit">Odeslat</button>
    </form>
</body>
</html>