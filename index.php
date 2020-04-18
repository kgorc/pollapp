<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
$stmt = $pdo->query('SELECT p.*, GROUP_CONCAT(pa.title ORDER BY pa.id) AS answers FROM polls p LEFT JOIN poll_answers pa ON pa.poll_id = p.id GROUP BY p.id');
$polls = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<?=template_header('Ankiety')?>

<div class="content index">
	<h2>Ankiety</h2>
	<p>Witaj na naszej stronie. Tu będzie jakiś opis.</p>
	<a href="create.php" class="create-poll">Stwórz ankietę</a>
	<table>
        <thead>
            <tr>
                <td>#</td>
                <td>Tytuł</td>
				<td>Odpowiedzi</td>
                <td></td>
            </tr>
        </thead>
        <tbody>
			<?php foreach ($polls as $poll): ?>
            <tr>
                <td><?=$poll['id']?></td>
                <td><?=$poll['title']?></td>
				<td><?=$poll['answers']?></td>
                <td class="actions">
					<a href="vote.php?id=<?=$poll['id']?>" class="view" title="Zobacz ankietę"><i class="fas fa-eye fa-xs"></i></a>
                    <a href="delete.php?id=<?=$poll['id']?>" class="trash" title="Usuń ankietę"><i class="fas fa-trash fa-xs"></i></a>
                </td>
            </tr>
			<?php endforeach; ?>
        </tbody>
    </table>
</div>

<?=template_footer()?>
