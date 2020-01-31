function mysqlTimeStampToDate(timestamp) {
    //function parses mysql datetime string and returns javascript Date object
    //input has to be in this format: 2007-06-05 15:26:02
    var regex=/^([0-9]{2,4})-([0-1][0-9])-([0-3][0-9]) (?:([0-2][0-9]):([0-5][0-9]):([0-5][0-9]))?$/;
    var parts=timestamp.replace(regex,"$1 $2 $3 $4 $5 $6").split(' ');
    return new Date(parts[0],parts[1]-1,parts[2],parts[3],parts[4],parts[5]);
}
function validateDispatches()
{
var text=document.forms["dispatches"]["dispatch"].value;
if (text==null || text=="")
	{
  alert("Please type something to post!");
  return false;
  }
}
function pullTheFeed(uid)
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
					var tryit = "<p></p><table id=\"feedhometable\"><tbody>";
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
						tryit += "</h3></td><td style=\"margin-left:400px;\">" + timestamp + "</td></tr><tr><td><p>" + content + "<p></td></tr>";
					}
					tryit += "</tbody></table>";
					document.getElementById('thefeed').innerHTML = tryit;
				}
			}
	 
	}
	
	xmlhttp.open("GET", "getmyfeed.php", true);
	xmlhttp.send();

}
function printFriendsList(userid)
{
	var xmlhttp = new XMLHttpRequest();

	xmlhttp.onreadystatechange = function() 
	{
		if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
			{ 
				var xml_doc = xmlhttp.responseXML;
				var friends_list = xml_doc.getElementsByTagName('friend');
				if (friends_list.length> 0)
				{
					var friendshtml = "<p></p><table id='friendsTable' >";
					for(var i = 0; i < friends_list.length; i += 1)
					{
						var userid = friends_list[i].getElementsByTagName('userid')[0].textContent;
						var fname = friends_list[i].getElementsByTagName('fname')[0].textContent;
						var lname = friends_list[i].getElementsByTagName('lname')[0].textContent;
						var friendsstatus =  parseInt(friends_list[i].getElementsByTagName('friendsstatus')[0].textContent);
						friendshtml += "<tr><td><a href='profile.php?id=" + userid + "' 'alt='" + fname + " " + lname + "\'s Profile'><h3>"  + fname + " " + lname + "</h3></a></td><td>";
						switch(friendsstatus)
						{
							case -1:
								friendshtml += "My Profile <img src='check.png' width='12' height='13' />";
								break;
							case 0:
								friendshtml += "<button type=\"button\" style=\"font: 24px;\" onclick=\"window.location = 'addfriend.php?id=" + userid + "';\">+1 Friend</button>";
								break;
							case 1:
								friendshtml += "<img src='check.png' width='12' height='13' />Friends";
								break;
							case 2:
								friendshtml += "Friend request pending!";
								break;
							case 3:
								friendshtml += "This user wants to be friends. <button type='button' onclick=\"window.location = 'addfriend.php?id=" + userid + "';\">Approve</button> <button type='button' onclick=\"window.location = 'denyrequest.php?id=" + userid + "';\">Deny</button>";
								break;
							default:
								friendshtml += "we;ve got a problem";
						}
						
						 friendshtml += "</td></tr>";
				
					} 
					friendshtml += "</table>";
					document.getElementById('friendslist').innerHTML = friendshtml;
	
				} 
			}

	}
	xmlhttp.open("GET","getfriends.php?id=" + userid, true)
	xmlhttp.send()
}

/***********Pull the Friend Feed from the for the Friends/Homepage********************/

function printFriendsPageList(userid)
{
	var xmlhttp = new XMLHttpRequest();

	xmlhttp.onreadystatechange = function() 
	{
		if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
			{ 
				var xml_doc = xmlhttp.responseXML;
				var friends_list = xml_doc.getElementsByTagName('friend');
				if (friends_list.length> 0)
				{
					var friendshtml = "<p></p><h2>You have " + friends_list.length + " friends</h2><table id='friendsPageTable' >";
					for(var i = 0; i < friends_list.length; i += 1)
					{
						var userid = friends_list[i].getElementsByTagName('userid')[0].textContent;
						var fname = friends_list[i].getElementsByTagName('fname')[0].textContent;
						var lname = friends_list[i].getElementsByTagName('lname')[0].textContent;
						var friendsstatus =  parseInt(friends_list[i].getElementsByTagName('friendsstatus')[0].textContent);
						friendshtml += "<tr><td><a href='profile.php?id=" + userid + "' 'alt='" + fname + " " + lname + "\'s Profile'><h3>"  + fname + " " + lname + "</h3></a></td><td>";
						switch(friendsstatus)
						{
							case -1:
								friendshtml += "My Profile <img src='check.png' width='12' height='13' />";
								break;
							case 0:
								friendshtml += "<button type=\"button\" style=\"font: 24px;\" onclick=\"window.location = 'addfriend.php?id=" + userid + "';\">+1 Friend</button>";
								break;
							case 1:
								friendshtml += "<img src='check.png' width='12' height='13' />Friends";
								break;
							case 2:
								friendshtml += "Friend request pending!";
								break;
							case 3:
								friendshtml += "This user wants to be friends. <button type='button' onclick=\"window.location = 'addfriend.php?id=" + userid + "';\">Approve</button> <button type='button' onclick=\"window.location = 'denyrequest.php?id=" + userid + "';\">Deny</button>";
								break;
							default:
								friendshtml += "we;ve got a problem";
						}
						
						 friendshtml += "</td></tr>";
				
					} 
					friendshtml += "</table>";
					document.getElementById('friendslist').innerHTML = friendshtml;
	
				}
				else
				{
					document.getElementById('friendslist').innerHTML = "<h3>You have no friends :(</h3>";
				} 
			}

	}
	xmlhttp.open("GET","getfriends.php?id=" + userid, true)
	xmlhttp.send()
}
		

function printFriendsListold(userid)
{
	var xmlhttp = new XMLHttpRequest();

	xmlhttp.onreadystatechange = function()
	{
		if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
			{ 
			xmlDoc = xmlhttp.responseXML;
			var root = xmlDoc.documentElement;
			var friends = root.getElementsByTagName("friend");
			document.write("<table border=\"1\"><tbody><tr><th>Userid</th><th>First Name</th><th>Last Name</th>");
			for(var i = 0; i < friends.length; i += 1)
			{
				var fuserid = friends[i].getElementsByTagName("userid");
				var fname = friends[i].getElementsByTagName("fname");
				var lname = friends[i].getElementsByTagName("lname");
				document.write("<tr><td>");
				document.write(fuserid[0].textContent);
				document.write("</td><td>");
				document.write(fname[0].textContent);
				document.write("</td><td>");
				document.write(lname[0].textContent);
				document.write("</td></tr>");
			}
			document.write("</tbody></table>");
			}

	}
	var fListURL="getfriends.php?id=" + userid;
	xmlhttp.open("GET", fListURL, true)
	xmlhttp.send()
}
