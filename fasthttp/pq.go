package main

import (
    "fmt"
    "database/sql"
    _ "github.com/go-sql-driver/mysql"
)

func main() {
    fmt.Println("Golang dengan MySQL")

    // Open database connection
    // The database is called test
    db, err := sql.Open("mysql", "root:hai2coders@tcp(localhost:3306)/news")

    // if there is an error opening the connection, handle it
    if err != nil {
        panic(err.Error())
    }

    // defer the close till after the main function has finished
    // executing
    defer db.Close()

    // perform a db.Query insert
    insert, err := db.Query("INSERT INTO posts (post_title) VALUES ('TEST' )")

    // if there is an error inserting, handle it
    if err != nil {
        panic(err.Error())
    }
    // be careful deferring Queries if you are using transactions
    defer insert.Close()


}
