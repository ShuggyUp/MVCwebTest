<?php

class ControllerNewsList extends Controller {

    function __construct() {
        $this->model = new ModelNewsList();
        $this->view  = new View();
    }

    function actionIndex() {
        $outputData = $this->model->getData();
        $basepage = 'NewsListView.php';

        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            if ($_GET['id']) {
                $basepage = 'NewsPageView.php';
            }
        }

        $this->view->generate($basepage, 'TemplateView.php', $outputData);
    }
}
