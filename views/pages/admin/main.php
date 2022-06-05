<section id="panel-main">
    <div class="white-box">
        <div class="white-box-header">
            <p>Stats</p>
        </div>
        <div id="panel-stats" class="white-box-content">
            <?php $basicStats = getBasicVisitsInfo(); ?>
            <div class="stat-box">
                <div class="stat-box-header">
                    <p>Logged users in last 24h</p>
                    <i class="fa-solid fa-user stat-box-icon"></i>
                </div>
                <p class="stat-box-value">/</p>
            </div>
            <div class="stat-box">
                <div class="stat-box-header">
                    <p>Total visits in last 24h</p>
                    <i class="fa-solid fa-eye stat-box-icon"></i>
                </div>
                <p class="stat-box-value"><?=$basicStats[1]?></p>
            </div>
            <div class="stat-box">
                <div class="stat-box-header">
                    <p>Total visits</p>
                    <i class="fa-solid fa-eye stat-box-icon"></i>
                </div>
                <p class="stat-box-value"><?=$basicStats[0]?></p>
            </div>
        </div>
    </div>
    <div class="white-box">
        <div class="white-box-header">
            <p>Latest activity</p>
        </div>
        <div class="white-box-content white-box-table">
            <table class="panel-table">
                <tr>
                    <th>Page</th>
                    <th>IP</th>
                    <th>User</th>
                    <th>Time</th>
                </tr>
                <?php
                    $activity = file(LOG_FILE);
                    foreach($activity as $row):
                        $columns = explode("\t", $row);
                        $date = explode("\n", $columns[3])[0];
                ?>
                <tr>
                    <td class="page-name"><?=$columns[0]?></td>
                    <td><?=$columns[1]?></td>
                    <td><?=$columns[2]?></td>
                    <td><?=date("jS M Y H:i:s", $date)?></td>
                </tr>
                <?php endforeach; ?>
            </table>
        </div>
    </div>
</section>