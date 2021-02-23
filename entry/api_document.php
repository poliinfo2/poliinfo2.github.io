<!doctype html>
<html lang="ja"><head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>QALab PoliInfo2 APIマニュアル</title>
  </head>
  <body>
	  <div class="container" style="margin-top:30px;">
          
	  <div class="row">
        <div class="col-12">
			<p class=""><a href="/">QALab PoliInfo2ホームに戻る</a></p>
            <h1 style="margin-top: 10px;">東京都議会会議録データセットAPIマニュアル</h1>
            <p>私たちは，地方議会会議録に関する研究促進に向けて（NTCIR14 QALab-PoliInfo で利用する）東京都議会会議録のデータセットのAPIマニュアルです．</p>
        </div>
			<br>
		<ul>
        <li>2020.01.12 ドキュメントを更新しました。</li>
        <li>2020.02.22 APIのパラメータを追加しました。</li>
        <li>2020.03.06 テスト投稿用testflgのAPIのパラメータを追加しました。</li>
        <li>2020.07.05 tasktypeに「Topic detection task」を追加しました。</li>
      </ul>
      <div class="col-12">
        <h2>投稿API</h2>
        <h3>リクエストURL</h3>
        <p>https://poliinfo2.net/api/post_dataset/</p>
        <p>各パラメータはPOST形式で送信してください。*は必須項目です。<br>
        </p>
        <p style="color:red;" class="text-center"><b>2020/03/06 API投稿フォームでも投稿が可能です。APIフォームはこちら</b><br><br>

			<a class="btn btn-primary btn-lg" href="/entry/api_form.php" target="fms">API投稿フォーム</a>
		  </p>
        <table class="table table-striped table-borderd">
			
  <tr>
    <th>access_token * : STRING</th>
    <td>アクセストークンキー</td>
  </tr>
  <tr>
    <th>tasktype * : INT</th>
    <td>採点するタスクのタイプ(1～3)を指定してください。<br>
		1 : Dialog Summarization task<br>
		2 : Stance Classification task<br>
		3 : Entity Linking task<br>
		4 : Topic detection task</td>
  </tr>
  <tr>
    <th>json or tsv * : STRING</th>
    <td>データセットの形式に基づくjsonテキストあるいは、tsv テキスト</td>
  </tr>
  <tr>
    <th>json_public * : INT</th>
    <td>データを公開してもよい場合は1を、非公開にしたい場合は0を指定してください。</td>
  </tr>
  <tr>
    <th>score_id : INT</th>
    <td>すでにリーダーボードなどで公開されているデータを参照した場合はそのIDを指定してください。</td>
  </tr>
  <tr>
    <th>comment * : STRING</th>
    <td>前回の投稿との差分（変更箇所）が必ずわかるようにSystem descriptionを記載してください。最初の投稿では、どのような方法を用いたかを記載してください。
</td>
  </tr>


</table>
        <p>&nbsp;</p>
      </div>
      <div class="col-12">
        <h3>レスポンス仕様 </h3>
        <p>レスポンス形式：json</p>
        <p>レスポンスデータは採点結果ではなくデータが正常に受付されたかどうかの判定を返します。(採点結果は処理に時間がかかるため、採点が完了次第、登録されたメール宛への通知と合わせて結果が正常な場合はリーダーボードなどに掲載されます)</p>
        <table class="table table-striped table-borderd">
          <tr>
            <th>status</th>
            <td><p>success : 正常にデータを受け付けた場合表示されます<br>
failed : データに不備がある場合表示されます</p></td>
          </tr>
          <tr>
            <th>error_message</th>
            <td><p>statusがfailedの場合、エラー内容が表示されます</p></td>
          </tr>
        </table>
        <p>&nbsp;</p>
      </div>
      <div class="col-12">
        <h4>サンプルレスポンス        </h4>
        <pre class="prettyprint" style="overflow:auto;width:100%;max-height:400px">{
  "status": "success",
  "error_message": ""
}</pre>
      </div>
      <p>&nbsp;</p>
      <div class="col-12">
        <h2>エラー</h2>
        <p>APIに対する不正なURLおよび障害等の理由で返されるHTTPエラーコードは以下のとおりです。 </p>
        <table class="table table-striped table-borderd">
          <tr>
            <th>400<span></span></th>
            <td><p>Bad request. 渡されたパラメータがWeb APIで期待されたものと一致しない場合に
              返されます。このメッセージは何が間違っているか、何が正しくないかを伝えます。</p></td>
          </tr>
          <tr>
            <th>401</th>
            <td>Unauthorized. 許可されていないアクセスであった場合に返されます。</td>
          </tr>
          <tr>
            <th>403</th>
            <td>Forbidden. リソースへのアクセスを許されていないか、利用制限を超えている場合に<br>
              適用されます。</td>
          </tr>
          <tr>
            <th>404</th>
            <td>Not Found. 指定されたリソースが見つからない場合に返されます。</td>
          </tr>
          <tr>
            <th>500<span></span></th>
            <td><p>Internal Server Error. 内部的な問題によってデータを返すことができない場合に返されます。</p></td>
          </tr>
          <tr>
            <th>503<span></span></th>
            <td><p>Service unavailable. 内部的な問題によってデータを返すことができない場合に返されます。</p></td>
          </tr>
        </table>
      </div>
      <p>&nbsp;</p>
      <div class="col-12">
        <h2>利用制限</h2>
        <p>※短時間での集中アクセスが続くなどの場合は一時的に制限をかけさせていただくことがあります</p>
      </div>
    </div> <!-- /container -->	  
      </div>
	  
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	<script type="text/javascript">
		$('#chk').change(function() {
			var val = $('#chk:checked').val();
			if(val){
				$("#btn_entry").prop("disabled", false);				
			}
			else{
				$("#btn_entry").prop("disabled", true);
			}
		});
	
		$("#btn_entry").on("click",function(){
			var sender		= $("#teamName").val();
			var email		= $("#email").val();
			var representativesNname	= $("#representativesNname").val();

			if(sender == "" || email == "" || representativesNname == ""){
				alert("項目をすべて記入してください。");
				return false;
			}
			if(!email.match(/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/)){
				alert("正しくメールアドレスを入れてください。");
				return false;
			}
			if(!confirm('登録内容は正しいですか？申し込みを行います。')){
				/* キャンセルの時の処理 */
				return false;
			}
		});
	</script>
  </body>
</html>