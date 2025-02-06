<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Cabinet Médical' ?></title>
    <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body class="bg-gray-100">
    <header class="bg-white shadow">
        <nav class="container mx-auto px-4 py-6">
            <div class="flex justify-between items-center">
                <a href="/" class="text-xl font-bold">Cabinet Médical</a>
                <div class="space-x-4">
                    <?php if ($user): ?>
                        <span>Bonjour, <?= htmlspecialchars($user['prenom']) ?></span>
                        <a href="/rendez-vous" class="btn-link">Mes rendez-vous</a>
                        <a href="/logout" class="btn-secondary">Déconnexion</a>
                    <?php else: ?>
                        <a href="/login" class="btn-primary">Connexion</a>
                        <a href="/register" class="btn-secondary">Inscription</a>
                    <?php endif; ?>
                </div>
            </div>
        </nav>
    </header>

    <main class="container mx-auto px-4 py-8">
        <?php if (!empty($flash)): ?>
            <?php foreach ($flash as $type => $message): ?>
                <div class="alert alert-<?= $type ?> mb-4">
                    <?= htmlspecialchars($message) ?>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>

        <?= $content ?>
    </main>

    <footer class="bg-gray-800 text-white py-8">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div>
                    <h3 class="text-lg font-bold mb-4">Contact</h3>
                    <p>123 Rue de la Santé</p>
                    <p>75000 Paris</p>
                    <p>Tél : 01 23 45 67 89</p>
                </div>
                <div>
                    <h3 class="text-lg font-bold mb-4">Horaires</h3>
                    <p>Lundi - Vendredi : 9h - 19h</p>
                    <p>Samedi : 9h - 12h</p>
                </div>
                <div>
                    <h3 class="text-lg font-bold mb-4">Liens utiles</h3>
                    <ul>
                        <li><a href="/mentions-legales">Mentions légales</a></li>
                        <li><a href="/politique-confidentialite">Politique de confidentialité</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>

    <script src="/assets/js/main.js"></script>
</body>
</html>

