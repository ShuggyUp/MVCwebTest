<?php

class Controller404 extends Controller {

    function actionIndex($e) {
        $this->view->generate('404View.php', 'TemplateView.php', $e);
    }
}
