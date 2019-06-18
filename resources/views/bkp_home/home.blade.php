@extends('layouts.app-inner')

@section('content')

            <div class="dashboard-wrapper dashboard-wrapper-new-div ">
                <div class="dashboard-ecommerce">
                    <div class="container-fluid dashboard-content ">
                        
                         <div class="ecommerce-widget">

                            <div class="row">

                                
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                    <div class="admin-penal-right-side-contain-common-main-div">
                                        <div class="card common-card-div">
                                            <div class="dashboard-contain-div">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="user-rasio-info-div">
                                                            <div class="img-div">
                                                                <img src="assets/images/dashboard-img1.png" class="img-fluid">
                                                            </div>
                                                            <div class="text-divs">
                                                                <p class="numbers">24</p>
                                                                <p class="texts">Appointments</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="user-rasio-info-div">
                                                            <div class="img-div">
                                                                <img src="assets/images/dashboard-img2.png" class="img-fluid">
                                                            </div>
                                                            <div class="text-divs">
                                                                <p class="numbers">$345</p>
                                                                <p class="texts">Estimate Sales</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="user-rasio-info-div">
                                                            <div class="img-div">
                                                                <img src="assets/images/dashboard-img3.png" class="img-fluid">
                                                            </div>
                                                            <div class="text-divs">
                                                                <p class="numbers">20</p>
                                                                <p class="texts">New Customers</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> 
                                            <div class="business-button pt-2">
                                                <h2 class="pb-2 pt-5">Average Stats</h2>
                                            </div>   
                                            <div class="business-logo"> 
                                                <div class="row"> 
                                                    <div class="col-md-6">
                                                        <div class="average-stats ml-3 mb-5">
                                                           <i class="fa fa-circle"></i>
                                                           <span>Customers</span>
                                                        </div>
                                                         <div class="average-stats-revenue ml-3 mb-5">
                                                           <i class="fa fa-circle"></i>
                                                           <span>Revenue</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 ">
                                                        <div class="monthly-btn ">
                                                            <span class="mr-3">Monthly</span>
                                                                <label class="switch ">
                                                                  <input type="checkbox">
                                                                  <span class="slider round"></span>
                                                                </label>
                                                            <span class="ml-3">Yearly</span>
                                                      </div>
                                                    </div>
                                                </div>  
                                                    <div id="chartContainer" style="height: 370px; width: 100%;"></div>
                                            </div>
                                            <div class="business-button">
                                                <div class="row">
                                                    <div class="col-md-8">
                                                        <h2 class="pb-2 pt-5">Calender </h2>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <h2 class="pb-2 pt-5">Activity Timeline </h2>
                                                    </div>
                                                </div>
                                            </div>  
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <div class="business-logo"> 
                                                            <div class="calendar-container">
                                                               <div id="calendar" class="fc fc-unthemed fc-ltr">
                                                                  <div class="fc-toolbar fc-header-toolbar">
                                                                     <div class="fc-left"></div>
                                                                     <div class="fc-right">
                                                                        <div class="fc-button-group">
                                                                           <button type="button" class="fc-month-button fc-button fc-state-default fc-corner-left fc-state-active">month</button>
                                                                           <button type="button" class="fc-agendaWeek-button fc-button fc-state-default">week</button><button type="button" class="fc-agendaDay-button fc-button fc-state-default fc-corner-right">day</button></div>
                                                                     </div>
                                                                     <div class="fc-center">
                                                                        <div>
                                                                           <button type="button" class="fc-prev-button fc-button fc-state-default"><span class="fc-icon fc-icon-left-single-arrow"></span></button>
                                                                           <h2>October 2016</h2>
                                                                           <button type="button" class="fc-next-button fc-button fc-state-default"><span class="fc-icon fc-icon-right-single-arrow"></span></button>
                                                                        </div>
                                                                     </div>
                                                                     <div class="fc-clear"></div>
                                                                  </div>
                                                                  <div class="fc-view-container" style="">
                                                                     <div class="fc-view fc-month-view fc-basic-view" style="">
                                                                        <table class="">
                                                                           <thead class="fc-head">
                                                                              <tr>
                                                                                 <td class="fc-head-container fc-widget-header">
                                                                                    <div class="fc-row fc-widget-header">
                                                                                       <table class="">
                                                                                          <thead>
                                                                                             <tr>
                                                                                                <th class="fc-day-header fc-widget-header fc-sun"><span>Sun</span></th>
                                                                                                <th class="fc-day-header fc-widget-header fc-mon"><span>Mon</span></th>
                                                                                                <th class="fc-day-header fc-widget-header fc-tue"><span>Tue</span></th>
                                                                                                <th class="fc-day-header fc-widget-header fc-wed"><span>Wed</span></th>
                                                                                                <th class="fc-day-header fc-widget-header fc-thu"><span>Thu</span></th>
                                                                                                <th class="fc-day-header fc-widget-header fc-fri"><span>Fri</span></th>
                                                                                                <th class="fc-day-header fc-widget-header fc-sat"><span>Sat</span></th>
                                                                                             </tr>
                                                                                          </thead>
                                                                                       </table>
                                                                                    </div>
                                                                                 </td>
                                                                              </tr>
                                                                           </thead>
                                                                           <tbody class="fc-body">
                                                                              <tr>
                                                                                 <td class="fc-widget-content">
                                                                                    <div class="fc-scroller fc-day-grid-container" style="overflow: hidden; height: 693px;">
                                                                                       <div class="fc-day-grid fc-unselectable">
                                                                                          <div class="fc-row fc-week fc-widget-content fc-rigid" style="height: 115px;">
                                                                                             <div class="fc-bg">
                                                                                                <table class="">
                                                                                                   <tbody>
                                                                                                      <tr>
                                                                                                         <td class="fc-day fc-widget-content fc-sun fc-other-month fc-past" data-date="2016-09-25"></td>
                                                                                                         <td class="fc-day fc-widget-content fc-mon fc-other-month fc-past" data-date="2016-09-26"></td>
                                                                                                         <td class="fc-day fc-widget-content fc-tue fc-other-month fc-past" data-date="2016-09-27"></td>
                                                                                                         <td class="fc-day fc-widget-content fc-wed fc-other-month fc-past" data-date="2016-09-28"></td>
                                                                                                         <td class="fc-day fc-widget-content fc-thu fc-other-month fc-past" data-date="2016-09-29"></td>
                                                                                                         <td class="fc-day fc-widget-content fc-fri fc-other-month fc-past" data-date="2016-09-30"></td>
                                                                                                         <td class="fc-day fc-widget-content fc-sat fc-past" data-date="2016-10-01"></td>
                                                                                                      </tr>
                                                                                                   </tbody>
                                                                                                </table>
                                                                                             </div>
                                                                                             <div class="fc-content-skeleton">
                                                                                                <table>
                                                                                                   <thead>
                                                                                                      <tr>
                                                                                                         <td class="fc-day-top fc-sun fc-other-month fc-past" data-date="2016-09-25"><span class="fc-day-number">25</span></td>
                                                                                                         <td class="fc-day-top fc-mon fc-other-month fc-past" data-date="2016-09-26"><span class="fc-day-number">26</span></td>
                                                                                                         <td class="fc-day-top fc-tue fc-other-month fc-past" data-date="2016-09-27"><span class="fc-day-number">27</span></td>
                                                                                                         <td class="fc-day-top fc-wed fc-other-month fc-past" data-date="2016-09-28"><span class="fc-day-number">28</span></td>
                                                                                                         <td class="fc-day-top fc-thu fc-other-month fc-past" data-date="2016-09-29"><span class="fc-day-number">29</span></td>
                                                                                                         <td class="fc-day-top fc-fri fc-other-month fc-past" data-date="2016-09-30"><span class="fc-day-number">30</span></td>
                                                                                                         <td class="fc-day-top fc-sat fc-past" data-date="2016-10-01"><span class="fc-day-number">1</span></td>
                                                                                                      </tr>
                                                                                                   </thead>
                                                                                                   <tbody>
                                                                                                      <tr>
                                                                                                         <td></td>
                                                                                                         <td></td>
                                                                                                         <td></td>
                                                                                                         <td></td>
                                                                                                         <td></td>
                                                                                                         <td></td>
                                                                                                         <td class="fc-event-container">
                                                                                                            <a class="fc-day-grid-event fc-h-event fc-event fc-start fc-end fc-draggable fc-resizable">
                                                                                                               <div class="fc-content"> <span class="fc-title">All Day Event</span></div>
                                                                                                               <div class="fc-resizer fc-end-resizer"></div>
                                                                                                            </a>
                                                                                                         </td>
                                                                                                      </tr>
                                                                                                   </tbody>
                                                                                                </table>
                                                                                             </div>
                                                                                          </div>
                                                                                          <div class="fc-row fc-week fc-widget-content fc-rigid" style="height: 115px;">
                                                                                             <div class="fc-bg">
                                                                                                <table class="">
                                                                                                   <tbody>
                                                                                                      <tr>
                                                                                                         <td class="fc-day fc-widget-content fc-sun fc-past" data-date="2016-10-02"></td>
                                                                                                         <td class="fc-day fc-widget-content fc-mon fc-past" data-date="2016-10-03"></td>
                                                                                                         <td class="fc-day fc-widget-content fc-tue fc-past" data-date="2016-10-04"></td>
                                                                                                         <td class="fc-day fc-widget-content fc-wed fc-past" data-date="2016-10-05"></td>
                                                                                                         <td class="fc-day fc-widget-content fc-thu fc-past" data-date="2016-10-06"></td>
                                                                                                         <td class="fc-day fc-widget-content fc-fri fc-past" data-date="2016-10-07"></td>
                                                                                                         <td class="fc-day fc-widget-content fc-sat fc-past" data-date="2016-10-08"></td>
                                                                                                      </tr>
                                                                                                   </tbody>
                                                                                                </table>
                                                                                             </div>
                                                                                             <div class="fc-content-skeleton">
                                                                                                <table>
                                                                                                   <thead>
                                                                                                      <tr>
                                                                                                         <td class="fc-day-top fc-sun fc-past" data-date="2016-10-02"><span class="fc-day-number">2</span></td>
                                                                                                         <td class="fc-day-top fc-mon fc-past" data-date="2016-10-03"><span class="fc-day-number">3</span></td>
                                                                                                         <td class="fc-day-top fc-tue fc-past" data-date="2016-10-04"><span class="fc-day-number">4</span></td>
                                                                                                         <td class="fc-day-top fc-wed fc-past" data-date="2016-10-05"><span class="fc-day-number">5</span></td>
                                                                                                         <td class="fc-day-top fc-thu fc-past" data-date="2016-10-06"><span class="fc-day-number">6</span></td>
                                                                                                         <td class="fc-day-top fc-fri fc-past" data-date="2016-10-07"><span class="fc-day-number">7</span></td>
                                                                                                         <td class="fc-day-top fc-sat fc-past" data-date="2016-10-08"><span class="fc-day-number">8</span></td>
                                                                                                      </tr>
                                                                                                   </thead>
                                                                                                   <tbody>
                                                                                                      <tr>
                                                                                                         <td></td>
                                                                                                         <td></td>
                                                                                                         <td></td>
                                                                                                         <td></td>
                                                                                                         <td></td>
                                                                                                         <td class="fc-event-container" colspan="2">
                                                                                                            <a class="fc-day-grid-event fc-h-event fc-event fc-start fc-not-end fc-draggable" style="background-color:#0bb2d4;border-color:#0bb2d4">
                                                                                                               <div class="fc-content"> <span class="fc-title">Long Event</span></div>
                                                                                                            </a>
                                                                                                         </td>
                                                                                                      </tr>
                                                                                                   </tbody>
                                                                                                </table>
                                                                                             </div>
                                                                                          </div>
                                                                                          <div class="fc-row fc-week fc-widget-content fc-rigid" style="height: 115px;">
                                                                                             <div class="fc-bg">
                                                                                                <table class="">
                                                                                                   <tbody>
                                                                                                      <tr>
                                                                                                         <td class="fc-day fc-widget-content fc-sun fc-past" data-date="2016-10-09"></td>
                                                                                                         <td class="fc-day fc-widget-content fc-mon fc-past" data-date="2016-10-10"></td>
                                                                                                         <td class="fc-day fc-widget-content fc-tue fc-past" data-date="2016-10-11"></td>
                                                                                                         <td class="fc-day fc-widget-content fc-wed fc-past" data-date="2016-10-12"></td>
                                                                                                         <td class="fc-day fc-widget-content fc-thu fc-past" data-date="2016-10-13"></td>
                                                                                                         <td class="fc-day fc-widget-content fc-fri fc-past" data-date="2016-10-14"></td>
                                                                                                         <td class="fc-day fc-widget-content fc-sat fc-past" data-date="2016-10-15"></td>
                                                                                                      </tr>
                                                                                                   </tbody>
                                                                                                </table>
                                                                                             </div>
                                                                                             <div class="fc-content-skeleton">
                                                                                                <table>
                                                                                                   <thead>
                                                                                                      <tr>
                                                                                                         <td class="fc-day-top fc-sun fc-past" data-date="2016-10-09"><span class="fc-day-number">9</span></td>
                                                                                                         <td class="fc-day-top fc-mon fc-past" data-date="2016-10-10"><span class="fc-day-number">10</span></td>
                                                                                                         <td class="fc-day-top fc-tue fc-past" data-date="2016-10-11"><span class="fc-day-number">11</span></td>
                                                                                                         <td class="fc-day-top fc-wed fc-past" data-date="2016-10-12"><span class="fc-day-number">12</span></td>
                                                                                                         <td class="fc-day-top fc-thu fc-past" data-date="2016-10-13"><span class="fc-day-number">13</span></td>
                                                                                                         <td class="fc-day-top fc-fri fc-past" data-date="2016-10-14"><span class="fc-day-number">14</span></td>
                                                                                                         <td class="fc-day-top fc-sat fc-past" data-date="2016-10-15"><span class="fc-day-number">15</span></td>
                                                                                                      </tr>
                                                                                                   </thead>
                                                                                                   <tbody>
                                                                                                      <tr>
                                                                                                         <td class="fc-event-container">
                                                                                                            <a class="fc-day-grid-event fc-h-event fc-event fc-not-start fc-end fc-draggable fc-resizable" style="background-color:#0bb2d4;border-color:#0bb2d4">
                                                                                                               <div class="fc-content"> <span class="fc-title">Long Event</span></div>
                                                                                                               <div class="fc-resizer fc-end-resizer"></div>
                                                                                                            </a>
                                                                                                         </td>
                                                                                                         <td rowspan="6"></td>
                                                                                                         <td class="fc-event-container" colspan="2">
                                                                                                            <a class="fc-day-grid-event fc-h-event fc-event fc-start fc-end fc-draggable fc-resizable">
                                                                                                               <div class="fc-content"> <span class="fc-title">Conference</span></div>
                                                                                                               <div class="fc-resizer fc-end-resizer"></div>
                                                                                                            </a>
                                                                                                         </td>
                                                                                                         <td class="fc-event-container" rowspan="6">
                                                                                                            <a class="fc-day-grid-event fc-h-event fc-event fc-start fc-end fc-draggable">
                                                                                                               <div class="fc-content"><span class="fc-time">7a</span> <span class="fc-title">Birthday Party</span></div>
                                                                                                            </a>
                                                                                                         </td>
                                                                                                         <td rowspan="6"></td>
                                                                                                         <td rowspan="6"></td>
                                                                                                      </tr>
                                                                                                      <tr>
                                                                                                         <td class="fc-event-container" rowspan="5">
                                                                                                            <a class="fc-day-grid-event fc-h-event fc-event fc-start fc-end fc-draggable" style="background-color:#ff4c52;border-color:#ff4c52">
                                                                                                               <div class="fc-content"><span class="fc-time">4p</span> <span class="fc-title">Repeating Event</span></div>
                                                                                                            </a>
                                                                                                         </td>
                                                                                                         <td rowspan="5"></td>
                                                                                                         <td class="fc-event-container">
                                                                                                            <a class="fc-day-grid-event fc-h-event fc-event fc-start fc-end fc-draggable">
                                                                                                               <div class="fc-content"><span class="fc-time">10:30a</span> <span class="fc-title">Meeting</span></div>
                                                                                                            </a>
                                                                                                         </td>
                                                                                                      </tr>
                                                                                                      <tr>
                                                                                                         <td class="fc-event-container">
                                                                                                            <a class="fc-day-grid-event fc-h-event fc-event fc-start fc-end fc-draggable">
                                                                                                               <div class="fc-content"><span class="fc-time">12p</span> <span class="fc-title">Lunch</span></div>
                                                                                                            </a>
                                                                                                         </td>
                                                                                                      </tr>
                                                                                                      <tr>
                                                                                                         <td class="fc-event-container fc-limited">
                                                                                                            <a class="fc-day-grid-event fc-h-event fc-event fc-start fc-end fc-draggable">
                                                                                                               <div class="fc-content"><span class="fc-time">2:30p</span> <span class="fc-title">Meeting</span></div>
                                                                                                            </a>
                                                                                                         </td>
                                                                                                         <td class="fc-more-cell" rowspan="1">
                                                                                                            <div><a class="fc-more">+3 more</a></div>
                                                                                                         </td>
                                                                                                      </tr>
                                                                                                      <tr class="fc-limited">
                                                                                                         <td class="fc-event-container">
                                                                                                            <a class="fc-day-grid-event fc-h-event fc-event fc-start fc-end fc-draggable">
                                                                                                               <div class="fc-content"><span class="fc-time">5:30p</span> <span class="fc-title">Happy Hour</span></div>
                                                                                                            </a>
                                                                                                         </td>
                                                                                                      </tr>
                                                                                                      <tr class="fc-limited">
                                                                                                         <td class="fc-event-container">
                                                                                                            <a class="fc-day-grid-event fc-h-event fc-event fc-start fc-end fc-draggable">
                                                                                                               <div class="fc-content"><span class="fc-time">8p</span> <span class="fc-title">Dinner</span></div>
                                                                                                            </a>
                                                                                                         </td>
                                                                                                      </tr>
                                                                                                   </tbody>
                                                                                                </table>
                                                                                             </div>
                                                                                          </div>
                                                                                          <div class="fc-row fc-week fc-widget-content fc-rigid" style="height: 115px;">
                                                                                             <div class="fc-bg">
                                                                                                <table class="">
                                                                                                   <tbody>
                                                                                                      <tr>
                                                                                                         <td class="fc-day fc-widget-content fc-sun fc-past" data-date="2016-10-16"></td>
                                                                                                         <td class="fc-day fc-widget-content fc-mon fc-past" data-date="2016-10-17"></td>
                                                                                                         <td class="fc-day fc-widget-content fc-tue fc-past" data-date="2016-10-18"></td>
                                                                                                         <td class="fc-day fc-widget-content fc-wed fc-past" data-date="2016-10-19"></td>
                                                                                                         <td class="fc-day fc-widget-content fc-thu fc-past" data-date="2016-10-20"></td>
                                                                                                         <td class="fc-day fc-widget-content fc-fri fc-past" data-date="2016-10-21"></td>
                                                                                                         <td class="fc-day fc-widget-content fc-sat fc-past" data-date="2016-10-22"></td>
                                                                                                      </tr>
                                                                                                   </tbody>
                                                                                                </table>
                                                                                             </div>
                                                                                             <div class="fc-content-skeleton">
                                                                                                <table>
                                                                                                   <thead>
                                                                                                      <tr>
                                                                                                         <td class="fc-day-top fc-sun fc-past" data-date="2016-10-16"><span class="fc-day-number">16</span></td>
                                                                                                         <td class="fc-day-top fc-mon fc-past" data-date="2016-10-17"><span class="fc-day-number">17</span></td>
                                                                                                         <td class="fc-day-top fc-tue fc-past" data-date="2016-10-18"><span class="fc-day-number">18</span></td>
                                                                                                         <td class="fc-day-top fc-wed fc-past" data-date="2016-10-19"><span class="fc-day-number">19</span></td>
                                                                                                         <td class="fc-day-top fc-thu fc-past" data-date="2016-10-20"><span class="fc-day-number">20</span></td>
                                                                                                         <td class="fc-day-top fc-fri fc-past" data-date="2016-10-21"><span class="fc-day-number">21</span></td>
                                                                                                         <td class="fc-day-top fc-sat fc-past" data-date="2016-10-22"><span class="fc-day-number">22</span></td>
                                                                                                      </tr>
                                                                                                   </thead>
                                                                                                   <tbody>
                                                                                                      <tr>
                                                                                                         <td></td>
                                                                                                         <td></td>
                                                                                                         <td></td>
                                                                                                         <td></td>
                                                                                                         <td></td>
                                                                                                         <td></td>
                                                                                                         <td></td>
                                                                                                      </tr>
                                                                                                   </tbody>
                                                                                                </table>
                                                                                             </div>
                                                                                          </div>
                                                                                          <div class="fc-row fc-week fc-widget-content fc-rigid" style="height: 115px;">
                                                                                             <div class="fc-bg">
                                                                                                <table class="">
                                                                                                   <tbody>
                                                                                                      <tr>
                                                                                                         <td class="fc-day fc-widget-content fc-sun fc-past" data-date="2016-10-23"></td>
                                                                                                         <td class="fc-day fc-widget-content fc-mon fc-past" data-date="2016-10-24"></td>
                                                                                                         <td class="fc-day fc-widget-content fc-tue fc-past" data-date="2016-10-25"></td>
                                                                                                         <td class="fc-day fc-widget-content fc-wed fc-past" data-date="2016-10-26"></td>
                                                                                                         <td class="fc-day fc-widget-content fc-thu fc-past" data-date="2016-10-27"></td>
                                                                                                         <td class="fc-day fc-widget-content fc-fri fc-past" data-date="2016-10-28"></td>
                                                                                                         <td class="fc-day fc-widget-content fc-sat fc-past" data-date="2016-10-29"></td>
                                                                                                      </tr>
                                                                                                   </tbody>
                                                                                                </table>
                                                                                             </div>
                                                                                             <div class="fc-content-skeleton">
                                                                                                <table>
                                                                                                   <thead>
                                                                                                      <tr>
                                                                                                         <td class="fc-day-top fc-sun fc-past" data-date="2016-10-23"><span class="fc-day-number">23</span></td>
                                                                                                         <td class="fc-day-top fc-mon fc-past" data-date="2016-10-24"><span class="fc-day-number">24</span></td>
                                                                                                         <td class="fc-day-top fc-tue fc-past" data-date="2016-10-25"><span class="fc-day-number">25</span></td>
                                                                                                         <td class="fc-day-top fc-wed fc-past" data-date="2016-10-26"><span class="fc-day-number">26</span></td>
                                                                                                         <td class="fc-day-top fc-thu fc-past" data-date="2016-10-27"><span class="fc-day-number">27</span></td>
                                                                                                         <td class="fc-day-top fc-fri fc-past" data-date="2016-10-28"><span class="fc-day-number">28</span></td>
                                                                                                         <td class="fc-day-top fc-sat fc-past" data-date="2016-10-29"><span class="fc-day-number">29</span></td>
                                                                                                      </tr>
                                                                                                   </thead>
                                                                                                   <tbody>
                                                                                                      <tr>
                                                                                                         <td></td>
                                                                                                         <td></td>
                                                                                                         <td></td>
                                                                                                         <td></td>
                                                                                                         <td></td>
                                                                                                         <td></td>
                                                                                                         <td></td>
                                                                                                      </tr>
                                                                                                   </tbody>
                                                                                                </table>
                                                                                             </div>
                                                                                          </div>
                                                                                          <div class="fc-row fc-week fc-widget-content fc-rigid" style="height: 118px;">
                                                                                             <div class="fc-bg">
                                                                                                <table class="">
                                                                                                   <tbody>
                                                                                                      <tr>
                                                                                                         <td class="fc-day fc-widget-content fc-sun fc-past" data-date="2016-10-30"></td>
                                                                                                         <td class="fc-day fc-widget-content fc-mon fc-past" data-date="2016-10-31"></td>
                                                                                                         <td class="fc-day fc-widget-content fc-tue fc-other-month fc-past" data-date="2016-11-01"></td>
                                                                                                         <td class="fc-day fc-widget-content fc-wed fc-other-month fc-past" data-date="2016-11-02"></td>
                                                                                                         <td class="fc-day fc-widget-content fc-thu fc-other-month fc-past" data-date="2016-11-03"></td>
                                                                                                         <td class="fc-day fc-widget-content fc-fri fc-other-month fc-past" data-date="2016-11-04"></td>
                                                                                                         <td class="fc-day fc-widget-content fc-sat fc-other-month fc-past" data-date="2016-11-05"></td>
                                                                                                      </tr>
                                                                                                   </tbody>
                                                                                                </table>
                                                                                             </div>
                                                                                             <div class="fc-content-skeleton">
                                                                                                <table>
                                                                                                   <thead>
                                                                                                      <tr>
                                                                                                         <td class="fc-day-top fc-sun fc-past" data-date="2016-10-30"><span class="fc-day-number">30</span></td>
                                                                                                         <td class="fc-day-top fc-mon fc-past" data-date="2016-10-31"><span class="fc-day-number">31</span></td>
                                                                                                         <td class="fc-day-top fc-tue fc-other-month fc-past" data-date="2016-11-01"><span class="fc-day-number">1</span></td>
                                                                                                         <td class="fc-day-top fc-wed fc-other-month fc-past" data-date="2016-11-02"><span class="fc-day-number">2</span></td>
                                                                                                         <td class="fc-day-top fc-thu fc-other-month fc-past" data-date="2016-11-03"><span class="fc-day-number">3</span></td>
                                                                                                         <td class="fc-day-top fc-fri fc-other-month fc-past" data-date="2016-11-04"><span class="fc-day-number">4</span></td>
                                                                                                         <td class="fc-day-top fc-sat fc-other-month fc-past" data-date="2016-11-05"><span class="fc-day-number">5</span></td>
                                                                                                      </tr>
                                                                                                   </thead>
                                                                                                   <tbody>
                                                                                                      <tr>
                                                                                                         <td></td>
                                                                                                         <td></td>
                                                                                                         <td></td>
                                                                                                         <td></td>
                                                                                                         <td></td>
                                                                                                         <td></td>
                                                                                                         <td></td>
                                                                                                      </tr>
                                                                                                   </tbody>
                                                                                                </table>
                                                                                             </div>
                                                                                          </div>
                                                                                       </div>
                                                                                    </div>
                                                                                 </td>
                                                                              </tr>
                                                                           </tbody>
                                                                        </table>
                                                                     </div>
                                                                  </div>
                                                               </div>
                                                                <!--AddEvent Dialog -->
                                                                   <div class="modal fade" id="addNewEvent" aria-labelledby="addNewEvent" role="dialog" tabindex="-1" style="display: none;" aria-hidden="true">
                                                                      <div class="modal-dialog modal-simple">
                                                                         <form class="modal-content form-horizontal" action="#" method="post" role="form">
                                                                            <div class="modal-header">
                                                                               <button type="button" class="close" aria-hidden="true" data-dismiss="modal">×</button>
                                                                               <h4 class="modal-title">New Event</h4>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                               <div class="form-group row">
                                                                                  <label class="col-md-2 form-control-label" for="ename">Name:</label>
                                                                                  <div class="col-md-10">
                                                                                     <input type="text" class="form-control" id="ename" name="ename">
                                                                                  </div>
                                                                               </div>
                                                                               <div class="form-group row">
                                                                                  <label class="col-md-2 form-control-label" for="starts">Starts:</label>
                                                                                  <div class="col-md-10">
                                                                                     <div class="input-group">
                                                                                        <input type="text" class="form-control" id="starts" data-container="#addNewEvent" data-plugin="datepicker">
                                                                                        <span class="input-group-addon">
                                                                                        <i class="icon wb-calendar" aria-hidden="true"></i>
                                                                                        </span>
                                                                                     </div>
                                                                                  </div>
                                                                               </div>
                                                                               <div class="form-group row">
                                                                                  <label class="col-md-2 form-control-label" for="ends">Ends:</label>
                                                                                  <div class="col-md-10">
                                                                                     <div class="input-group">
                                                                                        <input type="text" class="form-control" id="ends" data-container="#addNewEvent" data-plugin="datepicker">
                                                                                        <span class="input-group-addon">
                                                                                        <i class="icon wb-calendar" aria-hidden="true"></i>
                                                                                        </span>
                                                                                     </div>
                                                                                  </div>
                                                                               </div>
                                                                               <div class="form-group row">
                                                                                  <label class="col-md-2 form-control-label" for="repeats">Repeats:</label>
                                                                                  <div class="col-md-10">
                                                                                     <div class="input-group bootstrap-touchspin"><span class="input-group-btn"><button class="btn btn-outline btn-default bootstrap-touchspin-down" type="button">-</button></span><span class="input-group-addon bootstrap-touchspin-prefix" style="display: none;"></span><input type="text" class="form-control" id="repeats" name="repeats" data-plugin="TouchSpin" data-min="0" data-max="10" value="0" style="display: block;"><span class="input-group-addon bootstrap-touchspin-postfix" style="display: none;"></span><span class="input-group-btn"><button class="btn btn-outline btn-default bootstrap-touchspin-up" type="button">+</button></span></div>
                                                                                  </div>
                                                                               </div>
                                                                               <div class="form-group row">
                                                                                  <label class="form-control-label col-md-2">Color:</label>
                                                                                  <div class="col-md-10">
                                                                                     <ul class="color-selector">
                                                                                        <li class="bg-blue-600">
                                                                                           <input type="radio" checked="" name="eventColorChosen" id="eventColorChosen2">
                                                                                           <label for="eventColorChosen2"></label>
                                                                                        </li>
                                                                                        <li class="bg-green-600">
                                                                                           <input type="radio" name="eventColorChosen" id="eventColorChosen3">
                                                                                           <label for="eventColorChosen3"></label>
                                                                                        </li>
                                                                                        <li class="bg-cyan-600">
                                                                                           <input type="radio" name="eventColorChosen" id="eventColorChosen4">
                                                                                           <label for="eventColorChosen4"></label>
                                                                                        </li>
                                                                                        <li class="bg-orange-600">
                                                                                           <input type="radio" name="eventColorChosen" id="eventColorChosen5">
                                                                                           <label for="eventColorChosen5"></label>
                                                                                        </li>
                                                                                        <li class="bg-red-600">
                                                                                           <input type="radio" name="eventColorChosen" id="eventColorChosen6">
                                                                                           <label for="eventColorChosen6"></label>
                                                                                        </li>
                                                                                        <li class="bg-blue-grey-600">
                                                                                           <input type="radio" name="eventColorChosen" id="eventColorChosen7">
                                                                                           <label for="eventColorChosen7"></label>
                                                                                        </li>
                                                                                        <li class="bg-purple-600">
                                                                                           <input type="radio" name="eventColorChosen" id="eventColorChosen8">
                                                                                           <label for="eventColorChosen8"></label>
                                                                                        </li>
                                                                                     </ul>
                                                                                  </div>
                                                                               </div>
                                                                               <div class="form-group row">
                                                                                  <label class="col-md-2 form-control-label" for="people">People:</label>
                                                                                  <div class="col-md-10">
                                                                                     <select id="eventPeople" multiple="multiple" class="plugin-selective" style="display: none;">
                                                                                        <option value="uid_1">Herman Beck</option>
                                                                                        <option value="uid_2">Caleb Richards</option>
                                                                                     </select>
                                                                                     <div class="addMember">
                                                                                        <ul class="addMember-items">
                                                                                           <li class="addMember-item"><img class="avatar" src="../../../global/portraits/1.jpg" title="Herman Beck"><span class="addMember-remove"><i class="wb-minus-circle"></i></span></li>
                                                                                           <li class="addMember-item"><img class="avatar" src="../../../global/portraits/2.jpg" title="Caleb Richards"><span class="addMember-remove"><i class="wb-minus-circle"></i></span></li>
                                                                                        </ul>
                                                                                        <div class="addMember-trigger">
                                                                                           <div class="addMember-trigger-button"><i class="wb-plus"></i></div>
                                                                                           <div class="addMember-trigger-dropdown">
                                                                                              <ul class="addMember-list">
                                                                                                 <li class="addMember-list-item addMember-selected"><img class="avatar" src="../../../global/portraits/1.jpg">Herman Beck</li>
                                                                                                 <li class="addMember-list-item addMember-selected"><img class="avatar" src="../../../global/portraits/2.jpg">Mary Adams</li>
                                                                                                 <li class="addMember-list-item"><img class="avatar" src="../../../global/portraits/3.jpg">Caleb Richards</li>
                                                                                                 <li class="addMember-list-item"><img class="avatar" src="../../../global/portraits/4.jpg">June Lane</li>
                                                                                              </ul>
                                                                                           </div>
                                                                                        </div>
                                                                                     </div>
                                                                                  </div>
                                                                               </div>
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                               <div class="form-actions">
                                                                                  <button class="btn btn-primary" data-dismiss="modal" type="button">Add this event</button>
                                                                                  <a class="btn btn-sm btn-white" data-dismiss="modal" href="javascript:void(0)">Cancel</a>
                                                                               </div>
                                                                            </div>
                                                                         </form>
                                                                      </div>
                                                                   </div>
                                                               <!-- End AddEvent Dialog -->
                                                               <!-- Edit Dialog -->
                                                                       <div class="modal fade" id="editNewEvent" aria-labelledby="editNewEvent" role="dialog" tabindex="-1" data-show="false" aria-hidden="true" style="display: none;">
                                                                          <div class="modal-dialog modal-simple">
                                                                             <form class="modal-content form-horizontal" action="#" method="post" role="form">
                                                                                <div class="modal-header">
                                                                                   <button type="button" class="close" aria-hidden="true" data-dismiss="modal">×</button>
                                                                                   <h4 class="modal-title">Edit Event</h4>
                                                                                </div>
                                                                                <div class="modal-body">
                                                                                   <div class="form-group row">
                                                                                      <label class="col-md-2 form-control-label" for="editEname">Name:</label>
                                                                                      <div class="col-md-10">
                                                                                         <input type="text" class="form-control" id="editEname" name="editEname">
                                                                                      </div>
                                                                                   </div>
                                                                                   <div class="form-group row">
                                                                                      <label class="col-md-2 form-control-label" for="editStarts">Starts:</label>
                                                                                      <div class="col-md-10">
                                                                                         <div class="input-group">
                                                                                            <input type="text" class="form-control" id="editStarts" name="editStarts" data-container="#editNewEvent" data-plugin="datepicker">
                                                                                            <span class="input-group-addon">
                                                                                            <i class="icon wb-calendar" aria-hidden="true"></i>
                                                                                            </span>
                                                                                         </div>
                                                                                      </div>
                                                                                   </div>
                                                                                   <div class="form-group row">
                                                                                      <label class="col-md-2 form-control-label" for="editEnds">Ends:</label>
                                                                                      <div class="col-md-10">
                                                                                         <div class="input-group">
                                                                                            <input type="text" class="form-control" id="editEnds" data-container="#editNewEvent" data-plugin="datepicker">
                                                                                            <span class="input-group-addon">
                                                                                            <i class="icon wb-calendar" aria-hidden="true"></i>
                                                                                            </span>
                                                                                         </div>
                                                                                      </div>
                                                                                   </div>
                                                                                   <div class="form-group row">
                                                                                      <label class="col-md-2 form-control-label" for="editRepeats">Repeats:</label>
                                                                                      <div class="col-md-10">
                                                                                         <div class="input-group bootstrap-touchspin"><span class="input-group-btn"><button class="btn btn-outline btn-default bootstrap-touchspin-down" type="button">-</button></span><span class="input-group-addon bootstrap-touchspin-prefix" style="display: none;"></span><input type="text" class="form-control" id="editRepeats" name="repeats" data-plugin="TouchSpin" data-min="0" data-max="10" value="0" style="display: block;"><span class="input-group-addon bootstrap-touchspin-postfix" style="display: none;"></span><span class="input-group-btn"><button class="btn btn-outline btn-default bootstrap-touchspin-up" type="button">+</button></span></div>
                                                                                      </div>
                                                                                   </div>
                                                                                   <div class="form-group row" id="editColor">
                                                                                      <label class="form-control-label col-md-2">Color:</label>
                                                                                      <div class="col-md-10">
                                                                                         <ul class="color-selector">
                                                                                            <li class="bg-blue-600">
                                                                                               <input type="radio" data-color="blue|600" name="colorChosen" id="editColorChosen2">
                                                                                               <label for="editColorChosen2"></label>
                                                                                            </li>
                                                                                            <li class="bg-green-600">
                                                                                               <input type="radio" data-color="green|600" name="colorChosen" id="editColorChosen3">
                                                                                               <label for="editColorChosen3"></label>
                                                                                            </li>
                                                                                            <li class="bg-cyan-600">
                                                                                               <input type="radio" data-color="cyan|600" name="colorChosen" id="editColorChosen4">
                                                                                               <label for="editColorChosen4"></label>
                                                                                            </li>
                                                                                            <li class="bg-orange-600">
                                                                                               <input type="radio" data-color="orange|600" name="colorChosen" id="editColorChosen5">
                                                                                               <label for="editColorChosen4"></label>
                                                                                            </li>
                                                                                            <li class="bg-red-600">
                                                                                               <input type="radio" data-color="red|600" name="colorChosen" id="editColorChosen6">
                                                                                               <label for="editColorChosen6"></label>
                                                                                            </li>
                                                                                            <li class="bg-blue-grey-600">
                                                                                               <input type="radio" data-color="blue-grey|600" name="colorChosen" id="editColorChosen7">
                                                                                               <label for="editColorChosen7"></label>
                                                                                            </li>
                                                                                            <li class="bg-purple-600">
                                                                                               <input type="radio" data-color="purple|600" name="colorChosen" id="editColorChosen8">
                                                                                               <label for="editColorChosen8"></label>
                                                                                            </li>
                                                                                         </ul>
                                                                                      </div>
                                                                                   </div>
                                                                                   <div class="form-group row">
                                                                                      <label class="col-md-2 form-control-label" for="editPeople">People:</label>
                                                                                      <div class="col-md-10">
                                                                                         <select id="editPeople" multiple="multiple" class="plugin-selective" style="display: none;">
                                                                                            <option value="uid_1">Herman Beck</option>
                                                                                            <option value="uid_2">Caleb Richards</option>
                                                                                         </select>
                                                                                         <div class="addMember">
                                                                                            <ul class="addMember-items">
                                                                                               <li class="addMember-item"><img class="avatar" src="../../../global/portraits/1.jpg" title="Herman Beck"><span class="addMember-remove"><i class="wb-minus-circle"></i></span></li>
                                                                                               <li class="addMember-item"><img class="avatar" src="../../../global/portraits/2.jpg" title="Caleb Richards"><span class="addMember-remove"><i class="wb-minus-circle"></i></span></li>
                                                                                            </ul>
                                                                                            <div class="addMember-trigger">
                                                                                               <div class="addMember-trigger-button"><i class="wb-plus"></i></div>
                                                                                               <div class="addMember-trigger-dropdown">
                                                                                                  <ul class="addMember-list">
                                                                                                     <li class="addMember-list-item addMember-selected"><img class="avatar" src="../../../global/portraits/1.jpg">Herman Beck</li>
                                                                                                     <li class="addMember-list-item addMember-selected"><img class="avatar" src="../../../global/portraits/2.jpg">Mary Adams</li>
                                                                                                     <li class="addMember-list-item"><img class="avatar" src="../../../global/portraits/3.jpg">Caleb Richards</li>
                                                                                                     <li class="addMember-list-item"><img class="avatar" src="../../../global/portraits/4.jpg">June Lane</li>
                                                                                                  </ul>
                                                                                               </div>
                                                                                            </div>
                                                                                         </div>
                                                                                      </div>
                                                                                   </div>
                                                                                </div>
                                                                                <div class="modal-footer">
                                                                                   <div class="form-actions">
                                                                                      <button class="btn btn-primary" data-dismiss="modal" type="button">Save</button>
                                                                                      <button class="btn btn-danger" data-dismiss="modal" type="button">Delete</button>
                                                                                      <a class="btn btn-sm btn-white" data-dismiss="modal" href="javascript:void(0)">Cancel</a>
                                                                                   </div>
                                                                                </div>
                                                                             </form>
                                                                          </div>
                                                                       </div>
                                                                   <!-- End EditEvent Dialog -->
                                                                   <!--AddCalendar Dialog -->
                                                                           <div class="modal fade" id="addNewCalendar" aria-labelledby="addNewCalendar" role="dialog" tabindex="-1" aria-hidden="true" style="display: none;">
                                                                              <div class="modal-dialog modal-simple">
                                                                                 <form class="modal-content form-horizontal" action="#" method="post" role="form">
                                                                                    <div class="modal-header">
                                                                                       <button type="button" class="close" aria-hidden="true" data-dismiss="modal">×</button>
                                                                                       <h4 class="modal-title">New Calendar</h4>
                                                                                    </div>
                                                                                    <div class="modal-body">
                                                                                       <div class="form-group row">
                                                                                          <label class="col-md-2 form-control-label" for="ename">Name:</label>
                                                                                          <div class="col-md-10">
                                                                                             <input type="text" class="form-control" id="ename" name="ename">
                                                                                          </div>
                                                                                       </div>
                                                                                       <div class="form-group row">
                                                                                          <label class="form-control-label col-md-2">Color:</label>
                                                                                          <div class="col-md-10">
                                                                                             <ul class="color-selector">
                                                                                                <li class="bg-blue-600">
                                                                                                   <input type="radio" checked="" name="colorChosen" id="colorChosen2">
                                                                                                   <label for="colorChosen2"></label>
                                                                                                </li>
                                                                                                <li class="bg-green-600">
                                                                                                   <input type="radio" name="colorChosen" id="colorChosen3">
                                                                                                   <label for="colorChosen3"></label>
                                                                                                </li>
                                                                                                <li class="bg-cyan-600">
                                                                                                   <input type="radio" name="colorChosen" id="colorChosen4">
                                                                                                   <label for="colorChosen4"></label>
                                                                                                </li>
                                                                                                <li class="bg-orange-600">
                                                                                                   <input type="radio" name="colorChosen" id="colorChosen5">
                                                                                                   <label for="colorChosen5"></label>
                                                                                                </li>
                                                                                                <li class="bg-red-600">
                                                                                                   <input type="radio" name="colorChosen" id="colorChosen6">
                                                                                                   <label for="colorChosen6"></label>
                                                                                                </li>
                                                                                                <li class="bg-blue-grey-600">
                                                                                                   <input type="radio" name="colorChosen" id="colorChosen7">
                                                                                                   <label for="colorChosen7"></label>
                                                                                                </li>
                                                                                                <li class="bg-purple-600">
                                                                                                   <input type="radio" name="colorChosen" id="colorChosen8">
                                                                                                   <label for="colorChosen8"></label>
                                                                                                </li>
                                                                                             </ul>
                                                                                          </div>
                                                                                       </div>
                                                                                       <div class="form-group row">
                                                                                          <label class="col-md-2 form-control-label" for="people">People:</label>
                                                                                          <div class="col-md-10">
                                                                                             <select id="people" multiple="multiple" class="plugin-selective" style="display: none;">
                                                                                                <option value="uid_1">Herman Beck</option>
                                                                                                <option value="uid_2">Caleb Richards</option>
                                                                                             </select>
                                                                                             <div class="addMember">
                                                                                                <ul class="addMember-items">
                                                                                                   <li class="addMember-item"><img class="avatar" src="../../../global/portraits/1.jpg" title="Herman Beck"><span class="addMember-remove"><i class="wb-minus-circle"></i></span></li>
                                                                                                   <li class="addMember-item"><img class="avatar" src="../../../global/portraits/2.jpg" title="Caleb Richards"><span class="addMember-remove"><i class="wb-minus-circle"></i></span></li>
                                                                                                </ul>
                                                                                                <div class="addMember-trigger">
                                                                                                   <div class="addMember-trigger-button"><i class="wb-plus"></i></div>
                                                                                                   <div class="addMember-trigger-dropdown">
                                                                                                      <ul class="addMember-list">
                                                                                                         <li class="addMember-list-item addMember-selected"><img class="avatar" src="../../../global/portraits/1.jpg">Herman Beck</li>
                                                                                                         <li class="addMember-list-item addMember-selected"><img class="avatar" src="../../../global/portraits/2.jpg">Mary Adams</li>
                                                                                                         <li class="addMember-list-item"><img class="avatar" src="../../../global/portraits/3.jpg">Caleb Richards</li>
                                                                                                         <li class="addMember-list-item"><img class="avatar" src="../../../global/portraits/4.jpg">June Lane</li>
                                                                                                      </ul>
                                                                                                   </div>
                                                                                                </div>
                                                                                             </div>
                                                                                          </div>
                                                                                       </div>
                                                                                    </div>
                                                                                    <div class="modal-footer">
                                                                                       <div class="form-actions">
                                                                                          <button class="btn btn-primary" data-dismiss="modal" type="button">Create</button>
                                                                                          <a class="btn btn-sm btn-white" data-dismiss="modal" href="javascript:void(0)">Cancel</a>
                                                                                       </div>
                                                                                    </div>
                                                                                 </form>
                                                                              </div>
                                                                           </div>
                                                                    <!-- End AddCalendar Dialog -->
                                                            </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="business-logo">
                                                        <ul class="timeline">
                                                            <li>

                                                                <a target="_blank" class="" href="#">Bussiness Meeting</a>
                                                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing sed eget faucibus leo. Sed bibendum luctus diam ut consect.</p>
                                                                <p>20 Minutes Ago</p>
                                                            </li>
                                                            <li>
                                                                <a href="#">Mohammed Birthday</a>
                                                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing ut consectetus. </p>
                                                                 <p>20 Minutes Ago</p>
                                                            </li>
                                                            <li>
                                                                <a href="#">Gym Session</a>
                                                                <p>Fusce ullamcorper ligula sit amet centectetur adipiscing sed eget faucibus leo.sed bibendum luctus diam ut consectetur. </p>
                                                                 <p>20 Minutes Ago</p>
                                                            </li>
                                                              <li>
                                                                <a href="#">Business Meeting</a>
                                                                <p>Fusce ullamcorper ligula sit amet ,centectetur adipiscing ut consectetur.</p>
                                                                <p>20 Minutes Ago</p>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> <!-- End common-card-div -->
                                    </div> <!-- End admin-penal-right-side-contain-common-main-div -->
                                </div> <!-- End col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 -->
                               
                            </div> <!-- End row -->

                        </div> <!-- End ecommerce-widget -->
                        
                        <div class="ecommerce-widget">

                            <div class="row">
                                
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    
                                    <div class="modal main-modal-div" id="myModal">
                                        <div class="modal-dialog custom-dialog-div">
                                            <div class="modal-content custom-modal-contain-div">
                                          
                                                 <!-- step verifivation section -->
                                                <div class="step-varification-section-main-div">
                                                    <ul>
                                                        <li class="round1 active">
                                                            <span class="border-line-div"></span>
                                                        </li>
                                                        <li class="round2">
                                                            <span class="border-line-div"></span>
                                                        </li>
                                                        <li class="round3">
                                                            <span class="border-line-div"></span>
                                                        </li>
                                                        <li class="round4">
                                                            <span class="border-line-div"></span>
                                                        </li>
                                                        <li class="round5">
                                                            <span class="border-line-div"></span>
                                                        </li>
                                                        <li class="round6">
                                                            <span class="border-line-div"></span>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <!-- signup screen section  -->

                                                <div class="signup-screen-section-main-div">
                                                    <div class="signup-section-sub-div" style="max-width: 1200px;">
                                                        <div class="signup-screen-contain-div" >
                                                            <div id="reg_step_all">

                                                                <div id="screen-one" class="common-secreen-div selected">
                                                                    <form id="step1" name="step1" class="reg_step" action="http://localhost/schedulix_final/public/step_one" method="post">
                                                                         <input type="hidden" name="_token" value="pZysftsFLeh2sV7folyBtjObqzO4Vwy0y12UN2Bz">                                                             <div class="signup-header-div">
                                                                            <h3 class="common-header-text">What best describes your business?</h3>
                                                                            </div>
                                                                        <div class="multiple-radio-btn-main-div">
                                                                            <span class="small-text-div">If you are a solo flyer</span>
                                                                                  <input type="radio" name="business_type" value="1">
                                                                                  <span class="checkmark"></span>
                                                                                </label>
                                                                                <span class="small-text-div">If you have multiple stores/ centres</span>
                                                                                  <input type="radio" name="business_type" value="2">
                                                                                  <span class="checkmark"></span>
                                                                                </label>
                                                                               
                                                                                                                                                        
                                                                        </div>
                                                                        <span id="business_type_error" style="display: none;color: #f00;    width: 100%;float: left;text-align: center;">Please select business type.</span>   
                                                                    </form>
                                                                </div> <!-- screen-one -->
                                                            </div>
                                                            <div class="signup-footer-div">
                                                                <div class="footer-btn-div">
                                                                    <div class="backbtn-div">
                                                                        <button type="button" style="display: none;" class="btn" id="back-btn"><i class="fas fa-chevron-left"></i> Back</button>
                                                                    </div>
                                                                    <div class="next-btn-div">
                                                                        <button type="button" class="btn" id="next-btn">Next <i class="fas fa-long-arrow-alt-right"></i></button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div> <!-- signup-screen-contain-div -->
                                                    </div> <!-- signup-section-sub-div -->
                                                </div> <!-- signup-screen-section-main-div -->
                                          
                                            </div> <!-- End modal-content -->
                                        </div> <!-- End modal-dialog -->
                                    </div> <!-- End Modal -->
                                </div>

                            </div>

                        </div>
                    </div>
                </div>
            </div>




