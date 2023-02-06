

<div class="row gx-lg-5 ">

    <div class="col-lg-6 mb-4 mb-lg-0">
          <!-- card -->
      <div class=" bg-glass shadow-4-strong rounded-6">

          <!-- card header -->

              <div class="p-4 border-bottom">

                    <div class="row align-items-center">
                          <div class="col-6">
                            <p class="text-muted mb-2">Opened Tickets</p>
                            <p class="mb-0">
                              <span class="h4 me-2 opened"></span>
                              <small class="text-danger text-sm percentage">
                               
                              </small>
                            </p>
                          </div><!-- end of 1st col-6 -->
                          <div class="col-6 text-end">
                                <form action="" class="myForm" onSubmit="return false">
                                  <div class="form-outline m-2">
                                    <input type="date" id="startDate" name="startDate" class="form-control text-white" />
                                    <label class="form-label text-white" for="form12">Choose Date</label>
                                  </div>
                                  <div class="form-outline m-2">
                                    <input type="date" id="endDate" name="endDate" class="form-control text-white" />
                                    <label class="form-label text-white" for="form12">Choose Date</label>
                                  </div>
                               
    
                                   <div class=" m-2">
                            <button class="btn btn-success text-white text-lg"  id='resetChart'>Refresh Chart</button>
                          </div>
                                </form>

                          </div><!-- end of 2nd col-6 -->
                    </div><!-- end of row -->

              </div><!-- p-4 border-boottom -->

          <!-- end of card header -->

          <!-- card body -->
                <div class="p-4">
                    <canvas id="bar-chart" height="200px" class="text-white">

                    </canvas>
                </div><!-- end of p-4 -->
          <!-- end of card body -->

      </div><!-- end of bg-glass shadow-4-strong rounded-6 -->

    </div><!-- end of col-lg-6 mb-4 mb-lg-0 -->

    <!-- second column col-lg-6 begins here -->
    <div class="col-lg-6 mb-4 mb-lg-0">
      <!-- card -->
  <div class=" bg-glass shadow-4-strong rounded-6">

      <!-- card header -->

          <div class="p-4 border-bottom">

                <div class="row align-items-center">
                      <div class="col-6">
                        <p class="mb-0 m-0">
                                <p class="text-muted mb-2">Closed Tickets</p>
                                    <span class="h5 me-2 closed"></span>
                                     <small class="text-success text-sm percentage1">
             
                                     </small>
                            </p>
                        
                      </div><!-- end of 1st col-6 -->

                      <div class="col-6 ">

                      <form action="" class="myForm" onSubmit="return false">
                      

                          <div class="form-outline m-2">

                                    <input type="date" id="ActionClosed1" name="ActionClosed1" class="form-control text-white" />
                                    <label class="form-label text-white" for="form12">Choose Date</label>
                                  </div>

                                  <div class="form-outline m-2">
                                    <input type="date" id="ActionClosed2" name="ActionClosed2" class="form-control text-white" />
                                    <label class="form-label text-white" for="form12">Choose Date</label>
                                  </div>

                        </form>
                        <div class=" m-2">
                            <button class="btn btn-success text-white text-lg"  id='resetClosedChart'>Refresh Chart</button>
                          </div>
                          </div><!-- end of 2nd col-6 -->
                     
                </div><!-- end of row -->

          </div><!-- p-4 border-boottom -->

      <!-- end of card header -->

      <!-- card body -->
          

           
          
              <!-- searched ticket details goes here! -->
              <div class="container">
                <div id="searchedTickets" class="table-responsive striped"></div>
              <div class="chartDisplay p-2"><canvas id="closedChart" height="200px" class="text-white"></div>
              </div>
              
             
              <script src="js/searchTickets.js"></script>
              <!-- end of searched tickets -->
            </div><!-- end of p-4 -->
      <!-- end of card body -->

  </div><!-- end of bg-glass shadow-4-strong rounded-6 -->

</div><!-- end of col-lg-6 mb-4 mb-lg-0 -->

    <!-- end of second column col-lg-6 -->

</div><!-- end of row gx-lg-5 -->
