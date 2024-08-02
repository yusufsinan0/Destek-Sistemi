					<div class="row">
	                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
	                        <div class="card influencer-profile-data">
	                            <div class="card-body">
								<div class="row">
	                                    <div class="col-xl-2 col-lg-4 col-md-4 col-sm-4 col-12">
	                                        <div class="text-center">
												<img src="assets/images/black-logo.png" style="width:18px;" alt="User Avatar" class="rounded-circle user-avatar-xxl">
											</div>
	                                        </div>
	                                        <div class="col-xl-10 col-lg-8 col-md-8 col-sm-8 col-12">
	                                            <div class="user-avatar-info">
	                                                <div class="m-b-20">
	                                                    <div class="user-avatar-name">
	                                                        <h2 class="mb-1"><?= $userFirstname." ".$userLastname ?></h2>
	                                                    </div>
	                                                    <div class="rating-star  d-inline-block">
	                                                        <i class="fa fa-fw fa-star"></i>
	                                                        <i class="fa fa-fw fa-star"></i>
	                                                        <i class="fa fa-fw fa-star"></i>
	                                                        <i class="fa fa-fw fa-star"></i>
	                                                        <i class="fa fa-fw fa-star"></i>
	                                                        <p class="d-inline-block text-dark">  14 Geri Dönüş	 </p>
	                                                    </div>
	                                                </div>
	                                                <!--  <div class="float-right"><a href="#" class="user-avatar-email text-secondary">www.henrybarbara.com</a></div> -->
	                                                <div class="user-avatar-address">
	                                                    <p class="border-bottom pb-3">
	                                                        <span class="d-xl-inline-block d-block mb-2"><i class="fa fa-map-marker-alt mr-2 text-primary "></i> Email : <?=$userEmail?></span>
	                                                        <span class="mb-2 ml-xl-4 d-xl-inline-block d-block">Telefon : <?=$userPhone?>  </span>
	                                                        <span class=" mb-2 d-xl-inline-block d-block ml-xl-4">Cinsiyet 
															<?php 
															if($userGenderID =='1'){
																echo 'Erkek';
															} else {
																echo 'Kadın';
															}
															?>
	                                                                </span>
	                                                    </p>
	                                                   
	                                                </div>
	                                            </div>
	                                        </div>
	                                    </div>
	                                </div>
	                               
	                            </div>
	                        </div>
	                    </div>
	                    <!-- ============================================================== -->
	                    <!-- end influencer profile  -->
	                    <!-- ============================================================== -->
	                    <!-- ============================================================== -->
	                    <!-- widgets   -->
	                    <!-- ============================================================== -->
	                    <div class="row">
	                        <!-- ============================================================== -->
	                        <!-- four widgets   -->
	                        <!-- ============================================================== -->
	                        <!-- ============================================================== -->
	                        <!-- total views   -->
	                        <!-- ============================================================== -->
	                        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
	                            <div class="card">
	                                <div class="card-body">
	                                    <div class="d-inline-block">
	                                        <h5 class="text-muted">Toplam Destek Kaydı</h5>
	                                        <h2 class="mb-0">
											<?php 
												$requestCount = sendApiRequestToken('/request/count-request', 'GET', [], $token);

												if ($requestCount && $requestCount['status'] == 'success') {
													$requestData = $requestCount['message'];
													
													if (isset($requestData[0]['total'])) {
														$count = $requestData[0]['total'];
														echo  $count;
													} else {
														echo "Toplam istek sayısı bulunamadı.";
													}
												} else {
													echo "Veri alırken bir hata oluştu.";
												}
												?>

											</h2>
	                                    </div>
	                                    <div class="float-right icon-circle-medium  icon-box-lg  bg-info-light mt-1">
	                                        <i class="fa fa-eye fa-fw fa-sm text-info"></i>
	                                    </div>
	                                </div>
	                            </div>
	                        </div>
	                        <!-- ============================================================== -->
	                        <!-- end total views   -->
	                        <!-- ============================================================== -->
	                        <!-- ============================================================== -->
	                        <!-- total followers   -->
	                        <!-- ============================================================== -->
	                     
	                        <!-- ============================================================== -->
	                        <!-- end total followers   -->
	                        <!-- ============================================================== -->
	                        <!-- ============================================================== -->
	                        <!-- partnerships   -->
	                        <!-- ============================================================== -->
	                        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
	                            <div class="card">
	                                <div class="card-body">
	                                    <div class="d-inline-block">
	                                        <h5 class="text-muted">Verdiğin Destek Sayısı </h5>
	                                        <h2 class="mb-0">
											<?php 
									$requestCount = sendApiRequestToken('/request/closed-request', 'GET', [], $token);

									if ($requestCount && $requestCount['status'] == 'success') {
										$requestData = $requestCount['message'];
										
										if (isset($requestData['rowCount'])) {
											$count = $requestData['rowCount'];
											echo  htmlspecialchars($count) ;
										} else {
											echo "Toplam istek sayısı bulunamadı";
										}
									} else {
										echo "Veri alınamadı";
									}
									?>


											</h2>
	                                    </div>
	                                    <div class="float-right icon-circle-medium  icon-box-lg  bg-secondary-light mt-1">
	                                        <i class="fa fa-handshake fa-fw fa-sm text-secondary"></i>
	                                    </div>
	                                </div>
	                            </div>
	                        </div>
	                        <!-- ============================================================== -->
	                        <!-- end partnerships   -->
	                        <!-- ============================================================== -->
	                        <!-- ============================================================== -->
	                        <!-- total earned   -->
	                        <!-- ============================================================== -->
	                        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
	                            <div class="card">
	                                <h5 class="card-header">Cinsiyet Dağılımı</h5>
	                                <div class="card-body">
	                                    <div id="gender_donut" style="height: 230px;"></div>
	                                </div>
	                                <div class="card-footer p-0 bg-white d-flex">
	                                    <div class="card-footer-item card-footer-item-bordered w-50">
	                                        <h2 class="mb-0"> 60% </h2>
	                                        <p>Erkek </p>
	                                    </div>
	                                    <div class="card-footer-item card-footer-item-bordered">
	                                        <h2 class="mb-0">40% </h2>
	                                        <p>Kadın </p>
	                                    </div>
	                                </div>
	                            </div>
	                        </div>
	                          <!-- ============================================================== -->
	                        <!-- end total earned   -->
	                        <!-- ============================================================== -->
							</div>
	                    <!-- ============================================================== -->
	                    <!-- end widgets   -->
	                    <!-- ============================================================== -->
	                    
	                	</div>