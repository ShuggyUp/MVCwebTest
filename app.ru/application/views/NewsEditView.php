<? $newsInformation = $data['newsInformation']; ?>

<? foreach ($newsInformation as $value) : ?>
    <? if ($value['id'] == $_GET['id']) : ?>
        <div class="p-2" style="display: flex; justify-content: center; align-items: flex-start">
            <form style="width: 25%" method="post" action='/AdminPage'>
                <div class="form-group mb-0 mt-2" style="text-align: left">
                    <label for="exampleFormControlInput1">Заголовок</label>
                    <input class="form-control" type=text name="titleNew" value="<? echo $value['title']; ?>">
                </div>
                <div class="form-group mb-0 mt-2" style="text-align: left">
                    <label for="exampleFormControlInput1">Текст</label>
                    <textarea class="form-control" name="descriptionNew" rows="5"><? echo $value['description']; ?></textarea>
                </div>
                <input type="hidden" name="id" value="<? echo $_GET['id']; ?>">
                <input type=submit class="btn btn-outline-primary mt-2" value="Сохранить изменения">
            </form>
        </div>
    <? endif; ?>
<? endforeach; ?>

<div class="p-2" style="display: flex; justify-content: center; align-items: flex-start">
    <form style="width: 25%" method="post" action='/AdminPage'>
        <input type=submit class="btn btn-outline-primary mt-2" value="Вернуться к списку">
    </form>
    <form style="width: 25%" method="post" action='/AdminPage'>
        <input type=submit class="btn btn-outline-primary mt-2" value="Удалить">
        <input type="hidden" name="delete" value="<? echo $_GET['id']; ?>">
    </form>
</div>