/**
 * Created by dell on 2017/3/13.
 */
var owner = "17816869781";
var count = 0;
//加载时查看未读信息
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
subscribe();
function subscribe(){
    goEasy.subscribe({
        channel: owner,
        onMessage: function(message){
            count++;
            //用伪元素实现好像无法修改content
            $('.tips').text(count);
            $('.tips').addClass('msgM');
            console.log(message.content);
            codecell+='<div class="container qnList" onclick="intoTest('+result[i].questionnaireId+')"><div class="row"><div class="col-xs-7" style="font-size: 18px;">调查表</div> <div class="col-xs-5"><button class="unRead">待填写</button></div></div><div class="row"> <div class="col-xs-3">请填写</div> <div class="col-xs-9 tableName">'+result[i].questionnaireName+'</div> </div> <div class="row"> <div class="col-xs-3">医生叮嘱</div> <div class="col-xs-9 tableName">'+result[i].pushTime+'</div> </div> </div>';
        },
        onSuccess:function(){
            console.log("Subscribe the Channel successfully.");
        },
        onFailed: function(error){
            console.log("Subscribe the Channel failed, error code: "+ error.code + " error message: "+ error.content);
        }
    });
}
$(showMessages);
var codecell;
function showMessages(){
    $.ajax({
        url: 'php/patMessage.php',
        type: 'POST',
        dataType: 'json',
        data: {ownerId: owner},
        success:function(data) {
            //alert(data);
            // 对所获得的json数据进行解析
            var result = eval(data);
            for(var i=0;i<result.length;i++){
                if(result[i].ifRead==0) {
                    count++;
                    $('.tips').text(count);
                    $('.tips').addClass('msgM');
                }
                if(result[i].isFinish==0){
                    codecell+='<div class="container qnList" onclick="intoTest('+result[i].questionnaireId+')"><div class="row"><div class="col-xs-7" style="font-size: 18px;">调查表</div> <div class="col-xs-5"><button class="unRead">待填写</button></div></div><div class="row"> <div class="col-xs-3">请填写</div> <div class="col-xs-9 tableName">'+result[i].questionnaireName+'</div> </div> <div class="row"> <div class="col-xs-3">医生叮嘱</div> <div class="col-xs-9 tableName">'+result[i].pushTime+'</div> </div> </div>';
                }else{
                    codecell+='<div class="container qnList" onclick="intoTest('+result[i].questionnaireId+')"><div class="row"><div class="col-xs-7" style="font-size: 18px;">调查表</div> <div class="col-xs-5"><button class="read">已填写</button></div></div><div class="row"> <div class="col-xs-3">请填写</div> <div class="col-xs-9 tableName">'+result[i].questionnaireName+'</div> </div> <div class="row"> <div class="col-xs-3">医生叮嘱</div> <div class="col-xs-9 tableName">'+result[i].pushTime+'</div> </div> </div>';
                }
            }
            $(".Main").html(codecell);
        }
    });
}
var choose =[];
var code1cell,code2cell;
// intoTest(1);
function intoTest(id){
    id = parseInt(id);
    $.ajax({
        url: 'php/showQues.php',
        type: 'POST',
        dataType: 'json',
        data: {questionnaireId: id},
        success:function(data) {
            alert(data);
            // 对所获得的json数据进行解析
            var result = eval(data);
            for(var i=0;i<result.length;i++){
                code1cell+='<div class="row testLine"><p class="question">'+result[i].Question+'</p>';
                for(var j=0;j<result[i].QuestionDegree;j++){
                    code1cell+='<label class="radioBtn"><input name="test'+i+'" type="radio" value="'+(j+1)+'" />'+(j+1)+'</label>';
                }
                code1cell+='</div>';
                sum[i]=$('input[name="test'+i+'"]:checked').val()
            }
            $(".questionnaireInto").html(code1cell);
        }
    });
    // window.location = "mainTest.html";
}

$(".submit").click(function () {
    var sum=0;
    for(var i=0;i<choose.length;i++){
        sum+=choose[i];
    }
    $.ajax({
        url: 'php/patMessage.php',
        type: 'POST',
        dataType: 'json',
        data: {sum: sum},
        success:function(data) {
            alert(data);
            // 对所获得的json数据进行解析
            var result = eval(data);

        }
    });
});
