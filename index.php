<META HTTP-EQUIV="content-type" CONTENT="text/html; charset=utf-8">

<meta charset="utf-8">

<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Pragma" content="no-cache">
<META HTTP-EQUIV="content-type" CONTENT="text/html; charset=utf-8">
<meta charset="ISO-8859-1" />

<?php require_once('header.inc');
header("content-type: text/html; charset=UTF-8"); 

 ?>
 
<div class="form bg-blue text-light p-2" onsubmit="return doSubmit()">
	<div class="form-title">
	<center><h3> Trouvez votre envoi par numéro de référence</h3><a class="info" data-open="exampleModal1" aria-controls="exampleModal1" aria-haspopup="true" tabindex="0" ></a></center>
	</div>    <form id="search" action="trackref.php" method="get">
        <table width="90%" class="text-light">
          
            <tr>
                <td width="200px">Référence numéro</td>
                <td><input name="ref" class="form-control full-width" placeholder="" required></td>
            </tr>
            <tr>
                <td></td>
                <td class="pt-3">
                    <button id='btnSearch'  type="submit" type="button" class="btn btn-lg btn-block bg-orange" >suivi >></button>
                </td>
            </tr>
        </table>
    </form>
</div><br>
<div>
    <a href="https://www.tibo.ma" target="_blank"><img src="img/tibologo.png"  height="180" width="100%"><center><b><h5></h5></b></center></a> 
    
    
    </div>

<!--<br> ******************************************* <br> -->
<br>
<div class="form bg-blue text-light p-2">
	<div class="form-title">
	<center><h3>Simulateur des tarif amana internationa</h3><a class="info" data-open="exampleModal1" aria-controls="exampleModal1" aria-haspopup="true" tabindex="0" ></a></center>
	</div>

	<form id="simulation" action="simulat.php" method="post" accept-charset="utf-8" novalidate="novalidate">
	
	<table width="90%" class="text-light">
   			
		<tr>
			<td width="200px">Départ</td>
			<td><select id="departure" name="departure" class="form-control" >
						<option value="147" selected="selected">Maroc</option>
					</select>  
			</td>
		</tr>
	
	
		<tr>
			<td>Destination</td>
			<td>
					<select id="destination" name="destination"  class="form-control">
							<option value="">Pays</option>
							<option value="1" selected="selected">France</option>
							<option value="2">Belgique</option>
							<option value="3">Espagne</option>
							<option value="4">Allemagne</option>
							<option value="5">G. Bretagne</option>
							<option value="6">Italie</option>
							<option value="7">Pays Bas</option>
							<option value="9">Hong Kong</option>
							<option value="8">Japon</option>
							<option value="10">Portugal</option>
							<option value="12">Canada</option>
							<option value="11">USA</option>
							<option value="16">Nouvelle Zélande</option>
							<option value="13">A. Saoudite</option>
							<option value="19">Australie</option>
							<option value="20">Bahreïn</option>
							<option value="21">Egypte</option>
							<option value="14">Emirats Arabes Unies</option>
							<option value="15">Inde</option>
							<option value="22">IRAQ</option>
							<option value="23">JORDANIE</option>
							<option value="24">KUWAIT</option>
							<option value="25">LIBAN</option>
							<option value="27">OMAN </option>
							<option value="26">QATAR</option>
							<option value="18">Syrie</option>
							<option value="17">Yémen</option>
							<option value="28">Brésil</option>
							<option value="30">Chine</option>
							<option value="29">Corée du Sud</option>
							<option value="31">PAKISTANE</option>
							<option value="33">Bulgarie</option>
							<option value="37">BULGARIE</option>
							<option value="34">Grèce</option>
							<option value="35">POLOGNE</option>
							<option value="36">Suède       </option>
							<option value="32">Tchèque</option>
							<option value="38">ALGERIE</option>
							<option value="41">BURKINA FASO</option>
							<option value="42">Cameroun</option>
							<option value="44">Congo</option>
							<option value="43">Côte d'ivoire</option>
							<option value="48">LIBYE</option>
							<option value="46">MAURITANIE</option>
							<option value="45">NIGERIA</option>
							<option value="47">SENAGAL </option>
							<option value="40">Soudan</option>
							<option value="39">TUNISIE</option>
							<option value="50">Autriche</option>
							<option value="51">Danemark</option>
							<option value="49">Suisse</option>
							<option value="53">Moldova</option>
							<option value="52">RUSSIE</option>
					</select>  
			</td>
		</tr>

    
		<tr>
			<td >Poids</td>
			<td><input type="text" name="weight" id="weight" value="1"  class="form-control datepart">	
			    <!--
				<select id="weight" name="weight"  class="form-control datepart" >
					<option value="1">0.25</option>
					<option value="1">0.5</option>
					<option value="1">0.75</option>
					<option value="1" selected="selected">1</option>
					<option value="2">1.5</option>
					<option value="2">2</option>
					<option value="3">2.5</option>
					<option value="3">3</option>
					<option value="4">3.5</option>
					<option value="4">4</option>
					<option value="5">4.5</option>
					<option value="5">5</option>
					<option value="6">5.5</option>
					<option value="6">6</option>
					<option value="7">6.5</option>
					<option value="7">7</option>
					<option value="8">7.5</option>
					<option value="8">8</option>
					<option value="9">8.5</option>
					<option value="9">9</option>
					<option value="10">9.5</option>
					<option value="10">10</option>
					<option value="11.5">10.5</option>
					<option value="11">11</option>
					<option value="12">11.5</option>
					<option value="12">12</option>
					<option value="13">12.5</option>
					<option value="13">13</option>
					<option value="14">13.5</option>
					<option value="14">14</option>
					<option value="15">14.5</option>
					<option value="15">15</option>
					<option value="16">15.5</option>
					<option value="16">16</option>
					<option value="17">16.5</option>
					<option value="17">17</option>
					<option value="18">17.5</option>
					<option value="18">18</option>
					<option value="19">18.5</option>
					<option value="19">19</option>
					<option value="20">19.5</option>
					<option value="20">20</option>
					<option value="21">20.5</option>
					<option value="21">21</option>
					<option value="22">21.5</option>
					<option value="22">22</option>
					<option value="23">22.5</option>
					<option value="23">23</option>
					<option value="24">23.5</option>
					<option value="24">24</option>
					<option value="24.5">24.5</option>
					<option value="25">25</option>
					<option value="25">25.5</option>
					<option value="26">26</option>
					<option value="27">26.5</option>
					<option value="27">27</option>
					<option value="28">27.5</option>
					<option value="28">28</option>
					<option value="28.5">28.5</option>
					<option value="29">29</option>
					<option value="30">29.5</option>
					<option value="30">30</option>
				</select>            	
				 -->
			</td>
		</tr>
			
		
		<tr>
			<td>Dimensions (en cm)</td>
			<td>
				<input type="text" name="length" id="length" value="10"  class="form-control datepart">
				<input type="text" name="width" id="width" value="10"  class="form-control datepart">
				<input type="text" name="height" id="height" value="10"  class="form-control datepart">
			</td>
		</tr>
         	
		<tr>
			<td></td>
			<td class="pt-3">
				<button id='btnSearch'  type="submit" type="button" class="btn btn-lg btn-block bg-orange" >Afficher >></button>
				<input type="hidden" name="sess_id" id="sess-id" value="603ca2a3bedb6">
			</td>
		</tr>
            

	</table>	
     
	
	</form>
	
 </div>
 





