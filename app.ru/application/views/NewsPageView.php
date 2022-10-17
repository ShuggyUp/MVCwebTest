<div class="d-flex justify-content-center">
<table class="table table-sm table-bordered table-hover table-responsive mt-2" style="width: auto">
    <thead class="thead-light">
    </thead>

    <? $newsInformation = $data['newsInformation']; ?>
    <tbody>
    <? foreach ($newsInformation as $value) : ?>
    <? if ($value['id'] == $_GET['id']) : ?>
    <tr>
        <td><a class="nav-link p-0" style="color: #565e64"><?= $value['title']; ?></td>
    </tr>
    <tr>
        <td><a class="nav-link p-0" style="color: #565e64"><?= $value['description']; ?></td>
    </tr>
    <? endif; ?>
    </tbody>
<? endforeach; ?>
</table>
</div>

<div class="p-2" style="display: flex; justify-content: center; align-items: flex-start">
    <form style="width: 25%" method="post" action='/NewsList'>
        <input type=submit class="btn btn-outline-primary mt-2" value="Вернуться к списку">
    </form>
</div>

