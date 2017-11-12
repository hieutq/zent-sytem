@extends('layouts.master')
@section('contents')
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="{{URL::asset('')}}">Trang chủ</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span>Bảng điều khiển</span>
        </li>
    </ul>
    <div class="page-toolbar">
        <div id="dashboard-report-range" class="pull-right tooltips btn btn-sm" data-container="body" data-placement="bottom" data-original-title="Change dashboard date range">
            <i class="icon-calendar"></i>&nbsp;
            <span class="thin uppercase hidden-xs"></span>&nbsp;
            <i class="fa fa-angle-down"></i>
        </div>
    </div>
</div>
<!-- END PAGE BAR -->
<!-- BEGIN PAGE TITLE-->
<h3 class="page-title"> Bảng điều khiển
<small>Số liệu thống kê</small>
</h3>
<!-- END PAGE TITLE-->
<!-- END PAGE HEADER-->
<!-- BEGIN DASHBOARD STATS 1-->
<div class="row">
<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
<div class="dashboard-stat blue">
    <div class="visual">
        <i class="fa fa-comments"></i>
    </div>
    <div class="details">
        <div class="number">
            <span data-counter="counterup" data-value="{{$avg_point}}">{{$avg_point}}</span> 
            {{-- <i class="fa fa-comments" aria-hidden="true"></i> --}}
        </div>
        <div class="desc"> Điểm trung bình </div>
    </div>
    <a class="more" href="#"> Chi tiết
        <i class="m-icon-swapright m-icon-white"></i>
    </a>
</div>
</div>
<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
<div class="dashboard-stat red">
    <div class="visual">
        <i class="fa fa-graduation-cap"></i>
    </div>
    <div class="details">
        <div class="number">
            <span data-counter="counterup" data-value="{{$sum_point}}">{{$sum_point}}</span> 
            {{-- <i class="fa fa-star-o" aria-hidden="true"></i>  --}}
          </div>
        <div class="desc"> Tổng điểm </div>
    </div>
    <a class="more" href="#"> Chi tiết
        <i class="m-icon-swapright m-icon-white"></i>
    </a>
</div>
</div>
<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
<div class="dashboard-stat green">
    <div class="visual">
        <i class="fa fa-windows"></i>
    </div>
    <div class="details">
        <div class="number">
            <span data-counter="counterup" data-value="{{$level_name}}">{{$level_name}}</span> 
            {{-- <i class="fa fa-heart-o" aria-hidden="true"></i> --}}
        </div>
        <div class="desc"> Thứ hạng</div>
    </div>
    <a class="more" href="#"> Chi tiết
        <i class="m-icon-swapright m-icon-white"></i>
    </a>
</div>
</div>
<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
<div class="dashboard-stat purple">
    <div class="visual">
        <i class="fa fa-globe"></i>
    </div>
    <div class="details">
        <div class="number">
            <span data-counter="counterup" data-value="{{$classes->count()}}">{{$classes->count()}}</span>
            {{-- <i class="fa fa-graduation-cap" aria-hidden="true"></i> --}}
            </div>
        <div class="desc"> Tổng khóa học </div>
    </div>
    <a class="more" href="#"> Chi tiết
        <i class="m-icon-swapright m-icon-white"></i>
    </a>
