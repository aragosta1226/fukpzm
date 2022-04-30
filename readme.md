# プロダクトのタイトル
<img width="auto" height="auto" src="https://user-images.githubusercontent.com/96280160/166083787-97ab9f64-de4e-42bf-bbbc-fcf12af71211.png">
<strong>DoKoDeMo DJ</strong><br>
〜福岡のパーティー絶対盛り上げる.com〜<br>

## プロダクトの紹介
​<img width="auto" height="auto" src="https://user-images.githubusercontent.com/96280160/166084038-9d57a81d-91f2-4127-8ca5-16eb430b0417.png">
- 呼びたいと思ったらDJを呼ぶ事が出来るサービス「DoKoDeMo DJ」のお問い合わせ画面・打ち合わせ画面・進捗状況確認画面を作成しました。
- 打ち合わせ内容がDBに送信され、イベントまでの準備の状況がいつでも確認が出来ます。<br>
- 今後実装予定の機能<br>
  ①打ち合わせ画面の「詳細」・「追加」・「削除」ボタン<br>
  ②打ち合わせ画面の会場のマップやＵＲＬの変更<br>
  ③スケジュール入力画面上にあるセレクトボックス<br>
  ④パーティーのイメージの共有のための画面<br>

- 開発担当箇所について<br>
  田中：TOP画面／ログイン画面／問い合わせ一覧画面<br>
  原田：打ち合わせ画面／スケジュール入力画面／スケジュール表示画面<br>
​
## 操作方法
   <h2>[ユーザー側]</h2>
   <h2>１：TOPページ</h2>
   TOPページ https://fukpzm.com/ の一番下に問い合わせフォームがあります。
   <img width="auto" height="auto" src="https://user-images.githubusercontent.com/96280160/165939063-74464f65-7a95-432c-9a8e-3c9f7744e872.png">
   フォームからお問い合わせ内容が送信できる様になっています。
   <img width="auto" height="auto" src="https://user-images.githubusercontent.com/96280160/165939230-684070ae-521c-406f-9981-90f47fd35a84.png">
   ちゃんと送信されると、メッセージが表示されます。
   <img width="auto" height="auto" src="https://user-images.githubusercontent.com/96280160/165939994-672b71e0-1276-43ab-8131-79316e7d8b7c.png">

   <h2>２：DBにお問い合わせ内容が登録される</h2>
   お問い合わせ内容を記載の上、「送信する」ボタンをクリックするとinquiryテーブルにお問い合わせデータが登録される。
   <img width="auto" height="auto" src="https://user-images.githubusercontent.com/96280160/165940594-17467a2e-9421-49cb-ab94-b65c172af45c.png">

​  <h2>[運営側]</h2>
  <h2>１：TOP画面</h2>
  TOPページ https://fukpzm.com/ の右上にある「管理者ログイン」ボタンを押す。
  <img width="auto" height="auto" src="https://user-images.githubusercontent.com/96280160/165744652-124f2767-668c-4605-b91b-c381f3d08d6c.png">
  <br>
  <h2>２：ログイン画面</h2>
  ログイン画面に遷移するので、IDとパスワードを入力しログインする。<br>
  ​①ID：aragosta<br>②Password：tonkotsu<br>
  <img width="auto" height="auto"src="https://user-images.githubusercontent.com/96280160/165899372-bdb6271e-0c77-4d38-a032-09e3f07f478e.png">
  ユーザーを登録する場合は、画面下の青字CREATE ACCOUNTをクリックすると<br>
  <img width="auto" height="auto" src="https://user-images.githubusercontent.com/96280160/165904146-8bf29d45-eed4-4983-8cda-170746c6b118.png">
  ボタン名称がCREATE ACCOUNTに変わるのでUserIDとPasswordを入力後ボタンを押すとユーザーが登録されます。
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
  セレクトボックスのパーティー種別、会場、DJ、オプションを選択したり、
  <img width="auto" height="auto" src="https://user-images.githubusercontent.com/96280160/165915433-6c55a5de-6d0c-48b6-9f26-10c1c48b7453.png">
  画面左下のカレンダーから日付を選んだり、料金を入力します。<br>
  <img width="auto" height="auto" src="https://user-images.githubusercontent.com/96280160/165915504-ae10ba86-07c4-49fa-a563-c8f14df521c4.png">
  画面右上の「予約」ボタンをクリックすると選択したり入力したりした内容が保存されてステータスが予約状態になります。<br>
  <img width="auto" height="auto" src="https://user-images.githubusercontent.com/96280160/165916074-013aba06-9bf7-4652-ab15-69d5a3c54b5b.png">
  <img width="auto" height="auto" src="https://user-images.githubusercontent.com/96280160/165917347-81be3c7b-ead7-45c8-b0fc-ec4f653a4f39.png">
  <img width="auto" height="auto" src="https://user-images.githubusercontent.com/96280160/165917626-8e0f5081-b298-4bee-8ec0-cd0aca944fa4.png">
