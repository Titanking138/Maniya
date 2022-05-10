<?php
include_once("include/header.php");
?>

<div class="textBoxContainer">
    <input type="text" class="searchInput" name="searchInput" id="searchInput" placeholder="search for somthing">
</div>

<div class="results"></div>

<script>

    $(function () {
        var username = '<?php echo $userLoggedIn; ?>'
        var timer;

        $(".searchInput").keyup(function () {
            clearTimeout(timer);
            timer = setTimeout(function () {
                var val = $(".searchInput").val();
                
                if(val != "")
                {
                    $.post("ajax/getSearchResult.php",{term:val,username:username},function(data){
                        $(".results").html(data);
                    })
                }
                else{
                    $(".results").html("");
            }, 500);
        })
    })

</script>