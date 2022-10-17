<?php


class ModelAdminPage {

    private $login    = 'admin';
    private $password = 'admin123456789';

    public function adminLog($log, $passwd) {
        $message = '';
        $log    = FilterData::filterInput($log);
        $passwd = FilterData::filterInput($passwd);

        if (!CheckEmptyInput::isValid($log)) {
            $message = 'Поле логина не может быть пустым!';
        } else {
            if (!ValidateLoginAndPassword::isValid($log)) {
                $message = 'Некорректный формат логина!';
            }
        }

        if (!CheckEmptyInput::isValid($passwd)) {
            $message .= ' Поле пароля не может быть пустым!';
        } else {
            if (!ValidateLoginAndPassword::isValid($passwd)) {
                $message .= ' Некорректный формат пароля!';
            }
        }

        if ($log != $this->login and $passwd != $this->password) {
            $message .= ' Логин или пароль введены неверно!';
        }

        return $message;
    }

    public function addData($title, $desc) {
        $message = '';
        $title = FilterData::filterInput($title);
        $desc  = FilterData::filterInput($desc);

        if (!CheckEmptyInput::isValid($title)) {
            $message = 'Поле названия не может быть пустым!';
        }

        if (!CheckEmptyInput::isValid($desc)) {
            $message .= ' Поле пароля не может быть пустым!';
        }

        if (!$message) {
            $newsRH = new NewsRequestHandler();
            $pdoLink   = SingletonDB::getLink();

            $newsRH->insert(['title', 'description'], [$title, $desc]);
            $message = 'Данные успешно добавлены!';
        }

        return $message;
    }

    public function getData() {
        $newsRH = new NewsRequestHandler();
        $newsInformation = $newsRH->getList('*');

        return ['newsInformation' => $newsInformation];
    }

    public function editData($id, $titleNew, $descriptionNew) {
        $newsRH = new NewsRequestHandler();
        $newsRH->update(['title' => $titleNew, 'description' => $descriptionNew], $id);
    }

    public function deleteData($id) {
        $productRH = new NewsRequestHandler();
        $productRH->deleteData($id);
    }
}
