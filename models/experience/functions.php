<?php

    function getAllExperiences() {
        return executeQuery("SELECT * FROM experience_review ORDER BY id ASC");
    }