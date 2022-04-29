# プロダクトのタイトル
DoKoDeMo DJ
〜福岡のパーティー絶対盛り上げる.com〜
## プロダクトの紹介
​
- 呼びたいと思ったらDJを呼ぶ事が出来るサービスのお問い合わせ画面と打合せ画面、進捗状況確認画面を作成しました。
- 打合せ内容がDBに送信され、イベントまでの準備の状況がいつでも確認が出来ます。
- 今後実装予定の機能
  ①Raspberry Piを使った誰でもガヤが表示できるLED掲示板の作成
  ②パーティーのイメージの共有ができる画面
  ③スマホ対応
​
## 操作方法
   <h1>ユーザー側</h1>
   <h2>①TOPページ：https://fukpzm.com/</h2>
   <h2>②打合せの内容と準備の状況が確認できる</h2>
   <h2>③お問い合わせ内容を記載の上、「送信する」ボタンをクリックするとinquiryテーブルにお問い合わせデータが登録される。</h2>

​  <h1>運営側</h1>
  <h2>１：TOP画面</h2>
  TOPページ https://fukpzm.com/ の右上にある「管理者ログイン」ボタンを押す。
  <img width="auto" height="auto" src="https://user-images.githubusercontent.com/96280160/165744652-124f2767-668c-4605-b91b-c381f3d08d6c.png"><br>
  <br>
  <h2>２：ログイン画面</h2>
  ログイン画面に遷移するので、IDとパスワードを入力しログインする。<br>
  ​①ID：aragosta<br>②Password：tonkotsu<br>
  <img width="auto" height="auto"src="https://user-images.githubusercontent.com/96280160/165899372-bdb6271e-0c77-4d38-a032-09e3f07f478e.png">
  ユーザーを登録する場合は、画面下の青字CREATE ACCOUNTをクリックすると<br>
  <img width="auto" height="auto" src="https://user-images.githubusercontent.com/96280160/165904146-8bf29d45-eed4-4983-8cda-170746c6b118.png">
  ボタン名称がCREATE ACCOUNTに変わるのでUserIDとPasswordを入力後ボタンを押すとユーザーが登録されます。<br>
  TOPページに戻りたい場合は、画面下の赤字BACKで戻ります。<br>
  <br>
  <h2>３：問い合わせ一覧画面</h2>
  問い合わせ一覧が表示されるので、確認したい番号の横に「チェック」を入れて右上の「打ち合わせ」ボタンを押す。<br>
  <img width="auto" height="auto" src="https://user-images.githubusercontent.com/96280160/165909840-a3783098-1c19-43a7-90b3-5f03e97b4bb5.png">
  ※複数の問い合わせにチェックを入れて打ち合わせボタンを押すとポップアップが表示されます。<br>
  <img width="auto" height="auto" src="https://user-images.githubusercontent.com/96280160/165910226-6742418e-c4fd-4c87-996a-f5c2769f0933.png">
​  <br>
  <h2>４：打ち合わせ画面</h2>
  打ち合わせ画面が表示される。
  打ち合わせ画面(赤で囲ってある部分)にはお問い合わせで入力された内容が反映されている。
  <img width="auto" height="auto" src="https://user-images.githubusercontent.com/96280160/165915317-62c59d91-6bf6-4197-bc21-0e8231f141c0.png">
  ・セレクトボックスのパーティー種別、会場、DJ、オプションを選択したり、
  <img width="auto" height="auto" src="https://user-images.githubusercontent.com/96280160/165915433-6c55a5de-6d0c-48b6-9f26-10c1c48b7453.png">
  画面左下のカレンダーから日付を選んだり、料金を入力します。<br>
  <img width="auto" height="auto" src="https://user-images.githubusercontent.com/96280160/165915504-ae10ba86-07c4-49fa-a563-c8f14df521c4.png">
  ・画面右上の「予約」ボタンをクリックすると選択したり入力したりした内容が保存されてステータスが予約状態になります。<br>
  <img width="auto" height="auto" src="https://user-images.githubusercontent.com/96280160/165916074-013aba06-9bf7-4652-ab15-69d5a3c54b5b.png">
  <img width="auto" height="auto" src="https://user-images.githubusercontent.com/96280160/165917347-81be3c7b-ead7-45c8-b0fc-ec4f653a4f39.png">
  <img width="auto" height="auto" src="https://user-images.githubusercontent.com/96280160/165917626-8e0f5081-b298-4bee-8ec0-cd0aca944fa4.pngg">
  ・画面右上の「保存」ボタンはステータスが保存状態になるだけで「予約」ボタンと変わらないです。
  　（予約か保存をした場合は、問い合わせ一覧にその内容が反映されます。<br>
  ・画面右上の「クリア」ボタンは入力した内容がすべてリセットされます。<br>
  ・画面右上の「戻る」ボタンは問い合わせ一覧画面に戻ります。<br>
  ・「詳細」、「追加」、「削除」ボタンはまだ未実装です。<br>
  ・会場のマップやＵＲＬの変更も未実装です。（ここは出来ることは確認しています。）<br>
  
  <h2>５：準備のスケジュール状況の登録と更新</h2>
  ・問い合わせ一覧画面に戻り、問い合わせ内容を１つ選び「スケジュール入力」ボタンを押します。
  ・スケジュール入力画面に遷移するので、工程名、開始日付、予定日数、進捗率を入力して、「更新」ボタンを押すとスケジュール
  　が保存されます。
  ・画面上にあるセレクトボックスはまだ機能しないです。
  ・「戻る」ボタンを押すと問い合わせ一覧画面に戻ります。
​
  <h2>６：準備のスケジュール状況の表示</h2>
  ・問い合わせ一覧画面に戻り、問い合わせ内容を１つ選び「スケジュール表示」ボタンを押します。
  ・スケジュール画面に遷移します。ここではスケジュール入力画面で入力された内容がガントチャート形式で表示されます。
  ・画面上にあるセレクトボックスはまだ機能しないです。
  ・「戻る」ボタンを押すと問い合わせ一覧画面に戻ります。
​
  <h2>７：問い合わせの削除</h2>
  ・あまりないと思いますが問い合わせ内容を削除したい場合は、問い合わせ一覧画面に戻り、削除したい問い合わせ内容を選択して
  　「削除」ボタンを押すと削除されます。
  　（複数チェックを入れることで一度に複数削除することが出来ます。）
​
  <h2>８：ログアウト</h2>
  ・管理者機能からログアウトしたい場合は、問い合わせ一覧の右上の「LOGOUT」ボタンを押すことでログアウト出来ます。
  　その後は、ログイン画面に戻ります。