<!---<br> ******************************************* <br><br>-->

<?php require_once('footer.inc') ?>

<script>

$(document).ready(function (){

    var dt = new Date();
    d = dt.getDate();
    m = dt.getMonth()+1;
    dd = d.toString().padStart(2,"0");
    mm = m.toString().padStart(2,"0");
    $("#dd2").val(dd);
    $("#mm2").val(mm);

    $("#myModal").modal({
        backdrop: 'static',
        keyboard: false
    });
    //enableSearch({});
});

function doSubmit(){
//    if(checkDate($("#yy1").val(), $("#mm1").val(), $("#dd1").val()) && 
//        checkDate($("#yy2").val(), $("#mm2").val(), $("#dd2").val()))
        return true;
        
//    alert('dates invalides, veuillez corriger');
//    return false;
}

function checkDate(yy,mm,dd){
    
    y = parseInt(yy); m = parseInt(mm); d = parseInt(dd);

    m31 = [1,3,5,7,8,10,12];
    m30 = [4,6,9,11];
    
    if (d <= 28 && m<=12) return true;
    if (m==2 && y % 4 == 0 && d<=29) return true;
    if (m==2 && y % 4 > 0 && d<=28) return true;
    if (m30.includes(m) && d<=30) return true;
    if (m31.includes(m) && d<=31) return true;
    
    return false;
}

function enableSearch(resp) {
    $("#myModal").modal('hide');
    document.getElementById('btnSearch').disabled = false;
    document.getElementById('btnSearch').classList.remove("disabled");
}

</script>