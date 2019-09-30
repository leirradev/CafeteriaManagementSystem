function startTime(){
                var today = new Date();
                var h = today.getHours();
                var m = today.getMinutes();
                var s = today.getSeconds();
				var n = today.getDay();
				var y = today.getYear();
				var month = "";
				var day = "";
				var year = "";
				var a = " ";
                // Add a zero in front of numbers<10
                m = checkTime(m);
                if(h>12){
					h = h- 12;
				}
				h = checkTime(h);
				var mon = (today.getMonth()+1);
				if(mon == 1){
					month = "January";
				}
				else if(mon == 2){
					month = "February";
				}
				else if(mon == 3){
					month = "March";
				}
				else if(mon == 4){
					month = "April";
				}
				else if(mon == 5){
					month = "May";
				}
				else if(mon == 6){
					month = "June";
				}
				else if(mon == 7){
					month = "July";
				}
				else if(mon == 8){
					month = "August";
				}
				else if(mon == 9){
					month = "September";
				}
				else if(mon == 10){
					month = "October";
				}
				else if(mon == 11){
					month = "November";
				}
				else if(mon == 12){
					month = "December";
				}
				if(n==0){
					day = "Sunday";
				}
				else if(n==1){
					day = "Monday";
				}
				else if(n==2){
					day = "Tuesday";
				}
				else if(n==3){
					day = "Wednesday";
				}
				else if(n==4){
					day = "Thursday";
				}
				else if(n==5){
					day = "Friday";
				}
				else if(n==6){
					day = "Saturday";
				}
				if(y == 115){
					year = "2015";
				}
				else if(y == 116){
					year = "2016";
				}
				else if(y == 117){
					year = "2017";
				}
				else if(y == 118){
					year = "2018";
				}
				else if(y == 119){
					year = "2019";
				}
				else if(y == 120){
					year = "2020";
				}
				document.getElementById('time').innerHTML = h+":"+m;
				document.getElementById('date').innerHTML = month + " " + today.getDate() + ", " + year; 
				document.getElementById('day').innerHTML = day; 
                t = setTimeout(function(){startTime()},500);
            }
			function checkTime(i){
                if (i<10)
                {
                    i = "0" + i;
                }
                return i;
            }