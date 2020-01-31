function validateDispatches()
{
var text=document.forms["dispatches"]["dispatch"].value;
alert(text);
if (text==null || text=="")
	{
  alert("Please type something to post!");
  return false;
  }
}
/*function pullTheFeed(uid)
{
	var xmlhttp = new XMLHttpRequest();
	
	xmlhttp.onreadystatechange = function()
	{
		if (xmlhttp.readyState == 4
			&& xmlhttp.status == 200)
			{
				var xml_doc = xmlhttp.responseXML;
				
				var post_list = xml_doc.getElementsByTagName("post");
				if (post_list.length == 0)
				{
						var tryit = "<h3>No Posts</h3>";
						document.getElementById('thefeed').innerHTML = tryit;
				}
				else
				{
					/*****Code here for parsing feed******/
					/*var tryit = "<p></p><table id="feedhometable"><tbody>";
					for (var i = 0; i < post_list.length; i++)
					{
						var userid = post_list[i].getElementsByTagName('userid')[0].textContent;
						var fname = post_list[i].getElementsByTagName('fname')[0].textContent;
						var lname = post_list[i].getElementsByTagName('lname')[0].textContent;
						var content = post_list[i].getElementsByTagName('content')[0].textContent;
						var timestamp = post_list[i].getElementsByTagName('timestamp')[0].textContent;
						var thetime = mysqlTimeStampToDate(timestamp);
						tryit += "<tr><td><h3><a href='profile.php?id=" + userid + "'>" + fname + "&nbsp;" + lname + "</a>";
						var recipientid = post_list[i].getElementsByTagName('recipientid')[0].textContent;
						if (recipientid != "")
							{
								var rfname = post_list[i].getElementsByTagName('rfname')[0].textContent;
								var rlfname = post_list[i].getElementsByTagName('rlname')[0].textContent;
								tryit += " > <a href='profile.php?id=" + recipientid + "'>" + rfname + "&nbsp;" + rlfname + "</a>";
							}
						tryit += "</h3></td><td>" + timestamp + "</td></tr><tr><td><p>" + content + "<p></td></tr>";
					}
					tryit += "</tbody></table>";
					document.getElementById('thefeed').innerHTML = tryit;
				}
			}
	 
	}
	
	xmlhttp.open("GET", "getmyfeed.php", true);
	xmlhttp.send();

}
}
*/