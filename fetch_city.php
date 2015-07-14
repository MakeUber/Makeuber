<script>
$(document).ready(function(){
$("select#drop1").change(function(){

var id = $("select#drop1 option:selected").attr('value');
 $("#city").html( "" );
 if (city.length > 0 ) {

 $.ajax({
 type: "POST",
 url: "fetch_state.php",
 data: "city="+city,
 cache: false,
});
 }

});
}
</script>