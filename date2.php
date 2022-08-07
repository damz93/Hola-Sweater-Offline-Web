<html>
   <head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8">     
      <link rel="shortcut icon" href="img/tokonline.png">
	  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">	  	  
		<script src="https://code.jquery.com/jquery-3.4.1.js"></script>
	<script src="js/bootstrap-datepicker.js"></script>
    <link rel="stylesheet" href="css/datepicker.css">
	</head>
	<body>
	<div class="container">
    <br>
    <h4>Datepicker di PHP dengan Bootstrap</h4>

        <div class="form-group">
            <label>Tanggal:</label>
            <input type="text"  name="tanggal"  class="form-control datepicker"  required/>
        </div>
    <script type="text/javascript">
        $(function(){
            $(".datepicker").datepicker({
                format: 'yyyy-mm-dd',
                autoclose: true,
                todayHighlight: true,
            });
        });
    </script>
	</body>
	</html>