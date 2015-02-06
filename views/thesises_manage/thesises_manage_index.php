

<div class="btn-group-vertical" role="group" aria-label="...">
    <? foreach ($departments as $department): ?>
    <a class="btn btn-default" href="thesises/manage/view/<?=$department['department_id']?>"><?=$department['department_name']?></a>
<? endforeach ?>
</div>

