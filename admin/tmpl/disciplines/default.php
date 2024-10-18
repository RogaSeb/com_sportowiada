<?php

defined('_JEXEC') or die;

// Przykładowe dane do wyświetlenia
echo '<h1>Dyscypliny Sportowe</h1>';
echo '<p>To jest przykładowy komponent Joomla!</p>';

?>

<table class="table table-striped table-hover">
    <thead>
        <tr>
            <th>Title</th>
            <th>ID</th>
        </tr>
    </thead>
   <tbody>
       <?php foreach ($this->items as $i => $item) : ?>
            <tr>
               <td><?php echo $item->title; ?></td>
               <td><?php echo $item->id; ?></td>
            </tr>
       <?php endforeach; ?>
    </tbody>
</table>