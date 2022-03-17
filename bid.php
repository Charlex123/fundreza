<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    </head>
    <body>
        <div>
            <input type="text" name="numb" id="numb">
            <button onclick="sendtron()">Can you get tronweb from tronlink?</button>
      </div>
    <script>
        function sendtron(){
        var obj = setInterval(async ()=>{
            if (window.tronWeb && window.tronWeb.defaultAddress.base58) {
                clearInterval(obj)
                var tronweb = window.tronWeb
                var amount = document.querySelector('#numb').value;
                var tokens = amount * 1000000
                var tx = await tronweb.trx.sendTransaction("TWs2Z7dLMcPnXi9pnWqCUPzAnqUv6T54dy", tokens)
                var signedTx = await tronweb.trx.sign(tx)
                var broastTx = await tronweb.trx.sendRawTransaction(signedTx)
                console.log(broastTx);
                
            }
        });
    }
    </script>
    </body>
</html>