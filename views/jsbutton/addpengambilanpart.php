<!-- <script type="text/javascript">

$(document).ready(function() {
    $(function () {
        $('#datetimepicker6').datetimepicker();
    });
});
</script> -->

<script>
    $(document).ready(function(){
        var id = 1;
        $("#add-row").click(function(){
            if($('#kodepart').val() == ''){
                alert('Kode part Tidak Boleh Kosong');
                $('#search').focus();
            }
            else if($('#namapart').val() == ''){
                alert('Descripsi Part Tidak Boleh Kosong');
                $('#search').focus();
            }
            else if($('#qty').val() == ''|| $('#qty').val() <= 0){
                alert('QTY Tidak Boleh Kosong');
                $('#qty').focus();
            }else
            {
            var kodepart = $("#kodepart").val();
            var namapart = $("#namapart").val();
            var qty = $("#qty").val();
            id++;
            var row = 
                '<tr id="'+ id +'">' +
                    '<td>'+kodepart+'</td>' +
                    '<td>'+namapart+'</td>' +
                    '<td>'+qty+'</td>' +
                    '<td><button data-id="'+ id +'" class="remove btn btn-danger">X</button></td>' +
                '</tr>'
            ;
            $('.table').append(row);
            $("#kodepart").val("");
            $("#namapart").val("");
            $("#qty").val("0");
            }
        });

        $("#push-row").click(function(){
            //========================CARA 1=======================
            var table = document.getElementById('mytable');
            var arr2 =[];
            var qty = 0;
            for (var r = 1, n = table.rows.length; r < n; r++) {
                var string ="";
                for (var c = 0, m = table.rows[r].cells.length; c < m-1; c++) {
                    if (c==0) {
                        string= "{"+table.rows[0].cells[c].innerHTML+" : '"+table.rows[r].cells[c].innerHTML+"'";
                    }
                    else{
                        string = string +", "+table.rows[0].cells[c].innerHTML+" : '"+table.rows[r].cells[c].innerHTML+"'";
                        if (c == 3){
                            qty = qty+parseInt(table.rows[r].cells[c].innerHTML);
                        }                
                    }
                }
                string = string+"}";
                var obj = JSON.stringify(eval('(' + string + ')'));
                var arr = $.parseJSON(obj);
                arr2.push(arr);
            }
            console.log(qty);
            // console.log(arr2);
            // console.log(arr2.length);
            // $.ajax({  
            //     url:"<?php echo base_url('home/lempar'); ?>",  
            //     method:"POST", 
            //     data: { data: JSON.stringify(arr) },  
            //     success:function(data){  
            //     var html = '';
            //     }  
            // });  
        });
        $(document).on('click','.remove',function() {
            var id = $(this).attr("data-id");
            $('#'+id).remove();
            
        });
    });
</script>