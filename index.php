<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
	<title>Tes</title>
	<style>
		body {
			background-color: #eee;
			min-width: 640px;
		}

		* {
			font-family: arial;
			font-size: 14px;
		}

		#content {
			max-width: 1024px;
			padding: 24px 0px;
			margin: auto;
		}

		#content h1 {
			padding: 0px 12px;
		}

		#box-content {
			min-height: 300px;
			background-color: #fff;
			box-shadow: 2px 2px 2px #888888;
			padding: 6px 12px;
		}

		#box-content h2 {
			margin: 6px 0px;
		}

		.table select {
			margin: 6px 0px;
			box-sizing: border-box;
			width: 100%;
		}

		p {
			margin: 6px 2px;
		}

		.button {
			float: right;
			padding: 0px 12px;
		}

		.button button {
			padding: 12px;
			border: none;
			border-radius: 4px;
		}

		.green_bg {
			background: limegreen;
			color: #fff;
		}

		button:disabled {
			background: #ddd;
			color: #aaa;
		}

		input, select {
			padding: 6px;
			border-radius: 4px;
			border: solid 1px #aaa;
		}

		.select2-selection__arrow,
		.select2-selection {
			height: 34px !important;
		}

		.select2-selection__rendered {
			padding: 2px 8px !important;
		}

		.select2-search__field {
			outline: none;
		}
	</style>
	<script>
		$(document).ready(function() {
			var arr = '';
			$('.select2').select2();
			$(".select2").select2({
				placeholder: "Select"
			});
		});
	</script>
</head>

