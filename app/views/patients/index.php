<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des patients</title>
    <link rel="stylesheet" href="/Cabinet/public/assets/css/style.css">
</head>
<body>
    <h1>Liste des patients</h1>
    <a href="http://localhost/Cabinet/patient/add">Ajouter un patient</a>
    <table>
        <thead>
            <tr>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Date de naissance</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($patients)): ?>
                <tr><td colspan="4">Aucun patient trouvé.</td></tr>
            <?php else: ?>
                <?php foreach ($patients as $patient): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($patient['nom']); ?></td>
                        <td><?php echo htmlspecialchars($patient['prenom']); ?></td>
                        <td><?php echo htmlspecialchars($patient['date_naissance']); ?></td>
                        <td>
                            <a href="http://localhost/Cabinet/patient/edit/<?php echo $patient['id']; ?>">Modifier</a>
                            <a href="http://localhost/Cabinet/patient/delete/<?php echo $patient['id']; ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce patient ?');">Supprimer</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
    <script src="http://localhost/Cabinet/js/script.js"></script>
</body>
</html>