<?php

class ModelNewsList {

    public function getData() {
        $newsRH = new NewsRequestHandler();
        $pdoLink   = SingletonDB::getLink();

        $newsInformation = $newsRH->getList('*');

        return ['newsInformation' => $newsInformation];
    }
}
