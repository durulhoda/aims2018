

<div class="page-header nonPrintarea">

    <button aria-expanded="false" data-toggle="tab"  onclick="printDiv('printableArea')" class="btn-new-mail no-border">
        <span class="btn btn-purple no-border">
            <i class="ace-icon fa fa-print bigger-130"></i>
            <span class="bigger-110">Print</span>
        </span>
    </button>
</div><!-- /.page-header -->


<div id="printableArea" class="printarea">
    <?php 
    $count=0;
    foreach($studentinfo as $info)
    {   
        // print_r($info);
        // exit();
        // echo info[0]['photo'];
        // exit();
        ++$count;
        ?>
        <div class="admitcarditem" style="width: 90%;margin: 0px auto;border: 3px solid #478fca;margin-bottom: 25px;<?php if($count%2==0){ echo 'page-break-after:always;';} ?>">
            <div class="instituteinfo" style="text-align: center;padding: 7px 0px;font-family: cambria;border-bottom:  1px solid #cccccc;">
                <div class="logo">
                    <img src="<?php echo base_url().$institute_details[0]['logo'];?>" height="70px" width="auto" alt="0"/>
                </div>
                <div class="title">
                 <h2 class="blue" style="font-size: 30px; color: royalblue;margin: 0px !important;margin-top: 7px;"><?php echo $institute_details[0]['instituteName'];?></h2>
             </div>
             <div class="subtitle">
                 <h3 style="font-size: 18px;margin: 0px !important;"> <?php echo  $institute_details[0]['town'].", ".$institute_details[0]['city'].", ".$institute_details[0]['disname']; ?></h3>
             </div>       
         </div>
         <div class="year" style=" text-align: center;border-bottom:  1px solid #cccccc;">
            <h4 class="green" style="font-family: Algerian;">ADMIT CARD for&nbsp;<?php echo getSemesterName($semester_type);?><strong>-</strong><?php echo $other_basic_info[0]['session'];?></h4> 
        </div>
        <div class="examinfo" style="text-align: center; font-size: 16px;padding: 7px 0px;border-bottom:  1px solid #cccccc;">
            <strong class="blue">Class : </strong><strong><?php echo $other_basic_info[0]['programName'];?></strong class="blue"><strong>,</strong>&nbsp;
            <strong class="blue">Medium :</strong> <strong><?php echo $other_basic_info[0]['mediumName'];?></strong><strong>,</strong>&nbsp;
            <strong class="blue">Shift : </strong><strong><?php echo $other_basic_info[0]['shiftName'];?></strong><strong>,</strong>&nbsp;
            <strong class="blue">Group : </strong><strong><?php echo $other_basic_info[0]['groupName'];?></strong><strong>,</strong>&nbsp;
            <strong class="blue">Section  : </strong><strong><?php echo $other_basic_info[0]['sectionName'];?></strong>
        </div>
        <div class="routine" style="padding: 7px 17px 0px 18px;">
         <div class="keynote" style=" width:78%;float: left;">
        <div style="text-align: center;color: red;padding:8px 0px;"><span style="color: red;">EXAM ROUTINE</span></div>
            <table style="border-collapse: collapse;margin-bottom: 12px;font-size: 16px;padding: 4px;border: 4px solid #cccccc;">
               <!--<caption style="text-align: center;color: red"><b>EXAM ROUTINE</b></caption>-->
               <thead>
                <tr>
                    <th width="10%" style="text-align: center; border: 2px solid #cccccc;"><p class="blue;margin: 0 0 5px !important;">Date</p></th>
                    <th width="37%" style="text-align: center; border: 2px solid #cccccc;"><p class="blue;margin: 0 0 5px !important;">Subject Name</p></th>
                    <th width="10%" style="text-align: center; border: 2px solid #cccccc;"><p class="blue;margin: 0 0 5px !important;">Code</p></th>
                    <th width="13%" style="text-align: center; border: 2px solid #cccccc;"><p class="blue;margin: 0 0 5px !important;">Time</p></th>
                    <th width="8%" style="text-align: center; border: 2px solid #cccccc;"><p class="blue;margin: 0 0 5px !important;">Room</p></th>
                </tr>
            </thead>
            <tbody>
                <?php 
                foreach($exam_routine as $routine){?>
                   <tr>
                    <td style="border: 2px solid #cccccc;text-align: left;font-size: 14px;padding: 5px;"> <?php echo $routine['date'];?></td>
                    <td style="border: 2px solid #cccccc;text-align: left;font-size: 14px;padding: 5px;"><?php echo $routine['courseName'];?></td>
                    <td style="text-align: center;border: 2px solid #cccccc;text-align: left;font-size: 14px;padding: 5px;"> <?php echo $routine['courseCode'];?></td>
                    <td style="text-align: center;border: 2px solid #cccccc;text-align: left;font-size: 14px;padding: 5px;"> <?php echo $routine['examtime'];?></td>
                    <td style="text-align: center;border: 2px solid #cccccc;text-align: left;font-size: 14px;padding: 5px;"><?php echo $routine['room'];?></td>
                </tr>
            <?php }
            ?>
        </tbody>
    </table>
    <div class="kenote-inner">
     <p class="red" style="margin: 0px !important;">Note: 1. Authority Holds full right to change exam routine as needed.</p>
     <p class="red last" style="margin-left: 35px !important;">     2. Admit Card is mandatory to Enter the Exam hall.</p>
 </div>
</div>

<div class="studentdetails" style="float: left;
    width: 22%;">
 <div class="student-img" style="min-height: 180px;margin-top: 30px;">
   <img style="padding: 10px;width:100%;height: 250px;box-sizing: border-box;" src="<?php echo base_url().$info['photo'];?>"/>
</div>
<div class="id" style="text-align: center;font-size: 17px;margin-top: 10px;font-weight: bold;">
    <span class="green">Id:&nbsp;<?php echo $info['studentId'];?></span>
</div>
<div class="name" style="text-align: center;font-size:17px;margin-top: 3px;font-weight: bold;">
 <span class="blue"><?php echo $info['firstName'];?></span>
</div>
<div class="roll" style="text-align: center;font-size:17px;margin-top: 3px;font-weight: bold;">
 <span class="red"><?php echo 'Roll No. '.$info['roll_no'];?></span>
</div>
</div>
<div style="clear: both;"></div>
</div>
<div class="signature">
    <table style="border-collapse: collapse; font-family: cambria; margin: 0px 10px; width: 97%; ">
        <tbody>
            <tr>
                <td colspan="4" style="padding:10px 0px 10px 10px;text-align: left;font-size: 12px;font-weight: bold;"><img  src="<?php echo base_url()."images/ct.png"; ?>"> <br>.............................................<br>Class Teacher </td>
                <td style="vertical-align: bottom;padding:10px 0px 10px 10px;text-align: left;font-size: 12px;font-weight: bold;"><h6 style="font-family:Segoe UI Semibold; text-align:center;margin: 0px 0px 0px 0px !important;"> Admit Card generated by:&nbsp;&nbsp;<span style="font-family: century gothic; color: red;">aims &nbsp;</span>||&nbsp; Powerd by:&nbsp;&nbsp;www.adventure-soft.com</h6></td>
                <td style="text-align: right;padding:10px 0px 10px 10px;text-align: left;font-size: 12px;font-weight: bold;" colspan="4"><img src="<?php echo base_url()."images/au.png"; ?>"> <br>.............................................<br> Authorized Signature </td>
            </tr>
        </tbody>
    </table>
    
</div>
</div>
<?php } ?>
</div>