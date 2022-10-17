<h3 class="mt-2">Список новостей</h3>
<div class="d-flex justify-content-center">
<table class="table table-sm table-bordered table-hover table-responsive mt-2" style="width: auto">
    <thead class="thead-light">
    </thead>

    <? $newsInformation = $data['newsInformation']; ?>
    <tbody>
    <? foreach ($newsInformation as $value) : ?>
    <tr>
        <td><a class="nav-link p-0" style="color: #565e64"
               href="/NewsList?<?= http_build_query(['id' => $value['id']]) ?>"><?= $value['title']; ?>
        </td>
    </tr>
    </tbody>
<? endforeach; ?>
</table>
</div>
