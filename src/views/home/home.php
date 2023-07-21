<div>
  <div class="row">
    <div class="col-lg-8 mb-4 order-0">
      <div class="card">
        <div class="d-flex align-items-end row">
          <div class="col-sm-7">
            <div class="card-body">
              <h5 class="card-title text-primary">Bienvenido, <?= $_SESSION['nombre'] . ' ' . $_SESSION['apellido'] ?> 🎉</h5>
              <p class="mb-4">
                <span class="fw-bold">Hoy es :</span> <?= Date('d') . ', ' . Date('D') . ' ' . Date('M') . ' ' . Date('Y') ?>
              <h5 class="text-thin"> Que gran día, para hacer mejor las cosas</h5>

              </p>

              </h2>
              <!--    <a href="javascript:;" class="btn btn-sm btn-outline-primary">View Badges</a> -->
            </div>
          </div>
          <div class="col-sm-5 text-center text-sm-left">
            <div class="card-body pb-0 px-0 px-md-4">
              <img src="<?= APP_URL ?>assets/img/illustrations/man-with-laptop-light.png" height="140" alt="View Badge User" data-app-dark-img="illustrations/man-with-laptop-dark.png" data-app-light-img="illustrations/man-with-laptop-light.png">
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-4 col-md-4 order-1">
      <div class="row">
        <div class="col-lg-6 col-md-12 col-6 mb-4">
          <div class="card">
            <div class="card-body">
              <div class="card-title d-flex align-items-start justify-content-between">
                <div class="avatar flex-shrink-0">
                  <img src="<?= APP_URL ?>assets/img/icons/unicons/usuario-verificado.png" alt="chart success" class="rounded">
                </div>
                <!-- <div class="dropdown">
                              <button class="btn p-0" type="button" id="cardOpt3" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="bx bx-dots-vertical-rounded"></i>
                              </button>
                              <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt3">
                                <a class="dropdown-item" href="javascript:void(0);">View More</a>
                                <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                              </div>
                            </div> -->
              </div>
              <span class="fw-semibold d-block mb-1">Activos</span>
              <h3 class="card-title mb-2"><?= $activos ?></h3>
              <!--        <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> +72.80%</small> -->
            </div>
          </div>
        </div>
        <div class="col-lg-6 col-md-12 col-6 mb-4">
          <div class="card">
            <div class="card-body">
              <div class="card-title d-flex align-items-start justify-content-between">
                <div class="avatar flex-shrink-0">
                  <img src="<?= APP_URL ?>assets/img/icons/unicons/bloquear-usuario.png" alt="Credit Card" class="rounded">
                </div>
                <!--          <div class="dropdown">
                              <button class="btn p-0" type="button" id="cardOpt6" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="bx bx-dots-vertical-rounded"></i>
                              </button>
                              <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt6">
                                <a class="dropdown-item" href="javascript:void(0);">View More</a>
                                <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                              </div>
                            </div> -->
              </div>
              <span class="fw-semibold d-block mb-1">Inactivos</span>
              <h3 class="card-title text-nowrap mb-1"><?= $inactivos ?></h3>
              <!--       <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> +28.42%</small> -->
            </div>
          </div>
        </div>
      </div>
    </div>
    <!--   <div class="col-lg-4 col-md-4 order-1">
      <div class="row">
        <div class="col-lg-6 col-md-12 col-6 mb-4">
          <div class="card">
            <div class="card-body">
              <div class="card-title d-flex align-items-start justify-content-between">
                <div class="avatar flex-shrink-0">
                  <img src="<?= APP_URL ?>assets/img/icons/unicons/chart-success.png" alt="chart success" class="rounded">
                </div>
                <div class="dropdown">
                  <button class="btn p-0" type="button" id="cardOpt3" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="bx bx-dots-vertical-rounded"></i>
                  </button>
                  <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt3">
                    <a class="dropdown-item" href="javascript:void(0);">View More</a>
                    <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                  </div>
                </div>
              </div>
              <span class="fw-semibold d-block mb-1">Profit</span>
              <h3 class="card-title mb-2">$12,628</h3>
              <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> +72.80%</small>
            </div>
          </div>
        </div>
        <div class="col-lg-6 col-md-12 col-6 mb-4">
          <div class="card">
            <div class="card-body">
              <div class="card-title d-flex align-items-start justify-content-between">
                <div class="avatar flex-shrink-0">
                  <img src="<?= APP_URL ?>assets/img/icons/unicons/wallet-info.png" alt="Credit Card" class="rounded">
                </div>
                <div class="dropdown">
                  <button class="btn p-0" type="button" id="cardOpt6" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="bx bx-dots-vertical-rounded"></i>
                  </button>
                  <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt6">
                    <a class="dropdown-item" href="javascript:void(0);">View More</a>
                    <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                  </div>
                </div>
              </div>
              <span>Sales</span>
              <h3 class="card-title text-nowrap mb-1">$4,679</h3>
              <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> +28.42%</small>
            </div>
          </div>
        </div>
      </div>
    </div> -->
    <!-- Total Revenue -->
    <!-- <div class="col-12 col-lg-8 order-2 order-md-3 order-lg-2 mb-4">
      <div class="card">
        <div class="row row-bordered g-0">
          <div class="col-md-8">
            <h5 class="card-header m-0 me-2 pb-3">Total Revenue</h5>
            <div id="totalRevenueChart" class="px-2" style="min-height: 315px;">
              <div id="apexcharts0c5pmtgr" class="apexcharts-canvas apexcharts0c5pmtgr apexcharts-theme-light" style="width: 440px; height: 300px;"><svg id="SvgjsSvg1571" width="440" height="300" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.dev" class="apexcharts-svg" xmlns:data="ApexChartsNS" transform="translate(0, 0)" style="background: transparent;">
                  <foreignObject x="0" y="0" width="440" height="300">
                    <div class="apexcharts-legend apexcharts-align-left apx-legend-position-top" xmlns="http://www.w3.org/1999/xhtml" style="right: 0px; position: absolute; left: 0px; top: 4px; max-height: 150px;">
                      <div class="apexcharts-legend-series" rel="1" seriesname="2021" data:collapsed="false" style="margin: 2px 10px;"><span class="apexcharts-legend-marker" rel="1" data:collapsed="false" style="background: rgb(105, 108, 255) !important; color: rgb(105, 108, 255); height: 8px; width: 8px; left: -3px; top: 0px; border-width: 0px; border-color: rgb(255, 255, 255); border-radius: 12px;"></span><span class="apexcharts-legend-text" rel="1" i="0" data:default-text="2021" data:collapsed="false" style="color: rgb(161, 172, 184); font-size: 12px; font-weight: 400; font-family: Helvetica, Arial, sans-serif;">2021</span></div>
                      <div class="apexcharts-legend-series" rel="2" seriesname="2020" data:collapsed="false" style="margin: 2px 10px;"><span class="apexcharts-legend-marker" rel="2" data:collapsed="false" style="background: rgb(3, 195, 236) !important; color: rgb(3, 195, 236); height: 8px; width: 8px; left: -3px; top: 0px; border-width: 0px; border-color: rgb(255, 255, 255); border-radius: 12px;"></span><span class="apexcharts-legend-text" rel="2" i="1" data:default-text="2020" data:collapsed="false" style="color: rgb(161, 172, 184); font-size: 12px; font-weight: 400; font-family: Helvetica, Arial, sans-serif;">2020</span></div>
                    </div>
                    <style type="text/css">
                      .apexcharts-legend {
                        display: flex;
                        overflow: auto;
                        padding: 0 10px;
                      }

                      .apexcharts-legend.apx-legend-position-bottom,
                      .apexcharts-legend.apx-legend-position-top {
                        flex-wrap: wrap
                      }

                      .apexcharts-legend.apx-legend-position-right,
                      .apexcharts-legend.apx-legend-position-left {
                        flex-direction: column;
                        bottom: 0;
                      }

                      .apexcharts-legend.apx-legend-position-bottom.apexcharts-align-left,
                      .apexcharts-legend.apx-legend-position-top.apexcharts-align-left,
                      .apexcharts-legend.apx-legend-position-right,
                      .apexcharts-legend.apx-legend-position-left {
                        justify-content: flex-start;
                      }

                      .apexcharts-legend.apx-legend-position-bottom.apexcharts-align-center,
                      .apexcharts-legend.apx-legend-position-top.apexcharts-align-center {
                        justify-content: center;
                      }

                      .apexcharts-legend.apx-legend-position-bottom.apexcharts-align-right,
                      .apexcharts-legend.apx-legend-position-top.apexcharts-align-right {
                        justify-content: flex-end;
                      }

                      .apexcharts-legend-series {
                        cursor: pointer;
                        line-height: normal;
                      }

                      .apexcharts-legend.apx-legend-position-bottom .apexcharts-legend-series,
                      .apexcharts-legend.apx-legend-position-top .apexcharts-legend-series {
                        display: flex;
                        align-items: center;
                      }

                      .apexcharts-legend-text {
                        position: relative;
                        font-size: 14px;
                      }

                      .apexcharts-legend-text *,
                      .apexcharts-legend-marker * {
                        pointer-events: none;
                      }

                      .apexcharts-legend-marker {
                        position: relative;
                        display: inline-block;
                        cursor: pointer;
                        margin-right: 3px;
                        border-style: solid;
                      }

                      .apexcharts-legend.apexcharts-align-right .apexcharts-legend-series,
                      .apexcharts-legend.apexcharts-align-left .apexcharts-legend-series {
                        display: inline-block;
                      }

                      .apexcharts-legend-series.apexcharts-no-click {
                        cursor: auto;
                      }

                      .apexcharts-legend .apexcharts-hidden-zero-series,
                      .apexcharts-legend .apexcharts-hidden-null-series {
                        display: none !important;
                      }

                      .apexcharts-inactive-legend {
                        opacity: 0.45;
                      }
                    </style>
                  </foreignObject>
                  <g id="SvgjsG1573" class="apexcharts-inner apexcharts-graphical" transform="translate(53.796875, 51)">
                    <defs id="SvgjsDefs1572">
                      <linearGradient id="SvgjsLinearGradient1577" x1="0" y1="0" x2="0" y2="1">
                        <stop id="SvgjsStop1578" stop-opacity="0.4" stop-color="rgba(216,227,240,0.4)" offset="0"></stop>
                        <stop id="SvgjsStop1579" stop-opacity="0.5" stop-color="rgba(190,209,230,0.5)" offset="1"></stop>
                        <stop id="SvgjsStop1580" stop-opacity="0.5" stop-color="rgba(190,209,230,0.5)" offset="1"></stop>
                      </linearGradient>
                      <clipPath id="gridRectMask0c5pmtgr">
                        <rect id="SvgjsRect1582" width="376.203125" height="223.73" x="-5" y="-3" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff"></rect>
                      </clipPath>
                      <clipPath id="forecastMask0c5pmtgr"></clipPath>
                      <clipPath id="nonForecastMask0c5pmtgr"></clipPath>
                      <clipPath id="gridRectMarkerMask0c5pmtgr">
                        <rect id="SvgjsRect1583" width="370.203125" height="221.73" x="-2" y="-2" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff"></rect>
                      </clipPath>
                    </defs>
                    <rect id="SvgjsRect1581" width="21.9721875" height="217.73" x="0" y="0" rx="0" ry="0" opacity="1" stroke-width="0" stroke-dasharray="3" fill="url(#SvgjsLinearGradient1577)" class="apexcharts-xcrosshairs" y2="217.73" filter="none" fill-opacity="0.9"></rect>
                    <g id="SvgjsG1603" class="apexcharts-xaxis" transform="translate(0, 0)">
                      <g id="SvgjsG1604" class="apexcharts-xaxis-texts-g" transform="translate(0, -4)"><text id="SvgjsText1606" font-family="Helvetica, Arial, sans-serif" x="26.157366071428573" y="246.73" text-anchor="middle" dominant-baseline="auto" font-size="13px" font-weight="400" fill="#a1acb8" class="apexcharts-text apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;">
                          <tspan id="SvgjsTspan1607">Jan</tspan>
                          <title>Jan</title>
                        </text><text id="SvgjsText1609" font-family="Helvetica, Arial, sans-serif" x="78.47209821428572" y="246.73" text-anchor="middle" dominant-baseline="auto" font-size="13px" font-weight="400" fill="#a1acb8" class="apexcharts-text apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;">
                          <tspan id="SvgjsTspan1610">Feb</tspan>
                          <title>Feb</title>
                        </text><text id="SvgjsText1612" font-family="Helvetica, Arial, sans-serif" x="130.78683035714286" y="246.73" text-anchor="middle" dominant-baseline="auto" font-size="13px" font-weight="400" fill="#a1acb8" class="apexcharts-text apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;">
                          <tspan id="SvgjsTspan1613">Mar</tspan>
                          <title>Mar</title>
                        </text><text id="SvgjsText1615" font-family="Helvetica, Arial, sans-serif" x="183.1015625" y="246.73" text-anchor="middle" dominant-baseline="auto" font-size="13px" font-weight="400" fill="#a1acb8" class="apexcharts-text apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;">
                          <tspan id="SvgjsTspan1616">Apr</tspan>
                          <title>Apr</title>
                        </text><text id="SvgjsText1618" font-family="Helvetica, Arial, sans-serif" x="235.41629464285714" y="246.73" text-anchor="middle" dominant-baseline="auto" font-size="13px" font-weight="400" fill="#a1acb8" class="apexcharts-text apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;">
                          <tspan id="SvgjsTspan1619">May</tspan>
                          <title>May</title>
                        </text><text id="SvgjsText1621" font-family="Helvetica, Arial, sans-serif" x="287.73102678571433" y="246.73" text-anchor="middle" dominant-baseline="auto" font-size="13px" font-weight="400" fill="#a1acb8" class="apexcharts-text apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;">
                          <tspan id="SvgjsTspan1622">Jun</tspan>
                          <title>Jun</title>
                        </text><text id="SvgjsText1624" font-family="Helvetica, Arial, sans-serif" x="340.0457589285715" y="246.73" text-anchor="middle" dominant-baseline="auto" font-size="13px" font-weight="400" fill="#a1acb8" class="apexcharts-text apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;">
                          <tspan id="SvgjsTspan1625">Jul</tspan>
                          <title>Jul</title>
                        </text></g>
                    </g>
                    <g id="SvgjsG1640" class="apexcharts-grid">
                      <g id="SvgjsG1641" class="apexcharts-gridlines-horizontal">
                        <line id="SvgjsLine1643" x1="0" y1="0" x2="366.203125" y2="0" stroke="#eceef1" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline"></line>
                        <line id="SvgjsLine1644" x1="0" y1="43.546" x2="366.203125" y2="43.546" stroke="#eceef1" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline"></line>
                        <line id="SvgjsLine1645" x1="0" y1="87.092" x2="366.203125" y2="87.092" stroke="#eceef1" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline"></line>
                        <line id="SvgjsLine1646" x1="0" y1="130.638" x2="366.203125" y2="130.638" stroke="#eceef1" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline"></line>
                        <line id="SvgjsLine1647" x1="0" y1="174.184" x2="366.203125" y2="174.184" stroke="#eceef1" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline"></line>
                        <line id="SvgjsLine1648" x1="0" y1="217.73" x2="366.203125" y2="217.73" stroke="#eceef1" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline"></line>
                      </g>
                      <g id="SvgjsG1642" class="apexcharts-gridlines-vertical"></g>
                      <line id="SvgjsLine1650" x1="0" y1="217.73" x2="366.203125" y2="217.73" stroke="transparent" stroke-dasharray="0" stroke-linecap="butt"></line>
                      <line id="SvgjsLine1649" x1="0" y1="1" x2="0" y2="217.73" stroke="transparent" stroke-dasharray="0" stroke-linecap="butt"></line>
                    </g>
                    <g id="SvgjsG1584" class="apexcharts-bar-series apexcharts-plot-series">
                      <g id="SvgjsG1585" class="apexcharts-series" seriesName="2021" rel="1" data:realIndex="0">
                        <path id="SvgjsPath1587" d="M 15.171272321428573 120.638L 15.171272321428573 62.255200000000016Q 15.171272321428573 52.255200000000016 25.171272321428575 52.255200000000016L 21.14345982142857 52.255200000000016Q 31.14345982142857 52.255200000000016 31.14345982142857 62.255200000000016L 31.14345982142857 62.255200000000016L 31.14345982142857 120.638Q 31.14345982142857 130.638 21.14345982142857 130.638L 25.171272321428575 130.638Q 15.171272321428573 130.638 15.171272321428573 120.638z" fill="rgba(105,108,255,0.85)" fill-opacity="1" stroke="#ffffff" stroke-opacity="1" stroke-linecap="round" stroke-width="6" stroke-dasharray="0" class="apexcharts-bar-area" index="0" clip-path="url(#gridRectMask0c5pmtgr)" pathTo="M 15.171272321428573 120.638L 15.171272321428573 62.255200000000016Q 15.171272321428573 52.255200000000016 25.171272321428575 52.255200000000016L 21.14345982142857 52.255200000000016Q 31.14345982142857 52.255200000000016 31.14345982142857 62.255200000000016L 31.14345982142857 62.255200000000016L 31.14345982142857 120.638Q 31.14345982142857 130.638 21.14345982142857 130.638L 25.171272321428575 130.638Q 15.171272321428573 130.638 15.171272321428573 120.638z" pathFrom="M 15.171272321428573 120.638L 15.171272321428573 120.638L 31.14345982142857 120.638L 31.14345982142857 120.638L 31.14345982142857 120.638L 31.14345982142857 120.638L 31.14345982142857 120.638L 15.171272321428573 120.638" cy="52.255200000000016" cx="64.48600446428571" j="0" val="18" barHeight="78.38279999999999" barWidth="21.9721875"></path>
                        <path id="SvgjsPath1588" d="M 67.48600446428571 120.638L 67.48600446428571 110.15580000000001Q 67.48600446428571 100.15580000000001 77.48600446428571 100.15580000000001L 73.45819196428572 100.15580000000001Q 83.45819196428572 100.15580000000001 83.45819196428572 110.15580000000001L 83.45819196428572 110.15580000000001L 83.45819196428572 120.638Q 83.45819196428572 130.638 73.45819196428572 130.638L 77.48600446428571 130.638Q 67.48600446428571 130.638 67.48600446428571 120.638z" fill="rgba(105,108,255,0.85)" fill-opacity="1" stroke="#ffffff" stroke-opacity="1" stroke-linecap="round" stroke-width="6" stroke-dasharray="0" class="apexcharts-bar-area" index="0" clip-path="url(#gridRectMask0c5pmtgr)" pathTo="M 67.48600446428571 120.638L 67.48600446428571 110.15580000000001Q 67.48600446428571 100.15580000000001 77.48600446428571 100.15580000000001L 73.45819196428572 100.15580000000001Q 83.45819196428572 100.15580000000001 83.45819196428572 110.15580000000001L 83.45819196428572 110.15580000000001L 83.45819196428572 120.638Q 83.45819196428572 130.638 73.45819196428572 130.638L 77.48600446428571 130.638Q 67.48600446428571 130.638 67.48600446428571 120.638z" pathFrom="M 67.48600446428571 120.638L 67.48600446428571 120.638L 83.45819196428572 120.638L 83.45819196428572 120.638L 83.45819196428572 120.638L 83.45819196428572 120.638L 83.45819196428572 120.638L 67.48600446428571 120.638" cy="100.15580000000001" cx="116.80073660714285" j="1" val="7" barHeight="30.482199999999995" barWidth="21.9721875"></path>
                        <path id="SvgjsPath1589" d="M 119.80073660714285 120.638L 119.80073660714285 75.31900000000002Q 119.80073660714285 65.31900000000002 129.80073660714285 65.31900000000002L 125.77292410714284 65.31900000000002Q 135.77292410714284 65.31900000000002 135.77292410714284 75.31900000000002L 135.77292410714284 75.31900000000002L 135.77292410714284 120.638Q 135.77292410714284 130.638 125.77292410714284 130.638L 129.80073660714285 130.638Q 119.80073660714285 130.638 119.80073660714285 120.638z" fill="rgba(105,108,255,0.85)" fill-opacity="1" stroke="#ffffff" stroke-opacity="1" stroke-linecap="round" stroke-width="6" stroke-dasharray="0" class="apexcharts-bar-area" index="0" clip-path="url(#gridRectMask0c5pmtgr)" pathTo="M 119.80073660714285 120.638L 119.80073660714285 75.31900000000002Q 119.80073660714285 65.31900000000002 129.80073660714285 65.31900000000002L 125.77292410714284 65.31900000000002Q 135.77292410714284 65.31900000000002 135.77292410714284 75.31900000000002L 135.77292410714284 75.31900000000002L 135.77292410714284 120.638Q 135.77292410714284 130.638 125.77292410714284 130.638L 129.80073660714285 130.638Q 119.80073660714285 130.638 119.80073660714285 120.638z" pathFrom="M 119.80073660714285 120.638L 119.80073660714285 120.638L 135.77292410714284 120.638L 135.77292410714284 120.638L 135.77292410714284 120.638L 135.77292410714284 120.638L 135.77292410714284 120.638L 119.80073660714285 120.638" cy="65.31900000000002" cx="169.11546875" j="2" val="15" barHeight="65.31899999999999" barWidth="21.9721875"></path>
                        <path id="SvgjsPath1590" d="M 172.11546875 120.638L 172.11546875 14.35460000000002Q 172.11546875 4.354600000000019 182.11546875 4.354600000000019L 178.08765624999998 4.354600000000019Q 188.08765624999998 4.354600000000019 188.08765624999998 14.35460000000002L 188.08765624999998 14.35460000000002L 188.08765624999998 120.638Q 188.08765624999998 130.638 178.08765624999998 130.638L 182.11546875 130.638Q 172.11546875 130.638 172.11546875 120.638z" fill="rgba(105,108,255,0.85)" fill-opacity="1" stroke="#ffffff" stroke-opacity="1" stroke-linecap="round" stroke-width="6" stroke-dasharray="0" class="apexcharts-bar-area" index="0" clip-path="url(#gridRectMask0c5pmtgr)" pathTo="M 172.11546875 120.638L 172.11546875 14.35460000000002Q 172.11546875 4.354600000000019 182.11546875 4.354600000000019L 178.08765624999998 4.354600000000019Q 188.08765624999998 4.354600000000019 188.08765624999998 14.35460000000002L 188.08765624999998 14.35460000000002L 188.08765624999998 120.638Q 188.08765624999998 130.638 178.08765624999998 130.638L 182.11546875 130.638Q 172.11546875 130.638 172.11546875 120.638z" pathFrom="M 172.11546875 120.638L 172.11546875 120.638L 188.08765624999998 120.638L 188.08765624999998 120.638L 188.08765624999998 120.638L 188.08765624999998 120.638L 188.08765624999998 120.638L 172.11546875 120.638" cy="4.354600000000019" cx="221.43020089285713" j="3" val="29" barHeight="126.28339999999999" barWidth="21.9721875"></path>
                        <path id="SvgjsPath1591" d="M 224.43020089285713 120.638L 224.43020089285713 62.255200000000016Q 224.43020089285713 52.255200000000016 234.43020089285713 52.255200000000016L 230.40238839285712 52.255200000000016Q 240.40238839285712 52.255200000000016 240.40238839285712 62.255200000000016L 240.40238839285712 62.255200000000016L 240.40238839285712 120.638Q 240.40238839285712 130.638 230.40238839285712 130.638L 234.43020089285713 130.638Q 224.43020089285713 130.638 224.43020089285713 120.638z" fill="rgba(105,108,255,0.85)" fill-opacity="1" stroke="#ffffff" stroke-opacity="1" stroke-linecap="round" stroke-width="6" stroke-dasharray="0" class="apexcharts-bar-area" index="0" clip-path="url(#gridRectMask0c5pmtgr)" pathTo="M 224.43020089285713 120.638L 224.43020089285713 62.255200000000016Q 224.43020089285713 52.255200000000016 234.43020089285713 52.255200000000016L 230.40238839285712 52.255200000000016Q 240.40238839285712 52.255200000000016 240.40238839285712 62.255200000000016L 240.40238839285712 62.255200000000016L 240.40238839285712 120.638Q 240.40238839285712 130.638 230.40238839285712 130.638L 234.43020089285713 130.638Q 224.43020089285713 130.638 224.43020089285713 120.638z" pathFrom="M 224.43020089285713 120.638L 224.43020089285713 120.638L 240.40238839285712 120.638L 240.40238839285712 120.638L 240.40238839285712 120.638L 240.40238839285712 120.638L 240.40238839285712 120.638L 224.43020089285713 120.638" cy="52.255200000000016" cx="273.74493303571427" j="4" val="18" barHeight="78.38279999999999" barWidth="21.9721875"></path>
                        <path id="SvgjsPath1592" d="M 276.74493303571427 120.638L 276.74493303571427 88.3828Q 276.74493303571427 78.3828 286.74493303571427 78.3828L 282.7171205357143 78.3828Q 292.7171205357143 78.3828 292.7171205357143 88.3828L 292.7171205357143 88.3828L 292.7171205357143 120.638Q 292.7171205357143 130.638 282.7171205357143 130.638L 286.74493303571427 130.638Q 276.74493303571427 130.638 276.74493303571427 120.638z" fill="rgba(105,108,255,0.85)" fill-opacity="1" stroke="#ffffff" stroke-opacity="1" stroke-linecap="round" stroke-width="6" stroke-dasharray="0" class="apexcharts-bar-area" index="0" clip-path="url(#gridRectMask0c5pmtgr)" pathTo="M 276.74493303571427 120.638L 276.74493303571427 88.3828Q 276.74493303571427 78.3828 286.74493303571427 78.3828L 282.7171205357143 78.3828Q 292.7171205357143 78.3828 292.7171205357143 88.3828L 292.7171205357143 88.3828L 292.7171205357143 120.638Q 292.7171205357143 130.638 282.7171205357143 130.638L 286.74493303571427 130.638Q 276.74493303571427 130.638 276.74493303571427 120.638z" pathFrom="M 276.74493303571427 120.638L 276.74493303571427 120.638L 292.7171205357143 120.638L 292.7171205357143 120.638L 292.7171205357143 120.638L 292.7171205357143 120.638L 292.7171205357143 120.638L 276.74493303571427 120.638" cy="78.3828" cx="326.05966517857144" j="5" val="12" barHeight="52.255199999999995" barWidth="21.9721875"></path>
                        <path id="SvgjsPath1593" d="M 329.05966517857144 120.638L 329.05966517857144 101.44660000000002Q 329.05966517857144 91.44660000000002 339.05966517857144 91.44660000000002L 335.03185267857145 91.44660000000002Q 345.03185267857145 91.44660000000002 345.03185267857145 101.44660000000002L 345.03185267857145 101.44660000000002L 345.03185267857145 120.638Q 345.03185267857145 130.638 335.03185267857145 130.638L 339.05966517857144 130.638Q 329.05966517857144 130.638 329.05966517857144 120.638z" fill="rgba(105,108,255,0.85)" fill-opacity="1" stroke="#ffffff" stroke-opacity="1" stroke-linecap="round" stroke-width="6" stroke-dasharray="0" class="apexcharts-bar-area" index="0" clip-path="url(#gridRectMask0c5pmtgr)" pathTo="M 329.05966517857144 120.638L 329.05966517857144 101.44660000000002Q 329.05966517857144 91.44660000000002 339.05966517857144 91.44660000000002L 335.03185267857145 91.44660000000002Q 345.03185267857145 91.44660000000002 345.03185267857145 101.44660000000002L 345.03185267857145 101.44660000000002L 345.03185267857145 120.638Q 345.03185267857145 130.638 335.03185267857145 130.638L 339.05966517857144 130.638Q 329.05966517857144 130.638 329.05966517857144 120.638z" pathFrom="M 329.05966517857144 120.638L 329.05966517857144 120.638L 345.03185267857145 120.638L 345.03185267857145 120.638L 345.03185267857145 120.638L 345.03185267857145 120.638L 345.03185267857145 120.638L 329.05966517857144 120.638" cy="91.44660000000002" cx="378.3743973214286" j="6" val="9" barHeight="39.191399999999994" barWidth="21.9721875"></path>
                      </g>
                      <g id="SvgjsG1594" class="apexcharts-series" seriesName="2020" rel="2" data:realIndex="1">
                        <path id="SvgjsPath1596" d="M 15.171272321428573 150.638L 15.171272321428573 187.24779999999998Q 15.171272321428573 197.24779999999998 25.171272321428575 197.24779999999998L 21.14345982142857 197.24779999999998Q 31.14345982142857 197.24779999999998 31.14345982142857 187.24779999999998L 31.14345982142857 187.24779999999998L 31.14345982142857 150.638Q 31.14345982142857 140.638 21.14345982142857 140.638L 25.171272321428575 140.638Q 15.171272321428573 140.638 15.171272321428573 150.638z" fill="rgba(3,195,236,0.85)" fill-opacity="1" stroke="#ffffff" stroke-opacity="1" stroke-linecap="round" stroke-width="6" stroke-dasharray="0" class="apexcharts-bar-area" index="1" clip-path="url(#gridRectMask0c5pmtgr)" pathTo="M 15.171272321428573 150.638L 15.171272321428573 187.24779999999998Q 15.171272321428573 197.24779999999998 25.171272321428575 197.24779999999998L 21.14345982142857 197.24779999999998Q 31.14345982142857 197.24779999999998 31.14345982142857 187.24779999999998L 31.14345982142857 187.24779999999998L 31.14345982142857 150.638Q 31.14345982142857 140.638 21.14345982142857 140.638L 25.171272321428575 140.638Q 15.171272321428573 140.638 15.171272321428573 150.638z" pathFrom="M 15.171272321428573 150.638L 15.171272321428573 150.638L 31.14345982142857 150.638L 31.14345982142857 150.638L 31.14345982142857 150.638L 31.14345982142857 150.638L 31.14345982142857 150.638L 15.171272321428573 150.638" cy="177.24779999999998" cx="64.48600446428571" j="0" val="-13" barHeight="-56.60979999999999" barWidth="21.9721875"></path>
                        <path id="SvgjsPath1597" d="M 67.48600446428571 150.638L 67.48600446428571 209.0208Q 67.48600446428571 219.0208 77.48600446428571 219.0208L 73.45819196428572 219.0208Q 83.45819196428572 219.0208 83.45819196428572 209.0208L 83.45819196428572 209.0208L 83.45819196428572 150.638Q 83.45819196428572 140.638 73.45819196428572 140.638L 77.48600446428571 140.638Q 67.48600446428571 140.638 67.48600446428571 150.638z" fill="rgba(3,195,236,0.85)" fill-opacity="1" stroke="#ffffff" stroke-opacity="1" stroke-linecap="round" stroke-width="6" stroke-dasharray="0" class="apexcharts-bar-area" index="1" clip-path="url(#gridRectMask0c5pmtgr)" pathTo="M 67.48600446428571 150.638L 67.48600446428571 209.0208Q 67.48600446428571 219.0208 77.48600446428571 219.0208L 73.45819196428572 219.0208Q 83.45819196428572 219.0208 83.45819196428572 209.0208L 83.45819196428572 209.0208L 83.45819196428572 150.638Q 83.45819196428572 140.638 73.45819196428572 140.638L 77.48600446428571 140.638Q 67.48600446428571 140.638 67.48600446428571 150.638z" pathFrom="M 67.48600446428571 150.638L 67.48600446428571 150.638L 83.45819196428572 150.638L 83.45819196428572 150.638L 83.45819196428572 150.638L 83.45819196428572 150.638L 83.45819196428572 150.638L 67.48600446428571 150.638" cy="199.0208" cx="116.80073660714285" j="1" val="-18" barHeight="-78.38279999999999" barWidth="21.9721875"></path>
                        <path id="SvgjsPath1598" d="M 119.80073660714285 150.638L 119.80073660714285 169.8294Q 119.80073660714285 179.8294 129.80073660714285 179.8294L 125.77292410714284 179.8294Q 135.77292410714284 179.8294 135.77292410714284 169.8294L 135.77292410714284 169.8294L 135.77292410714284 150.638Q 135.77292410714284 140.638 125.77292410714284 140.638L 129.80073660714285 140.638Q 119.80073660714285 140.638 119.80073660714285 150.638z" fill="rgba(3,195,236,0.85)" fill-opacity="1" stroke="#ffffff" stroke-opacity="1" stroke-linecap="round" stroke-width="6" stroke-dasharray="0" class="apexcharts-bar-area" index="1" clip-path="url(#gridRectMask0c5pmtgr)" pathTo="M 119.80073660714285 150.638L 119.80073660714285 169.8294Q 119.80073660714285 179.8294 129.80073660714285 179.8294L 125.77292410714284 179.8294Q 135.77292410714284 179.8294 135.77292410714284 169.8294L 135.77292410714284 169.8294L 135.77292410714284 150.638Q 135.77292410714284 140.638 125.77292410714284 140.638L 129.80073660714285 140.638Q 119.80073660714285 140.638 119.80073660714285 150.638z" pathFrom="M 119.80073660714285 150.638L 119.80073660714285 150.638L 135.77292410714284 150.638L 135.77292410714284 150.638L 135.77292410714284 150.638L 135.77292410714284 150.638L 135.77292410714284 150.638L 119.80073660714285 150.638" cy="159.8294" cx="169.11546875" j="2" val="-9" barHeight="-39.191399999999994" barWidth="21.9721875"></path>
                        <path id="SvgjsPath1599" d="M 172.11546875 150.638L 172.11546875 191.6024Q 172.11546875 201.6024 182.11546875 201.6024L 178.08765624999998 201.6024Q 188.08765624999998 201.6024 188.08765624999998 191.6024L 188.08765624999998 191.6024L 188.08765624999998 150.638Q 188.08765624999998 140.638 178.08765624999998 140.638L 182.11546875 140.638Q 172.11546875 140.638 172.11546875 150.638z" fill="rgba(3,195,236,0.85)" fill-opacity="1" stroke="#ffffff" stroke-opacity="1" stroke-linecap="round" stroke-width="6" stroke-dasharray="0" class="apexcharts-bar-area" index="1" clip-path="url(#gridRectMask0c5pmtgr)" pathTo="M 172.11546875 150.638L 172.11546875 191.6024Q 172.11546875 201.6024 182.11546875 201.6024L 178.08765624999998 201.6024Q 188.08765624999998 201.6024 188.08765624999998 191.6024L 188.08765624999998 191.6024L 188.08765624999998 150.638Q 188.08765624999998 140.638 178.08765624999998 140.638L 182.11546875 140.638Q 172.11546875 140.638 172.11546875 150.638z" pathFrom="M 172.11546875 150.638L 172.11546875 150.638L 188.08765624999998 150.638L 188.08765624999998 150.638L 188.08765624999998 150.638L 188.08765624999998 150.638L 188.08765624999998 150.638L 172.11546875 150.638" cy="181.6024" cx="221.43020089285713" j="3" val="-14" barHeight="-60.96439999999999" barWidth="21.9721875"></path>
                        <path id="SvgjsPath1600" d="M 224.43020089285713 150.638L 224.43020089285713 152.411Q 224.43020089285713 162.411 234.43020089285713 162.411L 230.40238839285712 162.411Q 240.40238839285712 162.411 240.40238839285712 152.411L 240.40238839285712 152.411L 240.40238839285712 150.638Q 240.40238839285712 140.638 230.40238839285712 140.638L 234.43020089285713 140.638Q 224.43020089285713 140.638 224.43020089285713 150.638z" fill="rgba(3,195,236,0.85)" fill-opacity="1" stroke="#ffffff" stroke-opacity="1" stroke-linecap="round" stroke-width="6" stroke-dasharray="0" class="apexcharts-bar-area" index="1" clip-path="url(#gridRectMask0c5pmtgr)" pathTo="M 224.43020089285713 150.638L 224.43020089285713 152.411Q 224.43020089285713 162.411 234.43020089285713 162.411L 230.40238839285712 162.411Q 240.40238839285712 162.411 240.40238839285712 152.411L 240.40238839285712 152.411L 240.40238839285712 150.638Q 240.40238839285712 140.638 230.40238839285712 140.638L 234.43020089285713 140.638Q 224.43020089285713 140.638 224.43020089285713 150.638z" pathFrom="M 224.43020089285713 150.638L 224.43020089285713 150.638L 240.40238839285712 150.638L 240.40238839285712 150.638L 240.40238839285712 150.638L 240.40238839285712 150.638L 240.40238839285712 150.638L 224.43020089285713 150.638" cy="142.411" cx="273.74493303571427" j="4" val="-5" barHeight="-21.772999999999996" barWidth="21.9721875"></path>
                        <path id="SvgjsPath1601" d="M 276.74493303571427 150.638L 276.74493303571427 204.6662Q 276.74493303571427 214.6662 286.74493303571427 214.6662L 282.7171205357143 214.6662Q 292.7171205357143 214.6662 292.7171205357143 204.6662L 292.7171205357143 204.6662L 292.7171205357143 150.638Q 292.7171205357143 140.638 282.7171205357143 140.638L 286.74493303571427 140.638Q 276.74493303571427 140.638 276.74493303571427 150.638z" fill="rgba(3,195,236,0.85)" fill-opacity="1" stroke="#ffffff" stroke-opacity="1" stroke-linecap="round" stroke-width="6" stroke-dasharray="0" class="apexcharts-bar-area" index="1" clip-path="url(#gridRectMask0c5pmtgr)" pathTo="M 276.74493303571427 150.638L 276.74493303571427 204.6662Q 276.74493303571427 214.6662 286.74493303571427 214.6662L 282.7171205357143 214.6662Q 292.7171205357143 214.6662 292.7171205357143 204.6662L 292.7171205357143 204.6662L 292.7171205357143 150.638Q 292.7171205357143 140.638 282.7171205357143 140.638L 286.74493303571427 140.638Q 276.74493303571427 140.638 276.74493303571427 150.638z" pathFrom="M 276.74493303571427 150.638L 276.74493303571427 150.638L 292.7171205357143 150.638L 292.7171205357143 150.638L 292.7171205357143 150.638L 292.7171205357143 150.638L 292.7171205357143 150.638L 276.74493303571427 150.638" cy="194.6662" cx="326.05966517857144" j="5" val="-17" barHeight="-74.0282" barWidth="21.9721875"></path>
                        <path id="SvgjsPath1602" d="M 329.05966517857144 150.638L 329.05966517857144 195.957Q 329.05966517857144 205.957 339.05966517857144 205.957L 335.03185267857145 205.957Q 345.03185267857145 205.957 345.03185267857145 195.957L 345.03185267857145 195.957L 345.03185267857145 150.638Q 345.03185267857145 140.638 335.03185267857145 140.638L 339.05966517857144 140.638Q 329.05966517857144 140.638 329.05966517857144 150.638z" fill="rgba(3,195,236,0.85)" fill-opacity="1" stroke="#ffffff" stroke-opacity="1" stroke-linecap="round" stroke-width="6" stroke-dasharray="0" class="apexcharts-bar-area" index="1" clip-path="url(#gridRectMask0c5pmtgr)" pathTo="M 329.05966517857144 150.638L 329.05966517857144 195.957Q 329.05966517857144 205.957 339.05966517857144 205.957L 335.03185267857145 205.957Q 345.03185267857145 205.957 345.03185267857145 195.957L 345.03185267857145 195.957L 345.03185267857145 150.638Q 345.03185267857145 140.638 335.03185267857145 140.638L 339.05966517857144 140.638Q 329.05966517857144 140.638 329.05966517857144 150.638z" pathFrom="M 329.05966517857144 150.638L 329.05966517857144 150.638L 345.03185267857145 150.638L 345.03185267857145 150.638L 345.03185267857145 150.638L 345.03185267857145 150.638L 345.03185267857145 150.638L 329.05966517857144 150.638" cy="185.957" cx="378.3743973214286" j="6" val="-15" barHeight="-65.31899999999999" barWidth="21.9721875"></path>
                      </g>
                      <g id="SvgjsG1586" class="apexcharts-datalabels" data:realIndex="0"></g>
                      <g id="SvgjsG1595" class="apexcharts-datalabels" data:realIndex="1"></g>
                    </g>
                    <line id="SvgjsLine1651" x1="0" y1="0" x2="366.203125" y2="0" stroke="#b6b6b6" stroke-dasharray="0" stroke-width="1" stroke-linecap="butt" class="apexcharts-ycrosshairs"></line>
                    <line id="SvgjsLine1652" x1="0" y1="0" x2="366.203125" y2="0" stroke-dasharray="0" stroke-width="0" stroke-linecap="butt" class="apexcharts-ycrosshairs-hidden"></line>
                    <g id="SvgjsG1653" class="apexcharts-yaxis-annotations"></g>
                    <g id="SvgjsG1654" class="apexcharts-xaxis-annotations"></g>
                    <g id="SvgjsG1655" class="apexcharts-point-annotations"></g>
                  </g>
                  <g id="SvgjsG1626" class="apexcharts-yaxis" rel="0" transform="translate(15.796875, 0)">
                    <g id="SvgjsG1627" class="apexcharts-yaxis-texts-g"><text id="SvgjsText1628" font-family="Helvetica, Arial, sans-serif" x="20" y="52.5" text-anchor="end" dominant-baseline="auto" font-size="13px" font-weight="400" fill="#a1acb8" class="apexcharts-text apexcharts-yaxis-label " style="font-family: Helvetica, Arial, sans-serif;">
                        <tspan id="SvgjsTspan1629">30</tspan>
                        <title>30</title>
                      </text><text id="SvgjsText1630" font-family="Helvetica, Arial, sans-serif" x="20" y="96.04599999999999" text-anchor="end" dominant-baseline="auto" font-size="13px" font-weight="400" fill="#a1acb8" class="apexcharts-text apexcharts-yaxis-label " style="font-family: Helvetica, Arial, sans-serif;">
                        <tspan id="SvgjsTspan1631">20</tspan>
                        <title>20</title>
                      </text><text id="SvgjsText1632" font-family="Helvetica, Arial, sans-serif" x="20" y="139.59199999999998" text-anchor="end" dominant-baseline="auto" font-size="13px" font-weight="400" fill="#a1acb8" class="apexcharts-text apexcharts-yaxis-label " style="font-family: Helvetica, Arial, sans-serif;">
                        <tspan id="SvgjsTspan1633">10</tspan>
                        <title>10</title>
                      </text><text id="SvgjsText1634" font-family="Helvetica, Arial, sans-serif" x="20" y="183.13799999999998" text-anchor="end" dominant-baseline="auto" font-size="13px" font-weight="400" fill="#a1acb8" class="apexcharts-text apexcharts-yaxis-label " style="font-family: Helvetica, Arial, sans-serif;">
                        <tspan id="SvgjsTspan1635">0</tspan>
                        <title>0</title>
                      </text><text id="SvgjsText1636" font-family="Helvetica, Arial, sans-serif" x="20" y="226.68399999999997" text-anchor="end" dominant-baseline="auto" font-size="13px" font-weight="400" fill="#a1acb8" class="apexcharts-text apexcharts-yaxis-label " style="font-family: Helvetica, Arial, sans-serif;">
                        <tspan id="SvgjsTspan1637">-10</tspan>
                        <title>-10</title>
                      </text><text id="SvgjsText1638" font-family="Helvetica, Arial, sans-serif" x="20" y="270.22999999999996" text-anchor="end" dominant-baseline="auto" font-size="13px" font-weight="400" fill="#a1acb8" class="apexcharts-text apexcharts-yaxis-label " style="font-family: Helvetica, Arial, sans-serif;">
                        <tspan id="SvgjsTspan1639">-20</tspan>
                        <title>-20</title>
                      </text></g>
                  </g>
                  <g id="SvgjsG1574" class="apexcharts-annotations"></g>
                </svg>
                <div class="apexcharts-tooltip apexcharts-theme-light">
                  <div class="apexcharts-tooltip-title" style="font-family: Helvetica, Arial, sans-serif; font-size: 12px;"></div>
                  <div class="apexcharts-tooltip-series-group" style="order: 1;"><span class="apexcharts-tooltip-marker" style="background-color: rgb(105, 108, 255);"></span>
                    <div class="apexcharts-tooltip-text" style="font-family: Helvetica, Arial, sans-serif; font-size: 12px;">
                      <div class="apexcharts-tooltip-y-group"><span class="apexcharts-tooltip-text-y-label"></span><span class="apexcharts-tooltip-text-y-value"></span></div>
                      <div class="apexcharts-tooltip-goals-group"><span class="apexcharts-tooltip-text-goals-label"></span><span class="apexcharts-tooltip-text-goals-value"></span></div>
                      <div class="apexcharts-tooltip-z-group"><span class="apexcharts-tooltip-text-z-label"></span><span class="apexcharts-tooltip-text-z-value"></span></div>
                    </div>
                  </div>
                  <div class="apexcharts-tooltip-series-group" style="order: 2;"><span class="apexcharts-tooltip-marker" style="background-color: rgb(3, 195, 236);"></span>
                    <div class="apexcharts-tooltip-text" style="font-family: Helvetica, Arial, sans-serif; font-size: 12px;">
                      <div class="apexcharts-tooltip-y-group"><span class="apexcharts-tooltip-text-y-label"></span><span class="apexcharts-tooltip-text-y-value"></span></div>
                      <div class="apexcharts-tooltip-goals-group"><span class="apexcharts-tooltip-text-goals-label"></span><span class="apexcharts-tooltip-text-goals-value"></span></div>
                      <div class="apexcharts-tooltip-z-group"><span class="apexcharts-tooltip-text-z-label"></span><span class="apexcharts-tooltip-text-z-value"></span></div>
                    </div>
                  </div>
                </div>
                <div class="apexcharts-yaxistooltip apexcharts-yaxistooltip-0 apexcharts-yaxistooltip-left apexcharts-theme-light">
                  <div class="apexcharts-yaxistooltip-text"></div>
                </div>
              </div>
            </div>
            <div class="resize-triggers">
              <div class="expand-trigger">
                <div style="width: 457px; height: 377px;"></div>
              </div>
              <div class="contract-trigger"></div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="card-body">
              <div class="text-center">
                <div class="dropdown">
                  <button class="btn btn-sm btn-outline-primary dropdown-toggle" type="button" id="growthReportId" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    2022
                  </button>
                  <div class="dropdown-menu dropdown-menu-end" aria-labelledby="growthReportId">
                    <a class="dropdown-item" href="javascript:void(0);">2021</a>
                    <a class="dropdown-item" href="javascript:void(0);">2020</a>
                    <a class="dropdown-item" href="javascript:void(0);">2019</a>
                  </div>
                </div>
              </div>
            </div>
            <div id="growthChart" style="min-height: 154.875px;">
              <div id="apexchartsvamg6c7r" class="apexcharts-canvas apexchartsvamg6c7r apexcharts-theme-light" style="width: 228px; height: 154.875px;"><svg id="SvgjsSvg1656" width="228" height="154.875" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.dev" class="apexcharts-svg" xmlns:data="ApexChartsNS" transform="translate(0, 0)" style="background: transparent;">
                  <g id="SvgjsG1658" class="apexcharts-inner apexcharts-graphical" transform="translate(7, -25)">
                    <defs id="SvgjsDefs1657">
                      <clipPath id="gridRectMaskvamg6c7r">
                        <rect id="SvgjsRect1660" width="222" height="285" x="-3" y="-1" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff"></rect>
                      </clipPath>
                      <clipPath id="forecastMaskvamg6c7r"></clipPath>
                      <clipPath id="nonForecastMaskvamg6c7r"></clipPath>
                      <clipPath id="gridRectMarkerMaskvamg6c7r">
                        <rect id="SvgjsRect1661" width="220" height="287" x="-2" y="-2" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff"></rect>
                      </clipPath>
                      <linearGradient id="SvgjsLinearGradient1666" x1="1" y1="0" x2="0" y2="1">
                        <stop id="SvgjsStop1667" stop-opacity="1" stop-color="rgba(105,108,255,1)" offset="0.3"></stop>
                        <stop id="SvgjsStop1668" stop-opacity="0.6" stop-color="rgba(255,255,255,0.6)" offset="0.7"></stop>
                        <stop id="SvgjsStop1669" stop-opacity="0.6" stop-color="rgba(255,255,255,0.6)" offset="1"></stop>
                      </linearGradient>
                      <linearGradient id="SvgjsLinearGradient1677" x1="1" y1="0" x2="0" y2="1">
                        <stop id="SvgjsStop1678" stop-opacity="1" stop-color="rgba(105,108,255,1)" offset="0.3"></stop>
                        <stop id="SvgjsStop1679" stop-opacity="0.6" stop-color="rgba(105,108,255,0.6)" offset="0.7"></stop>
                        <stop id="SvgjsStop1680" stop-opacity="0.6" stop-color="rgba(105,108,255,0.6)" offset="1"></stop>
                      </linearGradient>
                    </defs>
                    <g id="SvgjsG1662" class="apexcharts-radialbar">
                      <g id="SvgjsG1663">
                        <g id="SvgjsG1664" class="apexcharts-tracks">
                          <g id="SvgjsG1665" class="apexcharts-radialbar-track apexcharts-track" rel="1">
                            <path id="apexcharts-radialbarTrack-0" d="M 73.83506097560974 167.17541022773656 A 68.32987804878049 68.32987804878049 0 1 1 142.16493902439026 167.17541022773656" fill="none" fill-opacity="1" stroke="rgba(255,255,255,0.85)" stroke-opacity="1" stroke-linecap="butt" stroke-width="17.357317073170734" stroke-dasharray="0" class="apexcharts-radialbar-area" data:pathOrig="M 73.83506097560974 167.17541022773656 A 68.32987804878049 68.32987804878049 0 1 1 142.16493902439026 167.17541022773656"></path>
                          </g>
                        </g>
                        <g id="SvgjsG1671">
                          <g id="SvgjsG1676" class="apexcharts-series apexcharts-radial-series" seriesName="Growth" rel="1" data:realIndex="0">
                            <path id="SvgjsPath1681" d="M 73.83506097560974 167.17541022773656 A 68.32987804878049 68.32987804878049 0 1 1 175.95555982735613 100.85758285229481" fill="none" fill-opacity="0.85" stroke="url(#SvgjsLinearGradient1677)" stroke-opacity="1" stroke-linecap="butt" stroke-width="17.357317073170734" stroke-dasharray="5" class="apexcharts-radialbar-area apexcharts-radialbar-slice-0" data:angle="234" data:value="78" index="0" j="0" data:pathOrig="M 73.83506097560974 167.17541022773656 A 68.32987804878049 68.32987804878049 0 1 1 175.95555982735613 100.85758285229481"></path>
                          </g>
                          <circle id="SvgjsCircle1672" r="54.65121951219512" cx="108" cy="108" class="apexcharts-radialbar-hollow" fill="transparent"></circle>
                          <g id="SvgjsG1673" class="apexcharts-datalabels-group" transform="translate(0, 0) scale(1)" style="opacity: 1;"><text id="SvgjsText1674" font-family="Public Sans" x="108" y="123" text-anchor="middle" dominant-baseline="auto" font-size="15px" font-weight="500" fill="#566a7f" class="apexcharts-text apexcharts-datalabel-label" style="font-family: &quot;Public Sans&quot;;">Growth</text><text id="SvgjsText1675" font-family="Public Sans" x="108" y="99" text-anchor="middle" dominant-baseline="auto" font-size="22px" font-weight="500" fill="#566a7f" class="apexcharts-text apexcharts-datalabel-value" style="font-family: &quot;Public Sans&quot;;">78%</text></g>
                        </g>
                      </g>
                    </g>
                    <line id="SvgjsLine1682" x1="0" y1="0" x2="216" y2="0" stroke="#b6b6b6" stroke-dasharray="0" stroke-width="1" stroke-linecap="butt" class="apexcharts-ycrosshairs"></line>
                    <line id="SvgjsLine1683" x1="0" y1="0" x2="216" y2="0" stroke-dasharray="0" stroke-width="0" stroke-linecap="butt" class="apexcharts-ycrosshairs-hidden"></line>
                  </g>
                  <g id="SvgjsG1659" class="apexcharts-annotations"></g>
                </svg>
                <div class="apexcharts-legend"></div>
              </div>
            </div>
            <div class="text-center fw-semibold pt-3 mb-2">62% Company Growth</div>

            <div class="d-flex px-xxl-4 px-lg-2 p-4 gap-xxl-3 gap-lg-1 gap-3 justify-content-between">
              <div class="d-flex">
                <div class="me-2">
                  <span class="badge bg-label-primary p-2"><i class="bx bx-dollar text-primary"></i></span>
                </div>
                <div class="d-flex flex-column">
                  <small>2022</small>
                  <h6 class="mb-0">$32.5k</h6>
                </div>
              </div>
              <div class="d-flex">
                <div class="me-2">
                  <span class="badge bg-label-info p-2"><i class="bx bx-wallet text-info"></i></span>
                </div>
                <div class="d-flex flex-column">
                  <small>2021</small>
                  <h6 class="mb-0">$41.2k</h6>
                </div>
              </div>
            </div>
            <div class="resize-triggers">
              <div class="expand-trigger">
                <div style="width: 229px; height: 377px;"></div>
              </div>
              <div class="contract-trigger"></div>
            </div>
          </div>
        </div>
      </div>
    </div> -->
    <!--/ Total Revenue -->
    <!--  <div class="col-12 col-md-8 col-lg-4 order-3 order-md-2">
      <div class="row">
        <div class="col-6 mb-4">
          <div class="card">
            <div class="card-body">
              <div class="card-title d-flex align-items-start justify-content-between">
                <div class="avatar flex-shrink-0">
                  <img src="<?= APP_URL ?>assets/img/icons/unicons/paypal.png" alt="Credit Card" class="rounded">
                </div>
                <div class="dropdown">
                  <button class="btn p-0" type="button" id="cardOpt4" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="bx bx-dots-vertical-rounded"></i>
                  </button>
                  <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt4">
                    <a class="dropdown-item" href="javascript:void(0);">View More</a>
                    <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                  </div>
                </div>
              </div>
              <span class="d-block mb-1">Payments</span>
              <h3 class="card-title text-nowrap mb-2">$2,456</h3>
              <small class="text-danger fw-semibold"><i class="bx bx-down-arrow-alt"></i> -14.82%</small>
            </div>
          </div>
        </div>
        <div class="col-6 mb-4">
          <div class="card">
            <div class="card-body">
              <div class="card-title d-flex align-items-start justify-content-between">
                <div class="avatar flex-shrink-0">
                  <img src="<?= APP_URL ?>assets/img/icons/unicons/cc-primary.png" alt="Credit Card" class="rounded">
                </div>
                <div class="dropdown">
                  <button class="btn p-0" type="button" id="cardOpt1" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="bx bx-dots-vertical-rounded"></i>
                  </button>
                  <div class="dropdown-menu" aria-labelledby="cardOpt1">
                    <a class="dropdown-item" href="javascript:void(0);">View More</a>
                    <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                  </div>
                </div>
              </div>
              <span class="fw-semibold d-block mb-1">Transactions</span>
              <h3 class="card-title mb-2">$14,857</h3>
              <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> +28.14%</small>
            </div>
          </div>
        </div>
        <!-- </div>
    <div class="row"> 
        <div class="col-12 mb-4">
          <div class="card">
            <div class="card-body">
              <div class="d-flex justify-content-between flex-sm-row flex-column gap-3" style="position: relative;">
                <div class="d-flex flex-sm-column flex-row align-items-start justify-content-between">
                  <div class="card-title">
                    <h5 class="text-nowrap mb-2">Profile Report</h5>
                    <span class="badge bg-label-warning rounded-pill">Year 2021</span>
                  </div>
                  <div class="mt-sm-auto">
                    <small class="text-success text-nowrap fw-semibold"><i class="bx bx-chevron-up"></i> 68.2%</small>
                    <h3 class="mb-0">$84,686k</h3>
                  </div>
                </div>
                <div id="profileReportChart" style="min-height: 80px;">
                  <div id="apexcharts0htd1a0r" class="apexcharts-canvas apexcharts0htd1a0r apexcharts-theme-light" style="width: 143px; height: 80px;"><svg id="SvgjsSvg1685" width="143" height="80" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.dev" class="apexcharts-svg" xmlns:data="ApexChartsNS" transform="translate(0, 0)" style="background: transparent;">
                      <g id="SvgjsG1687" class="apexcharts-inner apexcharts-graphical" transform="translate(0, 0)">
                        <defs id="SvgjsDefs1686">
                          <clipPath id="gridRectMask0htd1a0r">
                            <rect id="SvgjsRect1692" width="144" height="85" x="-4.5" y="-2.5" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff"></rect>
                          </clipPath>
                          <clipPath id="forecastMask0htd1a0r"></clipPath>
                          <clipPath id="nonForecastMask0htd1a0r"></clipPath>
                          <clipPath id="gridRectMarkerMask0htd1a0r">
                            <rect id="SvgjsRect1693" width="139" height="84" x="-2" y="-2" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff"></rect>
                          </clipPath>
                          <filter id="SvgjsFilter1699" filterUnits="userSpaceOnUse" width="200%" height="200%" x="-50%" y="-50%">
                            <feFlood id="SvgjsFeFlood1700" flood-color="#ffab00" flood-opacity="0.15" result="SvgjsFeFlood1700Out" in="SourceGraphic"></feFlood>
                            <feComposite id="SvgjsFeComposite1701" in="SvgjsFeFlood1700Out" in2="SourceAlpha" operator="in" result="SvgjsFeComposite1701Out"></feComposite>
                            <feOffset id="SvgjsFeOffset1702" dx="5" dy="10" result="SvgjsFeOffset1702Out" in="SvgjsFeComposite1701Out"></feOffset>
                            <feGaussianBlur id="SvgjsFeGaussianBlur1703" stdDeviation="3 " result="SvgjsFeGaussianBlur1703Out" in="SvgjsFeOffset1702Out"></feGaussianBlur>
                            <feMerge id="SvgjsFeMerge1704" result="SvgjsFeMerge1704Out" in="SourceGraphic">
                              <feMergeNode id="SvgjsFeMergeNode1705" in="SvgjsFeGaussianBlur1703Out"></feMergeNode>
                              <feMergeNode id="SvgjsFeMergeNode1706" in="[object Arguments]"></feMergeNode>
                            </feMerge>
                            <feBlend id="SvgjsFeBlend1707" in="SourceGraphic" in2="SvgjsFeMerge1704Out" mode="normal" result="SvgjsFeBlend1707Out"></feBlend>
                          </filter>
                        </defs>
                        <line id="SvgjsLine1691" x1="0" y1="0" x2="0" y2="80" stroke="#b6b6b6" stroke-dasharray="3" stroke-linecap="butt" class="apexcharts-xcrosshairs" x="0" y="0" width="1" height="80" fill="#b1b9c4" filter="none" fill-opacity="0.9" stroke-width="1"></line>
                        <g id="SvgjsG1708" class="apexcharts-xaxis" transform="translate(0, 0)">
                          <g id="SvgjsG1709" class="apexcharts-xaxis-texts-g" transform="translate(0, -4)"></g>
                        </g>
                        <g id="SvgjsG1717" class="apexcharts-grid">
                          <g id="SvgjsG1718" class="apexcharts-gridlines-horizontal" style="display: none;">
                            <line id="SvgjsLine1720" x1="0" y1="0" x2="135" y2="0" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline"></line>
                            <line id="SvgjsLine1721" x1="0" y1="20" x2="135" y2="20" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline"></line>
                            <line id="SvgjsLine1722" x1="0" y1="40" x2="135" y2="40" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline"></line>
                            <line id="SvgjsLine1723" x1="0" y1="60" x2="135" y2="60" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline"></line>
                            <line id="SvgjsLine1724" x1="0" y1="80" x2="135" y2="80" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline"></line>
                          </g>
                          <g id="SvgjsG1719" class="apexcharts-gridlines-vertical" style="display: none;"></g>
                          <line id="SvgjsLine1726" x1="0" y1="80" x2="135" y2="80" stroke="transparent" stroke-dasharray="0" stroke-linecap="butt"></line>
                          <line id="SvgjsLine1725" x1="0" y1="1" x2="0" y2="80" stroke="transparent" stroke-dasharray="0" stroke-linecap="butt"></line>
                        </g>
                        <g id="SvgjsG1694" class="apexcharts-line-series apexcharts-plot-series">
                          <g id="SvgjsG1695" class="apexcharts-series" seriesName="seriesx1" data:longestSeries="true" rel="1" data:realIndex="0">
                            <path id="SvgjsPath1698" d="M 0 76C 9.45 76 17.55 12 27 12C 36.45 12 44.55 62 54 62C 63.45 62 71.55 22 81 22C 90.45 22 98.55 38 108 38C 117.45 38 125.55 6 135 6" fill="none" fill-opacity="1" stroke="rgba(255,171,0,0.85)" stroke-opacity="1" stroke-linecap="butt" stroke-width="5" stroke-dasharray="0" class="apexcharts-line" index="0" clip-path="url(#gridRectMask0htd1a0r)" filter="url(#SvgjsFilter1699)" pathTo="M 0 76C 9.45 76 17.55 12 27 12C 36.45 12 44.55 62 54 62C 63.45 62 71.55 22 81 22C 90.45 22 98.55 38 108 38C 117.45 38 125.55 6 135 6" pathFrom="M -1 120L -1 120L 27 120L 54 120L 81 120L 108 120L 135 120"></path>
                            <g id="SvgjsG1696" class="apexcharts-series-markers-wrap" data:realIndex="0">
                              <g class="apexcharts-series-markers">
                                <circle id="SvgjsCircle1732" r="0" cx="0" cy="0" class="apexcharts-marker w9iufpjyo no-pointer-events" stroke="#ffffff" fill="#ffab00" fill-opacity="1" stroke-width="2" stroke-opacity="0.9" default-marker-size="0"></circle>
                              </g>
                            </g>
                          </g>
                          <g id="SvgjsG1697" class="apexcharts-datalabels" data:realIndex="0"></g>
                        </g>
                        <line id="SvgjsLine1727" x1="0" y1="0" x2="135" y2="0" stroke="#b6b6b6" stroke-dasharray="0" stroke-width="1" stroke-linecap="butt" class="apexcharts-ycrosshairs"></line>
                        <line id="SvgjsLine1728" x1="0" y1="0" x2="135" y2="0" stroke-dasharray="0" stroke-width="0" stroke-linecap="butt" class="apexcharts-ycrosshairs-hidden"></line>
                        <g id="SvgjsG1729" class="apexcharts-yaxis-annotations"></g>
                        <g id="SvgjsG1730" class="apexcharts-xaxis-annotations"></g>
                        <g id="SvgjsG1731" class="apexcharts-point-annotations"></g>
                      </g>
                      <rect id="SvgjsRect1690" width="0" height="0" x="0" y="0" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fefefe"></rect>
                      <g id="SvgjsG1716" class="apexcharts-yaxis" rel="0" transform="translate(-18, 0)"></g>
                      <g id="SvgjsG1688" class="apexcharts-annotations"></g>
                    </svg>
                    <div class="apexcharts-legend" style="max-height: 40px;"></div>
                    <div class="apexcharts-tooltip apexcharts-theme-light">
                      <div class="apexcharts-tooltip-title" style="font-family: Helvetica, Arial, sans-serif; font-size: 12px;"></div>
                      <div class="apexcharts-tooltip-series-group" style="order: 1;"><span class="apexcharts-tooltip-marker" style="background-color: rgb(255, 171, 0);"></span>
                        <div class="apexcharts-tooltip-text" style="font-family: Helvetica, Arial, sans-serif; font-size: 12px;">
                          <div class="apexcharts-tooltip-y-group"><span class="apexcharts-tooltip-text-y-label"></span><span class="apexcharts-tooltip-text-y-value"></span></div>
                          <div class="apexcharts-tooltip-goals-group"><span class="apexcharts-tooltip-text-goals-label"></span><span class="apexcharts-tooltip-text-goals-value"></span></div>
                          <div class="apexcharts-tooltip-z-group"><span class="apexcharts-tooltip-text-z-label"></span><span class="apexcharts-tooltip-text-z-value"></span></div>
                        </div>
                      </div>
                    </div>
                    <div class="apexcharts-yaxistooltip apexcharts-yaxistooltip-0 apexcharts-yaxistooltip-left apexcharts-theme-light">
                      <div class="apexcharts-yaxistooltip-text"></div>
                    </div>
                  </div>
                </div>
                <div class="resize-triggers">
                  <div class="expand-trigger">
                    <div style="width: 282px; height: 117px;"></div>
                  </div>
                  <div class="contract-trigger"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div> -->
  </div>
</div>