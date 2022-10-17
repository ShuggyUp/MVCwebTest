<h2 class="mt-2">Админка</h2>
<?php if ($_COOKIE['log']) : ?>

<div class="d-flex justify-content-center">
    <table class="table table-sm table-bordered table-hover table-responsive mt-2" style="width: auto">
        <thead class="thead-light">
        </thead>

        <? $newsInformation = $data['newsInformation']; ?>
        <tbody>
        <? foreach ($newsInformation as $value) : ?>
        <tr>
            <td><a class="nav-link p-0" style="color: #565e64"><?= $value['title']; ?></td>
            <td><a class="nav-link p-0" style="color: #565e64"
                   href="/AdminPage?<?= http_build_query(['id' => $value['id']]) ?>">Изменить
            </td>
        </tr>
        </tbody>
    <? endforeach; ?>
    </table>
</div>

<h2 class="mt-2">Создание новости</h2>
<div class="p-2" style="display: flex; justify-content: center; align-items: flex-start">
    <form style="width: 25%" method="post" action='/AdminPage'>
        <div class="form-group mb-0 mt-2" style="text-align: left">
            <label for="exampleFormControlInput1">Заголовок</label>
            <input class="form-control" type=text name="title">
        </div>
        <div class="form-group mb-0 mt-2" style="text-align: left">
            <label for="exampleFormControlInput1">Текст</label>
            <input class="form-control" type=text name="description">
        </div>
        <input type=submit class="btn btn-outline-primary mt-2" value="Создать новость">
        <div class="alert alert-success p-0 mt-2" style="border: 0"><?= $message; ?></div>
    </form>
</div>
<? else : ?>
    <div class="p-2" style="display: flex; justify-content: center; align-items: flex-start">
        <form style="width: 25%" method="post" action='/AdminPage'>
            <div class="form-group mb-0 mt-2" style="text-align: left">
                <label for="exampleFormControlInput1">Логин</label>
                <input class="form-control" type=text name="login">
            </div>
            <div class="form-group mb-0 mt-2" style="text-align: left">
                <label for="exampleFormControlInput1">Пароль</label>
                <input class="form-control" type=text name="password">
            </div>
            <input type=submit class="btn btn-outline-primary mt-2" value="Войти">
            <div class="alert alert-success p-0 mt-2" style="border: 0"><?= $message; ?></div>
        </form>
    </div>
<? endif; ?>
