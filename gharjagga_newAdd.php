<?php require_once("includes/initialize.php"); 
 Gharjaggaadd::resetAutoIncrement();
if(isset($_POST['submit']))
{
    $a=0;
    $land_array= array('old_vdc_mp_id','old_ward_id','new_vdc_mp_id','new_ward_id','nn','kn','area1','area2','area3','unit_id','minimum_amount','land_taken_date');
    $structure_array = array('structure_land_nn','land_kn','floor','length','breadth','b_area','constructed_year','structure_made_type','structure_use','structure_minimum_amount');
    $land_owner_details_array = array('name','address');
    $land_owner_details = new Landownerdetails();
    foreach($land_owner_details_array as $details):
     $land_owner_details->$details = $_POST[$details];    
    endforeach;
    $land_owner_details_clone = $land_owner_details;
    if($land_owner_details->save())
    {
        $a=1;
        for($i=0;$i<count($_POST['nn']);$i++)
        {
            $land_description = new Landdescription();
            $land_description->land_owner_id = $land_owner_details_clone->id;
            foreach ($land_array as $land)
            {
                $land_description->$land = $_POST[$land][$i];
            }
            if($land_description->save())
            {
                $a=1;
            }
            else
            {
                $a=0;
            }
            
        }
        if(isset($_POST['check_ghar']))
        {
             for($i=0;$i<count($_POST['land_kn']);$i++)
                {
                    $structure_description = new Structure();
                    $structure_description->land_owner_id = $land_owner_details_clone->id;
                    foreach ($structure_array as $structure)
                    {
                        $structure_description->$structure = $_POST[$structure][$i];
                    }
                        if($structure_description->save())
                        {
                           $a=1;
                        }
                        else
                        {
                           $a=0;
                        }

                }
        }
    }
    if($a==1)
    {
    echo alertBox("?????? ????????? ","gharjagga_newAdd.php");
    }
}
$floor_array     = array(1,1.5,2,2.5,3,3.5,4,4.5,5,5.5,6,6.5,7,7.5,8,8.5,9,9.5,10);
 $fiscals = FiscalYear::find_all();
 $unit_result=  Landunit::find_all();
 $current_land_type_result=  Currentlandtype::find_all();
 $land_type=  Landtype::find_all();
 $current_fiscal= Fiscalyear::find_current_id();
?>
<?php include("menuincludes/header.php"); ?>
<!-- js ends -->
<title>????????????????????? ?????????????????? ???????????? ????????????????????????</title>

