<section id="panel-pages">
    <div id="panel-pages-box" class="white-box">
        <div class="white-box-header">
            <p>Pages and stats</p>
        </div>
        <div class="white-box-content white-box-table">
            <table class="panel-table">
                <tr>
                    <th>Page</th>
                    <th>Total visits</th>
                    <th>Visits in last 24h</th>
                    <th>% of total visits</th>
                </tr>
                <?php 
                    $pageStats = getPageStats();

                    foreach($pageStats as $ps):
                ?>
                <tr>
                    <td class="page-name"><?=$ps->page?></td>
                    <td><?=$ps->counter?></td>
                    <td><?=$ps->counter24h?></td>
                    <td><?=$ps->percentage?>%</td>
                </tr>
                <?php endforeach; ?>
            </table>
        </div>
    </div>
</section>