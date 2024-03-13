<?php
echo <<<MENU1
<!DOCTYPE html>
<html>
<head>
    <title>Menu</title>
</head>
<body>
    Your options are <br>
    <table width="70%" border="0" cellspacing="0" align="center">
        <tr>
            <td bgcolor="#DCEFFE"><div align="center">
                <a href="https://bioinfmsc8.bio.ed.ac.uk/~$username/p1.php">Select Suppliers</a>
            </div></td>
            <td bgcolor="#DCEFFE"><div align="center">
                <a href="https://bioinfmsc8.bio.ed.ac.uk/~$username/p2.php">Search Compounds</a>
            </div></td>
            <td bgcolor="#DCEFFE"><div align="center">
                <a href="https://bioinfmsc8.bio.ed.ac.uk/~$username/p3.php">Stats</a>
            </div></td>
            <td bgcolor="#DCEFFE"><div align="center">
                <a href="https://bioinfmsc8.bio.ed.ac.uk/~$username/p4.php">Correlations</a>
            </div></td>
            <td bgcolor="#DCEFFE"><div align="center">
                <a href="https://bioinfmsc8.bio.ed.ac.uk/~$username/p5.php">Exit</a>
            </div></td>
        </tr>
    </table>
</body>
</html>
MENU1;
?>
