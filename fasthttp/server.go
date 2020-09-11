package main

import (
	"fmt"
	"github.com/valyala/fasthttp"
    "database/sql"
    _ "github.com/go-sql-driver/mysql"
	"log"
	"math/rand"
)

type Tag struct {
    Title string `json:"post_title"`
}

func main() {
	// This function will be called by the server for each incoming request.
	//
	// RequestCtx provides a lot of functionality related to http request
	// processing. See RequestCtx docs for details.

	db, err := sql.Open("mysql", "root:hai2coders@tcp(localhost:3306)/news")

    // if there is an error opening the connection, handle it
    if err != nil {
        panic(err.Error())
    }

    // defer the close till after the main function has finished
    // executing
    defer db.Close()

    // perform a db.Query insert
	
	if err != nil {
        panic(err.Error())
    }
    // be careful deferring Queries if you are using transactions
	var tag Tag
	var ran = rand.Intn(100)
		// Execute the query
		err = db.QueryRow("SELECT post_title FROM posts where ID= ?", 300).Scan(&tag.Title)
		if err != nil {
			panic(err.Error()) // proper error handling instead of panic in your app
		}
	
	
		requestHandler := func(ctx *fasthttp.RequestCtx) {

		
		fmt.Fprintf(ctx, tag.Title, ran)
	}

	// Create custom server.
	s := &fasthttp.Server{
		Handler: requestHandler,

		// Every response will contain 'Server: My super server' header.
		Name: "My super server",

		// Other Server settings may be set here.
	}

	// Start the server listening for incoming requests on the given address.
	//
	// ListenAndServe returns only on error, so usually it blocks forever.
	if err := s.ListenAndServe("127.0.0.1:8087"); err != nil {
		log.Fatalf("error in ListenAndServe: %s", err)
	}
}
