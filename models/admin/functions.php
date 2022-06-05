<?php

    function getBasicVisitsInfo() {
        $file = file(LOG_FILE);
        $allVisits = count($file);
        $past24hVisits = 0;

        foreach ($file as $row) {
            $columns = explode("\t", $row);
            $date = explode("\n", $columns[3])[0];
            $diff = time() - $date;

            if ($diff < 86400) $past24hVisits++;
        }

        return [$allVisits, $past24hVisits];
    }
    function getPageStats() {
        $pagesAndStats = [];

        $log = file(LOG_FILE);

        foreach($log as $row) {
            $columns = explode("\t", $row);
            $date = explode("\n", $columns[3])[0];

            $isPageRecorded = checkIfPageIsRecorded($columns[0], $pagesAndStats);
            if ($isPageRecorded == false) {
                recordPage($columns[0], $date, $pagesAndStats);
            }
            else {
                incrementVisits($columns[0], $date, $pagesAndStats);
            }
        }

        calculatePercentagesForPageVisits($pagesAndStats);
        return $pagesAndStats;
    }

    function checkIfPageIsRecorded($page, $array) {
        $result = false;
        foreach($array as $ps) {
            if ($ps->page == $page) {
                $result = true;
                break;
            }
        }

        return $result;
    }
    function recordPage($page, $time, &$array) {
        $record = new stdClass();
        $record->page = $page;
        $record->counter = 1;

        $diff = time() - $time;

        if($diff > 86400) $record->counter24h = 0;
        else $record->counter24h = 1;

        $array[] = $record;
    }
    function incrementVisits($page, $time, &$array) {
        foreach($array as $ps) {
            if ($ps->page == $page) {
                $ps->counter += 1;

                $diff = time() - $time;
                if($diff < 86400) $ps->counter24h += 1;
            }
        }
    }
    function calculatePercentagesForPageVisits(&$array) {
        $allVisits = 0;

        foreach($array as $ps) $allVisits += $ps->counter;

        foreach($array as $ps) {
            $percentage = ($ps->counter/$allVisits)*100;

            $ps->percentage = round($percentage, 2);
        }
    }