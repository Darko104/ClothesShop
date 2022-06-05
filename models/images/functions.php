<?php

    function getLastInsertedImages($amount) {
        return executeQuery("SELECT id FROM image ORDER BY id DESC LIMIT $amount");
    }