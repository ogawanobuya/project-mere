#開発メモ
## 参考サイト
### Symfonyを実装したDockerFile
- https://qiita.com/lnkusu/items/d6358885d868c00f977b
### DockerでLAMP構築
- https://php-archive.net/php/docker-php-environment/
### DockerでPHPとMySQL連携
- https://qiita.com/nikoniko/items/516b95c5944a19d8e16b
### 補足にLaravel版
- https://qiita.com/A-Kira/items/1c55ef689c0f91420e81

## デバックメモ
Docker関連
1. "../work-place:/var/www/html"は右(local内)左(docker内)のロケーション・ファイルは同じものということ
1. symfonyのprojectはdocker-compose php:volumes:の場所にできる(空じゃないとできない)
1. docker build でエラーが出ても空白や改行によるトラブルも多い
1. docker exec -it {container id} bin/bashでコンテナに入るということは/var/www/htmlに入るということ
1. phpmyadminのenvironmentは削除しておく
1. COPY で発生するエラーはファイルの場所が深く関わってる

DataBase関連
1. doctrine.yamlで接続設定
```
 dbal:
     # configure these for your database server
     driver: 'pdo_mysql'
     server_version: '5.7'
     charset: utf8mb4
     default_table_options:
         charset: utf8mb4
         collate: utf8mb4_unicode_ci
 
     url: '%env(resolve:DATABASE_URL)%'
     //DATABASE_URL=mysql://MYSQL_USER:MYSQL_PASSWORD@docker_service(db):3306/MYSQL_DATABASE
```
２. "./docker/mysql/data"を削除しないとDB名など設定が変わらない