<body>
    <?php include("menuincludes/topwrap.php"); ?>
    <div id="body_wrap_inner"> 
    	<div class="">
            <div class="">
                <div class="maincontent">
                    <h2 class="headinguserprofile">????????????????????? ?????????????????? ???????????? ???????????????????????? | <a href="dashboard_gharjagga.php" class="btn">????????? ????????????????????? </a> </h2>
                    <div class="OurContentFull">
                    	<h2>????????????????????? ?????????????????? ???????????? ????????????????????????</h2>
                        <div class="userprofiletable">
                            
                            <form method="post">
                          <table class="table borderless table-responsive myWidth100">
                          <tr>
                            	<td>?????????????????????????????? ?????????	</td>
                                <td><input class="form-control fill_height" type="text" name="name"></td>
                            </tr> 
                            <tr>
                            	<td>?????????????????????????????? ??????????????????</td>
                                <td><input class="form-control fill_height" type="text" name="address" ></td>
                            </tr> 
                         
                             </table>
                            <table class="table table-bordered  table-responsive table-hover myWidth100">
                            
                                <tr>
                                            <td colspan="2" class="mycenter">??????????????? </td>
                                            <td colspan="2" class="mycenter">????????? </td>
                                         
                                            <td rowspan="2" class="mycenter">???.???</td>
                                            <td rowspan="2" class="mycenter">??????.??????</td>
                                            <td  colspan="3" class="mycenter">???????????????????????????</td>
                                            <td rowspan="2" class="mycenter">??????????????????????????? ????????????</td>
                                            <td rowspan="2" class="mycenter">???????????? ?????? ???????????????</td>
                                            <td rowspan="2" class="mycenter">??????????????? ????????????????????? ???????????? ????????????</td>
                                            
                                        </tr>
                                        <tr>
                                            <td class="mycenter">??????.??????/???.?????? </td>
                                            <td class="mycenter">????????? ??????</td>
                                            <td class="mycenter">??????.??????/???.??????</td>
                                            <td class="mycenter">????????? ??????</td>
                                            <td>??????????????????</td>
                                            <td>???????????????</td>
                                            <td>?????????</td>
                                          
                                        </tr>
                                        <tr>
                                            <td>
                                                <input class="form-control" type="text" name="old_vdc_mp_id[]"> 
                                               
                                            </td>
                                            <td>
                                                <input class="form-control" type="text" name="old_ward_id[]"> 
                                            </td>
                                            
                                             <td>
                                               <input class="form-control" name="new_vdc_mp_id[]" type="text"> 
                                            </td>
                                            <td>
                                                <input class="form-control" type="text" name="new_ward_id[]"> 
                                                
                                            </td>
                                          
                                                                                 
                                            <td><input type="text" style="width: 100% !important;" name="nn[]" class="nn" required></td>
                                            <td><input type="text" style="width: 100% !important;" name="kn[]" class="kn" required></td>
                                            <td><input style="width: 100% !important;" type="text" name="area1[]" id="area1_1"   required></td>
                                            <td><input style="width: 100% !important;" type="text" name="area2[]" id="area2_1"   required></td>
                                            <td><input style="width: 100% !important;" type="text" name="area3[]" id="area3_1"   required></td>
                                           
                                          
                                            <td>
                                                <select name="unit_id[]" class="unit_id_1" style="width: 60px;" required>
                                                  
                                                    <option  value="1">??????????????????</option>
                                               
                                                </select> 
                                                
                                            </td>
                                           
                                            <td><input type="text" name="minimum_amount[]" id="accepted_amount_1" required ></td>
                                            <td><input class="fill_height" type="text" name="land_taken_date[]" id="nepaliDate1" required></td>
                                        </tr>
                                            
                                          
                           
                                <tbody id="add_more_kitta">
                                    
                                </tbody>
                    
                              </table>
                                <table class="table borderless table-responsive">
                                    <tr>
                            	     <td class="myCenter"><div class="add_ghar_jagga btn">????????????????????????</div> </td>
                                    <td class="myCenter"><div class="remove_ghar_jagga btn">?????????????????? ?????????</div> </td>
                                   </tr> 
                                </table>       
                         <table  class="table table-bordered table-hover table-responsive">
                                       <tr>
                                <td>??<b> ?????? ???????????? ???????????????????????? :<b> </td>
                              <td><input type="checkbox"  id="check_ghar" name="check_ghar" value="yes"></td>
                            </tr>
                         
                                <table id="check_ghar_div" style="display:none;" class="table table-bordered table-hover table_fixed">
                                      <?php
                                    
                                      ?>
                                           <tr>
                                               <td rowspan="2" class="mycenter">?????????????????? ??????????????? ??????.??????</td>
                                               <td rowspan="2" class="mycenter">?????????????????? ??????????????? ???.??????</td>
                                               <td colspan="5" class="mycenter">???????????????????????? </td>
                                               <td colspan="2" class="mycenter">??????????????? ???????????????????????? ???????????????</td>
                                              
                                               <td rowspan="2" class="mycenter">???????????????????????? ???????????????????????? ???????????????</td>
                                               
                                           </tr>
                                           <tr>
                                               <td class="mycenter">?????????</td>
                                               <td class="mycenter">??????????????????</td>
                                               <td class="mycenter">???????????????</td>
                                               <td class="mycenter">??????????????????????????? ?????????????????????</td>
                                               <td class="mycenter">??????????????? ?????????</td>
                                               <td class="mycenter">???????????????????????? ?????????????????? ???????????????</td>
                                               <td class="mycenter">???????????????????????? ???????????????????????? ???????????????</td>
                                           </tr>
                                           <tr>
                                              <td class="kn_ghar">
                                                 
                                              </td>
                                              <td id="kn_td_1">
                                                  <input type="text" name="structure_land_nn[]" id="nn_structure_1">
                                              </td>
                                              <td>
                                                  <select name="floor[]" id="floor_1" >
                                                      <option value="">??????????????????????????????</option>
                                                      <?php foreach ($floor_array as $floor) :?>
                                                      <option value="<?= $floor ?>"><?= $floor ?></option>
                                                      <?php endforeach;?>
                                                  </select>
                                              </td>        
                                              <td><input type="text" name="length[]" id="length_1" required></td>
                                              <td><input type="text" name="breadth[]" id="breadth_1" required></td>
                                              <td><input type="text" name="b_area[]" id="b_area_1" required></td>
                                              <td>
                                                  <input type="text" name="constructed_year[]"> 
                                              </td>
                                               <td>
                                                   <select name="structure_made_type[]">
                                                       <option value="">??????????????????????????????</option>
                                                       <option value="???????????????">???????????????</option>
                                                       <option value="???????????????">???????????????</option>
                                                   </select>
                                               
                                               </td>
                                               <td>
                                                   <select name="structure_use[]" id="structure_use_1" required>
                                                       <option value=""></option>
                                                       <option value="????????????">????????????</option>
                                                       <option value="????????????">????????????</option>
                                                       <option value="????????????">????????????</option>
                                                   </select>
                                                   
                                               </td>
                                             
                                               
                                               <td><input type="text" name="structure_minimum_amount[]" id="structure_land_kn_minimum_amount_1" ></td>
                                           </tr>
                                           <tbody id="show_ghar_details">
                                               
                                           </tbody>
                                             <tr>
                                                <td class="myCenter"><div class="add_jagga btn">????????????????????????</div> </td>
                                               <td class="myCenter"><div class="remove_ghar btn">?????????????????? ?????????</div> </td>
                                               <td colspan="9" class="myCenter"><input type="submit" name="submit" value="????????? ????????????????????????" class="btn"></a></td>
                                            </tr> 
                                     </table>
                             
                                     
                        
                          
                            </form>
                                          
                        </div>
                  </div>
                </div><!-- main menu ends -->
            </div>
         </div>   
    </div><!-- top wrap ends -->
    <?php include("menuincludes/footer.php"); ?>

