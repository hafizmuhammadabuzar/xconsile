<section id="Content">
    <div class="row mb-4">
        <div class="col-12">
            <h1>Dashboard</h1>
        </div>
    </div>
    <div class="row Dash_boxes mb-lg-5 mb-md-3">
        <div class="col-lg col-md-4 mb-3 mb-lg-0">
            <div class="inner bg-Blue">
                <h3><?php echo number_format($total_spent); ?></h3>
                <p>Total <br> Spent</p>
                <div class="icon"><i class="fa fa-money"></i></div>	
            </div>
        </div>
        <div class="col-lg col-md-4 mb-3 mb-lg-0">
            <div class="inner bg-purple">
                <h3><?php echo number_format($last_month_spent); ?></h3>
                <p>Last <br> Month</p>
                <div class="icon"><i class="fa fa-money"></i></div>
            </div>
        </div>
        <div class="col-lg col-md-4 mb-3 mb-lg-0">
            <div class="inner bg-Navyblue">
                <h3><?php echo number_format($total_records); ?></h3>
                <p>Total Receipts</p>
                <div class="icon"><i class="fa fa-copy"></i></div>
            </div>							
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="BgWhite full py-3">
                <h1 class="mb-5">Monthly Recap Report</h1>
                <div class="chart">
                    <canvas id="salesChart" style="height: 250px;"></canvas>
                </div>
            </div>
        </div>
    </div>
</section>