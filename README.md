an API REST to manage a CRUD of a upload music page 

DB=> import from "database/db" (only "Tracks" and "Accounts" is avaiable for the API)

ENDPOINTS=> http://localhost/*local_folder*/WeWavRest/api/*table*/
    (tables= tracks, accounts)

QUERY PARAMS (only avaiable in collection querys)=> 
    order= sort by field (column in the table DB), dont includes the multi-tables querys created colums // string (for example "..api/tracks?order=name" or "..api/accounts?order=genre_id")

    desc= if it exists, sort descending, else sort ascending (for example "../api/tracks?desc", setting values ​​does not affect)

    limit= set a limit of results // int (for example "..api/tracks?limit=10")
        page (only avaiable if "limit" is setted)= browse results pages // int (for example "..api/tracks?limit=6&page=2")
    
    filter= filter by field (column in the table DB), using LIKE operator, includes the multi-tables querys created columns //  "TABLE ABBR"."FIELD":"QUERY" (for example "../api/tracks?filter=t.name:a", "../api/tracks?filter=g.id:1")

    TABLES ABBR=> 
                "t" for tracks
                "a" for accounts
                "g" for genres
                "c" for countries


ADMIN ACCOUNT ACCESS=>
    user name: web-2
    user AKA: WEB2
    password: web2tudai

