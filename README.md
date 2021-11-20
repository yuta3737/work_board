#### アプリケーション名
野球掲示板
#### アプリケーション概要
野球について語ることのできるアプリケーションです。
#### URL
https://enigmatic-dusk-59032.herokuapp.com/
#### 制作意図
プロ野球などの野球の試合が行われた後は、誰でも誰かと感想を言い合いたいものだと思い、この掲示板を作りました。

#### 工夫したポイント
<img src="https://user-images.githubusercontent.com/75056980/142674043-7d37a329-6d3d-4054-a074-09a50b16234a.gif" width="50%">

YouTube APIを使用し、掲示板に投稿する際にコメントをチェックしながら関連度の高いYouTubeの動画を見ることが出来るようにしました。  

<img src="https://user-images.githubusercontent.com/75056980/142674062-a6d46db1-ac10-4267-b4c0-ad9e6ebcb6b3.gif" width="50%"><img src="https://user-images.githubusercontent.com/75056980/142674072-6b9ce028-709e-462f-b28b-6920dd377efd.gif" width="50%">

ユーザーが使いやすいようになるべくページを移動しなくてもよい構造にしました  
具体的には、JavaScriptを使用することでコメントを新規投稿、編集する際にページを移動しなくても良いようにしました。  
コメントに対する返信もできるようになっています。

##### 課題
YouTubeを表示しているためページを開く時間が通常より長いこと
##### 今後実装したい機能
ログインしていない場合コメントができないようにする機能