@endsection
@push('scripts')
@if(@$regStep)

        <script type="text/javascript">
            $(document).ready(function(){
                var cntstep = "{{$regStep->step}}";
                $.ajax({
                    url: "{{action('HomeController@findstep') }}",
                    type: "post",
                    data: {"id":"{{$regStep->step}}"},
                    success: function(data){
                        
                        if(data.success){

                            $("#myModal").modal('show');
                            if(cntstep == 3){
                                $(".round2").addClass("active");    
                            }
                            if(cntstep == 4){
                                $(".round2").addClass("active");    
                                $(".round3").addClass("active");    
                            }
                            if(cntstep == 5){
                                $(".round2").addClass("active");    
                                $(".round3").addClass("active");    
                                $(".round4").addClass("active");    
                            }
                            $(".round"+cntstep).addClass("active");
                            if (cntstep > 1) {
                              //$("#back-btn").show();
                            }
                            if(cntstep == 6){
                              $("#next-btn").html("Save");
                            }
                            $("#reg_step_all").hide();
                            $("#reg_step_all").html(data.html);$("#reg_step_all").slideDown(1000);
                            //$(".common-secreen-div").slideDown(1000);
                        }
                        if(data.codee == 100){
                            return false;
                        }
                    }
                    
                });
            });

        </script>

