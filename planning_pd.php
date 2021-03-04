<?php 
	session_start();
   include("../class/conn.php");
   include("planning_pd_qry.php");
	header('Content-Type: text/html; charset=windows-874');	
	header('Cache-Control: no-cache');
   header('Pragma: no-cache');
   header('Expires: 0');
   $DLexport = 0;
	if($_REQUEST['action']=='export'){
		header("Content-Type: application/vnd.ms-excel");
		header('Content-Disposition: attachment; filename="ข้อมูลรถเข้า-ออกประจำวัน.xls"');#ชื่อไฟล์
   }

   function DateThai($strDate)
   {
   $strYear = date("Y",strtotime($strDate))+543;
   $strMonth= date("n",strtotime($strDate));
   $strDay= date("d",strtotime($strDate));
   $strMonthCut = Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
   $strMonthThai=$strMonthCut[$strMonth];
   return "$strDay $strMonthThai $strYear";
   }
   
   
?>
  
  
   <body <? if($_REQUEST['action']!='export'){ ?> <? }?>>
   <link href="https://fonts.googleapis.com/css?family=Sarabun&display=swap" rel="stylesheet">
   
   
      <table width="1300"  align="center"  cellspacing="2" cellpadding="0" id="testTable" class="display" >
      <style>
      .tbB{ font-family: 'Sarabun', sans-serif, Times, serif; font-size:11px; border-bottom: 1px solid #333; background-color:#E2F5E2}
      .txtH10px{ font:10px  Sarabun, sans-serif; 	font-weight:bold; }
      .LD10px{ font:8px  Sarabun, sans-serif;  padding-left:5px; }
      .RD10px{ font:8px  Sarabun, sans-serif;  padding-right:5px; }
      .txtD10px{ font:8px  Sarabun, sans-serif; padding-right:5px; }
      .CH10px{ font:8px  Sarabun, sans-serif; }
      .txt9px{font:8px  Sarabun, sans-serif;  padding-left:5px; }
      .txtD14px{ font:10px Sarabun, sans-serif;}
      .txtH15px{ font:11px  Sarabun, sans-serif;  padding-left:3px; padding-right:3px;}
      .LRT{ border-left: 1px solid #333; border-top: 1px solid #333; border-right:1px solid #333;font:10px  Sarabun, sans-serif;   }
      .LTB{ border-left: 1px solid #333; border-top: 1px solid #333;  font:10px  Sarabun, sans-serif; font-weight:bold; padding-left:3px; padding-right:3px;   }
      .LT{ 	border-left: 1px solid #333; border-top: 1px solid #333; font:10px  Sarabun, sans-serif; }
      .LB{ 	border-left: 1px solid #333; border-bottom: 1px solid #333; }
      .LBR{ border-left: 1px solid #333; border-bottom: 1px solid #333;  border-right:1px solid #333;}
      .L{ border-left: 1px solid #333; }
      .T{ border-top: 1px solid #333; }
      @media print{
         .noprint{
            display:none;
         }
      }

      body {
         -webkit-print-color-adjust: exact;
         font-family: 'Sarabun', sans-serif, Times, serif; font-size:11px;
         margin-left: 5px;
         margin-top: 5px;
         margin-right: 0px;
         margin-bottom: 0px;
      }
      body,td,th {
         font-family: 'Sarabun', sans-serif;
         font-size: 11px;
      }

      
   </style>
         <tr>
            <td height="10" colspan="5" align="center" >
                  <table  width="1300" border="0" cellspacing="0" cellpadding="0">
                  <tr> <td >&nbsp;</td></tr>
                     <tr>
                     <td align="center"  colspan="23" style="font-size:16px;"><strong>รายนงานการผลิตประจำวันที่ <? echo DateThai($_REQUEST['st_Date']);  ?></strong></td>
                     </tr>
                     <tr> <td >&nbsp;</td></tr>
                  </table>          
               </td>
         </tr>
         <tr>
            <td colspan="5" align="center" valign="top" height="10">
               <table width="100%"   align="center"  cellspacing="0" cellpadding="0" id="tablelist">
                     <tr style="height: 24px;">
                        <td class="LT" colspan="23" style="border-right:1px solid #333;"><strong>&nbsp;&nbsp;&nbsp;&nbsp;รายงานการลงสินค้า</strong></td>
                     </tr>
                     <tr  bgcolor="#bfffbf" style="height: 24px;">
                        <td class="LT" align="center" colspan="13"><strong>แผนงานลงสินค้า</strong></td>
                        <td class="LT" align="center" colspan="6"  bgcolor="#f5c8fb"><strong>การปฏิบัติงานจริง</strong></td>
                        <td class="LT" align="center" colspan="3" bgcolor="#ffd8b0"><strong>สรุปผลต่างการลงสินค้า</strong></td>
                        <td class="LRT" align="center" rowspan="3" bgcolor="#ffd8b0"><strong>สรุปการลงสินค้า</strong></td>
                     </tr>
                     <tr bgcolor="#bfffbf" style="height: 24px;">
                        <td width="2%" class="LT" align="center" rowspan="2"><strong>ลำดับ</strong></td>
                        <td width="7%" class="LT" align="center" rowspan="2"><strong>ทะเบียนรถ (เข้า)</strong></td>
                        <td width="4%" class="LT" align="center" rowspan="2"><strong>ลักษณะรถ</strong></td>
                        <td width="10%" class="LT" align="center" rowspan="2"><strong>รายการสินค้า</strong></td>
                        <td width="10%" class="LT" align="center" rowspan="2"><strong>โรงสี</strong></td>
                        <td width="4%" class="LT" align="center" rowspan="2"><strong>รหัสสินค้า</strong></td>
                        <td width="8%" class="LT" align="center" colspan="3"><strong>ปริมาณ</strong></td>
                        <td width="4%" class="LT" align="center" rowspan="2"><strong>ลงตำแหน่ง</strong></td>
                        <td width="2%" class="LT" align="center" rowspan="2"><strong>คน</strong></td>
                        <td width="3%" class="LT" align="center" rowspan="2"><strong>ช่วงเวลา</strong></td>
                        <td width="5%" class="LT" align="center"><strong>เวลาที่ควรใช้</strong></td>
                        <td width="4%" class="LT" align="center" bgcolor="#f5c8fb"><strong>ช่วงเวลาที่</strong></td>
                        <td width="5%" class="LT" align="center" bgcolor="#f5c8fb"><strong>เวลาที่ใช้จริง</strong></td>
                        <td width="3%" class="LT" align="center" bgcolor="#f5c8fb"><strong>คนที่ใช้</strong></td>
                        <td width="8%" class="LT" align="center" bgcolor="#f5c8fb" colspan="3"><strong>ปริมาณรับจริง</strong></td>
                        <td width="3%" class="LT" align="center" bgcolor="#ffd8b0" rowspan="2"><strong>เวลา</strong></td>
                        <td width="3%" class="LT" align="center" bgcolor="#ffd8b0" rowspan="2"><strong>คน</strong></td>
                        <td width="3%" class="LT" align="center" bgcolor="#ffd8b0" rowspan="2" style="padding-bottom"><strong>ปริมาณ</strong></td>
                     </tr>
                     <tr bgcolor="#bfffbf" style="height: 24px;">
                        <td class="LT" align="center"><strong>น้ำหนัก</strong></td>
                        <td class="LT" align="center"><strong>จำนวน</strong></td>
                        <td class="LT" align="center"><strong>หน่วย</strong></td>
                        <td class="LT" align="center"><strong>(นาที)</strong></td>
                        <td class="LT" align="center" bgcolor="#f5c8fb"><strong>ใช้จริง</strong></td>
                        <td class="LT" align="center" bgcolor="#f5c8fb"><strong>นาที</strong></td>
                        <td class="LT" align="center" bgcolor="#f5c8fb"><strong>คน</strong></td>
                        <td class="LT" align="center" bgcolor="#f5c8fb"><strong>น้ำหนัก</strong></td>
                        <td class="LT" align="center" bgcolor="#f5c8fb"><strong>จำนวน</strong></td>
                        <td class="LT" align="center" bgcolor="#f5c8fb"><strong>หน่วย</strong></td>
                     </tr>
                     <tbody>
                        <?
                           $cnt_int=0;		 
                           for($i=0;$i<count($ld_pnn_In);$i++)
                           {
                              if($ld_pnn_In[$i]['lp_t_son'] !="")
                              {
                                    $t_in["'".$t[$ld_pnn_In[$i]['lp_t_id']]."<br>".$ld_pnn_In[$i]['lp_t_son']."'"]=$s_name[$ld_pnn_In[$i]['lp_t_id']];
                              }
                              else
                              {
                                 $t_in["'".$t[$ld_pnn_In[$i]['lp_t_id']]."'"]=$s_name[$ld_pnn_In[$i]['lp_t_id']];
                              }
                              
                              if($lp_id_same != $ld_pnn_In[$i]['lp_id'])
                              {
                                 if($rowspans_chk[$ld_pnn_In[$i]['lp_id']]=="2")
                                 {
                                    $d=$rowspans_num[$ld_pnn_In[$i]['lp_id']];
                                 }
                              }
                        ?>
                  
                        <tr height="25" style="cursor: move;" class="tr_loop_in">
                        <?
                              $pd=array();
                              $unit_mom_In=array();
                              $unit_son_In=array();
                              $weight_mom_in=array();
                              $weight_son_in=array();
                              $qty_mom_in=array();
                              $qty_son_in=array();
                              $remark=array();
                              $pd_id=array();
                                 for($k=0;$k<count($lpd[$ld_pnn_In[$i]['lpp_id']]);$k++){
                                    if($ld_pnn_In[$i]['lpp_st_blank'] !=0 && $ld_pnn_In[$i]['lpp_st_sr'] !=1){ $pd[]=$lpd[$ld_pnn_In[$i]['lpp_id']][$k]['pd_name'];}
                                    if($ld_pnn_In[$i]['lpp_st_blank'] !=0 && $ld_pnn_In[$i]['lpp_st_sr'] !=0){ $pd[]=$lpd[$ld_pnn_In[$i]['lpp_id']][$k]['pd_name'];}
                                    if($ld_pnn_In[$i]['lpp_st_blank'] ==0 && $ld_pnn_In[$i]['lpp_st_sr'] ==0){ $pd[]=$lpd[$ld_pnn_In[$i]['lpp_id']][$k]['pd_name'];}
                                    if($lpd[$ld_pnn_In[$i]['lpp_id']][$k]['lppd_weight_mom_start'] !=0 && $lpd[$ld_pnn_In[$i]['lpp_id']][$k]['lppd_weight_son_start'] !=0)
                                    {
                                       $weight_mom_in[]=$lpd[$ld_pnn_In[$i]['lpp_id']][$k]['lppd_weight_mom_start'];
                                       $weight_son_in[]=$lpd[$ld_pnn_In[$i]['lpp_id']][$k]['lppd_weight_son_start'];
                                    }else if($lpd[$ld_pnn_In[$i]['lpp_id']][$k]['lppd_weight_mom_start'] !=0){ 
                                       $weight_mom_in[]=$lpd[$ld_pnn_In[$i]['lpp_id']][$k]['lppd_weight_mom_start'];
                                    }else if($lpd[$ld_pnn_In[$i]['lpp_id']][$k]['lppd_weight_son_start'] !=0){
                                       $weight_son_in[]=$lpd[$ld_pnn_In[$i]['lpp_id']][$k]['lppd_weight_son_start'];                                                  
                                    }
                                    if($lpd[$ld_pnn_In[$i]['lpp_id']][$k]['lppd_qty_mom_start'] !=0 && $lpd[$ld_pnn_In[$i]['lpp_id']][$k]['lppd_qty_son_start'] !=0){
                                       $qty_mom_in[]=$lpd[$ld_pnn_In[$i]['lpp_id']][$k]['lppd_qty_mom_start'];
                                       $qty_son_in[]=$lpd[$ld_pnn_In[$i]['lpp_id']][$k]['lppd_qty_son_start'];
                                    }else if($lpd[$ld_pnn_In[$i]['lpp_id']][$k]['lppd_qty_mom_start'] !=0){
                                       $qty_mom_in[]=$lpd[$ld_pnn_In[$i]['lpp_id']][$k]['lppd_qty_mom_start'];
                                    }else if($lpd[$ld_pnn_In[$i]['lpp_id']][$k]['lppd_qty_son_start'] !=0){ 
                                       $qty_son_in[]=$lpd[$ld_pnn_In[$i]['lpp_id']][$k]['lppd_qty_son_start'];
                                    }
                                       $pd_id[]=$lpd[$ld_pnn_In[$i]['lpp_id']][$k]['pd_id'];
                                       $remark[]=$lpd[$ld_pnn_In[$i]['lpp_id']][$k]['lppd_remark'];
                                       $unit_mom_In[]=$lpd[$ld_pnn_In[$i]['lpp_id']][$k]['lppd_unit_m_s'];
                                       $unit_son_In[]=$lpd[$ld_pnn_In[$i]['lpp_id']][$k]['lppd_unit_s_s'];
                                    } 
                           ?>
                           <td class="LT" id="scles_row_num_in" align="center"> 
                              <?=$i+1?>
                           </td>
                           <? if($lp_id_same != $ld_pnn_In[$i]['lp_id']){?> 
                              <td class="LT" <? if($rowspans_chk[$ld_pnn_In[$i]['lp_id']]=="2"){echo "rowspan='".$d."'"; }?> align="center">
                              <?=$t[$ld_pnn_In[$i]['lp_t_id']]?><? if($ld_pnn_In[$i]['lp_t_son'] !=""){echo " , ".substr($ld_pnn_In[$i]['lp_t_son'],-4); }?>
                              </td>
                           <? }?>
                           <? if($lp_id_same != $ld_pnn_In[$i]['lp_id']){?>
                              <td class="LT" <? if($rowspans_chk[$ld_pnn_In[$i]['lp_id']]=="2"){echo "rowspan='".$d."'"; }?> align="center">
  
                              </td>
                           <? }?>
                           
                              <td class="LT" align="center"><? if(count($pd)>0){ for($k=0;$k<count($pd);$k++){echo $pd[$k];echo"<br>"; } }else{echo "ตีรถเปล่ากลับ";}?></td>
                              <td class="LT" align="center"><? $c_send_in=$ld_pnn_In[$i]['lpp_cs_code_send'];$c_receive_in=$ld_pnn_In[$i]['lpp_cs_code_receive']; if($csp[$ld_pnn_In[$i]['lpp_place_id_receive']][$ld_pnn_In[$i]['lpp_tb_po']] !=""){echo "".$csp[$ld_pnn_In[$i]['lpp_place_id_receive']][$ld_pnn_In[$i]['lpp_tb_po']]."";}?>
                              </td>
                              <td class="LT" align="center">
                                 <!-- <? for($k=0;$k<count($pd_id);$k++){echo $pd_id[$k];echo"<br>";} ?> -->
                              </td>
                              <td class="LT" align="center">
                                 <? for($k=0;$k<count($weight_mom_in);$k++){ if($weight_mom_in[$k] !=0){ echo number_format($weight_mom_in[$k],0);} echo"<br>";} ?>
                                 <? for($k=0;$k<count($weight_son_in);$k++){ if($weight_son_in[$k] !=0){ echo number_format($weight_son_in[$k],0);}echo"<br>";} ?>
                              </td>
                              <td class="LT" align="center">
                                 <? for($k=0;$k<count($qty_mom_in);$k++){echo $qty_mom_in[$k];echo"<br>";} ?>
                                <? for($k=0;$k<count($qty_son_in);$k++){echo $qty_son_in[$k];echo"<br>";} ?>
                              </td>
                              <td class="LT" align="center">
                                 <? 
                                    for($k=0;$k<count($unit_mom_In);$k++){ 
                                       if($unit_mom_In[$k] =="81"){ echo "กก.";echo"<br>";}
                                          else if($unit_mom_In[$k] =="86"){ echo "กระสอบ";echo"<br>";} 
                                          else if($unit_mom_In[$k] =="40"){ echo "ขวด";echo"<br>";} 
                                          else if($unit_mom_In[$k] =="46"){ echo "คัน";echo"<br>";} 
                                          else if($unit_mom_In[$k] =="88"){ echo"จัมโบ้";echo"<br>";} 
                                          else if($unit_mom_In[$k] =="6"){ echo "ตัน";echo"<br>";}
                                          else if($unit_mom_In[$k] =="32"){ echo "ถัง";echo"<br>";} 
                                          else if($unit_mom_In[$k] =="16"){ echo "ถุง";echo"<br>";} 
                                          else if($unit_mom_In[$k] =="87"){ echo "เบ้าท์";echo"<br>";} 
                                          else if($unit_mom_In[$k] =="2"){ echo "ใบ";echo"<br>";}
                                    } 
                                 ?>
                                 <? 
                                    for($k=0;$k<count($unit_son_In);$k++){ 
                                       if($unit_son_In[$k] =="81"){ echo "กก.";echo"<br>";}
                                          else if($unit_son_In[$k] =="86"){ echo "กระสอบ";echo"<br>";} 
                                          else if($unit_son_In[$k] =="40"){ echo "ขวด";echo"<br>";} 
                                          else if($unit_son_In[$k] =="46"){ echo "คัน";echo"<br>";} 
                                          else if($unit_son_In[$k] =="88"){ echo"จัมโบ้";echo"<br>";} 
                                          else if($unit_son_In[$k] =="6"){ echo "ตัน";echo"<br>";}
                                          else if($unit_son_In[$k] =="32"){ echo "ถัง";echo"<br>";} 
                                          else if($unit_son_In[$k] =="16"){ echo "ถุง";echo"<br>";} 
                                          else if($unit_son_In[$k] =="87"){ echo "เบ้าท์";echo"<br>";} 
                                          else if($unit_son_In[$k] =="2"){ echo "ใบ";echo"<br>";}
                                    } 
                                 ?>
                              </td>
                              <td class="LT" align="center">&nbsp;</td>
                              <td class="LT" align="center">&nbsp;</td>
                              <td class="LT" align="center">&nbsp;</td>
                              <td class="LT" align="center">&nbsp;</td>
                              <td class="LT" align="center">&nbsp;</td>
                              <td class="LT" align="center">&nbsp;</td>
                              <td class="LT" align="center">&nbsp;</td>
                              <td class="LT" align="center">&nbsp;</td>
                              <td class="LT" align="center">&nbsp;</td>
                              <td class="LT" align="center">&nbsp;</td>
                              <td class="LT" align="center">&nbsp;</td>
                              <td class="LT" align="center">&nbsp;</td>
                              <td class="LT" align="center">&nbsp;</td>
                              <td class="LRT">
                                
                              </td>
                        </tr>

                        <? $cnt_int++;
                           $lp_id_same=$ld_pnn_In[$i]['lp_id'];
                        }
                        if($cnt_int <1){
                           for($i=$cnt_int;$i<1;$i++){
                        ?>
                        <tr height="20">
                           <td height="25" align="center" class="LT">&nbsp;</td>
                           <td class="LT" align="center">&nbsp;</td>
                           <td class="LT" align="center">&nbsp;</td>
                           <td class="LT" align="center">&nbsp;</td>
                           <td class="LT" align="center">&nbsp;</td>
                           <td class="LT" align="center">&nbsp;</td>
                           <td class="LT" align="center">&nbsp;</td>
                           <td class="LT" align="center">&nbsp;</td>
                           <td class="LT" align="center">&nbsp;</td>
                           <td class="LT" align="center">&nbsp;</td>
                           <td class="LT" align="center">&nbsp;</td>
                           <td class="LT" align="center">&nbsp;</td>
                           <td class="LT" align="center">&nbsp;</td>
                           <td class="LT" align="center">&nbsp;</td>
                           <td class="LT" align="center">&nbsp;</td>
                           <td class="LT" align="center">&nbsp;</td>
                           <td class="LT" align="center">&nbsp;</td>
                           <td class="LT" align="center">&nbsp;</td>
                           <td class="LT" align="center">&nbsp;</td>
                           <td class="LT" align="center">&nbsp;</td>
                           <td class="LT" align="center">&nbsp;</td>
                           <td class="LT" align="center">&nbsp;</td>
                           <td class="LRT" >&nbsp;</td>
                        </tr>
                        <? $cnt_int++;} }?>
                        <tr height="20">
                           <td height="25" align="center" class="LT">&nbsp;</td>
                           <td class="LT" align="center">&nbsp;</td>
                           <td class="LT" align="center">&nbsp;</td>
                           <td class="LT" align="center">&nbsp;</td>
                           <td class="LT" align="center">&nbsp;</td>
                           <td class="LT" align="center">&nbsp;</td>
                           <td class="LT" align="center">&nbsp;</td>
                           <td class="LT" align="center">&nbsp;</td>
                           <td class="LT" align="center">&nbsp;</td>
                           <td class="LT" align="center">&nbsp;</td>
                           <td class="LT" align="center">&nbsp;</td>
                           <td class="LT" align="center">&nbsp;</td>
                           <td class="LT" align="center">&nbsp;</td>
                           <td class="LT" align="center">&nbsp;</td>
                           <td class="LT" align="center">&nbsp;</td>
                           <td class="LT" align="center">&nbsp;</td>
                           <td class="LT" align="center">&nbsp;</td>
                           <td class="LT" align="center">&nbsp;</td>
                           <td class="LT" align="center">&nbsp;</td>
                           <td class="LT" align="center">&nbsp;</td>
                           <td class="LT" align="center">&nbsp;</td>
                           <td class="LT" align="center">&nbsp;</td>
                           <td class="LRT" >&nbsp;</td>
                        </tr>
                     <tr height="20">
                        <td  class="T" colspan="23">&nbsp;</td>
                     </tr>
                     <tr style="height: 24px;">
                        <td class="LT" colspan="23" style="border-right:1px solid #333;"><strong>&nbsp;&nbsp;&nbsp;&nbsp;รายงานการขึ้นสินค้า</strong></td>
                     </tr>
                     <tr  bgcolor="#bfffbf" style="height: 24px;">
                        <td class="LT" align="center" colspan="13"><strong>แผนงานขึ้นสินค้า</strong></td>
                        <td class="LT" align="center" colspan="6"  bgcolor="#f5c8fb"><strong>การปฏิบัติงานจริง</strong></td>
                        <td class="LT" align="center" colspan="3" bgcolor="#ffd8b0"><strong>สรุปผลต่างการลงสินค้า</strong></td>
                        <td class="LRT" align="center" rowspan="3" bgcolor="#ffd8b0"><strong>สรุปการขึ้นสินค้า</strong></td>
                     </tr>
                     <tr bgcolor="#bfffbf" style="height: 24px;">
                        <td width="2%" class="LT" align="center" rowspan="2"><strong>ลำดับ</strong></td>
                        <td width="7%" class="LT" align="center" rowspan="2"><strong>ทะเบียนรถ</strong></td>
                        <td width="4%" class="LT" align="center" rowspan="2"><strong>เครื่องจักร</strong></td>
                        <td width="10%" class="LT" align="center" rowspan="2"><strong>รายการสินค้า</strong></td>
                        <td width="10%" class="LT" align="center" rowspan="2"><strong>ลูกค้า</strong></td>
                        <td width="4%" class="LT" align="center" rowspan="2"><strong>รหัสสินค้า</strong></td>
                        <td width="8%" class="LT" align="center" colspan="3"><strong>ปริมาณ</strong></td>
                        <td width="4%" class="LT" align="center" rowspan="2"><strong>ขึ้นตำแหน่ง</strong></td>
                        <td width="2%" class="LT" align="center" rowspan="2"><strong>คน</strong></td>
                        <td width="3%" class="LT" align="center" rowspan="2"><strong>ช่วงเวลา</strong></td>
                        <td width="5%" class="LT" align="center"><strong>เวลาที่ควรใช้</strong></td>
                        <td width="4%" class="LT" align="center" bgcolor="#f5c8fb"><strong>ช่วงเวลาที่</strong></td>
                        <td width="5%" class="LT" align="center" bgcolor="#f5c8fb"><strong>เวลาที่ใช้จริง</strong></td>
                        <td width="3%" class="LT" align="center" bgcolor="#f5c8fb"><strong>คนที่ใช้</strong></td>
                        <td width="8%" class="LT" align="center" bgcolor="#f5c8fb" colspan="3"><strong>ปริมาณจริงที่ขึ้น</strong></td>
                        <td width="3%" class="LT" align="center" bgcolor="#ffd8b0" rowspan="2"><strong>เวลา</strong></td>
                        <td width="3%" class="LT" align="center" bgcolor="#ffd8b0" rowspan="2"><strong>คน</strong></td>
                        <td width="3%" class="LT" align="center" bgcolor="#ffd8b0" rowspan="2" style="padding-bottom"><strong>ปริมาณ</strong></td>
                     </tr>
                     <tr bgcolor="#bfffbf" style="height: 24px;">
                        <td class="LT" align="center"><strong>น้ำหนัก</strong></td>
                        <td class="LT" align="center"><strong>จำนวน</strong></td>
                        <td class="LT" align="center"><strong>หน่วย</strong></td>
                        <td class="LT" align="center"><strong>(นาที)</strong></td>
                        <td class="LT" align="center" bgcolor="#f5c8fb"><strong>ใช้จริง</strong></td>
                        <td class="LT" align="center" bgcolor="#f5c8fb"><strong>นาที</strong></td>
                        <td class="LT" align="center" bgcolor="#f5c8fb"><strong>คน</strong></td>
                        <td class="LT" align="center" bgcolor="#f5c8fb"><strong>น้ำหนัก</strong></td>
                        <td class="LT" align="center" bgcolor="#f5c8fb"><strong>จำนวน</strong></td>
                        <td class="LT" align="center" bgcolor="#f5c8fb"><strong>หน่วย</strong></td>
                     </tr>
                     <tbody>
                        <?
                           $cnt_Outt=0;		 
                           for($i=0;$i<count($ld_pnn_Out);$i++)
                           {
                              if($ld_pnn_Out[$i]['lp_t_son'] !="")
                              {
                                    $t_Out["'".$t[$ld_pnn_Out[$i]['lp_t_id']]."<br>".$ld_pnn_Out[$i]['lp_t_son']."'"]=$s_name[$ld_pnn_Out[$i]['lp_t_id']];
                              }
                              else
                              {
                                 $t_Out["'".$t[$ld_pnn_Out[$i]['lp_t_id']]."'"]=$s_name[$ld_pnn_Out[$i]['lp_t_id']];
                              }
                              
                              if($lp_id_same != $ld_pnn_Out[$i]['lp_id'])
                              {
                                 if($rowspans_chk[$ld_pnn_Out[$i]['lp_id']]=="2")
                                 {
                                    $d=$rowspans_num[$ld_pnn_Out[$i]['lp_id']];
                                 }
                              }
                        ?>
                  
                        <tr height="25" style="cursor: move;" class="tr_loop_Out">
                           <?
                              $pd=array();
                              $weight_mom_Out=array();
                              $weight_son_Out=array();
                              $unit_mom_Out=array();
                              $unit_son_Out=array();
                              $qty_mom_Out=array();
                              $qty_son_Out=array();
                              $remark=array();
                              $pd_id=array();
                                 for($k=0;$k<count($lpd[$ld_pnn_Out[$i]['lpp_id']]);$k++){
                                    if($ld_pnn_Out[$i]['lpp_st_blank'] !=0 && $ld_pnn_Out[$i]['lpp_st_sr'] !=1){ $pd[]=$lpd[$ld_pnn_Out[$i]['lpp_id']][$k]['pd_name'];}
                                    if($ld_pnn_Out[$i]['lpp_st_blank'] !=0 && $ld_pnn_Out[$i]['lpp_st_sr'] !=0){ $pd[]=$lpd[$ld_pnn_Out[$i]['lpp_id']][$k]['pd_name'];}
                                    if($ld_pnn_Out[$i]['lpp_st_blank'] ==0 && $ld_pnn_Out[$i]['lpp_st_sr'] ==0){ $pd[]=$lpd[$ld_pnn_Out[$i]['lpp_id']][$k]['pd_name'];}
                                    if($lpd[$ld_pnn_Out[$i]['lpp_id']][$k]['lppd_weight_mom_start'] !=0 && $lpd[$ld_pnn_Out[$i]['lpp_id']][$k]['lppd_weight_son_start'] !=0)
                                    {
                                       $weight_mom_Out[]=$lpd[$ld_pnn_Out[$i]['lpp_id']][$k]['lppd_weight_mom_start'];
                                       $weight_son_Out[]=$lpd[$ld_pnn_Out[$i]['lpp_id']][$k]['lppd_weight_son_start'];
                                    }else if($lpd[$ld_pnn_Out[$i]['lpp_id']][$k]['lppd_weight_mom_start'] !=0){ 
                                       $weight_mom_Out[]=$lpd[$ld_pnn_Out[$i]['lpp_id']][$k]['lppd_weight_mom_start'];
                                    }else if($lpd[$ld_pnn_Out[$i]['lpp_id']][$k]['lppd_weight_son_start'] !=0){
                                       $weight_son_Out[]=$lpd[$ld_pnn_Out[$i]['lpp_id']][$k]['lppd_weight_son_start'];                                                  
                                    }
                                    if($lpd[$ld_pnn_Out[$i]['lpp_id']][$k]['lppd_qty_mom_start'] !=0 && $lpd[$ld_pnn_Out[$i]['lpp_id']][$k]['lppd_qty_son_start'] !=0){
                                       $qty_mom_Out[]=$lpd[$ld_pnn_Out[$i]['lpp_id']][$k]['lppd_qty_mom_start'];
                                       $qty_son_Out[]=$lpd[$ld_pnn_Out[$i]['lpp_id']][$k]['lppd_qty_son_start'];
                                    }else if($lpd[$ld_pnn_Out[$i]['lpp_id']][$k]['lppd_qty_mom_start'] !=0){
                                       $qty_mom_Out[]=$lpd[$ld_pnn_Out[$i]['lpp_id']][$k]['lppd_qty_mom_start'];
                                    }else if($lpd[$ld_pnn_Out[$i]['lpp_id']][$k]['lppd_qty_son_start'] !=0){ 
                                       $qty_son_Out[]=$lpd[$ld_pnn_Out[$i]['lpp_id']][$k]['lppd_qty_son_start'];
                                    }
                                       $pd_id[]=$lpd[$ld_pnn_Out[$i]['lpp_id']][$k]['pd_id'];
                                       $remark[]=$lpd[$ld_pnn_Out[$i]['lpp_id']][$k]['lppd_remark'];
                                       $unit_mom_Out[]=$lpd[$ld_pnn_Out[$i]['lpp_id']][$k]['lppd_unit_m_s'];
                                       $unit_son_Out[]=$lpd[$ld_pnn_Out[$i]['lpp_id']][$k]['lppd_unit_s_s'];
                                    } 
                           ?>
                           <td class="LT" id="scles_row_num_Out" align="center"> 
                              <?=$i+1?>
                           </td>
                           <? if($lp_id_same != $ld_pnn_Out[$i]['lp_id']){?> 
                              <td class="LT" <? if($rowspans_chk[$ld_pnn_Out[$i]['lp_id']]=="2"){echo "rowspan='".$d."'"; }?> align="center">
                              <?=$t[$ld_pnn_Out[$i]['lp_t_id']]?><? if($ld_pnn_Out[$i]['lp_t_son'] !=""){echo " , ".substr($ld_pnn_Out[$i]['lp_t_son'],-4); }?>
                              </td>
                           <? }?>
                           <? if($lp_id_same != $ld_pnn_Out[$i]['lp_id']){?>
                              <td class="LT" <? if($rowspans_chk[$ld_pnn_Out[$i]['lp_id']]=="2"){echo "rowspan='".$d."'"; }?> align="center">
  
                              </td>
                           <? }?>
                           
                           
                              <td class="LT" align="center"><? if(count($pd)>0){ for($k=0;$k<count($pd);$k++){echo $pd[$k];echo"<br>"; } }else{echo "ตีรถเปล่ากลับ";}?></td>
                              <td class="LT" align="center"><? $c_send_Out=$ld_pnn_Out[$i]['lpp_cs_code_send'];$c_receive_Out=$ld_pnn_Out[$i]['lpp_cs_code_receive']; if($csp[$ld_pnn_Out[$i]['lpp_place_id_receive']][$ld_pnn_Out[$i]['lpp_tb_po']] !=""){echo "".$csp[$ld_pnn_Out[$i]['lpp_place_id_receive']][$ld_pnn_Out[$i]['lpp_tb_po']]."";}?>
                              </td>
                              <td class="LT" align="center">
                                 <!-- <? for($k=0;$k<count($pd_id);$k++){echo $pd_id[$k];echo"<br>";} ?> -->
                              </td>
                              <td class="LT" align="center">
                                 <? for($k=0;$k<count($weight_mom_Out);$k++){ if($weight_mom_Out[$k] !=0){ echo number_format($weight_mom_Out[$k],0);} echo"<br>";} ?>
                                 <? for($k=0;$k<count($weight_son_Out);$k++){ if($weight_son_Out[$k] !=0){ echo number_format($weight_son_Out[$k],0);}echo"<br>";} ?>
                              </td>
                              <td class="LT" align="center">
                                 <? for($k=0;$k<count($qty_mom_Out);$k++){echo $qty_mom_Out[$k];echo"<br>";} ?>
                                <? for($k=0;$k<count($qty_son_Out);$k++){echo $qty_son_Out[$k];echo"<br>";} ?>
                              </td>
                              <td class="LT" align="center">
                                 <? 
                                    for($k=0;$k<count($unit_mom_Out);$k++){ 
                                       if($unit_mom_Out[$k] =="81"){ echo "กก.";echo"<br>";}
                                          else if($unit_mom_Out[$k] =="86"){ echo "กระสอบ";echo"<br>";} 
                                          else if($unit_mom_Out[$k] =="40"){ echo "ขวด";echo"<br>";} 
                                          else if($unit_mom_Out[$k] =="46"){ echo "คัน";echo"<br>";} 
                                          else if($unit_mom_Out[$k] =="88"){ echo"จัมโบ้";echo"<br>";} 
                                          else if($unit_mom_Out[$k] =="6"){ echo "ตัน";echo"<br>";}
                                          else if($unit_mom_Out[$k] =="32"){ echo "ถัง";echo"<br>";} 
                                          else if($unit_mom_Out[$k] =="16"){ echo "ถุง";echo"<br>";} 
                                          else if($unit_mom_Out[$k] =="87"){ echo "เบ้าท์";echo"<br>";} 
                                          else if($unit_mom_Out[$k] =="2"){ echo "ใบ";echo"<br>";}
                                    } 
                                 ?>
                                 <? 
                                    for($k=0;$k<count($unit_son_Out);$k++){ 
                                       if($unit_son_Out[$k] =="81"){ echo "กก.";echo"<br>";}
                                          else if($unit_son_Out[$k] =="86"){ echo "กระสอบ";echo"<br>";} 
                                          else if($unit_son_Out[$k] =="40"){ echo "ขวด";echo"<br>";} 
                                          else if($unit_son_Out[$k] =="46"){ echo "คัน";echo"<br>";} 
                                          else if($unit_son_Out[$k] =="88"){ echo"จัมโบ้";echo"<br>";} 
                                          else if($unit_son_Out[$k] =="6"){ echo "ตัน";echo"<br>";}
                                          else if($unit_son_Out[$k] =="32"){ echo "ถัง";echo"<br>";} 
                                          else if($unit_son_Out[$k] =="16"){ echo "ถุง";echo"<br>";} 
                                          else if($unit_son_Out[$k] =="87"){ echo "เบ้าท์";echo"<br>";} 
                                          else if($unit_son_Out[$k] =="2"){ echo "ใบ";echo"<br>";}
                                    } 
                                 ?>
                              </td>
                              <td class="LT" align="center">&nbsp;</td>
                              <td class="LT" align="center">&nbsp;</td>
                              <td class="LT" align="center">&nbsp;</td>
                              <td class="LT" align="center">&nbsp;</td>
                              <td class="LT" align="center">&nbsp;</td>
                              <td class="LT" align="center">&nbsp;</td>
                              <td class="LT" align="center">&nbsp;</td>
                              <td class="LT" align="center">&nbsp;</td>
                              <td class="LT" align="center">&nbsp;</td>
                              <td class="LT" align="center">&nbsp;</td>
                              <td class="LT" align="center">&nbsp;</td>
                              <td class="LT" align="center">&nbsp;</td>
                              <td class="LT" align="center">&nbsp;</td>
                              <td class="LRT">
                                
                              </td>
                        </tr>

                        <? $cnt_Outt++;
                           $lp_id_same=$ld_pnn_Out[$i]['lp_id'];
                        }
                        if($cnt_Outt <1){
                           for($i=$cnt_Outt;$i<1;$i++){
                        ?>
                        <tr height="20">
                           <td height="25" align="center" class="LT">&nbsp;</td>
                           <td class="LT" align="center">&nbsp;</td>
                           <td class="LT" align="center">&nbsp;</td>
                           <td class="LT" align="center">&nbsp;</td>
                           <td class="LT" align="center">&nbsp;</td>
                           <td class="LT" align="center">&nbsp;</td>
                           <td class="LT" align="center">&nbsp;</td>
                           <td class="LT" align="center">&nbsp;</td>
                           <td class="LT" align="center">&nbsp;</td>
                           <td class="LT" align="center">&nbsp;</td>
                           <td class="LT" align="center">&nbsp;</td>
                           <td class="LT" align="center">&nbsp;</td>
                           <td class="LT" align="center">&nbsp;</td>
                           <td class="LT" align="center">&nbsp;</td>
                           <td class="LT" align="center">&nbsp;</td>
                           <td class="LT" align="center">&nbsp;</td>
                           <td class="LT" align="center">&nbsp;</td>
                           <td class="LT" align="center">&nbsp;</td>
                           <td class="LT" align="center">&nbsp;</td>
                           <td class="LT" align="center">&nbsp;</td>
                           <td class="LT" align="center">&nbsp;</td>
                           <td class="LT" align="center">&nbsp;</td>
                           <td class="LRT" >&nbsp;</td>
                        </tr>
                        <? $cnt_Outt++;} }?>
                        <tr height="20">
                           <td height="25" align="center" class="LT">&nbsp;</td>
                           <td class="LT" align="center">&nbsp;</td>
                           <td class="LT" align="center">&nbsp;</td>
                           <td class="LT" align="center">&nbsp;</td>
                           <td class="LT" align="center">&nbsp;</td>
                           <td class="LT" align="center">&nbsp;</td>
                           <td class="LT" align="center">&nbsp;</td>
                           <td class="LT" align="center">&nbsp;</td>
                           <td class="LT" align="center">&nbsp;</td>
                           <td class="LT" align="center">&nbsp;</td>
                           <td class="LT" align="center">&nbsp;</td>
                           <td class="LT" align="center">&nbsp;</td>
                           <td class="LT" align="center">&nbsp;</td>
                           <td class="LT" align="center">&nbsp;</td>
                           <td class="LT" align="center">&nbsp;</td>
                           <td class="LT" align="center">&nbsp;</td>
                           <td class="LT" align="center">&nbsp;</td>
                           <td class="LT" align="center">&nbsp;</td>
                           <td class="LT" align="center">&nbsp;</td>
                           <td class="LT" align="center">&nbsp;</td>
                           <td class="LT" align="center">&nbsp;</td>
                           <td class="LT" align="center">&nbsp;</td>
                           <td class="LRT" >&nbsp;</td>
                        </tr>
                     <tr height="20">
                        <td  class="T" colspan="23">&nbsp;</td>
                     </tr>
                  </tbody>
               </table>
            </td>
         </tr>
         <tr class="noprint">
            <td align="center" colspan="23" valign="top"><input type="button" onclick="tableToExcel('testTable', 'W3C Example Table')" value="Export to Excel"></td>
         </tr>
      </table>
     
      
      
   </body>
<style type="text/css" media="print">
   @page 
   {
   size:auto;
   margin:4mm 4mm 5mm 4mm;
   }
   body 
   {
   size:auto;
   margin:0px 3px 0px 3px; 
   }
</style>
<script src="jquery.min.js"></script>
<script src="jquery-ui.min_1.js"></script>
<script>
  var $sortable = $( "#tablelist > tbody" );
  $sortable.sortable({
      stop: function ( event, ui ) {
          var parameters = $sortable.sortable( "toArray" );
          var loopnum = 1;
         $('.tr_loop_in').each(function(index, el) {
            $(this).find('#scles_row_num_in').html(loopnum++);
         });
         //  $.post("studentPosition.php",{value:parameters},function(result){
         //    //   alert(result);
            
         //  });
      }
  });
  function ExportToExcel(mytblId){
       var htmltable= document.getElementById('my-table-id');
       var html = htmltable.outerHTML;
       window.open('data:application/vnd.ms-excel,' + encodeURIComponent(html));
    }

    var tableToExcel = (function() {
  var uri = 'data:application/vnd.ms-excel;base64,'
    , template = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--></head><body><table>{table}</table></body></html>'
    , base64 = function(s) { return window.btoa(unescape(encodeURIComponent(s))) }
    , format = function(s, c) { return s.replace(/{(\w+)}/g, function(m, p) { return c[p]; }) }
  return function(table, name) {
    if (!table.nodeType) table = document.getElementById(table)
    var ctx = {worksheet: name || 'Worksheet', table: table.innerHTML}
    window.location.href = uri + base64(format(template, ctx))
  }
})()
</script>