<body>
	<?php
	function curl($url)
	{
		$ch = curl_init();
		curl_setopt_array($ch, array(
			CURLOPT_URL => $url,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		));
		$output = curl_exec($ch);
		$err = curl_error($ch);
		curl_close($ch);
		if ($err) {
			return "cURL Error #:" . $err;
		} else {
			return $output;
		}
	}

	//$send = curl("http://dummy.restapiexample.com/api/v1/employees");

	// mengubah JSON menjadi array
	// $data = json_decode($send, TRUE);
	?>
	<div id="content">
		<h1>Create Order</h1>
		<form id="formorder" action="" method="post" onchange="validateForm('formorder')">
			<div id="box-content">
				<div id="section1">
					<table class="table" style="width: 100%;">
						<tr>
							<td style="vertical-align:top; width: 30%;">
								<h2>Detail</h2>
							</td>
							<td style="vertical-align:top; width: 70%;">
								<div style="padding-bottom: 24px;">
									<label for="name">
										<p>Name<span style="color: red;">*</span></p>
									</label>
									<select style="width:70%;" class="select2" name="nama" id="name" onchange="dist()">
										<option value="">Name</option>
										<?php
										$tes = array('nama 1', 'nama 2', 'nama 3');
										if (!empty($tes)) {
											foreach ($tes as $value) {
												echo '<option value="' . $value . '">' . $value . '</option>';
											}
										}
										?>
									</select>
								</div>
								<div style="padding-bottom: 24px;">
									<label for="distribution">
										<p>Distribution Center<span style="color: red;">*</span></p>
									</label>
									<select class="select2" style="width:48%;" name="distribution" id="distribution">
										<option value="nodata" disabled selected>No data available</option>
									</select>
								</div>
								<div id="detail2" style="padding-bottom: 24px; display:none; justify-content:space-between; flex-wrap:wrap;">
									<div style="width: 48%;">
										<label for="payment">
											<p>Payment type<span style="color: red;">*</span></p>
										</label>
										<select style="width:100%;" class="select2" name="payment" id="payment">
											<option value="">Payment type</option>
											<option value="Cash H+1">Cash H+1</option>
											<option value="Cash H+3">Cash H+3</option>
											<option value="Cash H+7">Cash H+7</option>
											<option value="Transfer H+1">Transfer H+1</option>
											<option value="Transfer H+3">Transfer H+3</option>
											<option value="Transfer H+7">Transfer H+7</option>
										</select>
									</div>
									<div style="width: 50%;">
										<label for="expired">
											<p>Expired Date<span style="color: red;">*</span></p>
										</label>
										<input style="box-sizing: border-box; width:90%;" type="date" name="date">
									</div>
									<div style="width: 70%; margin-top:24px;">
										<label for="notes">
											<p>Notes</p>
										</label>
										<textarea style="box-sizing: border-box; width:100%; height:100px; resize:none;" name="notes" id="notes"></textarea>
									</div>
								</div>
							</td>
						</tr>
						<tr>
							<td colspan="2">
								<hr>
							</td>
						</tr>
					</table>
				</div>
				<div id="section2" style="display:none;">
					<table class="table" style="width: 100%;">
						<tr>
							<td style="vertical-align:top; width: 30%;">
								<h2>Products</h2>
							</td>
							<td style="vertical-align:top; width: 70%;">
							<div id="masterproduct">
								<div class="formproduct" style="padding-bottom: 24px; display:flex; justify-content:space-between; flex-wrap:wrap;">
									<div class="product" style="width:70%;">
										<label for="product">
										<p>Product<span style="color: red;">*</span></p>
										</label>
										<select style="width:100%;" class="select_product" name="product[]">
											
										</select>
									</div>
									<div class="unit" style="width:28%;">
										<label for="unit">
										<p>unit<span style="color: red;">*</span></p>
										</label>
										<select style="width:100%;" class="select_unit" name="unit[]">
											
										</select>
									</div>
									<div class="qty" style="width:22%;">
										<label for="qty">
										<p>Quantity<span style="color: red;">*</span></p>
										</label>
										<input class="in_qty" style="width: 100%;" type="number" name="qty[]">
									</div>
									<div class="price" style="width:30%;">
										<label for="price">
										<p>Price<span style="color: red;">*</span></p>
										</label>
										<input class="in_price" style="width: 100%;" type="text" name="price[]">
									</div>
									<div class="totalprice" style="width:40%;">
										<label for="totalprice">
										<p style="text-align: right;">Total Price<span style="color: red;">*</span></p>
										</label>
										<input class="in_totalprice" style="width: 95%;" type="number" name="totalprice[]" disabled>
									</div>
								</div>
							</div>
							<div>
								<button type="button" name="btn-order" onclick="clone()">New Item +</button>
							</div>
							<div style="display:flex;">
								<div style="width:50%; text-align:right;">Total</div><div style="width:50%; text-align:right;" id="total_prices">0</div>
							</div>
							<div style="clear: both;"></div>
							</td>
						</tr>
						<tr>
							<td colspan="2">
								<hr>
							</td>
						</tr>
					</table>
				</div>

				<div class="button">
					<button type="button" name="btn-order" style="background: transparent;">CANCEL</button>
					<button id="btn-submit" class="green_bg" type="submit" name="btn-order">CONFIRM</button>
				</div>

				<div style="clear: both;"></div>
			</div>
		</form>
	</div>
	<script>
