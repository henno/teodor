<h1><i><?= $thesis['thesis_title'] ?></i></h1>
<form id="form" method="post">
    <p><?= $thesis['thesis_description'] ?></p>
    <h4><?= $thesis['thesis_client_info'] ?></h4>
    <h4><?= $thesis['author_name'] ?></h4>
    <h4><?= $thesis['instructor_name'] ?></h4>
</form>
<? if ($auth->is_admin): ?>
    <form action="thesises/edit/<?= $thesis['thesis_id'] ?>">
        <div class="pull-right">
            <button class="btn btn-primary">
                Muuda
            </button>
        </div>
    </form>
<? endif; ?>