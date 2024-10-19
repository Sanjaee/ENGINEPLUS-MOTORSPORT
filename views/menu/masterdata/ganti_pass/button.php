<script type="text/javascript">
    $(document).ready( function () {

// ---------- Validasi----------------------------------------
    function CekValidasi() {

        var passbaru =  $('#passwordbaru').val();
        var konfirpass =  $('#konfirpass').val();

        if($('#passwordlama').val() == ''){
            $.alert({
                title: 'Info..',
                content: 'Password Lama Harus diisi',
                buttons: {
                formSubmit: {
                    text: 'OK',
                    btnClass: 'btn-red'
                }
                }
            });   
            $('#passwordlama').focus();
            var result = false;
        } else if($('#passwordbaru').val() == ''){
            $.alert({
                title: 'Info..',
                content: 'Password Baru Harus diisi',
                buttons: {
                formSubmit: {
                    text: 'OK',
                    btnClass: 'btn-red'
                }
                }
            });   
            $('#passwordbaru').focus();
            var result = false;
        } else if($('#konfirpass').val() == ''){
            $.alert({
                title: 'Info..',
                content: 'Silahkan Konfirmasi Password Anda',
                buttons: {
                formSubmit: {
                    text: 'OK',
                    btnClass: 'btn-red'
                }
                }
            });   
            $('#konfirpass').focus();
            var result = false;
        } else if($('#konfirpass').val() == ''){
            $.alert({
                title: 'Info..',
                content: 'Silahkan Konfirmasi Password Anda',
                buttons: {
                formSubmit: {
                    text: 'OK',
                    btnClass: 'btn-red'
                }
                }
            });   
            $('#konfirpass').focus();
            var result = false;
        } else if(konfirpass != passbaru){
            $.alert({
                title: 'Info..',
                content: 'Password baru dan Konfirmasi harus sama',
                buttons: {
                formSubmit: {
                    text: 'OK',
                    btnClass: 'btn-red'
                }
                }
            });   
            $('#konfirpass').focus();
            var result = false;
        } else {
            var result = true;
        }
    return result;
    };
// -- SAVE --
        document.getElementById("save").addEventListener("click", function(event) {
            event.preventDefault();
            var passlama =  $('#passwordlama').val();
            var passbaru =  $('#konfirpass').val();

            if(CekValidasi() == true){
                $.ajax({  
                    url:"<?php echo base_url('masterdata/user/ubah_pass'); ?>",  
                    method:"POST", 
                    dataType: "json",
                    async : true,
                    data:{
                            passlama:passlama,
                            passbaru:passbaru
                        },  
                    success:function(data){  
                    if (data.kode  != ""){
                        $.alert({
                            title: 'Info..',
                            content: data.message,
                            buttons: {
                            formSubmit: {
                            text: 'OK',
                            btnClass: 'btn-red'
                                }
                            }
                        });
                    }
                    else{
                        $.alert({
                            title: 'Info..',
                            content: data.message,
                            buttons: {
                            formSubmit: {
                            text: 'OK',
                            btnClass: 'btn-red'
                                }
                            }
                        });   
                    }
                    }   
                }, false);
            }
        }); 
// -- END SAVE --

// -- NEW --
    document.getElementById("new").addEventListener("click", function(event) {
        event.preventDefault(); 
        BersihkanLayar(); 
    }); 
// -- END NEW --
    function BersihkanLayar(){
        location.reload(true);
    };

    });
</script>