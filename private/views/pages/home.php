
<div class="container">
<?= GlobalUtility::createTable(Database::getAll('projects'), ['name', 'date', 'removed'], [['class' => 'btn btn-danger', 'action'=> '?delete=', 'label' => 'X'],['class' => 'btn btn-primary', 'action'=> 'edit_project?id=', 'label' => '...']], true) ?>
</div>
