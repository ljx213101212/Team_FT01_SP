<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>twitter prototype</title>
    <link href="../bootstrap/css/font.css" rel="stylesheet" type="text/css"/>
    <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../bootstrap/css/bootstrap-table.css" rel="stylesheet">
    <script src="../bootstrap/jquery/jquery.min.js"></script>
    <script src="../bootstrap/js/bootstrap.min.js"></script>
    <script src="../bootstrap/js/custome_widget_1.js"></script>
    <script src="../bootstrap/js/bootstrap.js"></script>
    <script src="../bootstrap/js/bootstrap-table.js"></script>
</head>
<body>

<?php
//
//
//$url = 'https://api.twitter.com/1.1/followers/ids.json';
//$url           = 'https://api.twitter.com/1.1/search/tweets.json';
//$getfield      = '?q=%23freebandnames';
//$getfield2     = '';
//$requestMethod = 'GET';
//
//$twitter = new TwitterAPIExchange($settings);
//echo $twitter->setGetfield($getfield)
//              ->buildOauth($url, $requestMethod)
//              ->performRequest();
//$string = json_decode($twitter->setGetfield($getfield)
//                        ->buildOauth($url, $requestMethod)
//                        ->performRequest(),$assoc = TRUE);
//    print_r($string)
//
//
//
//?>

<h1 class="page-header">
Social
</h1>
<span id="stage" style="background-color:#cc0;">
         RESTFUL JSON WILL GET FROM HERE
</span>

<form>

<div class="form-group">
        <div class="col-xs-6 col-md-4">
            <input type="text" class="form-control" id ="hash_text" placeholder="Set Hashtag like: #wedding">
        </div>
</div>
</form>

<button id= "protoType_btn" class="btn btn-default">submit</button>
<?php



//print_r($json)
?>

<table id="table" data-toggle="table" data-toolbar="#toolbar" data-height="460">
    <thead>
    <tr>
        <th data-field="user_img">user_img</th>
        <th data-field="username">username</th>
        <th data-field="text">text</th>
    </tr>
    </thead>
</table>
<script>

       var json_data = Object();
       $("#protoType_btn").click(function(){
//           $.post("twitter_json.php",
//               {
//                   result:value_send
//               },
//                   function(data, status)
//               {
//                   alert("Data: " + data);
//                   json_data = JSON.parse(data);
////                   json_back.result.push(data);
//                    //console.log(json_data);
//                    fill_table(json_data);

           var hash_text =  $("#hash_text").val();
           $.get(
               "twitter_json_REST.php",
               { hash_text: hash_text },
               function(data) {
                   $('#stage').html(data);
                   json_data = JSON.parse(data);
                   //alert(data);
                   fill_table(json_data);
               }
           );

           });

           //console.log(json_data);
          //alert(json_data);


function remove_all_table(){

    $('#table').bootstrapTable('removeAll');
}


function fill_table(json_data){

    if (json_data.length !== 0){


        console.log(json_data['display']);
        $('#table').bootstrapTable('load',build_data(json_data));
//        $('#table').bootstrapTable({
//            columns: [{
//                field: 'user_img',
//                title: 'user_img'
//            }, {
//                field: 'username',
//                title: 'username'
//            }, {
//                field: 'text',
//                title: 'text'
//            }],
//            data: json_data['display']
//        });
    }
}

    function build_data(json_data){
        data = json_data["display"];
        //alert(data.length);
        rows = [];
        for (var i = 0; i < data.length; i++) {
            rows.push({
                user_img: data[i]["user_img"],
                username:  data[i]["username"],
                text:  data[i]["text"]
            });
        }
        return rows;
    }
</script>
</body>
</html>