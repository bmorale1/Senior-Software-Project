var globalsearch;

$('document').ready(function() {

    $("#userForm").validate({
        rules: {
            q: {
                required: true
            }
        },
        messages: {
            q: "Please enter a search term"
        },
        submitHandler: submitForm
    });
    

    function submitForm() {
        //Event.preventDefault;
        globalsearch = $("#userForm").serialize();
        var date = new Date();
        var todaysdate = formatCurrentDate(date);
        globalsearch += "&datetime_utc.gt=" + todaysdate;         
        console.log(globalsearch);

       
        $.ajax({
            type: 'GET',
            url: '/services/events.php',
            data: globalsearch,
            async: true,
            dataType: 'json'
            /*success: function(response){
                console.log(response);
            },
            complete: function(response, textStatus) {
                //console.log(response);
                //console.log($.parseJSON(response.responseText));
                
                // alert("Hey: ");
              } */

        }).done(function(data){
            $("#main").empty();
            $("#main").append("<div id='result'></div>");
            /* $("#result").append(
                $('<pre>').text(
                    JSON.stringify(data, null, ' ')
                )
            ); */
            $(data.events).each(function(index, value){
                
                $("#result").append(
                  "<p>"+value.title+"</p><br><h3>"+value.venue.name+",<br>"+value.venue.city+","+
                  value.venue.country+"</h3><br>"
                );  
                
                var date = new Date(value.datetime_local);
                
                if(value.time_tbd){
                    $("#result").append(
                        "<h4>Time: TBA</h4><h4>Estimated date:  "+date.getDate()+"/"+(date.getMonth()+1)+"/"+
                        date.getFullYear()+"</h4>"
                      ); 
                }else{
                    $("#result").append(
                        "<h4>Time: "+ formatAMPM(date)
                        +"</h4><h4>Date:  "+date.getDate()+"/"+(date.getMonth()+1)+"/"+
                        date.getFullYear()+"</h4>"
                      );
                }
                $("#result").append(
                    "<h4>Type: "+value.type+"</h4>"+"<button type='button' value= "+value.id+
                    " onclick='eventdetail(this)'>More Information</button> <hr>"
                  );
                /* var taxs = "";
                if(value.taxonomies != null){
                    $(value.taxonomies).each(function(index1, value1){
                        taxs += taxs +"<li>"+value1.name+"</li>";
                    });
                    $("#result").append(
                        "<ul>"+taxs+"</ul><hr>"
                      );
                } */

            });

            if(data.meta.total > 1){
                var pages = Math.ceil(data.meta.total / 10);
                if(data.meta.page < pages){
                    pageq = data.meta.page + 1;
                    $("#main").append("<button id='pagination' type='button' value= '&page="+pageq+
                    "' onclick='eventinfo(this)'>NEXT PAGE</button>");
                }
                if(data.meta.page > 1){
                    pageq = data.meta.page - 1;
                    $("#main").append("<button id='pagination' type='button' value= '&page="+pageq+
                    "' onclick='eventinfo(this)'>PREVIOUS PAGE</button>");
                }
                //console.log(searchdata);
            }
            console.log(data);
            //console.log(date); 
        });
        return false;
    }

    /* $("#pagination").click(function() {
        var value = $(this).attr("value");
        console.log("value");
    }); */

    
}); 

function formatAMPM(date) {
    var hours = date.getHours();
    var minutes = date.getMinutes();
    var ampm = hours >= 12 ? 'pm' : 'am';
    hours = hours % 12;
    hours = hours ? hours : 12; // the hour '0' should be '12'
    minutes = minutes < 10 ? '0'+minutes : minutes;
    var strTime = hours + ':' + minutes + ' ' + ampm;
    return strTime;
}

function formatCurrentDate(date){
    var yyyy = date.getFullYear().toString();
    var mm = (date.getMonth()+1).toString();
    var dd  = date.getDate().toString();

    var mmChars = mm.split('');
    var ddChars = dd.split('');

    return yyyy + '-' + (mmChars[1]?mm:"0"+mmChars[0]) + '-' + (ddChars[1]?dd:"0"+ddChars[0]);
 }



function eventinfo(param1) {
        

        var qvalue = globalsearch + param1.value;
        console.log(qvalue);

        $.ajax({
            type: 'GET',
            url: '/services/events.php',
            data: qvalue,
            async: true,
            dataType: 'json'
            /*success: function(response){
                console.log(response);
            },
            complete: function(response, textStatus) {
                //console.log(response);
                //console.log($.parseJSON(response.responseText));
                
                // alert("Hey: ");
              } */

        }).done(function(data){
            $("#main").empty();
            $("#main").append("<div id='result'></div>");
            /* $("#result").append(
                $('<pre>').text(
                    JSON.stringify(data, null, ' ')
                )
            ); */
            $(data.events).each(function(index, value){
                
                $("#result").append(
                  "<p>"+value.title+"</p><br><h3>"+value.venue.name+",<br>"+value.venue.city+","+
                  value.venue.country+"</h3><br>"
                );  
                
                var date = new Date(value.datetime_local);
                
                if(value.time_tbd){
                    $("#result").append(
                        "<h4>Time: TBA</h4><h4>Estimated date:  "+date.getDate()+"/"+(date.getMonth()+1)+"/"+
                        date.getFullYear()+"</h4>"
                      ); 
                }else{
                    $("#result").append(
                        "<h4>Time: "+formatAMPM(date)
                        +"</h4><h4>Date:  "+date.getDate()+"/"+(date.getMonth()+1)+"/"+
                        date.getFullYear()+"</h4>"
                      );
                }
                $("#result").append(
                    "<h4>Type: "+value.type+"</h4>"+"<button type='button' value= "+value.id+
                    " onclick='eventdetail(this)'>More Information</button> <hr>"
                  );
                /* var taxs = "";
                if(value.taxonomies != null){
                    $(value.taxonomies).each(function(index1, value1){
                        taxs += taxs +"<li>"+value1.name+"</li>";
                    });
                    $("#result").append(
                        "<ul>"+taxs+"</ul><hr>"
                      );
                } */

            });

            if(data.meta.total > 1){
                var pages = Math.ceil(data.meta.total / 10);
                if(data.meta.page < pages){
                    pageq = data.meta.page + 1;
                    $("#main").append("<button id='pagination' type='button' value= '&page="+pageq+
                    "' onclick='eventinfo(this)'>NEXT PAGE</button>");
                }
                if(data.meta.page > 1){
                    pageq = data.meta.page - 1;
                    $("#main").append("<button id='pagination' type='button' value= '&page="+pageq+
                    "' onclick='eventinfo(this)'>PREVIOUS PAGE</button>");
                }
                //console.log(searchdata);
            }
            console.log(data);
            window.scrollTo(0,0);
            //console.log(date); 
        });


        return false;
    }

function eventdetail(eventid){
    var queryString = "?id=" + eventid.value;
    window.location.href = "../eventPage.html" + queryString;
}