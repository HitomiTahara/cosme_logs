# Part 2： アプリケーションの作り方

## 目的

- プログラムの作り方を学ぶ
- 基礎的な PHP の使い方を学ぶ
- アプリケーション作成の全体像を把握する

## 何を作るのか

コスメログサービスを作成します。
自分が化粧品を登録し、表示できるサービスです。

## 要件

1. コスメログを登録できる（コスメ名、メーカー名、使用期限、おすすめ度、備考）
2. コスメログを表示できる

## 開発ステップ

### 1. テキスト版アプリケーション (CLI で動作するアプリケーション) を作成

1. コスメログを表示できる
2. コスメログを登録できる
3. メニュー化し、アプリケーションとして動作できる
4. 複数のコスメログを登録できる

### 2. アプリケーションをデータベースに対応させる

1. コスメログを保存するテーブルを作成する
2. コスメログをデータベースに登録できる
3. コスメログをデータベースから表示できる

### 3. Web アプリケーション (HTML で動作するアプリケーション) を作成

1. 登録画面でコスメログを登録できる
2. 一覧画面でコスメログを表示できる

### 4. Heroku を使用してアプリケーションを Web 上に公開

<!-- サービス停止のため変更するかも -->

1. Heroku のアカウントを作成する
2. Heroku 上でアプリケーションを動作できる

## 環境構築

```bash
# Docker イメージのビルド
docker-compose build

# Docker コンテナの起動
docker-compose up -d

# Docker コンテナ内でコマンドを実行する
docker-compose exec app php -v

# Docker コンテナの停止・削除
docker-compose down
```

## Docker でよく使うコマンド

```bash
# コンテナの一覧と起動状態を確認する
docker-compose ps

# ログを確認する
docker-compose logs app

# コンテナ内で bash を操作する（コンテナ起動中のみ）
docker-compose exec app /bin/bash
```

## Docker で困ったら

### コンテナがうまく起動しないとき

下記のコマンドでログを確認して、ログに合わせて対応します。

```bash
# コンテナの起動状態を確認する
docker-compose ps

# 起動していないコンテナのログを確認する
docker-compose logs app
docker-compose logs db
```

対応したらコンテナを起動します。

```bash
# Docker コンテナの起動
docker-compose up -d

# コンテナの起動状態を確認する
docker-compose ps
```

Dockerfile 周りの対応を行った場合は、イメージから作り直します。

```bash
# Docker コンテナの停止・削除
docker-compose down

# Docker イメージのビルド
docker-compose build

# Docker コンテナの起動
docker-compose up -d

# コンテナの起動状態を確認する
docker-compose ps
```

### 上記の対応をしてもコンテナが起動しない場合

Docker 関連のファイルが変更されている可能性があるので、初期の状態に戻します。

```bash
# dokugaku-engineer/server-side リポジトリをクローンする
git clone https://github.com/dokugaku-engineer/server-side.git

# part 2 のソースコードを任意のディレクトリにコピーする
cp -r sever-side/part2 -t ~/Documents/code

# part2 のディレクトリに移動します
cd  ~/Documents/code/part2
```

Docker 関連のファイルを初期状態に戻した上で、src ディレクトリに設置していたファイルを、 ~/Documents/code/part2/src にコピーして持ってきます。

### それでも起動しない場合

- Docker Desktop を再起動します
- PC を再起動します

### ハードディスクの容量が逼迫したら

不要なイメージ、コンテナなどを削除します。

```bash
# Docker の不要なイメージ、コンテナなどを削除する
docker system prune
```

### ポートが重複して起動しない場合

- PC を再起動します
- ポートを使用しているプロセスを調べて kill します
- docker-compose.yml の ports の左側の番号を変更します

※Apache がある日突然レスポンスを返さなくなった場合もポートの重複が原因の可能性が高い

### db コンテナが起動しない場合

下記のエラーで db コンテナが起動しない場合

```bash
2017-11-20 02:56:52 1 [ERROR] InnoDB: auto-extending data file ./ibdata1 is of a different size 0 pages
 MB) than specified in the .cnf file: initial 768 pages, max 0 (relevant if non-zero) pages!
2017-11-20 02:56:52 1 [ERROR] InnoDB: Could not open or create the system tablespace. If you tried to a
 to the system tablespace, and it failed here, you should now edit innodb_data_file_path in my.cnf back
and remove the new ibdata files InnoDB created in this failed attempt. InnoDB only wrote those files fu
did not yet use them in any way. But be careful: do not remove old data files which contain your precio
2017-11-20 02:56:52 1 [ERROR] Plugin 'InnoDB' init function returned error.
2017-11-20 02:56:52 1 [ERROR] Plugin 'InnoDB' registration as a STORAGE ENGINE failed.
2017-11-20 02:56:52 1 [ERROR] Unknown/unsupported storage engine: InnoDB
2017-11-20 02:56:52 1 [ERROR] Aborting
```

MySQL の古いデータを削除します。

```bash
# MySQLの以前のデータを削除する
rm -rf docker/db/mysql_data
```

Docker の不要なイメージ、コンテナ、ネットワーク、ボリュームを削除します。

```bash
# Docker コンテナの停止・削除
docker-compose down

# Docker の不要なイメージ、コンテナ、ネットワーク、ボリュームを削除する
docker system prune --volumes
```

MySQL のデータの同期をやめるために、 `docker-compose.yml` の下記 3 行目を削除します

```bash
db:
  volumes:
    - ./docker/db/mysql_data:/var/lib/mysql # ← この行を削除します
```

イメージから作成し直します。

```bash
# Docker イメージのビルド
docker-compose build

# Docker コンテナの起動
docker-compose up -d

# コンテナの起動状態を確認する
docker-compose ps
```
