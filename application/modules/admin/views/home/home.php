<script src="<?= base_url('assets/highcharts/highcharts.js') ?>"></script>
<script src="<?= base_url('assets/highcharts/data.js') ?>"></script>
<script src="<?= base_url('assets/highcharts/drilldown.js') ?>"></script>
<h1><img src="<?= base_url('assets/imgs/admin-home.png') ?>" class="header-img" style="margin-top:-3px;"> Home</h1>
<hr>
<div class="home-page">
    <div class="row">
        <div class="col-lg-12">
            <ol class="breadcrumb">
                <li class="active">
                    <i class="fa fa-dashboard"></i> Dashboard - Statistics Overview
                </li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-primary">
                <div class="panel-heading fast-view-panel">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-clock-o fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge">
                                <div style="font-size: 25px;"><?= date('d.m.Y', $adminUserInfo['last_login']) ?></div>
                                <div style="font-size: 16px;"><?= date('H:m:s', $adminUserInfo['last_login']) ?></div>
                            </div>
                            <div>Last login!</div>
                        </div>
                    </div>
                </div>
                <a href="<?= base_url('admin/adminusers') ?>">
                    <div class="panel-footer">
                        <span class="pull-left">View Details</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-green">
                <div class="panel-heading fast-view-panel">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-envelope-o fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge"><?= $lastSubscribed ?></div>
                            <div>New subscribed!</div>
                        </div>
                    </div>
                </div>
                <a href="<?= base_url('admin/emails') ?>">
                    <div class="panel-footer">
                        <span class="pull-left">View Details</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-yellow">
                <div class="panel-heading fast-view-panel">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-shopping-cart fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge"><?= $newOrdersCount ?></div>
                            <div>New Orders!</div>
                        </div>
                    </div>
                </div>
                <a href="<?= base_url('admin/orders') ?>">
                    <div class="panel-footer">
                        <span class="pull-left">View Details</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-red">
                <div class="panel-heading fast-view-panel">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-sort-numeric-desc fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge"><?= $lowQuantity ?></div>
                            <div>Low Quantity Products!<br> (lower than 5)</div>
                        </div>
                    </div>
                </div>
                <a href="<?= base_url('admin/products?orderby=quantity=asc') ?>">
                    <div class="panel-footer">
                        <span class="pull-left">View Details</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="fa fa-bar-chart-o fa-fw"></i> Area Chart - Orders From Referrer</h3>
                </div>
                <div class="panel-body">
                    <div id="container-chart" style="min-width: 310px; height: 400px; margin: 0 auto;">

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="fa fa-long-arrow-right fa-fw"></i> Most Orders By Payment Type</h3>
                </div>
                <div class="panel-body">
                    <table class="table table-bordered table-hover table-striped">
                        <thead>
                            <tr>
                                <th>Payment type</th>
                                <th>Num Orders</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (!empty($mostOrdersByPaymentType)) {
                                foreach ($mostOrdersByPaymentType as $paymentT) {
                                    ?>
                                    <tr>
                                        <td><?= $paymentT['payment_type'] ?></td>
                                        <td><?= $paymentT['num'] ?></td>
                                    </tr>
                                    <?php
                                }
                            } else {
                                ?>
                                <tr>
                                    <td colspan="2">No Orders</td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="fa fa-clock-o fa-fw"></i> Last Activity Log</h3>
                </div>
                <div class="panel-body">
                    <div class="list-group">
                        <?php
                        if ($activity->result()) {
                            foreach ($activity->result() as $action) {
                                ?>
                                <a href="#" class="list-group-item">
                                    <i class="fa fa-user" aria-hidden="true"></i> <b><?= $action->username ?></b>
                                    <div><?= $action->activity . ' on ' . date('d.m.Y / H.m.s', $action->time) ?></div>
                                </a>
                                <?php
                            }
                        } else {
                            ?>
                            <tr><td colspan="3">No history found!</td></tr>
                        <?php } ?>
                    </div>
                    <div class="text-right">
                        <a href="<?= base_url('admin/history') ?>">View All Activity <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="fa fa-money fa-fw"></i> Most Sold</h3>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover table-striped">
                            <thead>
                                <tr>
                                    <th>Sales</th>
                                    <th>Url</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (!empty($mostSold)) {
                                    foreach ($mostSold as $product) {
                                        ?>
                                        <tr>
                                            <td><?= $product['procurement'] ?></td>
                                            <td><a target="_blank" href="<?= base_url($product['url']) ?>"><?= base_url($product['url']) ?></a></td>
                                        </tr>
                                        <?php
                                    }
                                } else {
                                    ?>
                                    <tr>
                                        <td colspan="2">No Orders</td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="text-right">
                        <a href="<?= base_url('admin/products?orderby=procurement=desc') ?>">View All Transactions <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(function () {
        // Create the chart
        Highcharts.chart('container-chart', {
            chart: {
                type: 'column'
            },
            title: {
                text: 'Statistics for all orders'
            },
            subtitle: {
                text: 'Most Orders By Referrer'
            },
            xAxis: {
                type: 'category'
            },
            yAxis: {
                title: {
                    text: 'Total max numbers'
                }

            },
            legend: {
                enabled: false
            },
            plotOptions: {
                series: {
                    borderWidth: 0,
                    dataLabels: {
                        enabled: true,
                        format: '{y}'
                    }
                }
            },

            tooltip: {
                headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
                pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y}</b> of total<br/>'
            },

            series: [{
                    name: 'Referrer',
                    colorByPoint: true,
                    data: [
<?php foreach ($mostReferral as $referrer) { ?>
                            {
                                name: '<?= $referrer['referrer'] ?>',
                                y: <?= $referrer['num'] ?>,
                                drilldown: '<?= $referrer['referrer'] ?>'
                            },
<?php } ?>
                    ]
                }]
        });
    });
</script>