@else
    <script type="text/javascript">
        $(document).ready(function(){
            $("#myModal").modal('show');
            
        });
    </script>
@endif
<script type="text/javascript" src="{{ asset('js/jquery.validate.js') }}"></script>
<script type="text/javascript">
    // Hit ajx and call the last saved step 
   
      var cnt = 1;
      if (cnt == 1) {
        $("#back-btn").hide();
      }
      $(document).on("click","#next-btn,.servicecat",function () {
        
        if($(".reg_step").valid()){

            var postdata = $(".reg_step").serialize();
            var url = $(".reg_step").attr("action");
            if($(".reg_step").attr("id")=='step1'){
                if ($('input[name="business_type"]:checked').length == 0) {
                    $("#business_type_error").show();
                     return false; 
                } 
                else {
                    $("#business_type_error").hide();
                     postData(postdata,url);
                     return false;
                }
            }
            if($(".reg_step").attr("id")=='step5'){
                
                if ($('#step5 input[type=checkbox]:checked').length == 0) {
                    
                    $("#step_5_error").show();
                     return false; 
                } 
                else {
                    
                    $("#step5 input[type=checkbox]").each(function(){
                        $("#step_5_error").hide();
                        var $this = $(this);
                        if($this.is(":checked")){
                            $("#"+$this.attr("id")+"-from").rules("add", {
                               required:true,
                            });
                            $("#"+$this.attr("id")+"-to").rules("add", {
                               required:true,
                            });
                        }else{
                            $("#"+$this.attr("id")+"-to").css("border","unset");
                        }
                    });
                    if($(".reg_step").valid()){
                     postData(postdata,url);
                     return false;
                    }
                    return false;
                }
            }
            postData(postdata,url);

        }else{
            return false;
        }
        
      });
      $("#back-btn").click(function () {
        if (cnt > 1) {
          $(".round"+cnt).removeClass("active");
          cnt = cnt - 1;
          if (cnt == 1) {
            //$("#back-btn").hide();
          }
          if(cnt < 6){
            $("#next-btn").html("Save");
          }

          var $next,
          $selected = $(".selected");
          $next = $selected.next('.common-secreen-div').length ? $selected.prev('.common-secreen-div') : $first;
          $selected.removeClass("selected").hide();
          $next.addClass('selected').slideDown(1000);
          
        }
      });
      $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });
    function postData(postdata,url){
        $.ajax({
            url: url,
            type: "post",
            data: postdata,
            success: function(data){
                
                
                if(data.success){
                    cnt = cnt + 1; 
                    $(".round"+cnt).addClass("active");
                    if (cnt > 1) {
                      //$("#back-btn").show();
                    }
                    if(cnt == 6){
                      $("#next-btn").hide();
                    }
                    $("#reg_step_all").hide();
                    $("#reg_step_all").html(data.html);$("#reg_step_all").slideDown(1000);;
                    //$(".common-secreen-div").slideDown(1000);
                }
                else if(data.codee == 100){
                    console.log("inside 100");
                    location.reload();
                }
            }
        });

        
    }

