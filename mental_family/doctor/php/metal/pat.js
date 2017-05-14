var userId = "3344";
function searchDoctor() {
    var str = document.getElementById("searchMsg");
    if(str.isEqual("")){
        str = "all";
    }
    var value = $('#searchType option:selected') .val();
    $.ajax({
        url: './php/doclist.php',
        type: 'POST',
        dataType: 'json',
        data: {searchString:str,
            searchType:value},
        success:function(data) {
            // alert(data);
            // 对所获得的json数据进行解析
            var result = eval(data);
            for(var i = 0; i < result.length; i++){
                // alert(result[i].questionnaireId);
                var newTr = $(".resultList").insertRow();
                newTr.style.borderBottomStyle = "1px solid #dddddd";
                var newTd0 = newTr.insertCell(0);  var newTd1 = newTr.insertCell(1);
                var newTd2 = newTr.insertCell(2);  var newTd3 = newTr.insertCell(3);
                newTd0.style.width = "16%";
                newTd1.style.width = "50%";
                newTd2.style.width = "17%";
                newTd3.style.width = "17%";
                newTd0.innerHTML = '<img src="'+result[i].header+'"/>';
                newTd1.innerHTML = '<p style="font-size: 16px;margin: 0;">'+result[i].docName+'</p> <p style="font-size: 12px;margin: 0;">'+result[i].docTag+'</p>';
                newTd2.innerHTML = '<button style="width: 80%;" onclick="docIntro('+result[i].docId+')">查看简介</button>';
                newTd3.innerHTML = '<button style="width: 80%;" onclick="requestDPRelation('+result[i].docId+')">请求随访</button>';
            }
        }
    });
}
function docIntro(id) {
    id=parseInt(id);
    $.ajax({
        url:'./php/doctor.php',
        type:'POST',
        dataType:'json',
        data: {doctorId:id},
        success:function(data) {
            var result = eval(data);
            if(result.length>0){
                //将信息填入已经打完框架的简介页面
                $(".userImg").src = result[0].header;
                $(".doctorName").text = result[0].name;
                $(".docterHospitol").text = result[0].hospitol;
                $(".doctorTags").text = result[0].tags;
            }
        }
    });
    var cell;
    $.ajax({
        url:'./php/docComment.php',
        type:'POST',
        dataType:'json',
        data: {doctorId:id},
        success:function(data) {
            var result = eval(data);
            if(result.length>0){
                //将信息填入已经打完框架的简介页面
                for(var i=0;i<result.length;i++){
                    cell+='<tr> <td>'+result[i].name+'</td> <td>'+result[i].pat+'</td> </tr> <tr> <td><p>'+result[i].comment+'</p></td> </tr>';
                }
            }
            $(".commentList").html = cell;
        }
    });
}

function requestDPRelation(id){
    id = parseInt(id);
    publishMessage(id,"用户"+userId+"请求和你建立随访关系，是否同意？");
    $.ajax({
        url:'./php/docComment.php',
        type:'POST',
        dataType:'json',
        data: {doctorId:id,patientId:userId},//传入数据库将添加一条请求新纪录,随访关系并未建立关系
        success:function(data) {
        }
    });
}

if(typeof GoEasy !== 'undefined'){
    var goEasy = new GoEasy({
        appkey: '8371993d-59bf-4ef0-96bd-9e9416853d13',
        userId:"222",
        username:"22",
        onConnected:function(){
            console.log("Connect to GoEasy success.");
        } ,
        onDisconnected:function(){
            console.log("Disconnect to GoEasy server.");
        } ,
        onConnectFailed:function(error){
            console.log("Connect to GoEasy failed, error code: "+ error.code+" Error message: "+ error.content);
        }
    });
}

$(subscribe);  //接收消息
function subscribe(){
    goEasy.subscribe({
        channel: userId,
        onMessage: function(message){
            console.log('Meessage received:'+message.content);},
        onSuccess:function(){
            console.log("Subscribe the Channel successfully.");
        },
        onFailed: function(error){
            console.log("Subscribe the Channel failed, error code: "+ error.code + " error message: "+ error.content);
        }
    });

}
//推送消息
function publishMessage(paId, msg){
    goEasy.publish({
        channel: paId,
        message: msg,
        onSuccess:function(){
            console.log("Publish message success.");
        },
        onFailed: function(error){
            console.log("Publish message failed, error code: "+ error.code +" Error message: "+ error.content);
        }
    });
}
//不再接收信息
function unsubscribe(){
    goEasy.unsubscribe({
        channel: owner,
        onSuccess: function(){
            console.log("Cancel Subscription successfully.");
        },
        onFailed: function(error){
            console.log("Cancel the subscrition failed, error code: "+ error.code + "error message: "+ error.content);
        }
    });
}