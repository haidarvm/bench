package app

import io.jooby.Kooby
import io.jooby.runApp

class App: Kooby({

  get("/") {
    "Welcome to Jooby!"
  }
})

fun main(args: Array<String>) {
  runApp(args, App::class)
}