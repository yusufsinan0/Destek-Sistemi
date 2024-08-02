<?php 
$userFirstname = $userData['User_Firstname'];
$userLastname = $userData['User_Lastname'];
$userEmail = $userData['User_Email'];
$userPhone = $userData['User_Phone'];

?>

					<div class="row">
	                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
	                        <div class="card influencer-profile-data">
	                            <div class="card-body">
									<div class="row">
	                                    <div class="col-xl-2 col-lg-4 col-md-4 col-sm-4 col-12">
	                                        <div class="text-center">
	                                            <img src="assets/images/black-logo.png" style="width:175px;" alt="User Avatar" class="rounded-circle user-avatar-xxl">
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
	                                                        <span class=" mb-2 d-xl-inline-block d-block ml-xl-4">Cinsiyet : 
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