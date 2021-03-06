<?php include "controller/myMoneyController.php";?>

<div class="row">
    <div class="">
        <br>
    </div>

    <div class="col-md-12">
        <div class="money--info">
            <div class="col-md-4">
                <p class="left-border-primary">Số dư khả dụng: <?= number_format($money['money_rest']);?> VNĐ</p>
                <p class="left-border-primary">Số tiền đã sử dụng: <?= number_format(($money['money_first'] + $money['money_add']) - $money['money_rest']);?> VNĐ</p>
            </div>
            <div class="col-md-4">
                <p class="left-border-primary">Số ngày còn lại trong tháng: <?= date('t') - date('j');?> ngày</p>
                <p class="left-border-primary">Số tiền tối đa bạn NÊN dùng trong một ngày: <?=  number_format(floor($money['money_rest']/(date('t') - date('j'))));?>đ/ngày</p>
            </div>
            <div class="col-md-4">
            <p class="left-border-primary">Số dư đầu tháng: <?= number_format($money['money_first']);?> VNĐ</p>
                <p class="left-border-primary">Tổng tiền trong tháng: <?= number_format($money['money_first'] + $money['money_add']);?> VNĐ</p>
            </div>
        </div>
    </div>
    <div class="row break-line-info"></div>
    <div class="row mt-25">
        <div class="col-md-12">
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                <i class="fa fa-plus" aria-hidden="true"></i> Nhập tiền của bạn
            </button>

            <!-- Modal -->
            <?php include_once "addMoneyTemplate.php" ?>
        </div>
    </div>

    <!-- Message for add money success -->
    <div class="row row mt-25">
        <div class="col-md-6">
            <?php
                if (isset($message) && $message != '') {
                    echo "<div class='alert alert-success alert-dismissable'>
                        <button type='button' class='close' data-dismiss='alert'>×</button>
                        ".$message."
                    </div>";
                }
            ?>
        </div>
    </div>
    
    <!-- List money for month -->
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    Số tiền đã sử dụng qua các tháng
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                <p>
                    <span style="color:red">(∗)</span>
                    <span class="text-muted">Tổng tiền đã thêm là số tiền bạn đã thêm sau khi nhập khoản tiền dự định cho tháng đó</span>
                </p>
                    <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr>
                                <th class="text-center">STT</th>
                                <th class="text-center">Tháng</th>
                                <th class="text-center">Tổng tiền sử dụng</th>
                                <th class="text-center">Tổng tiền trong tháng</th>
                                <th class="text-center">Tổng tiền đã thêm</th>
                                <th class="text-center">Số lần thêm</th>
                                <th class="text-center">Max</th>
                                <th class="text-center">Số lần vượt max</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            $stt = 0;
                            foreach ($allMoney as $moneyDetail) {
                            $stt++
                        ?>
                            <tr class="gradeX">
                                <td class="text-center" style="width:10px;"><?= $stt;?></td>
                                <td class="text-center"><?= $moneyDetail['month'];?></td>
                                <td class="text-center"><?php echo number_format(($moneyDetail['money_first'] + $moneyDetail['money_add']) - $moneyDetail['money_rest']);?> VNĐ</td>
                                <td class="text-center"><?= number_format($moneyDetail['money_first'] + $moneyDetail['money_add']);?> VNĐ</td>
                                <td class="text-center"><?= number_format($moneyDetail['money_add']);?> VNĐ</td>
                                <td class="text-center"><?= $moneyDetail['count_money_add'];?> lần</td>
                                <td class="text-center"><?= number_format($moneyDetail['money_max']);?> đ/ngày</td>
                                <td class="text-center"><?= $moneyDetail['over_max'];?> lần</td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- Paging -->
            <div style="margin: 50px 0px;">
                <ul class="pagination" style="margin: 0px; padding: 0px; ">
                    <li style="pointer-events: none;"><span style=" color: #000">Trang</span></li>
                    <?php 
                        for($i=1; $i<=$num_page; $i++) {
                            if (!isset($_GET['p'])) {
                                $page = 1;
                            } else {
                                $page = $_GET['p'];
                            }
                    ?>
                    <li class="<?php echo ($page == $i) ? "active":"";?>">
                        <a href="?view=listBought&p=<?php echo $i;?>"><?php echo $i;?></a>
                    </li>
                    
                    <?php }
                        if ($num_page > 1) {
                    ?>
                        <li class="<?php echo ($page == $i) ? "active":"";?>">
                            <a href="?view=listBought&p=fix_this">
                                10 trang tiếp <i class="fa fa-angle-double-right"></i>
                            </a>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </div>
</div>
