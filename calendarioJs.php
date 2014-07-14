<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>jQuery UI Datepicker - Restrict date range</title>
<link rel="stylesheet" href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
<link rel="stylesheet" href="/resources/demos/style.css">
<script>
    
    $(function() {
        
        $('#ver_data').click(function (){
            var dt =$('#dt_loca').val();
            $( "#datepicker" ).datepicker({
                minDate: -1, maxDate: dt
            });            
        });
        

    });
    
</script>
</head>
<body>
<p>Date: <input type="text" id="datepicker"></p>
<p>Data loca : <input type="text" id="dt_loca"></p>

<div id="ver_data" style="float: left; width: 50px; height: 50px; background: red; cursor: pointer;" >
    
</div>

</body>
</html>