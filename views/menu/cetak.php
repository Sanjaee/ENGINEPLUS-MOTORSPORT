<html>
<head>
    <title>
        <?php echo SITE_NAME ." : ". ucfirst($this->uri->segment(1)) ." - ". ucfirst($this->uri->segment(2)) ?>
    </title>

    <!-- Custom styles for this template -->
    <link href="<?php echo base_url(); ?>assets/css/cetak.css" rel="stylesheet">

    <!-- Site Icons -->
    <link rel="shortcut icon" href="<?php echo base_url(); ?>assets/img/tms2.png" type="image/x-icon" />
</head>
<body>
    
    <br>
    <table class="table" border="0" style="width:80%" align="center" cellpadding="2">
        <tr>
            <td width="50" align="left">
                <img src="<?php echo base_url(); ?>assets/img/tms2.png" width="80" height="80">
            </td>
            <td>
                <h1>City Trans Utama</h1>
            </td>
			<td  align="right">City Trans Utama<br>
                jl.zzz<br>
                021-0000000<br>
                ctu@gmail.com<br>
            </td>
        </tr>
    </table>
    
    <hr style="width:80%">
    <br>
 
    <table border="0" style="width:80%" align="center" cellpadding="2">
        <tr>
            <td width="120">Booking Order </td>
            <td  colspan="3">: 00000</td>
			<td  align="right">zzzz</td>
        </tr>
        <tr>
            <td width="120">Nama </td>
            <td colspan="3">: blank</td>
            <td align="right">zzzz</td>
        </tr>
        <tr>
            <td>Alamat </td>
            <td colspan="3">: Jl.zzz</td>
            <td align="right">zzzz</td>
        </tr>
    </table>

    <br><br>

    <table class="table table-bordered table-striped dataTable no-footer" rules="rows" align="center" style="width: 80%;">
		<tr>
			<th width="20">No</th>
			<th width="100">Kode Part</th>
            <th width="">Nama Part</th>
        </tr>
        <tr role="row" class="odd">
            <td align="center">zzz</td>
            <td align="center">zzz</td>
            <td align="center">zzz</td>
        </tr>
		<!-- <?php 
            $no = 1;
            $result = $this->db->get('tmsdb')->result(); 
            // print_r($result);
            // die();
            foreach($result as $row)  
            { 
		?>
            <tr role="row" class="odd">
                <td align="center"><?php echo $no++; ?></td>
                <td align="center"><?php echo $row->kode; ?></td>
                <td align="center"><?php echo $row->nama; ?></td>
            </tr>
		<?php 
		    }
		?> -->
	</table>
 
	<script>
		window.print();
	</script>
 
</body>
</html>