<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
<title>A JSmol and Smile Draw Demo</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://bioinfmsc8.bio.ed.ac.uk/Als_stylesheet_2324.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="./jsmol/JSmol.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
    var Info = {
        width: 500,
        height: 500,
        debug: false,
        j2sPath: "jsmol/j2s",
        color: "0xC0C0C0",
        disableJ2SLoadMonitor: true,
        disableInitialConsole: true,
        addSelectionOptions: false,
        readyFunction: null,
        src: "https://bioinfmsc8.bio.ed.ac.uk/~aivens2/Oai40000.sdf"
    }
    $("#jsmolDiv").html(Jmol.getAppletHtml("jmolApplet0",Info));
});

function validate(form) {
    var fail = validatefield(form.smile.value);
    if(fail == "") {
        return true;
    } else {
        alert(fail);
        return false;
    }
}

function validatefield(field) {
    if(field == "") return "No smile string entered ";
    else return "";
}
</script>
<style>
.container {
    display: flex;
    justify-content: space-around;
}
</style>
</head>
<body>
<?php session_start(); ?>
<div class="container">
    <div id="jsmolDiv" style="width: 50%;"><!-- JSmol will be here --></div>
    <div style="width: 50%;">
        <h3>Give me a smile please! &#x1F603;</h3>
        <br/> <font style="font-size: 20px;">An example for you: [H]OC2=C([H])C([H])=C([H])C([H])=C2(C([H])=NN([H])C(=O)C1=C([H])C([H])=NC([H])=C1([H]))</font>
        <form  action="draw_my_smile_NIH.php" method="post" onSubmit="return validate(this)">
            <p>Smile string <input type="text" size="100" name="smile" /> </p>
            <p><input type="Submit" value="Retrieve NIH structure!" /></p>
        </form>
    </div>
</div>
<?php session_destroy(); ?>
</body>
</html>
