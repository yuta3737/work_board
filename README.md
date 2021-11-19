アプリケーション名
野球掲示板
アプリケーション概要
野球について語ることのできるアプリケーションです。
URL
https://enigmatic-dusk-59032.herokuapp.com/
制作意図
プロ野球などの野球の試合が行われた後は、誰でも誰かと感想を言い合いたいものだと思い、この掲示板を作りました。
![編集切り替え](https://user-images.githubusercontent.com/75056980/142479727-feb16d6b-4bc4-43c6-99ad-2176416f552c.gif)
![返信](https://user-images.githubusercontent.com/75056980/142479754-8cd3dd87-4adc-43d0-a40c-769c2510c911.gif)
工夫したポイント
・YouTube APIを使用し、掲示板に投稿する際にコメントをチェックしながら関連度の高いYouTubeの動画を見ることが出来るようにしました。
・ユーザーが使いやすいようになるべくページを移動しなくてもよい構造にしました。
具体的には、JavaScriptを使用することでコメントを新規投稿、編集する際にページを移動しなくても良いようにしました。
コメントに対する返信もできるようになっています。
使用技術

課題
YouTubeを表示しているためページを開く時間が通常より長いこと
今後実装したい機能
ログインしていない場合コメントができないようにする機能