打ち合わせ画面右上の「保存」ボタンはステータスが保存状態になるだけで「予約」ボタンと変わりません。（予約か保存をした場合は、問い合わせ一覧にその内容が反映されます。<br>
<img width="auto" height="auto" src="https://user-images.githubusercontent.com/96280160/166083494-bb4246ec-7f2c-40ed-8d36-9074e6019416.png">
打ち合わせ画面右上の「クリア」ボタンは入力した内容がすべてリセットされます。<br>
<img width="auto" height="auto" src="https://user-images.githubusercontent.com/96280160/166083565-fe56acd8-976a-44b2-9125-0c7fce6611bc.png">
打ち合わせ画面右上の「戻る」ボタンは問い合わせ一覧画面に戻ります。<br>
<img width="auto" height="auto" src="https://user-images.githubusercontent.com/96280160/166083635-ef6f7278-1903-4ec8-a4f2-e97001c0a3d5.png">
打ち合わせ画面の「詳細」・「追加」・「削除」ボタンと、会場のマップやＵＲＬの変更は未実装です。（ここは出来ることは確認しています。）<br>
<img width="auto" height="auto" src="https://user-images.githubusercontent.com/96280160/165937444-54fb5876-4f8b-4785-bef6-28a56a20273a.png">

  <h2>５：準備のスケジュール状況の登録と更新</h2>
  問い合わせ一覧画面に戻り、問い合わせ内容を１つ選び「スケジュール入力」ボタンを押します。
  <img width="auto" height="auto" src="https://user-images.githubusercontent.com/96280160/165936963-3cf88f93-43b8-49b0-b771-eea82f5e56d5.png">
  スケジュール入力画面に遷移するので、「工程名」・「開始日付」・「予定日数」・「進捗率」を入力して、「更新」ボタンを押すとスケジュール
  　が保存されます。※画面上にあるセレクトボックスはまだ機能しません。
  <img width="auto" height="auto" src="https://user-images.githubusercontent.com/96280160/165936579-0e4e6b3b-895a-4340-b34c-208f3e3689fa.png">
 「戻る」ボタンを押すと問い合わせ一覧画面に戻ります。
​
  <h2>６：準備のスケジュール状況の表示</h2>
  問い合わせ一覧画面に戻り、問い合わせ内容を１つ選び「スケジュール表示」ボタンを押します。
  <img width="auto" height="auto" src="https://user-images.githubusercontent.com/96280160/165937895-f477e547-73ea-4de9-b21a-c3c8ade4d7af.png">
 スケジュール画面に遷移します。ここではスケジュール入力画面で入力された内容がガントチャート形式で表示されます。<br>
 ※画面上にあるセレクトボックスはまだ機能しないです。スケジュールを入力していない場合は何も表示されません。<br>
 <img width="auto" height="auto" src="https://user-images.githubusercontent.com/96280160/166083270-7c035657-fac3-4908-a5b7-a8ed4898bc30.png">
 「戻る」ボタンを押すと問い合わせ一覧画面に戻ります。

​
  <h2>７：問い合わせの削除</h2>
  あまりないと思いますが問い合わせ内容を削除したい場合は、問い合わせ一覧画面に戻り、削除したい問い合わせ内容を選択して
  「削除」ボタンを押すと削除されます。
  （複数チェックを入れることで一度に複数削除することが出来ます。）
  <img width="auto" height="auto" src="https://user-images.githubusercontent.com/96280160/165938457-9611fa92-139e-409c-991b-097452451b0a.png">
​
  <h2>８：ログアウト</h2>
　　管理者機能からログアウトしたい場合は、問い合わせ一覧の右上の「LOGOUT」ボタンを押すことでログアウト出来ます。
  　その後は、ログイン画面に戻ります。
  <img width="auto" height="auto" src="https://user-images.githubusercontent.com/96280160/165942267-c5567aca-36c3-410c-a049-7fcfaf2b025c.png">
​