</script>

<script>
    $(document).ready(function(){
        $(document).on("click",".services-contain-div",function(){
            $("#screen-one").hide();
            $("#screen-two-search-box").show();
            $("#next-btn").click(function(){
                $("#screen-two-search-box").hide();
            });
        });
        $(document).on("click",".close-btn-main-div",function(){
            $("#screen-two-search-box").hide();
            $("#screen-one").show();
        });
        $(document).on("click",".search-input-field",function(){
            $("#screen-one").hide();
            $("#screen-two-search-box").show();
            $("#next-btn").click(function(){
                $("#screen-two-search-box").hide();
            });
        });
    });
</script>

<script>
  $(document).ready(function(){
      $(".multiple-radio-btn-main-div .radio-container").click(function(){
        $('.multiple-radio-btn-main-div .radio-container').removeClass('active');
        $(this).addClass('active');
      });
    });
</script>


<script>
    $(document).on("change",".common-checkbox-div",function(){

        if($(this).prop("checked") == true){
                $(this).next(".checkmark").css("border","unset");
            }
            else if($(this).prop("checked") == false){
                $(this).next(".checkmark").css("border","2px solid #ed145b");
            }
        
    });
    $('.common-checkbox-div:checked').each(function(index, elem) {
        $(this).next(".checkmark").css("border","unset");
      });
