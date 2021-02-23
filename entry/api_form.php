<!doctype html>
<html lang="ja"><head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>QALab PoliInfo2 API投稿フォーム</title>
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
        <li>2020.07.05 tasktypeに「Topic detection task」を追加しました。</li>
      </ul>
      <div class="col-12">
        <h2>投稿API</h2>
        <h3>リクエストURL</h3>
        <p>https://poliinfo2.net/api/post_dataset/</p>
        <p>各パラメータはPOST形式で送信してください。*は必須項目です。<br>
        </p>
	  <form action="/api/post_dataset/" method="post" >
        <table class="table table-striped table-borderd">
  <tr>
    <th>access_token * : STRING</th>
    <td>アクセストークンキー		<br>
<input name="access_token" value="" /></td>
  </tr>
  <tr>
    <th>tasktype * : INT</th>
    <td>
		採点するタスクのタイプ(1～4)を指定してください。<br>
		<select name="tasktype" id="tasktype">
			<option value="1">Dialog Summarization task</option>
			<option value="2">Stance Classification task</option>
			<option value="3">Entity Linking task</option>
			<option value="4">Topic detection task</option>
		</select>
	</td>
  </tr>
  <tr>
    <th>json or tsv * : STRING</th>
    <td>データセットの形式に基づくjsonテキスト、あるいはtsvテキスト<br>
		<textarea name="json"></textarea>
</td>
  </tr>
  <tr>
    <th>json_public * : INT</th>
    <td>データを公開してもよい場合は1を、非公開にしたい場合は0を指定してください。<br>

	  		<select name="json_public" id="json_public">
			<option value="1">公開</option>
			<option value="0">非公開</option>
		</select>

	  </td>
  </tr>
  <tr>
    <th>score_id : INT</th>
    <td>すでにリーダーボードなどで公開されているデータを参照した場合はそのIDを指定してください。<br>
		<input name="score_id" value="" />
</td>
  </tr>
  <tr>
    <th>comment * : STRING</th>
    <td>前回の投稿との差分（変更箇所）が必ずわかるようにSystem descriptionを記載してください。最初の投稿では、どのような方法を用いたかを記載してください。
<br>
		<textarea name="comment"></textarea>

	  </td>
  </tr>
  <tr>
    <th></th>
    <td><br>
		<input name="testflg" type="hidden" value="0" />
	  </td>
  </tr>


</table>
		  <p class="text-center"><input class="btn btn-primary" type="submit" value="投稿する" /></p>
</form>
      </div>
    </div> <!-- /container -->	  
      </div>
	  
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>