</div>
</div>
</div>
<div class="row">
   <div class="col-md-6 col-sm-6">
      <div class="portlet light ">
         <div class="portlet-title">
            <div class="caption font-green">
               <span class="caption-subject bold uppercase">Revenue</span>
               <span class="caption-helper">distance stats...</span>
            </div>
            <div class="actions">
               <a class="btn btn-circle btn-icon-only btn-default" href="#">
               <i class="icon-cloud-upload"></i>
               </a>
               <a class="btn btn-circle btn-icon-only btn-default" href="#">
               <i class="icon-wrench"></i>
               </a>
               <a class="btn btn-circle btn-icon-only btn-default" href="#">
               <i class="icon-trash"></i>
               </a>
               <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="#" data-original-title="" title=""> </a>
            </div>
         </div>
         <div class="portlet-body">
            <div id="dashboard_amchart_1" class="CSSAnimationChart" style="overflow: hidden; text-align: left;">
               <div class="amcharts-main-div" style="position: relative;">
                  <div class="amcharts-chart-div" style="overflow: hidden; position: relative; text-align: left; width: 470px; height: 393px; padding: 0px; cursor: default;">
                     <svg version="1.1" style="position: absolute; width: 470px; height: 393px; top: 0px; left: 0px;">
                        <desc>JavaScript chart by amCharts 3.17.1</desc>
                        <g>
                           <path cs="100,100" d="M0.5,0.5 L469.5,0.5 L469.5,392.5 L0.5,392.5 Z" fill="#FFFFFF" stroke="#000000" fill-opacity="0" stroke-width="1" stroke-opacity="0" class="amcharts-bg"></path>
                           <path cs="100,100" d="M0.5,0.5 L355.5,0.5 L355.5,340.5 L0.5,340.5 L0.5,0.5 Z" fill="#FFFFFF" stroke="#000000" fill-opacity="0" stroke-width="1" stroke-opacity="0" class="amcharts-plot-area" transform="translate(74,20)"></path>
                        </g>
                        <g>
                           <g class="amcharts-category-axis" transform="translate(74,20)">
                              <g>
                                 <path cs="100,100" d="M0.5,0.5 L0.5,5.5" fill="none" stroke-width="1" stroke-opacity="1" stroke="#555555" transform="translate(0,340)" class="amcharts-axis-tick"></path>
                                 <path cs="100,100" d="M0.5,340.5 L0.5,340.5 L0.5,0.5" fill="none" stroke-width="1" stroke-opacity="0.1" stroke="#FFFFFF" class="amcharts-axis-grid"></path>
                              </g>
                              <g>
                                 <path cs="100,100" d="M32.5,0.5 L32.5,5.5" fill="none" stroke-width="1" stroke-opacity="1" stroke="#555555" transform="translate(0,340)" class="amcharts-axis-tick"></path>
                                 <path cs="100,100" d="M32.5,340.5 L32.5,340.5 L32.5,0.5" fill="none" stroke-width="1" stroke-opacity="0.1" stroke="#FFFFFF" class="amcharts-axis-grid"></path>
                              </g>
                              <g>
                                 <path cs="100,100" d="M65.5,0.5 L65.5,5.5" fill="none" stroke-width="1" stroke-opacity="1" stroke="#555555" transform="translate(0,340)" class="amcharts-axis-tick"></path>
                                 <path cs="100,100" d="M65.5,340.5 L65.5,340.5 L65.5,0.5" fill="none" stroke-width="1" stroke-opacity="0.1" stroke="#FFFFFF" class="amcharts-axis-grid"></path>
                              </g>
                              <g>
                                 <path cs="100,100" d="M97.5,0.5 L97.5,5.5" fill="none" stroke-width="1" stroke-opacity="1" stroke="#555555" transform="translate(0,340)" class="amcharts-axis-tick"></path>
                                 <path cs="100,100" d="M97.5,340.5 L97.5,340.5 L97.5,0.5" fill="none" stroke-width="1" stroke-opacity="0.1" stroke="#FFFFFF" class="amcharts-axis-grid"></path>
                              </g>
                              <g>
                                 <path cs="100,100" d="M129.5,0.5 L129.5,5.5" fill="none" stroke-width="1" stroke-opacity="1" stroke="#555555" transform="translate(0,340)" class="amcharts-axis-tick"></path>
                                 <path cs="100,100" d="M129.5,340.5 L129.5,340.5 L129.5,0.5" fill="none" stroke-width="1" stroke-opacity="0.1" stroke="#FFFFFF" class="amcharts-axis-grid"></path>
                              </g>
                              <g>
                                 <path cs="100,100" d="M161.5,0.5 L161.5,5.5" fill="none" stroke-width="1" stroke-opacity="1" stroke="#555555" transform="translate(0,340)" class="amcharts-axis-tick"></path>
                                 <path cs="100,100" d="M161.5,340.5 L161.5,340.5 L161.5,0.5" fill="none" stroke-width="1" stroke-opacity="0.1" stroke="#FFFFFF" class="amcharts-axis-grid"></path>
                              </g>
                              <g>
                                 <path cs="100,100" d="M194.5,0.5 L194.5,5.5" fill="none" stroke-width="1" stroke-opacity="1" stroke="#555555" transform="translate(0,340)" class="amcharts-axis-tick"></path>
                                 <path cs="100,100" d="M194.5,340.5 L194.5,340.5 L194.5,0.5" fill="none" stroke-width="1" stroke-opacity="0.1" stroke="#FFFFFF" class="amcharts-axis-grid"></path>
                              </g>
                              <g>
                                 <path cs="100,100" d="M226.5,0.5 L226.5,5.5" fill="none" stroke-width="1" stroke-opacity="1" stroke="#555555" transform="translate(0,340)" class="amcharts-axis-tick"></path>
                                 <path cs="100,100" d="M226.5,340.5 L226.5,340.5 L226.5,0.5" fill="none" stroke-width="1" stroke-opacity="0.1" stroke="#FFFFFF" class="amcharts-axis-grid"></path>
                              </g>
                              <g>
                                 <path cs="100,100" d="M258.5,0.5 L258.5,5.5" fill="none" stroke-width="1" stroke-opacity="1" stroke="#555555" transform="translate(0,340)" class="amcharts-axis-tick"></path>
                                 <path cs="100,100" d="M258.5,340.5 L258.5,340.5 L258.5,0.5" fill="none" stroke-width="1" stroke-opacity="0.1" stroke="#FFFFFF" class="amcharts-axis-grid"></path>
                              </g>
                              <g>
                                 <path cs="100,100" d="M290.5,0.5 L290.5,5.5" fill="none" stroke-width="1" stroke-opacity="1" stroke="#555555" transform="translate(0,340)" class="amcharts-axis-tick"></path>
                                 <path cs="100,100" d="M290.5,340.5 L290.5,340.5 L290.5,0.5" fill="none" stroke-width="1" stroke-opacity="0.1" stroke="#FFFFFF" class="amcharts-axis-grid"></path>
                              </g>
                              <g>
                                 <path cs="100,100" d="M323.5,0.5 L323.5,5.5" fill="none" stroke-width="1" stroke-opacity="1" stroke="#555555" transform="translate(0,340)" class="amcharts-axis-tick"></path>
                                 <path cs="100,100" d="M323.5,340.5 L323.5,340.5 L323.5,0.5" fill="none" stroke-width="1" stroke-opacity="0.1" stroke="#FFFFFF" class="amcharts-axis-grid"></path>
                              </g>
                              <g>
                                 <path cs="100,100" d="M355.5,0.5 L355.5,5.5" fill="none" stroke-width="1" stroke-opacity="1" stroke="#555555" transform="translate(0,340)" class="amcharts-axis-tick"></path>
                                 <path cs="100,100" d="M355.5,340.5 L355.5,340.5 L355.5,0.5" fill="none" stroke-width="1" stroke-opacity="0.1" stroke="#FFFFFF" class="amcharts-axis-grid"></path>
                              </g>
                           </g>
                           <g class="amcharts-value-axis value-axis-a1" transform="translate(74,20)" visibility="visible"></g>
                           <g class="amcharts-value-axis value-axis-a2" transform="translate(74,20)" visibility="visible"></g>
                           <g class="amcharts-value-axis value-axis-a3" transform="translate(74,20)" visibility="visible"></g>
                        </g>
                        <g></g>
                        <g></g>
                        <g></g>
                        <g>
                           <g transform="translate(74,20)">
                              <g class="amcharts-graph-column amcharts-graph-g1" transform="translate(3,340)">
                                 <path cs="100,100" d="M0.5,0.5 L0.5,-211.5 L26.5,-211.5 L26.5,0.5 L0.5,0.5 Z" fill="#08a3cc" stroke="#08a3cc" fill-opacity="0.7" stroke-width="1" stroke-opacity="1" class="amcharts-graph-column-front amcharts-graph-column-element"></path>
                              </g>
                              <g class="amcharts-graph-column amcharts-graph-g1" transform="translate(35,340)">
                                 <path cs="100,100" d="M0.5,0.5 L0.5,-140.5 L26.5,-140.5 L26.5,0.5 L0.5,0.5 Z" fill="#08a3cc" stroke="#08a3cc" fill-opacity="0.7" stroke-width="1" stroke-opacity="1" class="amcharts-graph-column-front amcharts-graph-column-element"></path>
                              </g>
                              <g class="amcharts-graph-column amcharts-graph-g1" transform="translate(68,340)">
                                 <path cs="100,100" d="M0.5,0.5 L0.5,-111.5 L26.5,-111.5 L26.5,0.5 L0.5,0.5 Z" fill="#08a3cc" stroke="#08a3cc" fill-opacity="0.7" stroke-width="1" stroke-opacity="1" class="amcharts-graph-column-front amcharts-graph-column-element"></path>
                              </g>
                              <g class="amcharts-graph-column amcharts-graph-g1" transform="translate(100,340)">
                                 <path cs="100,100" d="M0.5,0.5 L0.5,-28.5 L26.5,-28.5 L26.5,0.5 L0.5,0.5 Z" fill="#08a3cc" stroke="#08a3cc" fill-opacity="0.7" stroke-width="1" stroke-opacity="1" class="amcharts-graph-column-front amcharts-graph-column-element"></path>
                              </g>
                              <g class="amcharts-graph-column amcharts-graph-g1" transform="translate(132,340)">
                                 <path cs="100,100" d="M0.5,0.5 L0.5,-13.5 L26.5,-13.5 L26.5,0.5 L0.5,0.5 Z" fill="#08a3cc" stroke="#08a3cc" fill-opacity="0.7" stroke-width="1" stroke-opacity="1" class="amcharts-graph-column-front amcharts-graph-column-element"></path>
                              </g>
                              <g class="amcharts-graph-column amcharts-graph-g1" transform="translate(165,340)">
                                 <path cs="100,100" d="M0.5,0.5 L0.5,-112.5 L26.5,-112.5 L26.5,0.5 L0.5,0.5 Z" fill="#08a3cc" stroke="#08a3cc" fill-opacity="0.7" stroke-width="1" stroke-opacity="1" class="amcharts-graph-column-front amcharts-graph-column-element"></path>
                              </g>
                              <g class="amcharts-graph-column amcharts-graph-g1" transform="translate(197,340)">
                                 <path cs="100,100" d="M0.5,0.5 L0.5,-303.5 L26.5,-303.5 L26.5,0.5 L0.5,0.5 Z" fill="#08a3cc" stroke="#08a3cc" fill-opacity="0.7" stroke-width="1" stroke-opacity="1" class="amcharts-graph-column-front amcharts-graph-column-element"></path>
                              </g>
                              <g class="amcharts-graph-column amcharts-graph-g1" transform="translate(229,340)">
                                 <path cs="100,100" d="M0.5,0.5 L0.5,-251.5 L26.5,-251.5 L26.5,0.5 L0.5,0.5 Z" fill="#08a3cc" stroke="#08a3cc" fill-opacity="0.7" stroke-width="1" stroke-opacity="1" class="amcharts-graph-column-front amcharts-graph-column-element"></path>
                              </g>
                              <g class="amcharts-graph-column amcharts-graph-g1" transform="translate(261,340)">
                                 <path cs="100,100" d="M0.5,0.5 L0.5,-169.5 L26.5,-169.5 L26.5,0.5 L0.5,0.5 Z" fill="#08a3cc" stroke="#08a3cc" fill-opacity="0.4" stroke-width="1" stroke-opacity="1" class="amcharts-graph-column-front amcharts-graph-column-element"></path>
                              </g>
                           </g>
                        </g>
                        <g>
                           <g transform="translate(74,20)" class="amcharts-graph-column amcharts-graph-g1">
                              <g></g>
                           </g>
                           <g transform="translate(74,20)" class="amcharts-graph-line amcharts-graph-g2">
                              <g></g>
                              <g></g>
                              <g clip-path="url(#AmChartsEl-9)">
                                 <path cs="100,100" d="M16.5,305.5 L48.5,218.5 L81.5,228.5 L113.5,231.5 L145.5,174.5 L178.5,123.5 L210.5,55.5 L242.5,43.5 L274.5,24.5 L307.5,111.5 M0,0 L0,0" fill="none" stroke-width="1" stroke-opacity="1" stroke="#786c56" class="amcharts-graph-stroke"></path>
                              </g>
                              <clipPath id="AmChartsEl-9">
                                 <rect x="0" y="0" width="357" height="342" rx="0" ry="0" stroke-width="0"></rect>
                              </clipPath>
                           </g>
                           <g transform="translate(74,20)" class="amcharts-graph-line amcharts-graph-g3">
                              <g></g>
                              <g></g>
                              <g clip-path="url(#AmChartsEl-10)">
                                 <path cs="100,100" d="M16.5,194.5 L48.5,222.5 L81.5,240.5 L113.5,287.5 L145.5,298.5 L178.5,202.5 L210.5,5.5 L242.5,44.5 L274.5,112.5 L307.5,209.5 M0,0 L0,0" fill="none" stroke-width="1" stroke-opacity="0.8" stroke="#e26a6a" class="amcharts-graph-stroke"></path>
                              </g>
                              <clipPath id="AmChartsEl-10">
                                 <rect x="0" y="0" width="357" height="342" rx="0" ry="0" stroke-width="0"></rect>
                              </clipPath>
                           </g>
                        </g>
                        <g></g>
                        <g>
                           <g class="amcharts-category-axis">
                              <path cs="100,100" d="M0.5,0.5 L355.5,0.5" fill="none" stroke-width="1" stroke-opacity="1" stroke="#555555" transform="translate(74,360)" class="amcharts-axis-line"></path>
                           </g>
                           <g class="amcharts-value-axis value-axis-a1">
                              <path cs="100,100" d="M0.5,0.5 L0.5,340.5" fill="none" stroke-width="1" stroke-opacity="0" stroke="#000000" transform="translate(74,20)" class="amcharts-axis-line" visibility="visible"></path>
                           </g>
                           <g class="amcharts-value-axis value-axis-a2">
                              <path cs="100,100" d="M0.5,0.5 L0.5,340.5 L0.5,340.5" fill="none" stroke-width="1" stroke-opacity="0" stroke="#000000" transform="translate(429,20)" class="amcharts-axis-line" visibility="visible"></path>
                           </g>
                           <g class="amcharts-value-axis value-axis-a3">
                              <path cs="100,100" d="M0.5,0.5 L0.5,340.5 L0.5,340.5" fill="none" stroke-width="1" stroke-opacity="0" stroke="#000000" transform="translate(429,20)" class="amcharts-axis-line" visibility="visible"></path>
                           </g>
                        </g>
                        <g>
                           <g transform="translate(74,20)" visibility="hidden">
                              <path cs="100,100" d="M0.5,0.5 L0.5,0.5 L0.5,340.5" fill="none" stroke-width="1" stroke-opacity="0" stroke="#CC0000" class="amcharts-cursor-line" visibility="hidden" style="pointer-events: none;"></path>
                           </g>
                        </g>
                        <g></g>
                        <g>
                           <g transform="translate(74,20)" class="amcharts-graph-column amcharts-graph-g1"></g>
                           <g transform="translate(74,20)" class="amcharts-graph-line amcharts-graph-g2">
                              <circle r="5" cx="0" cy="0" fill="#89c4f4" stroke="#02617a" fill-opacity="1" stroke-width="2" stroke-opacity="1" transform="translate(16,305)" class="amcharts-graph-bullet"></circle>
                              <text y="6" fill="#6c7b88" font-family="Open Sans" font-size="12px" opacity="1" text-anchor="start" class="amcharts-graph-label" transform="translate(24,303)" style="pointer-events: none;">
                                 <tspan y="6" x="0">Miami</tspan>
                              </text>
                              <circle r="3.5" cx="0" cy="0" fill="#89c4f4" stroke="#02617a" fill-opacity="1" stroke-width="2" stroke-opacity="1" transform="translate(48,218)" class="amcharts-graph-bullet"></circle>
                              <text y="6" fill="#6c7b88" font-family="Open Sans" font-size="12px" opacity="1" text-anchor="start" class="amcharts-graph-label" transform="translate(55,218)" style="pointer-events: none;">
                                 <tspan y="6" x="0"></tspan>
                              </text>
                              <circle r="5" cx="0" cy="0" fill="#89c4f4" stroke="#02617a" fill-opacity="1" stroke-width="2" stroke-opacity="1" transform="translate(81,228)" class="amcharts-graph-bullet"></circle>
                              <text y="6" fill="#6c7b88" font-family="Open Sans" font-size="12px" opacity="1" text-anchor="start" class="amcharts-graph-label" transform="translate(89,228)" style="pointer-events: none;">
                                 <tspan y="6" x="0"></tspan>
                              </text>
                              <circle r="8" cx="0" cy="0" fill="#89c4f4" stroke="#02617a" fill-opacity="1" stroke-width="2" stroke-opacity="1" transform="translate(113,231)" class="amcharts-graph-bullet"></circle>
                              <text y="6" fill="#6c7b88" font-family="Open Sans" font-size="12px" opacity="1" text-anchor="start" class="amcharts-graph-label" transform="translate(124,229)" style="pointer-events: none;">
                                 <tspan y="6" x="0">Houston</tspan>
                              </text>
                              <circle r="8.5" cx="0" cy="0" fill="#89c4f4" stroke="#02617a" fill-opacity="1" stroke-width="2" stroke-opacity="1" transform="translate(145,174)" class="amcharts-graph-bullet"></circle>
                              <text y="6" fill="#6c7b88" font-family="Open Sans" font-size="12px" opacity="1" text-anchor="start" class="amcharts-graph-label" transform="translate(157,174)" style="pointer-events: none;">
                                 <tspan y="6" x="0"></tspan>
                              </text>
                              <circle r="5.5" cx="0" cy="0" fill="#89c4f4" stroke="#02617a" fill-opacity="1" stroke-width="2" stroke-opacity="1" transform="translate(178,123)" class="amcharts-graph-bullet"></circle>
                              <text y="6" fill="#6c7b88" font-family="Open Sans" font-size="12px" opacity="1" text-anchor="start" class="amcharts-graph-label" transform="translate(187,123)" style="pointer-events: none;">
                                 <tspan y="6" x="0"></tspan>
                              </text>
                              <circle r="5" cx="0" cy="0" fill="#89c4f4" stroke="#02617a" fill-opacity="1" stroke-width="2" stroke-opacity="1" transform="translate(210,55)" class="amcharts-graph-bullet"></circle>
                              <text y="6" fill="#6c7b88" font-family="Open Sans" font-size="12px" opacity="1" text-anchor="start" class="amcharts-graph-label" transform="translate(218,55)" style="pointer-events: none;">
                                 <tspan y="6" x="0"></tspan>
                              </text>
                              <circle r="9" cx="0" cy="0" fill="#89c4f4" stroke="#02617a" fill-opacity="1" stroke-width="2" stroke-opacity="1" transform="translate(242,43)" class="amcharts-graph-bullet"></circle>
                              <text y="6" fill="#6c7b88" font-family="Open Sans" font-size="12px" opacity="1" text-anchor="start" class="amcharts-graph-label" transform="translate(254,41)" style="pointer-events: none;">
                                 <tspan y="6" x="0">Denver</tspan>
                              </text>
                              <circle r="6" cx="0" cy="0" fill="#89c4f4" stroke="#02617a" fill-opacity="1" stroke-width="2" stroke-opacity="1" transform="translate(274,24)" class="amcharts-graph-bullet"></circle>
                              <text y="6" fill="#6c7b88" font-family="Open Sans" font-size="12px" opacity="1" text-anchor="start" class="amcharts-graph-label" transform="translate(283,24)" style="pointer-events: none;">
                                 <tspan y="6" x="0"></tspan>
                              </text>
                              <circle r="4" cx="0" cy="0" fill="#89c4f4" stroke="#02617a" fill-opacity="1" stroke-width="2" stroke-opacity="1" transform="translate(307,111)" class="amcharts-graph-bullet lastBullet"></circle>
                              <text y="6" fill="#6c7b88" font-family="Open Sans" font-size="12px" opacity="1" text-anchor="start" class="amcharts-graph-label" transform="translate(314,109)" style="pointer-events: none;">
                                 <tspan y="6" x="0">Las Vegas</tspan>
                              </text>
                           </g>
                           <g transform="translate(74,20)" class="amcharts-graph-line amcharts-graph-g3">
                              <path cs="100,100" d="M-3.5,4.5 L4.5,4.5 L4.5,-3.5 L-3.5,-3.5 Z" fill="#e26a6a" stroke="#e26a6a" fill-opacity="1" stroke-width="1" stroke-opacity="0.8" transform="translate(16,194)" class="amcharts-graph-bullet"></path>
                              <path cs="100,100" d="M-3.5,4.5 L4.5,4.5 L4.5,-3.5 L-3.5,-3.5 Z" fill="#e26a6a" stroke="#e26a6a" fill-opacity="1" stroke-width="1" stroke-opacity="0.8" transform="translate(48,222)" class="amcharts-graph-bullet"></path>
                              <path cs="100,100" d="M-3.5,4.5 L4.5,4.5 L4.5,-3.5 L-3.5,-3.5 Z" fill="#e26a6a" stroke="#e26a6a" fill-opacity="1" stroke-width="1" stroke-opacity="0.8" transform="translate(81,240)" class="amcharts-graph-bullet"></path>
                              <path cs="100,100" d="M-3.5,4.5 L4.5,4.5 L4.5,-3.5 L-3.5,-3.5 Z" fill="#e26a6a" stroke="#e26a6a" fill-opacity="1" stroke-width="1" stroke-opacity="0.8" transform="translate(113,287)" class="amcharts-graph-bullet"></path>
                              <path cs="100,100" d="M-3.5,4.5 L4.5,4.5 L4.5,-3.5 L-3.5,-3.5 Z" fill="#e26a6a" stroke="#e26a6a" fill-opacity="1" stroke-width="1" stroke-opacity="0.8" transform="translate(145,298)" class="amcharts-graph-bullet"></path>
                              <path cs="100,100" d="M-3.5,4.5 L4.5,4.5 L4.5,-3.5 L-3.5,-3.5 Z" fill="#e26a6a" stroke="#e26a6a" fill-opacity="1" stroke-width="1" stroke-opacity="0.8" transform="translate(178,202)" class="amcharts-graph-bullet"></path>
                              <path cs="100,100" d="M-3.5,4.5 L4.5,4.5 L4.5,-3.5 L-3.5,-3.5 Z" fill="#e26a6a" stroke="#e26a6a" fill-opacity="1" stroke-width="1" stroke-opacity="0.8" transform="translate(210,5)" class="amcharts-graph-bullet"></path>
                              <path cs="100,100" d="M-3.5,4.5 L4.5,4.5 L4.5,-3.5 L-3.5,-3.5 Z" fill="#e26a6a" stroke="#e26a6a" fill-opacity="1" stroke-width="1" stroke-opacity="0.8" transform="translate(242,44)" class="amcharts-graph-bullet"></path>
                              <path cs="100,100" d="M-3.5,4.5 L4.5,4.5 L4.5,-3.5 L-3.5,-3.5 Z" fill="#e26a6a" stroke="#e26a6a" fill-opacity="1" stroke-width="1" stroke-opacity="0.8" transform="translate(274,112)" class="amcharts-graph-bullet"></path>
                              <path cs="100,100" d="M-3.5,4.5 L4.5,4.5 L4.5,-3.5 L-3.5,-3.5 Z" fill="#e26a6a" stroke="#e26a6a" fill-opacity="1" stroke-width="1" stroke-opacity="0.8" transform="translate(307,209)" class="amcharts-graph-bullet"></path>
                           </g>
                        </g>
                        <g>
                           <g class="amcharts-category-axis" transform="translate(74,20)" visibility="visible">
                              <text y="6" fill="#6c7b88" font-family="Open Sans" font-size="12px" opacity="1" text-anchor="middle" transform="translate(16.136363653342134,353)" class="amcharts-axis-label">
                                 <tspan y="6" x="0">05</tspan>
                              </text>
                              <text y="6" fill="#6c7b88" font-family="Open Sans" font-size="12px" opacity="1" text-anchor="middle" transform="translate(48.13636365334213,353)" class="amcharts-axis-label">
                                 <tspan y="6" x="0">06</tspan>
                              </text>
                              <text y="6" fill="#6c7b88" font-family="Open Sans" font-size="12px" opacity="1" text-anchor="middle" transform="translate(81.13636365334213,353)" class="amcharts-axis-label">
                                 <tspan y="6" x="0">07</tspan>
                              </text>
                              <text y="6" fill="#6c7b88" font-family="Open Sans" font-size="12px" opacity="1" text-anchor="middle" transform="translate(113.13636365334213,353)" class="amcharts-axis-label">
                                 <tspan y="6" x="0">08</tspan>
                              </text>
                              <text y="6" fill="#6c7b88" font-family="Open Sans" font-size="12px" opacity="1" text-anchor="middle" transform="translate(145.13636365334213,353)" class="amcharts-axis-label">
                                 <tspan y="6" x="0">09</tspan>
                              </text>
                              <text y="6" fill="#6c7b88" font-family="Open Sans" font-size="12px" opacity="1" text-anchor="middle" transform="translate(177.13636365334213,353)" class="amcharts-axis-label">
                                 <tspan y="6" x="0">10</tspan>
                              </text>
                              <text y="6" fill="#6c7b88" font-family="Open Sans" font-size="12px" opacity="1" text-anchor="middle" transform="translate(210.13636365334213,353)" class="amcharts-axis-label">
                                 <tspan y="6" x="0">11</tspan>
                              </text>
                              <text y="6" fill="#6c7b88" font-family="Open Sans" font-size="12px" opacity="1" text-anchor="middle" transform="translate(242.13636365334213,353)" class="amcharts-axis-label">
                                 <tspan y="6" x="0">12</tspan>
                              </text>
                              <text y="6" fill="#6c7b88" font-family="Open Sans" font-size="12px" opacity="1" text-anchor="middle" transform="translate(274.13636365334213,353)" class="amcharts-axis-label">
                                 <tspan y="6" x="0">13</tspan>
                              </text>
                              <text y="6" fill="#6c7b88" font-family="Open Sans" font-size="12px" opacity="1" text-anchor="middle" transform="translate(306.13636365334213,353)" class="amcharts-axis-label">
                                 <tspan y="6" x="0">14</tspan>
                              </text>
                              <text y="6" fill="#6c7b88" font-family="Open Sans" font-size="12px" opacity="1" text-anchor="middle" transform="translate(339.13636365334213,353)" class="amcharts-axis-label">
                                 <tspan y="6" x="0">15</tspan>
                              </text>
                           </g>
                           <g class="amcharts-value-axis value-axis-a1" transform="translate(74,20)" visibility="visible">
                              <text y="6" fill="#6c7b88" font-family="Open Sans" font-size="12px" opacity="1" text-anchor="end" transform="translate(-12,337.5)" class="amcharts-axis-label">
                                 <tspan y="6" x="0">200</tspan>
                              </text>
                              <text y="6" fill="#6c7b88" font-family="Open Sans" font-size="12px" opacity="1" text-anchor="end" transform="translate(-12,299.5)" class="amcharts-axis-label">
                                 <tspan y="6" x="0">250</tspan>
                              </text>
                              <text y="6" fill="#6c7b88" font-family="Open Sans" font-size="12px" opacity="1" text-anchor="end" transform="translate(-12,261.5)" class="amcharts-axis-label">
                                 <tspan y="6" x="0">300</tspan>
                              </text>
                              <text y="6" fill="#6c7b88" font-family="Open Sans" font-size="12px" opacity="1" text-anchor="end" transform="translate(-12,224.5)" class="amcharts-axis-label">
                                 <tspan y="6" x="0">350</tspan>
                              </text>
                              <text y="6" fill="#6c7b88" font-family="Open Sans" font-size="12px" opacity="1" text-anchor="end" transform="translate(-12,186.5)" class="amcharts-axis-label">
                                 <tspan y="6" x="0">400</tspan>
                              </text>
                              <text y="6" fill="#6c7b88" font-family="Open Sans" font-size="12px" opacity="1" text-anchor="end" transform="translate(-12,148.5)" class="amcharts-axis-label">
                                 <tspan y="6" x="0">450</tspan>
                              </text>
                              <text y="6" fill="#6c7b88" font-family="Open Sans" font-size="12px" opacity="1" text-anchor="end" transform="translate(-12,110.5)" class="amcharts-axis-label">
                                 <tspan y="6" x="0">500</tspan>
                              </text>
                              <text y="6" fill="#6c7b88" font-family="Open Sans" font-size="12px" opacity="1" text-anchor="end" transform="translate(-12,73.5)" class="amcharts-axis-label">
                                 <tspan y="6" x="0">550</tspan>
                              </text>
                              <text y="6" fill="#6c7b88" font-family="Open Sans" font-size="12px" opacity="1" text-anchor="end" transform="translate(-12,35.5)" class="amcharts-axis-label">
                                 <tspan y="6" x="0">600</tspan>
                              </text>
                              <text y="6" fill="#6c7b88" font-family="Open Sans" font-size="12px" opacity="1" text-anchor="end" transform="translate(-12,-2.5)" class="amcharts-axis-label">
                                 <tspan y="6" x="0">650</tspan>
                              </text>
                              <text y="7" fill="#6c7b88" font-family="Open Sans" font-size="13px" opacity="1" font-weight="bold" text-anchor="middle" class="amcharts-axis-title" transform="translate(-52,170) rotate(-90)">
                                 <tspan y="7" x="0">distance</tspan>
                              </text>
                           </g>
                           <g class="amcharts-value-axis value-axis-a2" transform="translate(74,20)" visibility="visible"></g>
                           <g class="amcharts-value-axis value-axis-a3" transform="translate(74,20)" visibility="visible">
                              <text y="6" fill="#6c7b88" font-family="Open Sans" font-size="12px" opacity="1" text-anchor="end" transform="translate(346,330.5)" class="amcharts-axis-label">
                                 <tspan y="6" x="0">03h 20min</tspan>
                              </text>
                              <text y="6" fill="#6c7b88" font-family="Open Sans" font-size="12px" opacity="1" text-anchor="end" transform="translate(346,281.5)" class="amcharts-axis-label">
                                 <tspan y="6" x="0">05h 00min</tspan>
                              </text>
                              <text y="6" fill="#6c7b88" font-family="Open Sans" font-size="12px" opacity="1" text-anchor="end" transform="translate(346,233.5)" class="amcharts-axis-label">
                                 <tspan y="6" x="0">06h 40min</tspan>
                              </text>
                              <text y="6" fill="#6c7b88" font-family="Open Sans" font-size="12px" opacity="1" text-anchor="end" transform="translate(346,184.5)" class="amcharts-axis-label">
                                 <tspan y="6" x="0">08h 20min</tspan>
                              </text>
                              <text y="6" fill="#6c7b88" font-family="Open Sans" font-size="12px" opacity="1" text-anchor="end" transform="translate(346,136.5)" class="amcharts-axis-label">
                                 <tspan y="6" x="0">10h 00min</tspan>
                              </text>
                              <text y="6" fill="#6c7b88" font-family="Open Sans" font-size="12px" opacity="1" text-anchor="end" transform="translate(346,87.5)" class="amcharts-axis-label">
                                 <tspan y="6" x="0">11h 40min</tspan>
                              </text>
                              <text y="6" fill="#6c7b88" font-family="Open Sans" font-size="12px" opacity="1" text-anchor="end" transform="translate(346,39.5)" class="amcharts-axis-label">
                                 <tspan y="6" x="0">13h 20min</tspan>
                              </text>
                              <text y="7" fill="#6c7b88" font-family="Open Sans" font-size="13px" opacity="1" font-weight="bold" text-anchor="middle" class="amcharts-axis-title" transform="translate(372,170) rotate(-90)">
                                 <tspan y="7" x="0">duration</tspan>
                              </text>
                           </g>
                        </g>
                        <g>
                           <g></g>
                        </g>
                        <g></g>
                        <g></g>
                        <g></g>
                     </svg>
                     <a href="http://www.amcharts.com/javascript-charts/" title="JavaScript charts" style="position: absolute; text-decoration: none; color: rgb(108, 123, 136); font-family: "Open Sans"; font-size: 12px; opacity: 0.7; display: block; left: 79px; top: 25px;">JS chart by amCharts</a>
                  </div>
                  <div class="amChartsLegend amcharts-legend-div" style="overflow: hidden; position: relative; text-align: left; width: 470px; height: 107px; cursor: default;">
                     <svg version="1.1" style="position: absolute; width: 470px; height: 107px; top: 0px; left: 0px;">
                        <desc>JavaScript chart by amCharts 3.17.1</desc>
                        <g transform="translate(74,0)">
                           <path cs="100,100" d="M0.5,0.5 L355.5,0.5 L355.5,96.5 L0.5,96.5 Z" fill="#FFFFFF" stroke="#000000" fill-opacity="0" stroke-width="1" stroke-opacity="0" class="amcharts-legend-bg"></path>
                           <g transform="translate(0,11)">
                              <g cursor="pointer" class="amcharts-legend-item-g1" transform="translate(0,0)">
                                 <path cs="100,100" d="M-15.5,8.5 L16.5,8.5 L16.5,-7.5 L-15.5,-7.5 Z" fill="#08a3cc" stroke="#08a3cc" fill-opacity="0.7" stroke-width="1" stroke-opacity="1" transform="translate(16,8)" class="amcharts-graph-column amcharts-graph-g1 amcharts-legend-marker"></path>
                                 <text y="6" fill="#6c7b88" font-family="Open Sans" font-size="12px" opacity="1" text-anchor="start" class="amcharts-legend-label" transform="translate(37,7)">
                                    <tspan y="6" x="0">distance</tspan>
                                 </text>
                                 <text y="6" fill="#6c7b88" font-family="Open Sans" font-size="12px" opacity="1" text-anchor="start" class="amcharts-legend-value" transform="translate(109,7)">total: 3,581 mi</text>
                                 <rect x="32" y="0" width="213.328125" height="19" rx="0" ry="0" stroke-width="0" stroke="none" fill="#fff" fill-opacity="0.005"></rect>
                              </g>
                              <g cursor="pointer" class="amcharts-legend-item-g2" transform="translate(0,29)">
                                 <g class="amcharts-graph-line amcharts-graph-g2 amcharts-legend-marker">
                                    <path cs="100,100" d="M0.5,8.5 L32.5,8.5" fill="none" stroke-width="1" stroke-opacity="1" stroke="#786c56" class="amcharts-graph-stroke"></path>
                                    <circle r="4" cx="0" cy="0" fill="#89c4f4" stroke="#02617a" fill-opacity="1" stroke-width="2" stroke-opacity="1" class="amcharts-graph-bullet" transform="translate(17,8)"></circle>
                                 </g>
                                 <text y="6" fill="#6c7b88" font-family="Open Sans" font-size="12px" opacity="1" text-anchor="start" class="amcharts-legend-label" transform="translate(37,7)">
                                    <tspan y="6" x="0">latitude/city</tspan>
                                 </text>
                                 <text y="6" fill="#6c7b88" font-family="Open Sans" font-size="12px" opacity="1" text-anchor="start" class="amcharts-legend-value" transform="translate(129,7)"> </text>
                                 <rect x="32" y="0" width="232.59375" height="19" rx="0" ry="0" stroke-width="0" stroke="none" fill="#fff" fill-opacity="0.005"></rect>
                              </g>
                              <g cursor="pointer" class="amcharts-legend-item-g3" transform="translate(0,58)">
                                 <g class="amcharts-graph-line amcharts-graph-g3 amcharts-legend-marker">
                                    <path cs="100,100" d="M0.5,8.5 L32.5,8.5" fill="none" stroke-width="1" stroke-opacity="0.8" stroke="#e26a6a" class="amcharts-graph-stroke"></path>
                                    <path cs="100,100" d="M-3.5,4.5 L4.5,4.5 L4.5,-3.5 L-3.5,-3.5 Z" fill="#e26a6a" stroke="#e26a6a" fill-opacity="1" stroke-width="1" stroke-opacity="0.8" class="amcharts-graph-bullet" transform="translate(17,8)"></path>
                                 </g>
                                 <text y="6" fill="#6c7b88" font-family="Open Sans" font-size="12px" opacity="1" text-anchor="start" class="amcharts-legend-label" transform="translate(37,7)">
                                    <tspan y="6" x="0">duration</tspan>
                                 </text>
                                 <text y="6" fill="#6c7b88" font-family="Open Sans" font-size="12px" opacity="1" text-anchor="start" class="amcharts-legend-value" transform="translate(111,7)"> </text>
                                 <rect x="32" y="0" width="214.671875" height="19" rx="0" ry="0" stroke-width="0" stroke="none" fill="#fff" fill-opacity="0.005"></rect>
                              </g>
                           </g>
                        </g>
                     </svg>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="col-md-6 col-sm-6">
      <div class="portlet light ">
         <div class="portlet-title">
            <div class="caption font-red">
               <span class="caption-subject bold uppercase">Finance</span>
               <span class="caption-helper">distance stats...</span>
            </div>
            <div class="actions">
               <a href="#" class="btn btn-circle green btn-outline btn-sm">
               <i class="fa fa-pencil"></i> Export </a>
               <a href="#" class="btn btn-circle green btn-outline btn-sm">
               <i class="fa fa-print"></i> Print </a>
            </div>
         </div>
         <div class="portlet-body">
            <div id="dashboard_amchart_3" class="CSSAnimationChart" style="overflow: hidden; text-align: left;">
               <div class="amcharts-main-div" style="position: relative;">
                  <div class="amcharts-chart-div" style="overflow: hidden; position: relative; text-align: left; width: 470px; height: 500px; padding: 0px;">
                     <svg version="1.1" style="position: absolute; width: 470px; height: 500px; top: 0px; left: 0px;">
                        <desc>JavaScript chart by amCharts 3.17.1</desc>
                        <g>
                           <path cs="100,100" d="M0.5,0.5 L469.5,0.5 L469.5,499.5 L0.5,499.5 Z" fill="#FFFFFF" stroke="#000000" fill-opacity="0" stroke-width="1" stroke-opacity="0" class="amcharts-bg"></path>
                           <path cs="100,100" d="M0.5,0.5 L431.5,0.5 L431.5,463.5 L0.5,463.5 L0.5,0.5 Z" fill="#FFFFFF" stroke="#000000" fill-opacity="0" stroke-width="1" stroke-opacity="0" class="amcharts-plot-area" transform="translate(30,10)"></path>
                        </g>
                        <g>
                           <g class="amcharts-category-axis" transform="translate(30,10)">
                              <g>
                                 <path cs="100,100" d="M0.5,463.5 L0.5,463.5 L0.5,0.5" fill="none" stroke-width="1" stroke-opacity="0.1" stroke="#000000" class="amcharts-axis-grid"></path>
                              </g>
                              <g>
                                 <path cs="100,100" d="M72.5,463.5 L72.5,463.5 L72.5,0.5" fill="none" stroke-width="1" stroke-opacity="0.1" stroke="#000000" class="amcharts-axis-grid"></path>
                              </g>
                              <g>
                                 <path cs="100,100" d="M144.5,463.5 L144.5,463.5 L144.5,0.5" fill="none" stroke-width="1" stroke-opacity="0.1" stroke="#000000" class="amcharts-axis-grid"></path>
                              </g>
                              <g>
                                 <path cs="100,100" d="M215.5,463.5 L215.5,463.5 L215.5,0.5" fill="none" stroke-width="1" stroke-opacity="0.1" stroke="#000000" class="amcharts-axis-grid"></path>
                              </g>
                              <g>
                                 <path cs="100,100" d="M287.5,463.5 L287.5,463.5 L287.5,0.5" fill="none" stroke-width="1" stroke-opacity="0.1" stroke="#000000" class="amcharts-axis-grid"></path>
                              </g>
                              <g>
                                 <path cs="100,100" d="M359.5,463.5 L359.5,463.5 L359.5,0.5" fill="none" stroke-width="1" stroke-opacity="0.1" stroke="#000000" class="amcharts-axis-grid"></path>
                              </g>
                              <g>
                                 <path cs="100,100" d="M431.5,463.5 L431.5,463.5 L431.5,0.5" fill="none" stroke-width="1" stroke-opacity="0.1" stroke="#000000" class="amcharts-axis-grid"></path>
                              </g>
                           </g>
                           <g class="amcharts-value-axis value-axis-valueAxisAuto0_1477471795584" transform="translate(30,10)" visibility="visible">
                              <g>
                                 <path cs="100,100" d="M0.5,463.5 L0.5,463.5 L431.5,463.5" fill="none" stroke-width="1" stroke-opacity="0.1" stroke="#000000" class="amcharts-axis-grid"></path>
                              </g>
                              <g>
                                 <path cs="100,100" d="M0.5,405.5 L0.5,405.5 L431.5,405.5" fill="none" stroke-width="1" stroke-opacity="0.1" stroke="#000000" class="amcharts-axis-grid"></path>
                              </g>
                              <g>
                                 <path cs="100,100" d="M0.5,347.5 L0.5,347.5 L431.5,347.5" fill="none" stroke-width="1" stroke-opacity="0.1" stroke="#000000" class="amcharts-axis-grid"></path>
                              </g>
                              <g>
                                 <path cs="100,100" d="M0.5,289.5 L0.5,289.5 L431.5,289.5" fill="none" stroke-width="1" stroke-opacity="0.1" stroke="#000000" class="amcharts-axis-grid"></path>
                              </g>
                              <g>
                                 <path cs="100,100" d="M0.5,232.5 L0.5,232.5 L431.5,232.5" fill="none" stroke-width="1" stroke-opacity="0.1" stroke="#000000" class="amcharts-axis-grid"></path>
                              </g>
                              <g>
                                 <path cs="100,100" d="M0.5,174.5 L0.5,174.5 L431.5,174.5" fill="none" stroke-width="1" stroke-opacity="0.1" stroke="#000000" class="amcharts-axis-grid"></path>
                              </g>
                              <g>
                                 <path cs="100,100" d="M0.5,116.5 L0.5,116.5 L431.5,116.5" fill="none" stroke-width="1" stroke-opacity="0.1" stroke="#000000" class="amcharts-axis-grid"></path>
                              </g>
                              <g>
                                 <path cs="100,100" d="M0.5,58.5 L0.5,58.5 L431.5,58.5" fill="none" stroke-width="1" stroke-opacity="0.1" stroke="#000000" class="amcharts-axis-grid"></path>
                              </g>
                              <g>
                                 <path cs="100,100" d="M0.5,0.5 L0.5,0.5 L431.5,0.5" fill="none" stroke-width="1" stroke-opacity="0.1" stroke="#000000" class="amcharts-axis-grid"></path>
                              </g>
                           </g>
                        </g>
                        <g></g>
                        <g></g>
                        <g></g>
                        <g>
                           <g transform="translate(30,10)">
                              <g class="amcharts-graph-column amcharts-graph-graphAuto0_1477471795585" transform="translate(7,463)">
                                 <path cs="100,100" d="M0.5,0.5 L0.5,-100.5 L57.5,-100.5 L57.5,0.5 L0.5,0.5 Z" fill="#67b7dc" stroke="#67b7dc" fill-opacity="1" stroke-width="1" stroke-opacity="0.9" class="amcharts-graph-column-front amcharts-graph-column-element"></path>
                              </g>
                              <g class="amcharts-graph-column amcharts-graph-graphAuto0_1477471795585" transform="translate(79,463)">
                                 <path cs="100,100" d="M0.5,0.5 L0.5,-178.5 L57.5,-178.5 L57.5,0.5 L0.5,0.5 Z" fill="#67b7dc" stroke="#67b7dc" fill-opacity="1" stroke-width="1" stroke-opacity="0.9" class="amcharts-graph-column-front amcharts-graph-column-element"></path>
                              </g>
                              <g class="amcharts-graph-column amcharts-graph-graphAuto0_1477471795585" transform="translate(151,463)">
                                 <path cs="100,100" d="M0.5,0.5 L0.5,-291.5 L57.5,-291.5 L57.5,0.5 L0.5,0.5 Z" fill="#67b7dc" stroke="#67b7dc" fill-opacity="1" stroke-width="1" stroke-opacity="0.9" class="amcharts-graph-column-front amcharts-graph-column-element"></path>
                              </g>
                              <g class="amcharts-graph-column amcharts-graph-graphAuto0_1477471795585" transform="translate(222,463)">
                                 <path cs="100,100" d="M0.5,0.5 L0.5,-274.5 L57.5,-274.5 L57.5,0.5 L0.5,0.5 Z" fill="#67b7dc" stroke="#67b7dc" fill-opacity="1" stroke-width="1" stroke-opacity="0.9" class="amcharts-graph-column-front amcharts-graph-column-element"></path>
                              </g>
                              <g class="amcharts-graph-column amcharts-graph-graphAuto0_1477471795585" transform="translate(294,463)">
                                 <path cs="100,100" d="M0.5,0.5 L0.5,-306.5 L57.5,-306.5 L57.5,0.5 L0.5,0.5 Z" fill="#67b7dc" stroke="#67b7dc" fill-opacity="1" stroke-width="1" stroke-opacity="0.9" class="amcharts-graph-column-front amcharts-graph-column-element"></path>
                              </g>
                              <g class="amcharts-graph-column amcharts-graph-graphAuto0_1477471795585" transform="translate(366,463)">
                                 <path cs="100,100" d="M0.5,0.5 L0.5,-407.5 L57.5,-407.5 L57.5,0.5 L0.5,0.5 Z" fill="#67b7dc" stroke="#67b7dc" fill-opacity="0.2" stroke-width="1" stroke-opacity="0.9" stroke-dasharray="5" class="amcharts-graph-column-front amcharts-graph-column-element"></path>
                              </g>
                           </g>
                        </g>
                        <g>
                           <g transform="translate(30,10)" class="amcharts-graph-column amcharts-graph-graphAuto0_1477471795585">
                              <g></g>
                           </g>
                           <g transform="translate(30,10)" class="amcharts-graph-line amcharts-graph-graph2">
                              <g></g>
                              <g></g>
                              <g clip-path="url(#AmChartsEl-11)">
                                 <path cs="100,100" d="M36.5,431.5 L108.5,159.5 L180.5,32.5 L251.5,142.5 L323.5,226.5 L395.5,90.5 M0,0 L0,0" fill="none" stroke-width="3" stroke-opacity="1" stroke="#fdd400" class="amcharts-graph-stroke"></path>
                              </g>
                              <clipPath id="AmChartsEl-11">
                                 <rect x="0" y="0" width="433" height="465" rx="0" ry="0" stroke-width="0"></rect>
                              </clipPath>
                           </g>
                        </g>
                        <g></g>
                        <g>
                           <g class="amcharts-category-axis">
                              <path cs="100,100" d="M0.5,0.5 L431.5,0.5" fill="none" stroke-width="1" stroke-opacity="0" stroke="#000000" transform="translate(30,473)" class="amcharts-axis-line"></path>
                           </g>
                           <g class="amcharts-value-axis value-axis-valueAxisAuto0_1477471795584">
                              <path cs="100,100" d="M0.5,0.5 L0.5,463.5" fill="none" stroke-width="1" stroke-opacity="0" stroke="#000000" transform="translate(30,10)" class="amcharts-axis-line" visibility="visible"></path>
                           </g>
                        </g>
                        <g></g>
                        <g></g>
                        <g>
                           <g transform="translate(30,10)" class="amcharts-graph-column amcharts-graph-graphAuto0_1477471795585"></g>
                           <g transform="translate(30,10)" class="amcharts-graph-line amcharts-graph-graph2">
                              <circle r="3.5" cx="0" cy="0" fill="#FFFFFF" stroke="#fdd400" fill-opacity="1" stroke-width="3" stroke-opacity="1" transform="translate(36,431)" class="amcharts-graph-bullet"></circle>
                              <circle r="3.5" cx="0" cy="0" fill="#FFFFFF" stroke="#fdd400" fill-opacity="1" stroke-width="3" stroke-opacity="1" transform="translate(108,159)" class="amcharts-graph-bullet"></circle>
                              <circle r="3.5" cx="0" cy="0" fill="#FFFFFF" stroke="#fdd400" fill-opacity="1" stroke-width="3" stroke-opacity="1" transform="translate(180,32)" class="amcharts-graph-bullet"></circle>
                              <circle r="3.5" cx="0" cy="0" fill="#FFFFFF" stroke="#fdd400" fill-opacity="1" stroke-width="3" stroke-opacity="1" transform="translate(251,142)" class="amcharts-graph-bullet"></circle>
                              <circle r="3.5" cx="0" cy="0" fill="#FFFFFF" stroke="#fdd400" fill-opacity="1" stroke-width="3" stroke-opacity="1" transform="translate(323,226)" class="amcharts-graph-bullet"></circle>
                              <circle r="3.5" cx="0" cy="0" fill="#FFFFFF" stroke="#fdd400" fill-opacity="1" stroke-width="3" stroke-opacity="1" transform="translate(395,90)" class="amcharts-graph-bullet"></circle>
                           </g>
                        </g>
                        <g>
                           <g class="amcharts-category-axis" transform="translate(30,10)" visibility="visible">
                              <text y="6" fill="#000000" font-family="Verdana" font-size="11px" opacity="1" text-anchor="middle" transform="translate(35.916666666666664,475.5)" class="amcharts-axis-label">
                                 <tspan y="6" x="0">2009</tspan>
                              </text>
                              <text y="6" fill="#000000" font-family="Verdana" font-size="11px" opacity="1" text-anchor="middle" transform="translate(107.91666666666666,475.5)" class="amcharts-axis-label">
                                 <tspan y="6" x="0">2010</tspan>
                              </text>
                              <text y="6" fill="#000000" font-family="Verdana" font-size="11px" opacity="1" text-anchor="middle" transform="translate(179.91666666666666,475.5)" class="amcharts-axis-label">
                                 <tspan y="6" x="0">2011</tspan>
                              </text>
                              <text y="6" fill="#000000" font-family="Verdana" font-size="11px" opacity="1" text-anchor="middle" transform="translate(250.91666666666666,475.5)" class="amcharts-axis-label">
                                 <tspan y="6" x="0">2012</tspan>
                              </text>
                              <text y="6" fill="#000000" font-family="Verdana" font-size="11px" opacity="1" text-anchor="middle" transform="translate(322.9166666666667,475.5)" class="amcharts-axis-label">
                                 <tspan y="6" x="0">2013</tspan>
                              </text>
                              <text y="6" fill="#000000" font-family="Verdana" font-size="11px" opacity="1" text-anchor="middle" transform="translate(394.9166666666667,475.5)" class="amcharts-axis-label">
                                 <tspan y="6" x="0">2014</tspan>
                              </text>
                           </g>
                           <g class="amcharts-value-axis value-axis-valueAxisAuto0_1477471795584" transform="translate(30,10)" visibility="visible">
                              <text y="6" fill="#000000" font-family="Verdana" font-size="11px" opacity="1" text-anchor="end" transform="translate(-12,462)" class="amcharts-axis-label">
                                 <tspan y="6" x="0">20</tspan>
                              </text>
                              <text y="6" fill="#000000" font-family="Verdana" font-size="11px" opacity="1" text-anchor="end" transform="translate(-12,404)" class="amcharts-axis-label">
                                 <tspan y="6" x="0">22</tspan>
                              </text>
                              <text y="6" fill="#000000" font-family="Verdana" font-size="11px" opacity="1" text-anchor="end" transform="translate(-12,346)" class="amcharts-axis-label">
                                 <tspan y="6" x="0">24</tspan>
                              </text>
                              <text y="6" fill="#000000" font-family="Verdana" font-size="11px" opacity="1" text-anchor="end" transform="translate(-12,288)" class="amcharts-axis-label">
                                 <tspan y="6" x="0">26</tspan>
                              </text>
                              <text y="6" fill="#000000" font-family="Verdana" font-size="11px" opacity="1" text-anchor="end" transform="translate(-12,231)" class="amcharts-axis-label">
                                 <tspan y="6" x="0">28</tspan>
                              </text>
                              <text y="6" fill="#000000" font-family="Verdana" font-size="11px" opacity="1" text-anchor="end" transform="translate(-12,173)" class="amcharts-axis-label">
                                 <tspan y="6" x="0">30</tspan>
                              </text>
                              <text y="6" fill="#000000" font-family="Verdana" font-size="11px" opacity="1" text-anchor="end" transform="translate(-12,115)" class="amcharts-axis-label">
                                 <tspan y="6" x="0">32</tspan>
                              </text>
                              <text y="6" fill="#000000" font-family="Verdana" font-size="11px" opacity="1" text-anchor="end" transform="translate(-12,57)" class="amcharts-axis-label">
                                 <tspan y="6" x="0">34</tspan>
                              </text>
                              <text y="6" fill="#000000" font-family="Verdana" font-size="11px" opacity="1" text-anchor="end" transform="translate(-12,-1)" class="amcharts-axis-label">
                                 <tspan y="6" x="0">36</tspan>
                              </text>
                           </g>
                        </g>
                        <g>
                           <g></g>
                        </g>
                        <g></g>
                        <g></g>
                        <g></g>
                     </svg>
                     <a href="http://www.amcharts.com/javascript-charts/" title="JavaScript charts" style="position: absolute; text-decoration: none; color: rgb(0, 0, 0); font-family: Verdana; font-size: 11px; opacity: 0.7; display: block; left: 35px; top: 15px;">JS chart by amCharts</a>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<div class="clearfix"></div>
                    <!-- END DASHBOARD STATS 1-->

@endsection
@section('dashboard')
    <script src="{{url('js/jquery.waypoints.min.js')}}" type="text/javascript"></script>
    <script src="{{url('js/jquery.counterup.min.js')}}" type="text/javascript"></script>
    <script src="{{url('js/jquery.vmap.js')}}" type="text/javascript"></script>
    <script src="{{url('js/jquery.vmap.russia.js')}}" type="text/javascript"></script>
    <script src="{{url('js/jquery.vmap.world.js')}}" type="text/javascript"></script>
    <script src="{{url('js/jquery.vmap.europe.js')}}" type="text/javascript"></script>
    <script src="{{url('js/jquery.vmap.germany.js')}}" type="text/javascript"></script>
    <script src="{{url('js/jquery.vmap.usa.js')}}" type="text/javascript"></script>
    <script src="{{url('js/jquery.vmap.sampledata.js')}}" type="text/javascript"></script>
    <script src="{{url('js/morris.min.js')}}" type="text/javascript"></script>
    <script src="{{url('js/light.js')}}" type="text/javascript"></script>
@endsection