</script>



<script>
    $(document).ready(function(e){
       $(document).on("click",".add-service-btn-div",function(e){
        var cur_block = $(".countInputs").length+3;
        
        var htm = ' <div class="service-menu-new-add-div countInputs">\
        <div class="row">\
            <div class="col-md-7 padding-remove-div">\
                <input type="text" name="service['+cur_block+'][name]" id="service_name'+cur_block+'" class="form-control" >\
            </div>\
            <div class="col-md-2 padding-remove-div">\
                <input type="text" name="service['+cur_block+'][duration]" id="service_duration'+cur_block+'" class="form-control" >\
            </div>\
            <div class="col-md-2 padding-remove-div">\
                <input type="text" name="service['+cur_block+'][price]" id="service_price'+cur_block+'" class="form-control" >\
            </div>\
            <div class="col padding-remove-div">\
                <div class="close-btns">\
                    <i class="fas fa-times"></i>\
                </div>\
            </div>\
        </div>\
    </div>';

         $(".rows:last").append(htm);

        $("#service_name"+cur_block).rules("add", {
           required:true,
        });
        $("#service_duration"+cur_block).rules("add", {
           required:true,
        });
        $("#service_price"+cur_block).rules("add", {
           required:true,
        });

         return false;
       });
       $(document).on('click','.close-btns', function(){
          $(this).closest('.row').remove();
       })
    });
