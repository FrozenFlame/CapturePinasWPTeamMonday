Please make the following changes after importing:
1. SET column 'username' UNDER table users AS unique (already added this to initialise db)
2. ADD column 'title' UNDER table post (if you have installed before this update, otherwise, this is in the .sql script)
3. ADD column 'commentid' UNDER table postcomments (if you have installed before this update, otherwise, this is in the .sql script)
4. SET column 'timestamp' UNDER table post AS TIMESTAMP (already added this to initialise db)

==NEW==
5. removed "activated" column from table 'users'
6. removed "isMedia" column from table 'post'
7. changed *all dummy data

(please add/remove from this list if you guys find anything)