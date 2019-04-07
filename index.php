<?php
include 'includes/connect.php';
include 'includes/wallet.php';

	if($_SESSION['customer_sid']==session_id())
	{
		?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="msapplication-tap-highlight" content="no">
  <title>Order Food</title>

  <!-- Materialize Icons-->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  
  <!-- Favicons-->
  <link rel="icon" href="images/favicon/favicon-32x32.png" sizes="32x32">
  <!-- Favicons-->
  <link rel="apple-touch-icon-precomposed" href="images/favicon/apple-touch-icon-152x152.png">
  <!-- For iPhone -->
  <meta name="msapplication-TileColor" content="#00bcd4">
  <meta name="msapplication-TileImage" content="images/favicon/mstile-144x144.png">
  <!-- For Windows Phone -->


  <!-- CORE CSS-->
  <link href="css/materialize.min.css" type="text/css" rel="stylesheet" media="screen,projection">
  <link href="css/style.min.css" type="text/css" rel="stylesheet" media="screen,projection">
  <!-- Custome CSS-->    
  <link href="css/custom/custom.min.css" type="text/css" rel="stylesheet" media="screen,projection">
  <!-- INCLUDED PLUGIN CSS ON THIS PAGE -->
  <link href="js/plugins/perfect-scrollbar/perfect-scrollbar.css" type="text/css" rel="stylesheet" media="screen,projection">
  <link href="js/plugins/data-tables/css/jquery.dataTables.min.css" type="text/css" rel="stylesheet" media="screen,projection">
  
   <style type="text/css">
  .input-field div.error{
    position: relative;
    top: -1rem;
    left: 0rem;
    font-size: 0.8rem;
    color:#FF4081;
    -webkit-transform: translateY(0%);
    -ms-transform: translateY(0%);
    -o-transform: translateY(0%);
    transform: translateY(0%);
  }
  .input-field label.active{
      width:100%;
  }
  .left-alert input[type=text] + label:after, 
  .left-alert input[type=password] + label:after, 
  .left-alert input[type=email] + label:after, 
  .left-alert input[type=url] + label:after, 
  .left-alert input[type=time] + label:after,
  .left-alert input[type=date] + label:after, 
  .left-alert input[type=datetime-local] + label:after, 
  .left-alert input[type=tel] + label:after, 
  .left-alert input[type=number] + label:after, 
  .left-alert input[type=search] + label:after, 
  .left-alert textarea.materialize-textarea + label:after{
      left:0px;
  }
  .right-alert input[type=text] + label:after, 
  .right-alert input[type=password] + label:after, 
  .right-alert input[type=email] + label:after, 
  .right-alert input[type=url] + label:after, 
  .right-alert input[type=time] + label:after,
  .right-alert input[type=date] + label:after, 
  .right-alert input[type=datetime-local] + label:after, 
  .right-alert input[type=tel] + label:after, 
  .right-alert input[type=number] + label:after, 
  .right-alert input[type=search] + label:after, 
  .right-alert textarea.materialize-textarea + label:after{
      right:70px;
  }
  
  
  
  .center {
  margin: 0;
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
}
  
  </style> 
</head>

<body>
  <!-- Start Page Loading -->
  <div id="loader-wrapper">
      <div id="loader"></div>        
      <div class="loader-section section-left"></div>
      <div class="loader-section section-right"></div>
  </div>
  <!-- End Page Loading -->

  <!-- //////////////////////////////////////////////////////////////////////////// -->

  <!-- START HEADER -->
  <header id="header" class="page-topbar">
        <!-- start header nav-->
        <div class="navbar-fixed">
            <nav class="navbar-color">
                <div class="nav-wrapper">
                    <ul class="left">                      
                      <li><h1 class="logo-wrapper"><a href="index.php" class="brand-logo darken-1"><img src="images/materialize-logo.png" alt="logo"></a> <span class="logo-text">Logo</span></h1></li>
                    </ul>
                    <ul class="right">                        
						<li>
						<div >
						<!-- Modal Trigger -->
						<a class="waves-effect waves-light modal-trigger" href="#modal1"><i class="material-icons">shopping_cart</i></a>
						</div>
						</li>
                    </ul>					
                </div>
            </nav>
        </div>
		 <!-- Modal Structure -->
						<div id="modal1" class="modal modal-fixed-footer">
						<div class="modal-content">
						<h4>Your Items</h4>
						<ul class="collection">
						<p id="item_collection">Empty Cart<br></p>
						<!--<li class="collection-item avatar">
							<img src="images/avatar.jpg" alt="" class="circle">
							<span class="title">Name</span>
							<p>Prize <br>
							</p>
							<p style="float:right">Quantity</p>
							<a href="#!" class="secondary-content"><i class="material-icons">close</i></a>
						</li>-->
						</ul>			

						</div>
						<div class="modal-footer">
						<a id="total_cart_value" href="#!" class=" modal-action modal-close waves-effect waves-green btn">Ok</a>
						</div>
						</div>
        <!-- end header nav-->
  </header>
  <!-- END HEADER -->

  <!-- //////////////////////////////////////////////////////////////////////////// -->

  <!-- START MAIN -->
  <div id="main">
    <!-- START WRAPPER -->
    <div class="wrapper">

      <!-- START LEFT SIDEBAR NAV-->
      <aside id="left-sidebar-nav">
        <ul id="slide-out" class="side-nav fixed leftside-navigation">
            <li class="user-details cyan darken-2">
            <div class="row">
                <div class="col col s4 m4 l4">
                    <img src="images/avatar.jpg" alt="" class="circle responsive-img valign profile-image">
                </div>
				 <div class="col col s8 m8 l8">
                    <ul id="profile-dropdown" class="dropdown-content">
                        <li><a href="routers/logout.php"><i class="mdi-hardware-keyboard-tab"></i> Logout</a>
                        </li>
                    </ul>
                </div>
                <div class="col col s8 m8 l8">
                    <a class="btn-flat dropdown-button waves-effect waves-light white-text profile-btn" href="#" data-activates="profile-dropdown"><?php echo $name;?> <i class="mdi-navigation-arrow-drop-down right"></i></a>
                    <p class="user-roal"><?php echo $role;?></p>
                </div>
            </div>
            </li>
            <li class="bold active"><a href="index.php" class="waves-effect waves-cyan"><i class="mdi-editor-border-color"></i> Order Food</a>
            </li>
                <li class="no-padding">
                    <ul class="collapsible collapsible-accordion">
                        <li class="bold"><a class="collapsible-header waves-effect waves-cyan"><i class="mdi-editor-insert-invitation"></i> Orders</a>
                            <div class="collapsible-body">
                                <ul>
								<li><a href="orders.php">All Orders</a>
                                </li>
								<?php
									$sql = mysqli_query($con, "SELECT DISTINCT status FROM orders WHERE customer_id = $user_id;");
									while($row = mysqli_fetch_array($sql)){
                                    echo '<li><a href="orders.php?status='.$row['status'].'">'.$row['status'].'</a>
                                    </li>';
									}
									?>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </li>
                <li class="no-padding">
                    <ul class="collapsible collapsible-accordion">
                        <li class="bold"><a class="collapsible-header waves-effect waves-cyan"><i class="mdi-action-question-answer"></i> Tickets</a>
                            <div class="collapsible-body">
                                <ul>
								<li><a href="tickets.php">All Tickets</a>
                                </li>
								<?php
									$sql = mysqli_query($con, "SELECT DISTINCT status FROM tickets WHERE poster_id = $user_id AND not deleted;");
									while($row = mysqli_fetch_array($sql)){
                                    echo '<li><a href="tickets.php?status='.$row['status'].'">'.$row['status'].'</a>
                                    </li>';
									}
									?>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </li>					
            <li class="bold"><a href="details.php" class="waves-effect waves-cyan"><i class="mdi-social-person"></i> Edit Details</a>
            </li>				
        </ul>
        <a href="#" data-activates="slide-out" class="sidebar-collapse btn-floating btn-medium waves-effect waves-light hide-on-large-only cyan"><i class="mdi-navigation-menu"></i></a>
        </aside>
      <!-- END LEFT SIDEBAR NAV-->

      <!-- //////////////////////////////////////////////////////////////////////////// -->

      <!-- START CONTENT -->
      <section id="content">

        <!--breadcrumbs start-->
        <div id="breadcrumbs-wrapper">
          <div class="container">
            <div class="row">
              <div class="col s12 m12 l12">
                <h5 class="breadcrumbs-title">Order</h5>
              </div>
            </div>
          </div>
        </div>
        <!--breadcrumbs end-->


        <!--start container-->
        <div class="container">
          <p class="caption">Order your food here.</p>
          <div class="divider"></div>
		  <form class="formValidate" id="formValidate" method="post" action="place-order.php" novalidate="novalidate">
            <div class="row">
              <div style="float:left" class="col s12 m4 l3">
                <h4 class="header">Order Food</h4>
              </div>
			  <div style="float:right">
			  <div class="input-field col s12">
                              <button class="btn cyan waves-effect waves-light right" type="submit" name="action">Order
                                <i class="mdi-content-send right"></i>
                              </button>
                            </div>
            </div>
              <div>
                  <table id="data-table-customer" class="responsive-table display" cellspacing="0">
                    <thead style="display:none">
                      <tr>
                        <th>Name</th>
                        <th>Item Price/Piece</th>
                        <th>Quantity</th>
						
                      </tr>
                    </thead>

                    <tbody>
				<?php
				$result = mysqli_query($con, "SELECT * FROM items where not deleted;");
				while($row = mysqli_fetch_array($result))
				{
					echo '<tr class="col s4"><td>'.$row["category"].'<br><img id="'.$row['id'].'_image" height=200 width=200 class="responsive-img" src="images/food/'.$row["imagename"].'"></img><br><span id="'.$row['id'].'_name">'.$row["name"].'</span></td><td><span id="'.$row['id'].'_price">'.$row["price"].'</span></td>';                      
					echo '<td><div id="'.$row["id"].'_add" name="'.$row['id'].'_add" style="cursor: pointer" onClick="updateQuantity(this.id)"><i class="material-icons">add_box</i></div>';
					echo '<input id="'.$row["id"].'" name="'.$row['id'].'" type="hidden" value="0" data-error=".errorTxt'.$row["id"].'"><div class="errorTxt'.$row["id"].'"></td></tr>';
				}
				?>
                    </tbody>
				</table>
				
				
				
              </div>
			  <div class="input-field col s12">
              <i class="mdi-editor-mode-edit prefix"></i>
              <textarea id="description" name="description" class="materialize-textarea"></textarea>
              <label for="description" class="">Any note(optional)</label>
			  </div>
			  <div>
			  <div class="input-field col s12">
                              <button class="btn cyan waves-effect waves-light right" type="submit" name="action">Order
                                <i class="mdi-content-send right"></i>
                              </button>
                            </div>
            </div>
			</form>
            <div class="divider"></div>
            
          </div>
        </div>
        <!--end container-->

      </section>
      <!-- END CONTENT -->


  </div>
  <!-- END MAIN -->



  <!-- //////////////////////////////////////////////////////////////////////////// -->

  <!-- START FOOTER -->
  <footer class="page-footer">
    <div class="footer-copyright">
      <div class="container">
        <span>Copyright © 2017 <a class="grey-text text-lighten-4" href="#" target="_blank">Students</a> All rights reserved.</span>
        <span class="right"> Design and Developed by <a class="grey-text text-lighten-4" href="#">Students</a></span>
        </div>
    </div>
  </footer>
    <!-- END FOOTER -->



    <!-- ================================================
    Scripts
    ================================================ -->
    
    <!-- jQuery Library -->
    <script type="text/javascript" src="js/plugins/jquery-1.11.2.min.js"></script>    
    <!--angularjs-->
    <script type="text/javascript" src="js/plugins/angular.min.js"></script>
    <!--materialize js-->
    <script type="text/javascript" src="js/materialize.min.js"></script>
    <!--scrollbar-->
    <script type="text/javascript" src="js/plugins/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <!-- data-tables -->
    <script type="text/javascript" src="js/plugins/data-tables/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="js/plugins/data-tables/data-tables-script.js"></script>
	
    <script type="text/javascript" src="js/plugins/jquery-validation/jquery.validate.min.js"></script>
    <script type="text/javascript" src="js/plugins/jquery-validation/additional-methods.min.js"></script>
    
    <!--plugins.js - Some Specific JS codes for Plugin Settings-->
    <script type="text/javascript" src="js/plugins.min.js"></script>
    <!--custom-script.js - Add your own theme custom JS-->
    <script type="text/javascript" src="js/custom-script.js"></script>
    <script type="text/javascript">
	try{
	item_list=[];
}catch(err){console.log(err.message);}

function updateQuantity(id_str){
	  var id=id_str.split("_");
	  var quantity=document.getElementById(id[0]).value;
	  if(quantity==null||quantity==0||quantity=="")
		  quantity=1;
	  else
		  quantity++;
	  document.getElementById(id[0]).value=quantity;
	  alert(quantity)
	  updateCart(id[0]);
	  
  }
  
  function updateCart(id){
	  var image=document.getElementById(String(id)+"_image").src;
	  var name=document.getElementById(String(id)+"_name").innerHTML;
	  var price=document.getElementById(String(id)+"_price").innerHTML;
	  var quantity=document.getElementById(id).value;
	  var flag=0, i=0;
	  for(i=0;i<item_list.length;i++){
		  if(item_list[i][0]==id){
			  item_list[i][4]++;
			  item_list[i][5]=item_list[i][3]*item_list[i][4];
			  flag=1;
			  break;
		  }
	  }
	  if(flag==0){
		  item_list[i]=new Array(5);
		  item_list[i][0]=id;
		  item_list[i][1]=image;
		  item_list[i][2]=name;
		  item_list[i][3]=price;
		  item_list[i][4]=quantity;
		  item_list[i][5]=price*quantity;
	  }
	  
	  createCollectionList();
		  
  }
  
  function createCollectionList(){
	  var inner_value="";
	  var total_cart_value=0;
	  for(var i=0;i<item_list.length;i++){
		  total_cart_value+=item_list[i][5];
		  inner_value=inner_value+'<li class="collection-item avatar"><img src="'+item_list[i][1]+'" alt="" class="circle"><span class="title">'+item_list[i][2]+'</span><p>'+item_list[i][5]+'<span class="center">'+item_list[i][4]+'</span></p><a href="#!" class="secondary-content" onClick="removeItem('+item_list[i][0]+')"><i class="material-icons">close</i></a></li>';
	  }
	  document.getElementById("item_collection").innerHTML=inner_value;
	  document.getElementById("total_cart_value").innerHTML=total_cart_value+" Rupee";
  }
  
  function removeItem(id){
	  for(i=0;i<item_list.length;i++){
		  if(item_list[i][0]==id){
			  item_list.splice(i,1);
			  break;
		  }
	  }
	  document.getElementById(id).value=0;
	  createCollectionList();
  }
	
	
	
	
	
	
	
	
  $(document).ready(function(){
    // the "href" attribute of .modal-trigger must specify the modal ID that wants to be triggered
    $('.modal1').leanModal();
  });
 
  
    $("#formValidate").validate({
        rules: {
			<?php
			$result = mysqli_query($con, "SELECT * FROM items where not deleted;");
			while($row = mysqli_fetch_array($result))
			{
				echo $row["id"].':{
				min: 0,
				max: 10
				},
				';
			}
		echo '},';
		?>
        messages: {
			<?php
			$result = mysqli_query($con, "SELECT * FROM items where not deleted;");
			while($row = mysqli_fetch_array($result))
			{  
				echo $row["id"].':{
				min: "Minimum 0",
				max: "Maximum 10"
				},
				';
			}
		echo '},';
		?>
        errorElement : 'div',
        errorPlacement: function(error, element) {
          var placement = $(element).data('error');
          if (placement) {
            $(placement).append(error)
          } else {
            error.insertAfter(element);
          }
        }
     });
    </script>
</body>

</html>
<?php
	}
	else
	{
		if($_SESSION['admin_sid']==session_id())
		{
			header("location:admin-page.php");		
		}
		else{
			header("location:login.php");
		}
	}
?>