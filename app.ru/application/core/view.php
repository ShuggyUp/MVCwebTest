<?php

class View {

    function generate($content_view, $template_view, $data = null, $message = null) {
        include __DIR__ . '/../views/' .$template_view;
    }
}
