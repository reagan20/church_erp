<?php
foreach ($details as $det){
    $fname=$det['m_firstname'];$mname=$det['m_middlename'];$lname=$det['m_lastname'];
    $logo=$det['logo'];
    $church_name=$det['church_name'];
    $church_moto=$det['motto'];
    $phone=$det['phone'];
    $email=$det['email'];
    $box=$det['box'];
    $baptism=$det['date_of_baptism'];
    $dob=$det['m_dob'];
}
?>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/pdflayout.css">
<body>
<div class="container" >
    <div class="row-fluid "  style="text-align: center;">
        <img src="<?php echo base_url('assets/uploads/'.$logo);?>"  alt="Church Logo" class="logo" width="100" height="100"/><!--style="padding-left:39%"-->
        <h3><?php echo $church_name;?></h3><!--style="padding-top:0px; padding-left:16%;"-->
        <!--<h4 style="padding-left:26%;">--><?php //echo $church_moto;?><!--</h4>-->
    </div>
    <div class="row-fluid"  style="padding-left:10%; padding-right:-5%;">
        <div class="span6 pull-left" style="text-align:left;margin-top:-20px;"><br/>
            Tel. No: <?php echo $phone;?> <br/>
            Email: <u> <?php echo $email;?></u><br/>
            Motto: <u><?php echo $church_moto;?></u><br/>
        </div>

        <div class="span6" style="text-align:left; padding-left:74%; margin-top:-65px; ">P.O Box <?php echo $box;?> <br/>Kenya.<br/></div>
    </div>
    <div class=" row-fluid1"  style="padding-left:10%; padding-right:-5%;"><hr/>  </div>
    <div class=" row-fluid1"  style="padding-left:10%; padding-right:-5%;" style="text-align:center"><br/>
        <div style="padding-left:10%; padding-right:-5%;" >
            <u><strong>BIRTH CERTIFICATE</strong></u>
        </div>
    </div>
    <br/>
    <div class="row-fluid " style="padding-left:10%; padding-right:-5%;">
        <table class="table table-bordered table-hover">
            <tbody>
            <tr>
                <td style="width: 50%;">FULLNAME:</td>
                <td style="width: 50%;"><?php echo $fname.' '.$mname.' '.$lname;?></td>
            </tr>
            <tr>
                <td>DATE OF BIRTH:</td>
                <td><?php echo $dob;?></td>
            </tr>
            <tr>
                <td>DATE OF BAPTISM:</td>
                <td><?php echo $baptism;?></td>
            </tr>
            </tbody>
        </table>
    </div>
</div>
</body>

