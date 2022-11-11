an API REST to manage a CRUD of a upload music page

DB=> import from "database/db"

ENDPOINTS=> http://localhost/*local_folder*/WeWavAPI/api/*table*/
    (tables= tracks, accounts, genres, countries)

QUERY PARAMS=> 
    order= sort by field (column in the table DB) // string

    desc= if it exists, sort descending, else sort ascending

    limit & page // int
    
    filter= filter for field (column in the table DB)-> "TABLE ABBR"."FIELD":"QUERY" (for example "t.name:a" or "a.id:1")

TABLES ABBR=> 
            "t" for tracks
            "a" for accounts
            "g" for genres
            "c" for countries
