function addrow()
{
var g=loadXMLDoc("t1.xml");
xg=g.getElementsByTagName("molecule");
for (i=0;i<xg.length;i++)
  { 
  var x1=document.getElementById('table1').insertRow(1);
  var n=x1.insertCell(0);
  var x=x1.insertCell(1);
  var y=x1.insertCell(2);
  var z=x1.insertCell(3);
  n.innerHTML=xg[i].getAttribute("id");
  var xgaa = xg[i].firstChild;
  while ((xgaa != null) && (xgaa.nodeType == 3)) xgaa = xgaa.nextSibling;	
  var xaaa = xgaa.firstChild;
  var sumx = 0.0;
  var sumy = 0.0;
  var sumz = 0.0;
  var natm = 0;
  while (xaaa!= null) {
     if(xaaa.nodeType != 3) {
       sumx = sumx + parseFloat(xaaa.getAttribute("x3"));
       sumy = sumy + parseFloat(xaaa.getAttribute("y3"));
       sumz = sumz + parseFloat(xaaa.getAttribute("z3"));
       natm = natm + 1;
     }
     xaaa = xaaa.nextSibling;
  }
  x.innerHTML = sumx / natm;
  y.innerHTML = sumy / natm;
  z.innerHTML = sumz / natm;

     
  }
}
function loadXMLDoc(filename)
{
if (window.XMLHttpRequest)
  {
  xhttp=new XMLHttpRequest();
  }
else // code for IE5 and IE6
  {
  xhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xhttp.open("GET",filename,false);
xhttp.send();
return xhttp.responseXML;
}

