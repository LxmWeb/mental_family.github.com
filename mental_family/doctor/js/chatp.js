	var owner = "17816869781";
var doc = "17816869761";
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
    //接收信息        
//  subscribe();  
    function subscribe(){  
             goEasy.subscribe({  
                channel: owner,  
                onMessage: function(message){  
					var get = '<li id="receive">' + message.content +'</li>';
					$(".c-view").append(get);
					// 内容过多时,将滚动条放置到最底端
					var h = $(".c-view")[0].scrollHeight;
					$(".c-view").scrollTop(h); 
                },  
                onSuccess:function(){  
                    console.log("Subscribe the Channel successfully.");  
  
                },  
                onFailed: function(error){  
                    console.log("Subscribe the Channel failed, error code: "+ error.code + " error message: "+ error.content);  
  
                }  
  
            });  
  
    }  
    //推送消息         
     function publishMessage(msg){  
          goEasy.publish({  
                channel: doc,  
                message: msg,  
                onSuccess:function(){  
					var po = '<li id="publish">' + msg + '</li>';
					$(".c-view").append(po);	
					// 内容过多时,将滚动条放置到最底端
					var h = $(".c-view")[0].scrollHeight;
					$(".c-view").scrollTop(h); 				
  
                },  
                onFailed: function(error){  
  
                    console.log("Publish message failed, error code: "+ error.code +" Error message: "+ error.content);  
  
                }  
            });  
       
     }  
                    
     function unsubscribe(){  
                goEasy.unsubscribe({  
                    channel:"httishere",  
                    onSuccess: function(){  
  
                        console.log("Cancel Subscription successfully.");  
  
                    },  
                    onFailed: function(error){  
  
                        console.log("Cancel the subscrition failed, error code: "+ error.code + "error message: "+ error.content);  
                    }  
  
                });  
            }  
          