<?php

class ControllerAdminPage extends Controller {

    function __construct() {
        $this->model = new ModelAdminPage();
        $this->view  = new View();
    }

    function actionIndex() {
        $outputData = $this->model->getData();
        $basepage = 'AdminPageView.php';

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if ($_POST['login'] or $_POST['password']) {
                $message = $this->model->adminLog($_POST['login'], $_POST['password']);

                if (!$message) {
                    setcookie('log', 'log', time() + 360);
                    header('Location: /AdminPage');
                }
            }

            if ($_POST['title'] or $_POST['description']) {
                $message = $this->model->addData($_POST['title'], $_POST['description']);
                if ($message == 'Данные успешно добавлены!') {
                    header('Location: /AdminPage');
                }
            }

            if ($_POST['titleNew'] and $_POST['descriptionNew'] and $_POST['id']) {
                $this->model->editData($_POST['id'], $_POST['titleNew'], $_POST['descriptionNew']);
                header('Location: /AdminPage');
            }

            if ($_POST['delete']) {
                $this->model->deleteData($_POST['delete']);
                header('Location: /AdminPage');
            }
        }

        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            if ($_GET['id']) {
                $basepage = 'NewsEditView.php';
            }
        }

        $this->view->generate(
            $basepage,
            'TemplateView.php',
            $outputData, $message
        );
    }
}
