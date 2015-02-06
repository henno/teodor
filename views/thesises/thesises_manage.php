
<div class="btn-group-vertical" role="group" aria-label="...">
    <? foreach ($departments as $department): ?>
    <button type="button" class="btn btn-default"><?=$department['department_name']?></button>
    <? endforeach ?>
</div>