</script>

<!-- Append div Add service btn End --> 



<!-- Append div Add Staff btn -->


<script>
    $(document).ready(function(e){
       $(document).on('click',".add-staff-btn-div",function(e){
            var cur_blocks = $(".countstaff").length+4;
            var staffRow = '<div class="add-staff-rows countstaff">\
                            <div class="row">\
                                <div class="col padding-remove-div"> \
                                    <div class="light-dots-div">\
                                    </div>\
                                </div>\
                                <div class="col-md-3 padding-remove-div">\
                                    <input type="text" class="form-control" placeholder="" name="staff['+cur_blocks+'][name]" id="staff_name'+cur_blocks+'" >\
                                </div>\
                                <div class="col-md-3 padding-remove-div">\
                                    <input type="text" class="form-control" placeholder="" name="staff['+cur_blocks+'][email]" id="staff_email'+cur_blocks+'">\
                                </div>\
                                <div class="col-md-2 padding-remove-div">\
                                    <input type="text" class="form-control" placeholder="" name="staff['+cur_blocks+'][phone]" id="staff_phone'+cur_blocks+'">\
                                </div>\
                                <div class="col-md-2 padding-remove-div">\
                                    <div class="form-group add-staff-select-box">\
                                        <i class="fas fa-caret-down"></i>\
                                      <select class="form-control" name="staff['+cur_blocks+'][role]" id="staff_role'+cur_blocks+'">\
                                        <option value="">Select Role</option>\
                                        <option value="2">Staff</option>\
                                        <option value="1">Manager</option>\
                                      </select>\
                                    </div>\
                                </div>\
                                <div class="col padding-remove-div">\
                                    <div class="close-btns">\
                                        <i class="fas fa-times"></i>\
                                    </div>\
                                </div>\
                            </div>\
                        </div>';
         $(".add-staff-rows:last").append(staffRow);

            $("#staff_name"+cur_blocks).rules("add", {
               required:true,
            });
            $("#staff_email"+cur_blocks).rules("add", {
               required:true,
               email:true,
            });
            
            $("#staff_role"+cur_blocks).rules("add", {
               required:true,
            });
            return false;
       });
       $(document).on('click','.close-btns', function(){
          $(this).closest('.row').remove();
       })
    });
</script>
@endpush