var product = {
  nama: ['Morning Dew Milk','Le Minerale 600ml','Greenfields Full Cream Milk 1L'],
  unit: [
  ['pak :: 10000','pcs :: 2000','pak :: 20000'],
  ['karton :: 10000','pak :: 20000'],
  ['karton :: 10000','pcs :: 2000','pak :: 20000']
  ]
};
select_product(0);
coba();
function coba(){
var select_product = document.getElementsByClassName('select_product');
var select_unit = document.getElementsByClassName('select_unit');
var in_qty = document.getElementsByClassName('in_qty');
  for (var i = 0, len = select_product.length; i < len; i++)
  {
      (function(index){
          select_product[i].onchange = function(){
          var select = select_product[index].selectedIndex;
			unit(index,select);
			price(index,select);
			total_price(index);
		  }
		  select_unit[i].onchange = function(){
          var select = select_unit[index].selectedIndex;
			price(index,select);
			total_price(index);
		  }
		  in_qty[i].onchange = function(){
          var select = select_unit[index].selectedIndex;
            total_price(index);
          }
      })(i);
  }
}
function clone(){
	var tes = document.getElementById("masterproduct");
	var elmnt = document.getElementsByClassName("formproduct")[0];
	var hitung = document.getElementsByClassName("formproduct").length++;
	var cln = elmnt.cloneNode(true);
	tes.appendChild(cln);
	select_product(hitung);
	coba();
}
function total_price(data){
	var total_price = document.getElementsByClassName("in_totalprice")[data];
	var price = document.getElementsByClassName("in_price")[data].value;
	var qty = document.getElementsByClassName("in_qty")[data].value;
	total_price.value = qty * price;
}
function total_all(){
    var total_price = document.getElementsByClassName("in_totalprice")[data];
	var price = document.getElementsByClassName("in_price")[data].value;
	var qty = document.getElementsByClassName("in_qty")[data].value;
	total_price.value = qty * price;
}
function price(data,selected){
	var select = document.getElementsByClassName("in_price")[data];
	var unit = document.getElementsByClassName("select_unit")[data].value;
	var hasil = unit.split(" :: ");
	select.value = hasil[1];
}
function unit(data,selected){
	var i = 0;
	var select = document.getElementsByClassName("select_unit")[data];
	var tes = "";
	var unit = product.unit[selected];
	for(i=0;i < unit.length;i++){
	tes = tes + 
	"<option value='"+unit[i]+"'>" + unit[i] + "</option>";
	}
	select.innerHTML = select + tes;
	select.innerHTML = select + tes;
}
function select_product(data){
	var i = 0;
	var select = document.getElementsByClassName("select_product")[data];
	var tes = "";
	for(i=0;i < product.nama.length;i++){
	tes = tes + 
	"<option value='"+product.nama[i]+"'>" + product.nama[i] + "</option>";
	}
	select.innerHTML = select + tes;
}
		function additem(){
			var arr = ['Apple','Banana','Pear','Orange'];
			var option = "";
			var formselect = document.getElementById("formselect");
			var select = document.createElement("select");
				select.className = "select";
				for (i=0; i < arr.length; i++){
				var option = document.createElement("option");
				option.text = arr[i];
				select.add(option);
				}
				var btn = document.createElement("button");
				btn.className = "delete-select";
				btn.textContent = "delete";
				btn.type = "button";
				btn.value = "delete";
				btn.setAttribute("onclick", "hapus(this)");
				formselect.appendChild(select);
				formselect.appendChild(btn);
		}
		function dist() {
			var distribution = ['DC Tangerang', 'DC Cikarang'];
			$('#distribution').empty().trigger("change");
			distribution.forEach(dist);

			function dist(item, index) {
				var newState = new Option(item, item, true, true);
				$("#distribution").append(newState).trigger('change');
			}
			$('#distribution').val(null).trigger('change');
			$("#distribution").attr("onchange", "shownext()");
			validateForm('formorder');
		}

		function shownext() {
			var data = document.getElementById('distribution').value;
			if (data !== "") {
				document.getElementById('detail2').style.display = "flex";
				document.getElementById('section2').style.display = "";
			}
		}

		function validateForm(data) {
			var err = 0;
			var hitung = document.forms[data].length;
			var form = document.forms[data];
			var demo = document.getElementById('demo');
			for (i = 0; i < hitung; i++) {
				var xx = document.forms[data][i];
				if (xx.value == "") {
					var kecuali = ['notes','btn-order'];
					var name = xx.getAttribute("name");
					if (!kecuali.includes(name) || name == "") {
						//xx.style.border = 'solid 1px red';
						//alert("Name must be filled out");
						err++;
					}
				} else {
					xx.style.border = 'solid 1px #ddd';
				}
			}
			if (err > 0) {
				document.getElementById('btn-submit').setAttribute("disabled",true);
            }
            else{
				document.getElementById('btn-submit').removeAttribute("disabled");
			}
		}
	</script>
</body>

</html>